<?php
function autoload($class){
    /*
    ':' on a UNIX system and ';' on a Windows system is PATH_SEPARATOR
    '/' on UNIX system and '\' on Windows is DIRECTORY_SEPARATOR constant.
    */
    $paths = explode(PATH_SEPARATOR,get_include_path());
    
    /*
    PREG_SPLIT_NO_EMPTY = only non-empty pieces will be returned by preg_split().
    PREG_SPLIT_DELIM_CAPTURE = parenthesized expression in the delimiter pattern will be captured and returned as well.
    */
    $flags = PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE;
    
    echo $file = strtolower(str_replace("\\",DIRECTORY_SEPARATOR,trim("test/deepak","\\"))).".php";
    
    foreach ($paths as $path) {
        $combined = $path.DIRECTORY_SEPARATOR.$file;
        if(file_exists($combined)){
            include($combined);
            return;
        }
    }
    throw new Exception("{$class} not found");
    
}

class Autoloader{
    public static function autoload($class){
        autoload($class);
    }
}

spl_autoload_register('autoload');//PHP to use the autoload() method to load a class file by name
spl_autoload_register(array('autoloader','autoload'));//PHP to use the Autoloader::autoload() method to load a class file by name

/*
calls to spl_autoload_register() tell PHP to use the autoload()
method, belonging to the class in which these spl_autoload_register() calls occur, to load a class file by name
*/
spl_autoload_register(array($this,'autoload'));
spl_autoload_register(__CLASS__.'::load');

