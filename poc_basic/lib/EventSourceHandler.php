<?php 
//starting session
session_start();

$_SESSION['username'] = "thatsme_".session_id();
$_SESSION['status']	= "online";

if(isset($_POST['eventId']) && isset($_POST['response'])){
	$_SESSION["event"][$_POST['eventId']]["response"] = $_POST['response'];
	echo "completed".json_encode($_SESSION["event"][$_POST['eventId']]);
	exit;
}


//set event source specific headers
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

//if any event requested
if(count($_SESSION['event'])>0){
	//get first request and process
	$index = array_keys($_SESSION['event'])[0];
	$event = $_SESSION['event'][$index];
	// file_put_contents("test.txt", json_encode($_SESSION));
	if(!isset($event['response']))
	echo "data:".$event['request']." \n\n";
	else
	echo "data: \n\n";
}
else
	echo "data: \n\n";



// if(isset($_SESSION['event']))
// 	echo "data: ".json_encode($_SESSION['event'])."\n\n";
// else
// 	echo "data: unset\n\n";

?>