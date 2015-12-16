<?php 

class EmailModule extends CoreFormModule implements OnCLickListener{
	public $id = "email";

	public function __construct() {
		parent::_initialize();
		$this->value = "example@domain.com";
	}

	public function onClick(){
		console::log($this->value);
	}
}


?>