<?php  

class OOJSMVC{

	public static function getJavascript($filename){
		$file_content = file_get_contents($filename);
		$class_info = explode(" ", substr($file_content, 0, strpos($file_content, "\n")));
		$function_name = $class_info[1];
		$javascript = "oojsmvc.$function_name = ";
			
		$counter = 0;	
		$index_var = -1;
		$index_function = -1;
		$class_content = substr($file_content, strpos($file_content, "{"));

		while($index_var && $index_function){	
			//convert properties
			$index_var = strpos($class_content, "var", $index_var+1);
			if($index_var){
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
		
		$javascript .= $class_content;
		return $javascript;
	}

}


$output_file .= "(function(){"."\n";
$output_file .= ""."\n";
$output_file .= "window.oojsmvc = new (function oojsmvc(){"."\n";
$output_file .= "	this.version = \"1.0.0\";"."\n";
$output_file .= "})();"."\n\n";

$output_file .= OOJSMVC::getJavascript("module/EmailModule.js")."\n";

$output_file .= "})();"."\n";

file_put_contents("oojsmvc.js", $output_file);

?>