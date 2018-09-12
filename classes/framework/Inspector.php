/**
The first few methods of our Inspector class use built-in PHP reflection classes to get the string values of
Doc Comments, and to get a list of the properties and methods of a class. If we only wanted the string values,
we could make the _getClassComment(), _getPropertyComment(), and _getMethodComment() methods public
*/
<?php
namespace Framework{
    use Framework\ArrayMethods as ArrayMethods;
    use Framework\StringMethods as StringMethods;

    class Inspector{
        protected $_class;
        protected $_meta = array(
            "class" => array(),
            "properties" => array(),
            "methods" => array()
        );

        protected $_properties = array();
        protected $_methods = array();
        
        public function __construct($class){
            $this->_class = $class;
        }

        protected function _getClassComment(){
            $reflection = new \ReflectionClass($this->_class);
            return $reflection->getDocComment();
        }
        protected function _getClassProperties(){
            $reflection = new \ReflectionClass($this->_class);
            return $reflection->getProperties();   
        }
        protected function _getClassMethods(){
            $reflection = new \ReflectionClass($this->_class);
            return $reflection->getMethods();
        }
        protected function _getPropertyComment($property){
            $reflection = new \ReflectionProperty($this->_class,$property);
            return $reflection->getDocComment();
        }
        protected function _getMethodComment($method){
            $reflection = new \ReflectionMethod($this->_class,$method);
            return $reflection->getDocComment();
        }

        protected function _parse($comment){
            $meta = array();
            $pattern = "(@[a-zA-Z]+\s*[a-zA-Z0-9, ()_]*)";
            $matches = StringMethods::match($comment,$pattern);

            if($matches != null){
                foreach ($matches as $match) {
                    $parts = ArrayMethods::clean(
                        ArrayMethods::trim(StringMethods::split($match,"[\s]",2)
                        )
                    );
                    $meta[$part[0]] = true;
                    if(sizeof($parts) > 1){
                        $meta[$parts[0]] = ArrayMethods::clean(
                            ArrayMethods::time(StringMethods::split($parts[1],","))
                        );
                    }
                }
            }
            return $meta;
        }
    }
}