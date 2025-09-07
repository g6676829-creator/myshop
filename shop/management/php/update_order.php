<?php
require("db.php");
//receive data

$oid=$_POST['oid'];
$btn_type=$_POST['btn_type'];
//update the received_order table
$update=$db->query("UPDATE received_order SET $btn_type='completed' WHERE id='$oid'");
if($update)
{
	echo "success";
}
else
{
	echo "failed: " . $db->error;
}

?>