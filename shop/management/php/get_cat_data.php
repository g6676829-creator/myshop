<?php
require("db.php");
$id = $_POST['id'];

$res = $db->query("SELECT * FROM category WHERE id = '$id'");
$aa = $res->fetch_assoc();
echo json_encode($aa);

?>