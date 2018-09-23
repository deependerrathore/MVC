<?php

class Application{
    public function __construct(){
        $this->_set_reporting();
        $this->_unregister_globals();

    }

    private function _set_reporting(){
        if(DEBUG){
            error_reporting(E_ALL);
            ini_set('display_errors',1);
        }else{
            error_reporting(0);
            ini_set('display_errors',0);
            ini_set('log_errors',1);
            ini_set('error_log',ROOT . DS. 'tmp'. DS . 'logs' . DS . 'error.log');
        }
    }
    private function _unregister_globals(){
        if(ini_get('register_globals')){
            $globalsArray = ['_SESSION','_COOKIE','_ENV', '_POST','_GET','_FILES','_SERVER','_REQUEST'];
            foreach($globalsArray as $global){
                if(isset($GLOBALS[$global])){
                    foreach ($GLOBALS[$global] as $key => $value) {
                        if(isset($GLOBALS[$key])){
                            if($GLOBALS[$key] === $value){
                                unset($GLOBALS[$key]);
                            }
                        }
                    }
                }
            }
        }
    }
}