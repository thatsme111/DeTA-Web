<?php 
class Model{
	private $_id;
	public function __construct($id){
		echo "in model constructor";
		$this->_id = $id;
	}
	public function getAttribute($attribute){
		echo "data: getAttribute('".$this->_id."', '$attribute');\n\n";
	}
}
?>