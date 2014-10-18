<?php
define('BASE', 'http://'.$_SERVER['SERVER_NAME'].substr($_SERVER["SCRIPT_NAME"], 0, -9));
define('VERSION', '0.1');
define('TIME', microtime(true));

foreach(glob("./base/*.php") as $c) include($c);
foreach(glob("./config/*.php") as $c) include($c);

session_start();
ob_start();

$uri = route::uri();
if(isset($uri[1]))
	$route = route::getRoute($uri[0], $uri[1]);
elseif(isset($uri[0]))
  $route = route::getRoute($uri[0]);
else
	$route = route::getRoute();
list($class, $function) = explode('@', $route);
$class = str_replace('-', '_', $class);
$path = substr($_SERVER['SCRIPT_FILENAME'], 0, -9).'controllers/'.$class.'.php';
if(is_file($path)) include($path); else die('404 - Not found');
if(method_exists($class, $function))
	call_user_func_array(array($class, $function), route::args());
else die('404 - Not found');
