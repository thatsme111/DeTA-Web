<?php 

class BasicModule extends BaseModule{
	public $message;
	public function __construct(){
		$this->message = new BaseModel("message");
		$msg = $this->message->getProperty("innerHTML");
		file_put_contents("data.txt", $msg);
	}
}

?>