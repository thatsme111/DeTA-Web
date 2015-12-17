<?php 



class EmailModule extends CoreModule implements OnInputListener{
	public $_id = "email";

	public function __construct() {
		$this->value = "example@domain.com";
	}

	public function onInput(){
		console::log($this->value);
	}

}

class SubmitModule extends CoreModule implements OnClickListener{
	public $_id = "submit";
	public $_type = "submit";

	public function onClick(){
		console::log("submit module onclick");
	}
}

class LoginFormModule extends CoreModule implements OnSubmitListener{
	public $_id = "login_form";
	public function onSubmit($event){
		console::log($event);
	}	
}

?>