<?php 

interface OnClickListener{
	public function onClick();
}

class OOJSMVC{
	public static function generateJavascript(){
		$class_names = file_get_php_classes("modules.php");
		$classes = array();
		$javascript = "";

		foreach ($class_names as $key => $value) {
			$class = new $value;

			//create property_block
			$property_block = "";
			$instance = new $class;
			foreach ($class as $key => $value) {
				if(gettype($instance->$key) == "string"){
					$property_block .= "\tthis.$key=\"".$instance->$key."\";\n";
				}
			}
			//echo $property_block;

			//create method block
			$method_block = "";
			$methods = get_class_methods($class);
			foreach ($methods as $method) {
				if (substr($method, 0, 1)!="_") {
					$method_body = get_class_method_body("EmailModule", "onClick");
					$method_body = OOJSMVC::generateJavascriptFromFunctionString($method_body);
					$method_block .= "\tthis.$method = function(){\n$method_body\n\t}\n";
				}
			}
			// echo print_r(, true);

			// echo print_r($class, true);
			// $method_body = 
			// 


			$javascript = "function ".get_class($class)."(){\n".$property_block.$method_block."}";
			echo $javascript;
			$classes[] = $class;
			
		}
		return $classes;
	}
	public static function generateJavascriptFromFunctionString($function_string){
		
		$function_string = "<?php ".$function_string." ?>";
		// echo $function_string;
		$tokens = token_get_all($function_string);
		foreach ($tokens as $token) {
			echo $token[0]." ".$token[1]."\n";
		}
		return $function_string;
	}
}


class console{
	public static function log($data){
		return $data;
	}
}

class CoreFormModule{
	public function _generateJavascript(){
		echo get_class_methods($this);
	}
}

function get_class_method_body($class, $function){
  $func = new ReflectionMethod($class,$function);
  $filename = $func->getFileName();
  $start_line = $func->getStartLine();
  $end_line = $func->getEndLine()-1;
  $length = $end_line - $start_line;
  $source = file($filename);
  $body = implode("", array_slice($source, $start_line, $length));
  return $body;
}

function file_get_php_classes($filepath) {
	$php_code = file_get_contents($filepath);
	$classes = get_php_classes($php_code);
	return $classes;
}

function get_php_classes($php_code) {
	$classes = array();
	$tokens = token_get_all($php_code);
	$count = count($tokens);
	for ($i = 2; $i < $count; $i++) {
		if (   $tokens[$i - 2][0] == T_CLASS && $tokens[$i - 1][0] == T_WHITESPACE && $tokens[$i][0] == T_STRING){
			$class_name = $tokens[$i][1];
			$classes[] = $class_name;
		}
	}
	return $classes;
}


?>