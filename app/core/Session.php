<?php
declare(strict_types=1);

class Session extends SessionHandler {
    private static $_initialized = false;

    /**
     * Disallow public construction
     */
    private function __construct(){}
    
    public static function start($lifetime = 0, $path = '/', $domain = null, $httpOnly = true)
    {
        global $request;

        if (!self::$_initialized) {
            if (!is_object(Database::connect()) || !Database::connect()) {
                throw new Exception('Failed to start session, no Database found.');
            }

            // Get config
            $gcDivisor = 10;
            $strictDomain = 'yes';

            // Set php parameters
            if (@session_id() == '' && !headers_sent()) {
                ini_set('session.use_trans_sid', '0');
                ini_set('session.use_strict_mode', '1');
                ini_set('session.use_only_cookies', '1');
                ini_set('session.gc_maxlifetime', $lifetime);
                ini_set('session.gc_probability', '1');
                ini_set('session.gc_divisor', $gcDivisor);
            }

            // Register handler
            $handler = new Session;
            @session_set_save_handler(
                [$handler ,'open'],
                [$handler ,'close'],
                [$handler ,'read'],
                [$handler ,'write'],
                [$handler ,'destroy'],
                [$handler ,'gc']
            );

            // Set cookie parameters
            if ($strictDomain) {
                // setting the domain to null makes the cookie valid for the current host only
                $domain = null;
            } else {
                $domain = $domain ? : $handler->getDomain();
            }

            @session_set_cookie_params([
                'lifetime' => $lifetime,
                'path' => app('app', 'cache_path'),
                'domain' => $request->server['HTTP_HOST'],
                'secure' => true,
                'httponly' => true,
            ]);

            @session_cache_limiter('nocache');

            if (!@session_id()) {
                if (headers_sent()) {
                    throw new Exception('Headers already sent. Cannot start session.');
                }

                @register_shutdown_function('session_write_close');
                @session_start();
            }
            
            self::$_initialized = true;
        }

        return @session_id();
    }

    protected function createCookieSafePath($path): string|null
    {
        $path = array_filter(explode('/', $path));
        if (empty($path)) {
            return '/';
        }
        $path = array_map('rawurlencode', $path);
        return '/' . implode('/', $path);
    }

    public function getDomain(): mixed
    {
        if ($_SERVER['HTTP_HOST']) {
            if (preg_match('/(localhost|127\.0\.0\.1)/', $_SERVER['HTTP_HOST'])) {
                return null; // prevent problems on local setups
            }

            // Remove leading www and ending :port
            return preg_replace('/(^www\.|:\d+$)/i', '', $_SERVER['HTTP_HOST']);
        }

        return null;
    }

    public function open(string $savePath, string $sessionName): bool
    {
        return true;
    }

    public function close(): bool
    {
        return true;
    }

    public function write(string $id, string $data): bool
    {
        $session_data = $this->read($id);

        if (!$session_data) {
            $empty = true;
            if (function_exists('session_status') && session_status() === PHP_SESSION_ACTIVE) {
                $unserialized_data = $this->unserialize($data);

                foreach ($unserialized_data as $d) {
                    if (!empty($d)) {
                        $empty = false;
                    }
                }

                if ($empty) {
                    return true;
                }
            } elseif ($data === 'sts-' . '|a:0:{}') {
                return true;
            }
        }

        $fields = array(
            'session' => $session_data,
            'session_expires' => date('Y-m-d H:i:s', time()),
            'session_data' => $data
        );


        $sql = Database::connect()->prepare("INSERT INTO tbl_sessions(`session`, `session_expires`, `session_data`) VALUES ({$fields['session']}, {$fields['session_expires']}, {$fields['session_data']}) ON DUPLICATE KEY UPDATE session = session");
        dd($sql);
        $result  = $sql->execute();
        return $result ?? false;
    }

    private function unserialize($data)
    {
        $hasBuffer = isset($_SESSION);
        $buffer = $_SESSION;
        session_decode($data);
        $session = $_SESSION;

        if ($hasBuffer) {
            $_SESSION = $buffer;
        } else {
            unset($_SESSION);
        }

        return $session;
    }

    public function read(string $id): string
    {
        if (!$id) {
            return null;
        }

        $sql = Database::connect()->prepare("SELECT `session_data` FROM `tbl_sessions` WHERE `session` = '{$id}' LIMIT 0, 1");
        $sql->execute();
        $session = strval($sql->fetchColumn());
        return $session ?? $id;
    }

    public function destroy(string $id): bool
    {
        if (!$id) {
            return true;
        }

        $sql = Database::connect()->prepare("DELETE FROM `tbl_sessions` WHERE `session` = '{$id}'");
        return $sql->execute();
    }

    public function gc(int $max_lifetime): int|false
    {
        $sql = Database::connect()->prepare("DELETE FROM `tbl_sessions` WHERE `session_expires` <= ". time() - $max_lifetime ."");
        $sql->execute();
        return $sql->rowCount();
    }

    public static function put(string $key, string $keys, string $value) {
        if(!isset($_SESSION[$key])) {
            $_SESSION[$key] = array($keys => $value, 'registered' => time());
        } else {
            $_SESSION[$key] = array($keys => $value, 'registered' => time());
        }

        if(isset($keys)) {
            $_SESSION[$key] = $value;
        }
    }

    public static function all() {
        if(!isset($_SESSION)) return;

        return $_SESSION;
    }

    public static function get(string $key, $value = 'default') {
        if(!isset($_SESSION)) return;
        return $_SESSION[$key] ?? null;
    }

    public static function delete(string $key) {
        if(!isset($_SESSION)) return;
        
        unset($_SESSION[$key]);
    }

    public static function set(string $key, array $data = []) {
        if(!isset($_SESSION[$key]) && is_array($data)) {
            $_SESSION[$key] = $data;
        } else {
            $_SESSION[$key] = $data;
        }
        return false;
    }

    public static function showErrors(string $key = '') {
        $errors = [];

        if(isset($_SESSION[$key]) && is_array($_SESSION[$key])) {
            foreach($_SESSION[$key] as $keys => $value) {
                if(in_array($keys, [$_SESSION[$key][$keys], 'registered'])) {
                    continue;
                }

                if(!array_key_last($_SESSION[$key]))
                    $errors[] .= "$value<br />";
                else
                $errors[] .= "$value";
                
            }

            echo implode(" ", $errors);
            return true;
        }

        return false;
    }

    private static function expire() {
        foreach($_SESSION as $key => $data) {
            if(isset($_SESSION[$key]['registered'])) {
                if ((time() - $_SESSION[$key]['registered']) > (60 * 30)) {
                    unset($_SESSION[$key]['registered']);
                }
            } else {
                unset($_SESSION);
            }
        }

        return false;
    }
}