<?php
class Template {
    static $cache_enabled = false;

    public function __construct(
        protected string $viewPath,
        protected array $data = [],
        protected string $cache_path
    ) {}

	static function cache($file) {
		if (!file_exists(self::$cache_path)) {
		  	mkdir(self::$cache_path, 0744);
		}

        $cached_file = self::$cache_path . str_replace(array('/', '.html'), array('_', ''), $file . '.php');
	    if (!self::$cache_enabled || !file_exists($cached_file) || filemtime($cached_file) < filemtime($file)) {
			$code = self::includeFiles($file);
			$code = self::compileCode($code);
	        file_put_contents($cached_file, '<?php class_exists(\'' . __CLASS__ . '\') or exit; ?>' . PHP_EOL . $code);
	    }

		return $cached_file;
    }

    public function render(string $file, array $data = []) {
        $cached_file = self::cache($file);
	    extract($data, EXTR_SKIP);
	   	require $cached_file;
    }

    static function includeFiles($file) {
        $code = file_get_contents($file);
        preg_match_all('/{% ?(extends|include) ?\'?(.*?)\'? ?%}/i', $code, $matches, PREG_SET_ORDER);

		foreach ($matches as $value) {
			$code = str_replace($value[0], self::includeFiles($value[2]), $code);
		}

		return preg_replace('/{% ?(extends|include) ?\'?(.*?)\'? ?%}/i', '', $code);
    }

    /**
     * @param string $code
     * @return {% code %}
     */
    static function compilePHP($code) {
        return preg_replace('~\{%\s*(.+?)\s*\%}~is', '<?php $1 ?>', $code);
    }

    /**
     * @param string $code
     * @return {% code %}
     */
    static function compileEchos($code) {
        return preg_replace('~\{%\s*(.+?)\s*\%}~is', '<?php $1 ?>', $code);
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
			if (!array_key_exists($value[1], self::$data)) self::$data[$value[1]] = '';
			if (strpos($value[2], '@parent') === false) {
				self::$data[$value[1]] = $value[2];
			} else {
				self::$data[$value[1]] = str_replace('@parent', self::$data[$value[1]], $value[2]);
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
        foreach(self::$data as $block => $value) {
			$code = preg_replace('/{% ?yield ?' . $block . ' ?%}/', $value, $code);
		}
        
		return preg_replace('/{% ?yield ?(.*?) ?%}/i', '', $code);
    }

    static function compileCode($code) {
        $code = self::includeFiles($code);
        $code = self::compilePHP($code);
        $code = self::compileEchos($code);
        $code = self::compileEscapedEchos($code);
        $code = self::compileBlock($code);
        $code = self::compileYield($code);
        return $code;
    }
}