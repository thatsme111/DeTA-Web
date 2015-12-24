<?php 

class OOJSMVC{

	public function __construct(){

	}

	public static function generateJavascript(){
		$oojsmvc = new OOJSMVC;
		return generateJavascriptFromModules();
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