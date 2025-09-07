<?php
require("db.php");
$id = $_POST['id'];

$delete = $db->query("DELETE FROM `category` WHERE `category`.`id` = '$id'");

if($delete){
	echo "success";
}
else{
	echo "failed";
}


?>