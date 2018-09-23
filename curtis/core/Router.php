<?php

class Router{
    public static function route($url){
        //controller
        $controller = (isset($url[0]) && $url[0] != '')? ucfirst($url[0]) : DEFAULT_CONTROLLER ; // DEFAULT_CONTROLLER = Home in config/config.php
        $controller_name = $controller;
        array_shift($url);
        
        //action
        $action = (isset($url[0]) && $url[0] != '')? lcfirst($url[0]) . 'Action' : 'indexAction' ; 
        $action_name = $action;
        array_shift($url);
        
        //params
        $queryParams = $url;
        
        $dispatch = new $controller($controller_name,$action);

        if (method_exists($controller,$action)) {
            call_user_func_array([$dispatch,$action],$queryParams);// == $dispatch->registerAction($queryParams)
        }else{
            echo "{$action} does not exists in the controller {$controller}";
        }
        
    }
}