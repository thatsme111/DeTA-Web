<?php 
// require 'Core.php';
// require 'modules.php';

// $javascript = OOJSMVC::generateJavascript();
// // echo print_r($javascript, true);
// echo $javascript;

interface OnChangeListener{
	const event_OnChangeListener = "change";
	const handler_OnChangeListener = "onChange";
	public function onChange();
}


class CoreModule{
	public $value = "";
	public $_javascript = "";
	
	public function _initialize() {
		$this->_javascript = "";
		foreach (class_implements($this) as $interface_name) {
			
			$reflectionClass = new ReflectionClass ($interface_name);
			$constants_array = $reflectionClass->getConstants();
			$event = $constants_array["event_$interface_name"];
			$handler = $constants_array["handler_$interface_name"];
			
			$this->_javascript .= "\twindow.oojsmvc.".get_class($this).".element.addEventListener('$event', function(event){\n";
			$this->_javascript .= "\t\twindow.oojsmvc.".get_class($this).".$handler(event);\n";
			$this->_javascript .= "\t});\n";
		}
	}
	public function _generateJavascript(){
		echo get_class_methods($this);
	}
}

class EmailModule extends CoreModule implements OnChangeListener{
	apd_set_session_trace_socket(tcp_server, socket_type, port, debug_level)
	public $_id = "email";
	public $database;

	public function __construct() {
		$this->value = "example@domain.com";
		$this->database = array("one@domain.com", "two@domain.com", "three@domain.com");
	}

	public function onChange(){
		if($this->checkIfExists($this->value))
			echo "already exists";
		else
			echo "acceptable value";
	}

	public function checkIfExists($value){
		return in_array($value, $this->database);
	}	

}

$emailModule = new EmailModule;
// $emailModule->value = "test@domain.com";
// $emailModule->value = "two@domain.com";
$emailModule->onChange();





?>