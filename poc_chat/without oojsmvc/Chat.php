<?php 
session_start();

if(!isset($_SESSION['username'])){
	header("location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Chat</title>
	<link rel="stylesheet" href="../css/bootstrap.css">
	<style>
	.footer-content{
		padding:20px;
		background: #555;
	}
	</style>
	<script type="text/javascript">
	function addMessage(message,isMyMessage){
		var messageNode = document.createElement("span");
		messageNode.innerHTML = message;
		if(isMyMessage == true){
			messageNode.setAttribute("style", "display:block;min-width:200px;background:#006600;padding:10px;color:#FFF;text-align:right;");
			// console.log(message);
		}else{
			messageNode.setAttribute("style", "display:block;background:#3333FF;padding:10px;color:#FFF;text-align:left;");
		}
		document.getElementById('chat_box').appendChild(messageNode);

	}

	window.addEventListener("DOMContentLoaded",function(){
		document.getElementById('send_button').addEventListener('click', function(){
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (xhttp.readyState == 4 && xhttp.status == 200) {
					//console.log("response:"+xhttp.responseText);
				}
			};
			xhttp.open("POST", "backend.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("message="+document.getElementById('message').value);

			console.log("in send_button click");
			addMessage(document.getElementById('message').value, true);
		});
		source = new EventSource("backend.php");
		source.onmessage = function(event){
			addMessage(event.data, false);
		};	//onerror onopen
	});
	</script>
</head>
<body>
	<div class="container">
		<div class="jumbotron" id="chat_box">
			
		</div>
		<nav class="navbar navbar-default navbar-fixed-bottom" role="navigation">
    		<div class="footer-content row">
				<div class="input-group col-md-4 col-md-offset-4">
					<input type="text" id="message" name="message" class="form-control">
					<span class="input-group-btn">
				        <button id="send_button" class="btn btn-primary">Send</button>
				   	</span>	
				</div>
    		</div>
		</nav>
	</div>
</body>
</html>