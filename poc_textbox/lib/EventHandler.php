<?php 

session_start();

if(isset($_POST['response'])){
	$_SESSION['eventQueue']['response'] = $_POST['response'];
	echo "received:".$_POST['response'];
	exit;
}

//check if any pending request in queue, process it
if(count($_SESSION['eventQueue']) > 0){

	$event = $_SESSION['eventQueue'][0];
	$data = array("selector" => "textbox", "property" => $_SESSION['eventQueue']['request']);

	//set event source specific headers
	header('Content-Type: text/event-stream');
	header('Cache-Control: no-cache');

	//send request to browser
	echo "data: ".json_encode($data)." \n\n";	
}

?>