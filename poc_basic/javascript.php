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

	function getProperty(id, property){
		var data = "";
		switch(property){
			case "innerHTML": data = document.getElementById(id).innerHTML;
				break;
		}

		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
				console.log("getProperty_response:"+xhttp.responseText);
			}
		};
		xhttp.open("POST", "lib/EventSourceHandler.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("data="+data);
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
	    	// console.log(event.data);
	    	eval(event.data);
	    	//(function(){console.log(getAttribute('message',));})();
	        //document.getElementById("message").innerHTML += event.data + "<br>";
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