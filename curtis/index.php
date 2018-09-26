<?php

define('DS', DIRECTORY_SEPARATOR); //Windows = \
define('ROOT', __FILE__); //C:\Dev&Test\www\MVC\curtis\index.php
define('ROOT_DIR', __DIR__);//C:\Dev&Test\www\MVC\curtis
    
    
// load configuration and helper functions
require_once(ROOT_DIR . DS . 'config' . DS . 'config.php');
require_once(ROOT_DIR . DS . 'app' . DS . 'lib' . DS . 'helpers' . DS . 'functions.php');

// autoload the class
function autoload($className)
{
    if (file_exists(ROOT_DIR . DS . 'core' . DS . $className . '.php')) { //check for the files present in core folder

        require_once(ROOT_DIR . DS . 'core' . DS . $className . '.php');

    } elseif (file_exists(ROOT_DIR . DS . 'app' . DS . 'controllers' . DS . $className . '.php')) { // check the files present in app/contollers folder

        require_once(ROOT_DIR . DS . 'app' . DS . 'controllers' . DS . $className . '.php');

    } elseif (file_exists(ROOT_DIR . DS . 'app' . DS . 'models' . DS . $className . '.php')) { // check the files present in app/models folder

        require_once(ROOT_DIR . DS . 'app' . DS . 'models' . DS . $className . '.php');
    }
}


spl_autoload_register('autoload');
session_start();
$url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'], '/')) : [];

$db = DB::getInstance();

    
// Route the request
Router::route($url);