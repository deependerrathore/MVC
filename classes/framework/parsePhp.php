<?php
function parsePhp($path){
    $settings = array();
    include("{$path}.php");
    return $settings;
}
var_dump(parsePhp('config')) ;