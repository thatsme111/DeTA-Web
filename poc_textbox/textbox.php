<?php 
session_start();
$_SESSION['username'] = substr(session_id(), 0, 5);

if(!isset($_SESSION['eventQueue']))
	$_SESSION['eventQueue'] = [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>TextBox</title>
	<link rel="stylesheet" href="../css/bootstrap.css">
	<script type="text/javascript" src="../js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		
		var data = "";
		var processEvent = function(data){
			if(data.property){
				switch(data.property){
					case "value": data = document.getElementById(data.selector).value;
						break;
				}
			}
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (xhttp.readyState == 4 && xhttp.status == 200) {
					console.log("post response:"+xhttp.responseText);
				}
			};
			xhttp.open("POST", "lib/eventHandler.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("response="+data);
		};

		var eventSource = new EventSource("lib/eventHandler.php");
		eventSource.onmessage = function(event){
			var data = JSON.parse(event.data);
			processEvent(data);
		};
	});
	</script>
</head>
<body>
	<div class="container">
		<br><br>
		<input id="textbox" type="text" class="form-control">
	</div>
</body>
</html>