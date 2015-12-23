<?php 
session_start();

header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

$filename = "chat_stack.txt";
$file_handle = fopen($filename, "rw+");
$file_content = "";

while (($line = fgets($file_handle)) !== false) {
	$index_colon = strpos($line, ":");
	$receiver = substr($line, 0, $index_colon);
	$message_content = substr($line, $index_colon+1, strlen($line)-$index_colon);
	if($_SESSION['username'] == $receiver)
		echo "data: ".$message_content."\n\n";
	else
		$file_content .= $line;
}
file_put_contents($filename, $file_content);

if($_POST['message']){
	$content = file_get_contents($filename)."\n".$_SESSION['friend'].": ".$_POST['message'];
	file_put_contents($filename, $content);	
}

flush();
?>