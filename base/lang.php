<?php
class lang {
    
    public static $defaultLang = '';
    
    public static function setDefault($lang) {
        if(cookie::get('lang') == false) {
            $dir = substr($_SERVER['SCRIPT_FILENAME'], 0, -9).'lang/'.$lang;
            if(is_dir($dir)) {
                cookie::set('lang', $lang);
                echo cookie::get('lang');
            }
            echo 'set';
        }
    }
    
    public static function setLang($new) {
        $dir = substr($_SERVER['SCRIPT_FILENAME'], 0, -9).'lang/'.$new;
        if(is_dir($dir)) {
            cookie::set('lang', $new, true, 60 * 60 * 24 * 60 + time());
        }
    }
    public static function getLang() {
        return cookie::get('lang');
    }
    public static function get($name, $args) {
        $lang = self::getLang();
        $dir = substr($_SERVER['SCRIPT_FILENAME'], 0, -9).'lang/'.$lang.'/';
        $ex = explode('.', $name);
        if(is_file($dir.$ex[0].'.php')) {
            $ar = include($dir.$ex[0].'.php');
            $cur = $ar[$ex[1]];
            $ret = $cur;
            foreach($args as $k => $v) {
                $ret = str_replace(':'.$k.':', $v, $ret);
            }
            return $ret;
        }
    }
    
}