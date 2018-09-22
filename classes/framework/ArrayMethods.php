<?php
namespace Framework{
    class ArrayMethods{
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

        public static function toObject($array){
            $result = new \stdClass();
            foreach ($array as $key => $value) {
                if(is_array($value)){
                    $result->{$key} = self::toObject($value);
                }else{
                    $result->{$key} = $value;
                }
            }
            return $result;
        }
    }
    
}

?>