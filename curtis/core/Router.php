<?php

class Router{
    public static function route($url){
        //controller
        $controller = (isset($url[0]) && $url[0] != '')? ucfirst($url[0]) : DEFAULT_CONTROLLER ; // DEFAULT_CONTROLLER = Home in config/config.php
        $controller_name = $controller;
        array_shift($url);
        
        //action
        $action = (isset($url[0]) && $url[0] != '')? lcfirst($url[0]) . 'Action' : 'indexAction' ; 
        $action_name = (isset($url[0]) && $url[0] != '')? $url[0] : 'index';
        array_shift($url);
        
        //ACL check
        $grantAccess = self::hasAccess($controller_name,$action_name);

        if(!$grantAccess){
            $controller_name = $controller = ACCESS_RESTRICTED;
            $action = 'indexAction';
        }

        //params
        $queryParams = $url;
        
        if(class_exists($controller)){
            $dispatch = new $controller($controller_name,$action);
        }else{
            echo "CLASS ROUTER: {$controller} controller not found";
            die();
        }

        if (method_exists($controller,$action)) {
            call_user_func_array([$dispatch,$action],$queryParams);// == $dispatch->registerAction($queryParams)
        }else{
            echo "CLASS ROUTER: {$action} does not exists in the controller {$controller}";
        }
        
    }

    public static function redirect($location){
        if (!headers_sent()) {
            header('Location:'.PROJECT_ROOT.$location);
            exit();
        }else{
            echo '<script type="text/javascript">';
            echo 'window.location.href="'.PROJECT_ROOT.$location.'";';
            echo '<script>';
            echo '<noscript>';
            echo '<meta http-equiv="refresh" contect=0;url='.$location.'"/>';
            echo '</noscript>';
            exit();
        }
    }
    public static function hasAccess($controller_name,$action_name = 'index'){
        $acl_file = file_get_contents(ROOT_DIR. DS. 'app'. DS .'acl.json');
        $acl = json_decode($acl_file,true); //true will convert object to associative array
        $current_urer_acls = ["Guest"];
        $grantAccess = false;

        if(Session::exists(CURRENT_USER_SESSION_NAME)){
            $current_urer_acls[] = "LoggedIn";
            foreach(currentUser()->acls() as $a){
                $current_urer_acls[] = $a;
            }
        }

        foreach($current_urer_acls as $level){ //$level; = Guest,LoggedIn,Admin(FROM DB)
            if (array_key_exists($level,$acl) && array_key_exists($controller_name,$acl[$level])) {
                if (in_array($action_name,$acl[$level][$controller_name]) || in_array("*",$acl[$level][$controller_name])) {
                    $grantAccess = true;
                    break;
                }
            }
        }

        //Check for denied
        foreach($current_urer_acls as $level){
            $denied = $acl[$level]['denied'];
            if (!empty($denied) && array_key_exists($controller_name,$denied) && in_array($action_name,$denied[$controller_name])) {
                $grantAccess = false;
                break;
            }

        }

        return $grantAccess;

    }
}
