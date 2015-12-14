<?php  

class OOJSMVC{

	public static function getJavascript($filename){
		$file_content = file_get_contents($filename);
		$class_info = explode(" ", substr($file_content, 0, strpos($file_content, "\n")));
		$function_name = $class_info[1];
		$javascript = "oojsmvc.$function_name = ";
			
		$id = "";	
		$index_var = -1;
		$index_function = -1;
		$class_content = substr($file_content, strpos($file_content, "{"));

		while($index_var && $index_function){	
			//convert properties
			$index_var = strpos($class_content, "var", $index_var+1);
			if($index_var){
				//if property name is id then save it in $id
				$property_name = trim(substr($class_content, $index_var+4, strpos($class_content, "=", $index_var)-$index_var-4));
				if($property_name == "id"){
					$quote_start = strpos($class_content, "\"", $index_var);
					$quote_end = strpos($class_content, "\"", $quote_start+1);
					$id = substr($class_content, $quote_start+1, $quote_end-$quote_start-1);
				}

				$index_semi = strpos($class_content, ";", $index_var+1);
				$json = substr($class_content, $index_var+4, $index_semi-$index_var-4);
				$json = str_replace("=", ":", $json).",";
				$class_content = str_replace(substr($class_content, $index_var, $index_semi-$index_var+1), $json, $class_content);
			}
			
			//convert methods
			$index_function = strpos($class_content, "function");			
			while($index_function){
				if(substr($class_content, $index_function+8, 1)!="(")
					break;
				$index_function = strpos($class_content, "function", $index_function+1);			
			}
			if($index_function){
				$index_curly_close = strpos($class_content, "}", $index_function);
				$json = substr($class_content, $index_function, $index_curly_close-$index_function+1);
				$index_round_open = strpos($json, "(");
				$name = substr($json, 9, $index_round_open-9);
				$json = $name.":".str_replace(" $name", "", $json).",";
				$class_content = str_replace(substr($class_content, $index_function, $index_curly_close-$index_function+1), $json, $class_content);
			}
			// echo ($index_var?"T":"F").($index_function?"T":"F")." ";
		}

		//add parent property
		$index_curly_open = strpos($class_content, "{", $index_function);
		$class_content = "{\n\tcurr_instance: document.getElementById('".$id."'),".substr($class_content, 1);

		//replace this with curr_instance;
		$class_content = str_replace("this", "this.curr_instance", $class_content);

		$javascript .= "\n".$class_content.";";

		//set implements function to appropriate event handler
		$index_implements = 0;
		foreach ($class_info as $key => $value) {
			if($value == "implements")
				$index_implements = $key;
		}

		switch($class_info[$index_implements+1]){
			case 'OnClickListener':
				$javascript .= "\ndocument.getElementById('".$id."').addEventListener("
							."oojsmvc.".$class_info[$index_implements+1].".event,"
							."function(){\n\toojsmvc.".$class_info[$index_implements+1].".eventHandler(oojsmvc.".$class_info[1].");\n});";
				break;
		}
		return $javascript;
	}

}

$output_file = file_get_contents("vanilla_oojsmvc.js");
$generated_code = OOJSMVC::getJavascript("module/EmailModule.js");
$generated_code .= OOJSMVC::getJavascript("module/SubmitModule.js");
$output_file = str_replace("//::generated code::", $generated_code, $output_file);
file_put_contents("oojsmvc.js", $output_file);

?>