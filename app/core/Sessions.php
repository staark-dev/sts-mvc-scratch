<?php
class Sessions {

    static function all() {
        return $_SESSION;
    }
    static function get(string $key, $value = 'default') {
        return $_SESSION[$key] ?? null;
    }

    static function delete(string $key) {
        unset($_SESSION[$key]);
    }

    static function set(string $key, array $data = []) {
        if(!isset($_SESSION[$key]) && is_array($data)) {
            $_SESSION[$key] = $data;
        } else {
            $_SESSION[$key] = $data;
        }
        return false;
    }

    static function showErrors(string $key = '') {
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

    static function put(string $key, string $keys, string $value) {
        if(!isset($_SESSION[$key])) {
            $_SESSION[$key] = array($keys => $value, 'registered' => time());
        } else {
            $_SESSION[$key] = array($keys => $value, 'registered' => time());
        }

        if(isset($keys)) {
            $_SESSION[$key] = $value;
        }
    }

    static function expire() {
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

    static function session_start_timeout($timeout=5, $probability=100, $cookie_domain='/') {
        // Set the max lifetime
        ini_set("session.gc_maxlifetime", $timeout);
    
        // Set the session cookie to timout
        ini_set("session.cookie_lifetime", $timeout);
    
        $seperator = strstr(strtoupper(substr(PHP_OS, 0, 3)), "WIN") ? "\\" : "/";
        $path = basename('app/') . $seperator . "sessions";

        if(!file_exists($path)) {
            if(!mkdir($path, 600)) {
                trigger_error("Failed to create session save path directory '$path'. Check permissions.", E_USER_ERROR);
            }
        }
        ini_set("session.save_path", $path);
    
        // Set the chance to trigger the garbage collection.
        ini_set("session.gc_probability", $probability);
        ini_set("session.gc_divisor", 100); // Should always be 100
    
        // Start the session!
        session_start();
    
        // Renew the time left until this session times out.
        // If you skip this, the session will time out based
        // on the time when it was created, rather than when
        // it was last used.
        if(isset($_COOKIE[session_name()])) {
            setcookie(session_name(), $_COOKIE[session_name()], time() + $timeout, $cookie_domain);
        }
    }

    static function init() {
        self::session_start_timeout(60 * 60 * 15); // 15 minutes default
        self::expire(); // 5 minutes
    }
}