<?php
require("db.php");
$cat_id = $_POST['edit_cat_id'];
$cat_name = $_POST['edit_cat_name'];
$cat_url = strtolower($cat_name);
$cat_url = str_replace(' ', '-', $cat_url);


$update = $db->query("UPDATE category SET category_name = '$cat_name' , category_url = '$cat_url' WHERE id = '$cat_id'");

if($update)
{
	echo "success";
}
else
{
	echo "failed";
}

?>