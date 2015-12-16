<?php 

class EmailModule extends CoreFormModule {
	public $id = "email";
	public $defaultValue = "example@domain.com";
	public function onClick(){
		if(1==2)
			console::log("email module true");
		else
			console::log("email module false");
	}
}


?>