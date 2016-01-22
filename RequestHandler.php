<?php 


//require 'base.php';
session_start();

// $mysql = new Mysqli("localhost", "root", "", "detaweb");
// $request = "{\"selector\":\"#message\",\"property\":\"value\"}";
// $session_id = session_id();
// $query = "insert into event(session_from,session_to,request) values('123','".$session_id."','$request');";
// $result = $mysql->query($query);
// echo  $mysql->insert_id;
// exit;

header("Content-Type: text/event-stream");
function sendDataToBrowser($data){
	echo "data: $data\n\n";
}

$mysql = new Mysqli("localhost", "root", "", "detaweb");
$query = "select id,request from event where session='".session_id()."'";
$result = $mysql->query($query);
if($result->num_rows != 0){
	$row = $result->fetch_assoc();
	$row_data = json_decode($row["request"]);
	$row_data->event_id = $row["id"];
	$json = json_encode($row_data);
	sendDataToBrowser($json);
}

?>