<?php

namespace diversen\config;
/**
 * simple class for reading configuration
 */
class ary {

    public static $file = 'config.php';

    /**
     * array holding main vars
     * @var array 
     */
    public static $vars = array();

    /**
     * load config.php into $vars
     */
    public static function loadMain() {
        if (!file_exists(self::$file)) {
            die('create a config.php file');
        }
        self::$vars = include_once 'config.php';
    }

    /**
     * get a configuration value or a group of values
     * @param string $key key of array e.g. $config['database']
     * @param string $sub sub key of array e.g. $config['database']['default']
     * @return mixed
     */
    public static function get($key, $sub = null) {
        if (isset(self::$vars[$key][$sub])) {
            return self::$vars[$key][$sub];
        }

        if (isset(self::$vars[$key])) {
            return self::$vars[$key];
        }
        return null;
    }

    /**
     * sets a value in self::$vars[$key]
     * @param string $key
     * @param mixed $val
     */
    public static function set($key, $val) {
        self::$vars[$key] = $val;
    }
}

