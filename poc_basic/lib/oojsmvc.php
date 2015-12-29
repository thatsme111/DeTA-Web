<?php 

class BaseModel{
	private $_id;
	public function __construct($id){
		$this->_id = $id;
	}
	public function getId(){
		return $this->_id;
	}
	public function getProperty($property){
		//create event
		$event_string = "getProperty(".$this->_id.",$property)";
		//add to event array
		if(!isset($_SESSION['event']))
			$_SESSION['event'] = [];
		array_push($_SESSION['event'], array( "request"=>$event_string));
		//get current event index
		end($_SESSION['event']);
		$index = key($_SESSION);
		//until repose is set loop
		while(!isset($_SESSION['oojsmvc'][$index]["response"]));
		//remove event 
		unset($_SESSION['oojsmvc'][$index]);	
		//return response
		return $_SESSION['oojsmvc'][$index]["response"];
	}

}

class BaseModule{
	
	
}

class OOJSMVC{

	public function __construct(){

	}

	public static function generateJavascript(){
		$oojsmvc = new OOJSMVC;
		return $oojsmvc->generateJavascriptFromModules();
	}

	private function generateJavascriptFromModules(){
		$generated_code = "";
		$files = scandir("modules");
		foreach ($files as $module_file ) {
			if(!is_dir($module_file))
				$generated_code .= $this->processModule($module_file)."\n";
		}
		
		$output_file = file_get_contents("lib/vanilla_oojsmvc.js");
		$output_file = str_replace("//::generated code::", $generated_code, $output_file);
		
		return $output_file;
	}

	public function processModule($module_file){
		require "modules/$module_file";
		$class_name = substr($module_file, 0, strpos($module_file, ".php"));
		$this->modules[$class_name] = new $class_name;
		return $module_file;
	}
}

?>