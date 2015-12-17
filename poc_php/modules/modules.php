<?php 

class EmailModule extends CoreFormModule implements OnInputListener{
	public $_id = "email";

	public function __construct() {
		$this->value = "example@domain.com";
	}

	public function onInput(){
		console::log($this->value);
	}

}


?>