<?php
//namespace Traits;

trait Template {
    protected static array $blocks = [];

    private string $cache_path;

    private string $viewsPath;

    private bool $cache_status;
    
    public function getCache(string $fileName) {
        // Set Global Variables
        $this->cache_path = app('app', 'cache_path');
        $this->cache_status = app('app', 'cache_status');

        if (!file_exists($this->cache_path)) {
            mkdir($this->cache_path, 0744);
        }

        $cached_file = $this->cache_path . str_replace(array('/', '.html'), array('_', ''), $fileName . '.php');

        if (!$this->cache_status || !file_exists($cached_file) || filemtime($cached_file) < filemtime($fileName)) {
			$code = $this->includeFiles($fileName);
			$code = self::compileCode($code);
	        file_put_contents($cached_file, '<?php class_exists(\'' . __CLASS__ . '\') or exit; ?>' . PHP_EOL . $code);
	    }

		return $cached_file;
    }

    public function view(string $fileName, array $data = []) {
        $cached_file = $this->getCache($fileName);
        extract($data, EXTR_SKIP);
        require_once $cached_file;
    }

	private function includeFiles($fileName) {
        // Set Global Variables
        $this->viewsPath = app('app', 'views_path');

        if(!file_exists($this->viewsPath . $fileName . '.html'))
            throw new \Exception('Unable to open view file (' . $fileName . ') !', 0);

		$code = file_get_contents($this->viewsPath . $fileName . '.html');
        //var_dump($code);
		preg_match_all('/{% ?(extends|include) ?\'?(.*?)\'? ?%}/i', $code, $matches, PREG_SET_ORDER);

		foreach ($matches as $value) {
			$code = str_replace($value[0], $this->includeFiles($value[2]), $code);
		}

		$code = preg_replace('/{% ?(extends|include) ?\'?(.*?)\'? ?%}/i', '', $code);

		return $code;
	}

        /**
     * @param string $code
     * @return {% code %}
     */
    static function compilePHP($code) {
        $code = preg_replace('~\{%\s*(.+?)\s*\%}~is', '<?php $1; ?>', $code);
        $code = preg_replace('/@if\(\s*(.+?\(.*?\))\s*\)/i', '<?php if($1): ?>', $code);
        $code = preg_replace('/@elseif\(\s*(.+?\(.*?\))\s*\)/is', '<?php elseif($1): ?>', $code);
        $code = preg_replace('/@else/is', '<?php else: ?>', $code);
        $code = preg_replace('/@endif;/is', '<?php endif; ?>', $code);

        $code = preg_replace('/@\[\s*(.*?)\s*\]/is', '<?php $1; ?>', $code);
        $code = preg_replace('/@url\{(.+?)\|\s*(.+?\s*)\s*\}/is', '<a href="/user/accounts/$2/$1" class="user-link text-sm text-info">$2</a>', $code);
        $code = preg_replace('/@var\(\s*(.*?)\s*\)/is', '<?php print_r($1); ?>', $code);
        $code = preg_replace('/@user\(\s*(.*?)\s*\)/is', '<?php echo $data[\'$1\']; ?>', $code);

        $code = preg_replace('/@foreach\(\s*(.*?)\s*\)/is', '<?php foreach($1): ?>', $code);
        $code = preg_replace('/@endforeach/is', '<?php endforeach; ?>', $code);

        $code = preg_replace('/\<\!\-\- BEGIN \s*(.+?)\s*\\-\-\>/is', '<?php if(isset($$1)): ?>', $code);
        $code = preg_replace('/\<\!\-\- END \s*(.+?)\s*\\-\-\>/is', '<?php endif; ?>', $code);

        return $code;
    }

    /**
     * @param string $code
     * @return {% code %}
     */
    static function compileEchos($code) {
        return preg_replace('~\{%\s*(.+?)\s*\%}~is', '<?php echo $1 ?>', $code);
    }

    /**
     * @param string $code
     * @return {% code %}
     */
    static function compileEscapedEchos($code) {
        return preg_replace('~\{{{\s*(.+?)\s*\}}}~is', '<?php echo htmlentities($1, ENT_QUOTES, \'UTF-8\') ?>', $code);
    }

    /**
     * Blocks functions
     * @param string $code
     * @return {% block function %}
     * @return {% endblock %}
     */
    static function compileBlock($code) {
		preg_match_all('/{% ?block ?(.*?) ?%}(.*?){% ?endblock ?%}/is', $code, $matches, PREG_SET_ORDER);
		foreach ($matches as $value) {
			if (!array_key_exists($value[1], self::$blocks)) self::$blocks[$value[1]] = '';
			if (strpos($value[2], '@parent') === false) {
				self::$blocks[$value[1]] = $value[2];
			} else {
				self::$blocks[$value[1]] = str_replace('@parent', self::$blocks[$value[1]], $value[2]);
			}
			$code = str_replace($value[0], '', $code);
		}
        
		return $code;
    }

    /**
     * Yield functions
     * @param string $code
     * @return {% Yield block %}
     */
	static function compileYield($code) {
		foreach(self::$blocks as $block => $value) {
			$code = preg_replace('/{% ?yield ?' . $block . ' ?%}/', $value, $code);
		}

        $code = preg_replace('/@style\(\s*(.+?)\s*\)/is', \app('app', 'styles') . '/$1.css', $code);
        $code = preg_replace('/@jquery\(\s*(.+?)\s*\)/is', \app('app', 'jquery') . '/$1.js', $code);
		$code = preg_replace('/{% ?yield ?(.*?) ?%}/i', '', $code);
		return $code;
	}

	private static function compileCode($code) {
		$code = self::compileBlock($code);
		$code = self::compileYield($code);
		$code = self::compileEscapedEchos($code);
		$code = self::compileEchos($code);
		$code = self::compilePHP($code);
		return $code;
	}
}