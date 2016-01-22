<?php 

class EventManager{
	public $mysql;

	public function __construct(){
		$this->mysql = new Mysqli("localhost", "root", "", "detaweb");
	}

	public function removeEvent($event_id){
		$query = "delete from event where id=$event_id;";
		$this->mysql->query($query);
	}

	public function getResponse($event_id){
		$query = "select response from event where id=$event_id;";
		$result = $this->mysql->query($query);
		$row = $result->fetch_assoc();
		return $row["response"];
	}

	public function setRequest($data){
		//create json of request
		$request  = str_replace("'", "\'", json_encode($data));

		//session id to identify request
		$session_id = $_COOKIE["PHPSESSID"];
		$action = $data["action"];

		//insert request into mysql database
		$query = "insert into event(session,request,action) values('$session_id','$request','$action');";
		$result = $this->mysql->query($query);

		//return event id for furture processing
		return  $this->mysql->insert_id;
	}
}



class BaseModel extends EventManager{
	public function __construct(){
		parent::__construct();
	}
}



class FormModel extends BaseModel{
	private $selector;

	public function __construct($selector){
		parent::__construct();
		$this->selector = $selector;
	}

	public function set($property, $value){
		$data = array("selector"=>$this->selector, "property" => $property, "action" => "SET", "value" => $value);
		$id = $this->setRequest($data);
		$response = $this->getResponse($id);
		while($response == ""){
			sleep(1);
			$response = $this->getResponse($id);
		}
		$this->removeEvent($id);
	}

	public function get($property){
		$data = array("selector"=>$this->selector, "property" => $property, "action" => "GET");
		$id = $this->setRequest($data);
		$response = $this->getResponse($id);
		
		while($response == ""){
			sleep(1);
			$response = $this->getResponse($id);
		}

		$this->removeEvent($id);
		return $response;
	}
}



class BaseController extends EventManager{

	public function __construct(){
		parent::__construct();
	}

	public function execute($command){
		$data = array("command" => $command, "action" => "EXEC");
		$id = $this->setRequest($data);
		$response = $this->getResponse($id);
		
		while($response == ""){
			sleep(1);
			$response = $this->getResponse($id);
		}

		$this->removeEvent($id);
		return $response;
	}
}



class TestController extends BaseController{
	
	public function __construct(){
		parent::__construct();
		$board = new FormModel("#board");
		$message = new FormModel("#message");
		// $value = $message->get("value");
		// $board->set("innerHTML", "something else than this");
		$this->execute("alert('thatsme');");

		// file_put_contents("value.log", "$value\n", FILE_APPEND);
	}

}

// $message = new FormModel("message");
// $value = $message->get("id");
// echo "id{$value}";
new TestController();

?>