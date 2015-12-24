<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="stylesheet" href="../../css/bootstrap.css">
	<style>
	.footer-content{
		padding:20px;
		background: #555;
	}
	</style>
</head>
<body>
	<div class="container">
		<div class="jumbotron" id="chat_box"></div>
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