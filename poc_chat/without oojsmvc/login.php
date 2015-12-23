<?php 
// echo "<pre>".print_r($_GET, true)."</pre>";

session_start();

$users = [	["username" => "shailesh", "password" => "shailesh"],
			["username" => "nikhil", "password" => "nikhil"],
			["username" => "admin", "password" => "admin"]];

if(isset($_POST['username']) && isset($_POST['password'])){
	foreach ($users as $user) {
		if(($_POST['username'] == $user['username']) && ($_POST['password'] == $user['password'])){
			$_SESSION['username'] = $_POST['username'];
			if($_SESSION['username'] == "shailesh")
				$_SESSION['friend'] = "nikhil";
			if($_SESSION['username'] == "nikhil")
				$_SESSION['friend'] = "shailesh";
			header("location: chat.php");
		}else{
			$error_message = "Invalid username and password";
		}
	}
}	
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Chat Login</title>
	<link rel="stylesheet" href="../css/bootstrap.css">
</head>
<body>
	<div class="container">
		<br><br>
		<div class="jumbotron">
			<h2>Chat Login</h2>
			<form action="login.php" method="post">
				<div class="form-group">
					<label for="email">Email:</label>
					<input name="username" type="input" class="form-control" placeholder="Enter username" id="username" />
				</div>
				<div class="form-group">
					<label for="password">Password:</label>
					<input name="password" class="form-control" type="password" id="password" placeholder="Enter Password"/>
				</div>
				<div class="form-group">
					<button class="btn btn-primary btn-block" type="submit" id="submit">Submit</button>
				</div>
			</form>
		</div>
	</div>
</body>
</html>