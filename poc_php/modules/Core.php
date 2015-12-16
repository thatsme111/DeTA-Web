<?php 

interface OnClickListener{
	const event_OnClickListener = "click";
	const handler_OnClickListener = "onClick";
	public function onClick();
}


interface OnChangeListener{
	const event_OnChangeListener = "change";
	const handler_OnChangeListener = "onChange";
	public function onChange();
}

class console{
	public static function log($data){}
}


class OOJSMVC{
	public static function generateJavascript(){
		$class_names = file_get_php_classes("modules.php");
		$classes = array();
		$javascript = "";

		foreach ($class_names as $key => $value) {
			$class = new $value; $class->onClick();

			//create property_block
			$property_block = "";
			$instance = new $class;

			//add element property
			if(isset($instance->id)){
				$property_block .= "\t\tthis.element = document.getElementById('".$instance->id."');\n";
			}
			
			//add userdefined properties
			foreach ($class as $key => $value) {

				if(gettype($instance->$key) == "string" && substr($key, 0, 1) != "_"){
					$property_block .= "\t\tthis.$key=\"".$instance->$key."\";\n";
				}
			}

			//create method block
			$method_block = "";
			$methods = get_class_methods($class);
			$isConstructorDefined = false;
			foreach ($methods as $method) {
				if(substr($method, 0, 1)!="_"){
					$method_body = get_class_method_body("EmailModule", "onClick");
					$method_body = OOJSMVC::generateJavascriptFromFunctionString($method_body);
					$method_block .= "\t\tthis.$method = function(){\n\t$method_body\n\t\t}\n";
				}
			}
			$javascript = "function ".get_class($class)."(){\n".$property_block.$method_block."\t}\n";

			//add create object and append it to window.oojsmvc
			$javascript .= "\twindow.oojsmvc.".get_class($class)."= new ".get_class($class)."();\n";

			//add implements code
			$javascript .= $instance->_javascript;

			// echo $javascript;
			$classes[] = $class;
		}

		//add to vanilla javascript
		$output_file = file_get_contents("../vanilla_oojsmvc.js");
		$output_file = str_replace("/*::generated code::*/", $javascript, $output_file);
		return $output_file;
	}

	public static function generateJavascriptFromFunctionString($method_body){
		$tokens = token_get_all("<?php ".$method_body." ?>");
		$javascript = "";
		//echo "token name:".token_name(310)."\n";
		foreach ($tokens as $token) {  
			// echo print_r($token, true);
			if(is_int($token[0])){
				// echo token_name($token[0])." ".$token[1]."\n";
				switch($token[0]){
					case T_OPEN_TAG:
						break;					
					case T_CLOSE_TAG:
						break;
					case T_VARIABLE:
						if($token[1] == "\$this")
							$javascript .= "this.element";
						break;
					case T_DOUBLE_COLON:
						$javascript .= ".";
						break;
					case T_OBJECT_OPERATOR:
						$javascript .= ".";
						break;	
					default:
						if(isset($token[1]))
							$javascript .= $token[1];
				}
			}else{ //token is not array
				$javascript .= $token;
			}
		}
		return $javascript;
	}
}



class CoreFormModule{
	public $value = "";
	public $_javascript = "";
	public function _initialize() {
		foreach (class_implements($this) as $interface_name) {
			$reflectionClass = new ReflectionClass ($interface_name);
			$constants_array = $reflectionClass->getConstants();
			$event = $constants_array["event_$interface_name"];
			$handler = $constants_array["handler_$interface_name"];
			$this->_javascript = "";
			$this->_javascript .= "\twindow.oojsmvc.EmailModule.element.addEventListener('$event', function(){\n";
			$this->_javascript .= "\t\twindow.oojsmvc.EmailModule.$handler();\n";
			$this->_javascript .= "\t});\n";
		}
	}
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