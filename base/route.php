<?php
class route {
    /*
        uri( void ) Get the current page
        args( num<int> ) Get the args, use num to select a number
        getRoute( class<text>, function<text> ) Get the route for the class and function
        setRoute( key<text>, val<text> ) Set a route
        delRoute( key<text> ) Remove a route
    */
    public static $routes = array();
    
    public static function uri() {
    	$uri = explode('/', $_SERVER['REQUEST_URI']);
    	$url = $uri;
    	$script = explode('/', $_SERVER["SCRIPT_NAME"]);
    	array_pop($script);
    	$scr = $script;
    	for($i = 0; $i < count($scr); $i++)
    	array_shift($url);
    	return $url;
    }
    public static function args($num=false) {
        $uri = route::uri();
        unset($uri[0], $uri[1]);
        $args = array();
        foreach($uri as $arg) {
        	if($arg !== '') $args[] = $arg;
        }
        if($num == false) return $args;
        else return $args[$num];
    }
    
    public static function getRoute($c=false, $f=false) {
        if(!$c) {
            return self::$routes[''];
        }
        if(isset(self::$routes[$c.'@'.$f])) {
            return self::$routes[$c.'@'.$f];
        } elseif(isset(self::$routes[$c])) {
            return self::$routes[$c];
        } else {
            if($f == false) return $c.'@index';
            else return $c.'@'.$f;
        }
    }
    
    public static function setRoute($key, $val) {
        self::$routes[$key] = $val;
    }
    
    public static function delRoute($key) {
        unset(self::$routes[$key]);
    }
    
}