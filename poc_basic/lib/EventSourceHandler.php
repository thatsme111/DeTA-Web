<?php 
//starting session
session_start();
$_SESSION['username'] = "thatsme_".session_id();
$_SESSION['status']	= "online";

if(isset($_POST['data'])){
	echo $_POST['data'];
	exit;
}


//set event source specific headers
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

//create database connection
$conn = new mysqli("localhost", "root", "", "oojsmvc");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM message where session_id = '".session_id()."' limit 1;";
$result = $conn->query($sql);

if($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "data: ".$row['data']."\n\n";
} 
$conn->close();



?>