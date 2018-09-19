<?php
require('Base.php');
require('Inspector.php');

class Hello extends Framework\Base{
    /**
     * @readwrite
     */
    protected $_world;
    public function setWorld($value){
        echo "your setter is being called!";
        $this->_world = $value;
    }
    public function getWorld(){
        echo "your getting is being called!";
        return $this->_world;
    }
}

$hello = new Hello();
$hello->world = "foo!";
echo $hello->world;