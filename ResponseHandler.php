<?php 

//7:24 => Thu 21-Jan-2016 02:54:51pm
$timestamp = date("D d-M-Y h:i:sa", time());
$post  = json_encode($_POST);

file_put_contents("response.log", "[$timestamp] $post\n", FILE_APPEND);

$mysql = new Mysqli("localhost", "root", "", "detaweb");
$event_id = $_POST['event_id'];
$response = $_POST['response'];

$query_update = "update event set response = \"$response\" where id = $event_id";
$mysql->query($query_update);


?>