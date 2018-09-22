<?php
class Database{
    protected $_instance;
    public function getInstance(){
        throw new Exception("Instance is protected");
    }
    public function setInstance($instance){
        if($instance instanceof mysqli){
            $this->_instance = $instance;
        }
        throw new Exception("Instance must be of type Mysqli");
    }
    public function __construct($host,$username,$password,$schema){
        $this->_instance = new mysqli($host,$username,$password,$schema);
    }
    public function query($sql){
        return $this->_instance->query($sql);
    }
}

?>