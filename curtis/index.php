<?php
    session_start();
    define('DS',DIRECTORY_SEPARATOR); //Windows = \
    define('ROOT',__FILE__); //C:\Dev&Test\www\MVC\curtis\index.php
    define('ROOT_DIR',__DIR__);//C:\Dev&Test\www\MVC\curtis
    
    $url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'],'/'))  : [];

    require_once(ROOT_DIR. DS . 'core' . DS . 'bootstrap.php');