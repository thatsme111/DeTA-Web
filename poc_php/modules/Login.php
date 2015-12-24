<?php 
$email = $_POST['email'];
$password = $_POST['password'];

if($email="example@domain.com" && $password=="123"){
	echo "login successfull";
}
else
	echo "login failed";
?>