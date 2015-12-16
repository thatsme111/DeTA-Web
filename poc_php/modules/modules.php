<?php 

class EmailModule extends CoreFormModule {
	public $id = "email";

	public function __construct() {
		$this->value = "example@domain.com";
	}

	public function onClick(){
		console::log($this->value);
	}
}


?>