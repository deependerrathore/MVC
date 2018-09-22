<?php 
namespace Framework{
    include ('Base.php');
    use Framework\Base as Base;
    use Framework\Configuration\Exception as Exception;
    class Configuration extends Base{
        /**
         * @readwrite
         */
        protected $_type;
        
        /**
         * @readwrite
         */
        protected $_options;

        protected function _getExceptionForImplementation($method){
            throw new Exception\Impementation("{$method} method not implemented");
        }
        public function initialize(){
            if(!$this->type){
                throw new Exception\Argument("Invalid type");
            }
            switch ($this->type) {
                case 'ini':
                    return new Configuration\Driver\Ini($this->options);
                    break;
                
                default:    
                    throw new Exception\Argument("Invalid type");
                    break;
            }
        }

        public function __construct(){
            $configuration = new Framework\Configuration(array(
                "type" => "ini"
            ));
            $configuration = $configuration->initialize();
        }
    }
    
}

namespace Framework\Configuration{
    use Framework\Base as Base;
    use Framework\Configuration\Exception as Exception;
    class Driver extends Base{
        protected $_parsed = array();
        public function initialize(){
            return $this;
        }
        protected function _getExceptionForImlementation($method){
            return new Exception\Implementation("{$method} method not implementated");
        }
    }
}

namespace Framework\Configuration\Driver{
    use Framework\ArrayMethods as ArrayMethods;
    use Framework\Configuration as Configuration;
    use Framework\Configuration\Exception as Exception;
    class Ini extends Configuration\Driver{
        public function parse($path){
            if(empty($path)){
                throw new Exception\Argument("\$path argument is not valid");
            }
            if(!isset($this->_parsed[$path])){
                $config = array();
                ob_start();
                include("{$path}.ini");
                $string = ob_get_contents();
                ob_end_clean();

                $pairs = parse_ini_string($string);
                if($pairs == false){
                    throw new Exception\Syntax("Could not parse configuration file");
                }
                foreach ($pairs as $key => $value) {
                    $config = $this->_pair($config,$key,$value);
                }
                $this->_parsed[$path] = ArrayMethods::toObject($config);
            }
            return $this->_parsed[$path];
        }
        protected function _pair($config, $key,$value){
            if(strstr($key,".")){
                $parts = explode(".",$key,2);
                if(empty($config[$parts[0]])){
                    $config[$parts[0]] = array();
                }
                $config[$parts[0]] = $this->_pair($config[$parts[0]],$parts[1],$vlaue);
                
            }else{
                $config[$key] = $vlaue;
            }
            return $config;
        }
    }
}
?>