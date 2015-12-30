<?php 
define("SESSION_DELIM", "|");
function unserialize_php($session_data) {
    $return_data = array();
    $offset = 0;
    while ($offset < strlen($session_data)) {
        if (!strstr(substr($session_data, $offset), "|")) {
            throw new Exception("invalid data, remaining: " . substr($session_data, $offset));
        }
        $pos = strpos($session_data, "|", $offset);
        $num = $pos - $offset;
        $varname = substr($session_data, $offset, $num);
        $offset += $num + 1;
        $data = unserialize(substr($session_data, $offset));
        $return_data[$varname] = $data;
        $offset += strlen(serialize($data));
    }
    return $return_data;
}

if(isset($_POST['request'])){
	$session_file = session_save_path().DIRECTORY_SEPARATOR."sess_".$_POST['sessionId'];
	$session_data = unserialize_php(file_get_contents($session_file));
	
	echo "<pre>".print_r($session_data, true)."</pre>";
	exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Admin Panel</title>
	<link rel="stylesheet" href="../css/bootstrap.css">
</head>
<body>
	<div class="container">
		<div class="jumbotron">
			<br>
			<h3>Admin</h3>
			<div class="form-group">
				<label>Current sessions:</label><br>
			<?php 
				
				$files = scandir(session_save_path());
				foreach ($files as $file){
					if(substr($file, 0, 5) == "sess_" /*&& $file != "sess_4rih4e5l9d115jimcil2jj60k71gdndk"*/){
						$session_id = substr($file, 5);
						$session_file = session_save_path().DIRECTORY_SEPARATOR.$file;
						$session_data = unserialize_php(file_get_contents($session_file), true);
						// $username = $session_data['username'];
						echo "<input type='radio' name='sessions' value='$session_id'>$session_id<br>";
					}
				}
			?>
			</div>
			<div class="form-group">
				<input type="button" id="button" class="btn btn-primary" value="Get Message"><br>
				<span id="message"></span>
			</div>
		</div>
	</div>
<script type="text/javascript">
	window.addEventListener("DOMContentLoaded", function(){
		document.getElementById('button').addEventListener("click", function(){
			document.getElementById('message').innerHTML = "";
			var sessions = document.getElementsByName('sessions');
			for(index=0; index<sessions.length; index++){
				if(sessions[index].checked){
					var xhttp = new XMLHttpRequest();
					xhttp.onreadystatechange = function() {
						if (xhttp.readyState == 4 && xhttp.status == 200) {
							document.getElementById('message').innerHTML = xhttp.responseText;
							// console.log(xhttp.responseText);
						}
					};
					xhttp.open("POST", "admin.php", true);
					xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					var request = {
						"selector" = "textbox",
						"property" = "value",
						"sessionId"= sessions[index].value,
					};
					xhttp.send("sessionId="+sessions[index].value);
				}
			}
		});
	});
</script>
</body>
</html>