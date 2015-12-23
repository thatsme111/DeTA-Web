(function(){
	window.DeTAWeb = new (function(){
		this.version = "1.0.4";
		// this.source = new EventSource("server.php");
		// this.source.onmessage = function(event){
		// 	(event.data)();
		// 	// console.log(window.DeTAWeb.source.onmessage);
		// };	//onerror onopen
		this.token = "123456789";
		this.exec = function(id, attribute, value){
			if(typeof value === "undefined"){
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (xhttp.readyState == 4 && xhttp.status == 200) {
						console.log("response:"+xhttp.responseText);
					}
				};
				xhttp.open("GET", "server.php?token="+this.token, true);
				xhttp.send();
			}else{
				document.getElementById(id).setAttribute(attribute, value);
			}
			console.log(id+" "+attribute+" "+value);
		};
	});
	window.addEventListener("DOMContentLoaded", function(){
		var event = {
			data: "window.DeTAWeb.exec('email','value','shailesh.nighojkar@gslab.com')",
		};
		eval(event.data);
		event.data = "window.DeTAWeb.exec('email','value')";
		eval(event.data);
	});

	
})();