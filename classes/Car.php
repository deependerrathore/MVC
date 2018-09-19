<?php 
class Car extends Framework\Base{
    /**
     * @readwrite
     */
    protected $_color;
    /**
     * $write
     */
    protected $_model;

}

$car = new Car();
$car->setColor("blue")->setModel("b-class");
echo $car->getColor();