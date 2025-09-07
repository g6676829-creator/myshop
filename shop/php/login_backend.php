<?php
require("db.php");

$email = $_POST['email'];
$password = md5($_POST['password']);

$check_user = $db->query("SELECT email FROM users WHERE email='$email'");
if($check_user->num_rows != 0)
{
	$check = $db->query("SELECT email,password FROM users WHERE email='$email' AND password='$password'");
	if($check->num_rows !=0)
	{
		$c_email = base64_encode($email);
		$c_time = time()+(60*60*24*365);
		setcookie("_enter_u_",$c_email,$c_time,'/');
		echo "success";
	}
	else
	{
		echo "wrong password";
	}
}
else
{
	echo "user not found, please register !";
}

?>