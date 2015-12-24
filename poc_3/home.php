<html>
<head>
	<title>Object Oriented Javascript MVC</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<!-- // <script type="text/javascript" src="modules/Controller.php"></script> -->

</head>
<body>
	<div class="container">
		<br><br>
		<div class="jumbotron">
			<!--h2>Object Oriented Javascript MVC</h2>
			<form action="modules/Login.php" method="post" id="login_form">
				<div class="form-group">
					<label for="email">Email:</label>
					<input name="email" type="email" class="form-control" placeholder="Enter Email Address" id="email" />
				</div>
				<div class="form-group">
					<label for="password">Password:</label>
					<input name="password" class="form-control" type="password" id="password" placeholder="Enter Password"/>
				</div>
				<div class="form-group">
					<button class="btn btn-primary btn-block" type="submit" value="submit" id="submit">Submit  </button>
				</div>
			</form-->
			<?php 
				$browser = get_browser(null, true);
				echo "<pre>".print_r($browser,true)."</pre>";
			?>
		</div>
	</div>
</body>
</html>

