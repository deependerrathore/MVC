<?php
namespace Framework{
    class ArrayMethod{
        private function __construct(){
            // do nothing
        }
        private function __clone(){
            // do nothing
        }
        //array_filter — Filters elements of an array using a callback function
        public static function clean($array){
            return array_filter($array,function($item){
                return !empty($item);
            });
        }

        //array_map — Applies the callback to the elements of the given arrays
        public static function trim($array){
            return array_map(function($item){ 
                return trim($item);
            },$array);
        }
    }
    
}