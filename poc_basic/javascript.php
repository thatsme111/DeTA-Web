<?php 

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Basic</title>
	<script type="text/javascript">

	function getAttribute(id, attribute){
		return document.getElementById(id).getAttribute(attribute);
	}

	function getProperty(eventId, elementId, property){
		var data = "";
		switch(property){
			case "innerHTML": data = document.getElementById(elementId).innerHTML;
				break;
		}

		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
				console.log("post response:"+xhttp.responseText);
			}
		};
		xhttp.open("POST", "lib/EventSourceHandler.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("eventId="+eventId+"&response="+data);
	}

	function setProperty(id, property, value){
		switch(property){
			case "innerHTML": document.getElementById(id).innerHTML = value;
				break;
		}
	}

	if(typeof(EventSource) !== "undefined") {
	    var source = new EventSource("lib/EventSourceHandler.php");
	    source.onmessage = function(event) {
	    	// var value = eval(event.data);
	    	if(event.data !== ""){
	    		eval(event.data);
	    		console.log(event.data);
	    	}
	    		
	    };
	}else{
	    document.getElementById("message").innerHTML = "Sorry, your browser does not support server-sent events...";
	}
	</script>
</head>
<body>
	<div id="message">some message</div>
</body>
</html>