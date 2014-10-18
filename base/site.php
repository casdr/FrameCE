<?php
class site {
    /*
        name( void ) Get the website name
    */
    public static $name = false;
    
    public static function name() {
        if(self::$name !== false) return self::$name;
        else return 'New Site';
    }
}