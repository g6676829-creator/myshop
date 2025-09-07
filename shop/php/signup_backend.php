<?php
require("db.php");

$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$address = $_POST['address'];
$password = md5($_POST['password']);


//create table if not exists
$db->query("CREATE TABLE IF NOT EXISTS users (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, -- Unique ID for each user
    name VARCHAR(100) NOT NULL,        -- User's name
    phone VARCHAR(15) NOT NULL,        -- User's phone number
    email VARCHAR(100) NOT NULL UNIQUE, -- User's email address (must be unique)
	address MEDIUMTEXT,
    password VARCHAR(255) NOT NULL,    -- User's hashed password
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Timestamp for when the record is created
)
");

//check user
$check_user = $db->query("SELECT * FROM users WHERE email='$email'");
if($check_user->num_rows === 0)
{

	$store = $db->query("INSERT INTO users(name,phone,email,address,password)VALUES('$name','$phone','$email','$address','$password')");
	if($store)
	{
		echo "success";
	}
	else
	{
		echo "failed";
	}
}
else
{
	echo "user allready exist, please try again with another email id";
}

?>