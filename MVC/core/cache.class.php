<?php
class Cache {
    
    public static $cache_dir = ROOT . DS . 'cache';
    
    public function __construct() {
        
	}
    
    public static function set($value, $data) {
        $file_path = self::path($value);
        if (($file = fopen($file_path, "w+")) !== FALSE) {
            fwrite($file, $data);
            fclose($file);
            return TRUE;
        }
        return FALSE;
    }
    
    public static function get($value) {
        $file_path = self::path($value);
        if (is_file($file_path)) {
            if (($file = fopen($file_path, 'r')) !== FALSE) {
                if ($contents = fread($file, filesize($file_path))) {
                    $data = unserialize($contents);
                    return $data;
                }
            }
        }
        return FALSE;
    }
    
    public static function clean($value = '') {
        if ($value == '') {
            $dh = opendir(Cache::$cache_dir);
            while ($file = readdir($dh)) {
                if ($file != "." && $file != "..") {
                    $fullpath = Cache::$cache_dir."/".$file;
                    if (!is_dir($fullpath)) {
                        unlink($fullpath);
                    }
                }
            }
            return;
        }
        $file_path = self::path($value);
        if (is_file($file_path) && unlink($file_path)) {
            return TRUE;
        }else {
            return FALSE;
        }
    }
    
    public static function getKey($value) {
        return md5($value);
    }
    
    public static function path($value) {
        $key = Cache::getKey($value);
        $file_path = Cache::$cache_dir . DS . $key;
        return $file_path;
    }
}