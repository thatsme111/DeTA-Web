<?php  

class ChatModule extends CoreModule{

	public $message;

	public function __construct(){
		$this->message = new Model("message");
		echo $this->message->getAttribute("value");	
	}


}
?>

