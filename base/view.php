<?php
class view {
    /*
        add( <string>name, <array> arguments ) Add a view
    */
    
    public static function add($view, $args = array()) {
        
        $view = str_replace('.', '/', $view);
        $path = substr($_SERVER['SCRIPT_FILENAME'], 0, -9).'views/'.$view.'.php';
        
        if(is_file($path)) {
            foreach($args as $a => $b) $$a = $b;
            include($path);
        } else {
            die('404 - Not found');
        }
    }
    
}