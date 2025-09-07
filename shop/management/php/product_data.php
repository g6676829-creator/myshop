<?php
require("db.php");

$product_id = $_POST['id'];

$product_data_sql = $db->query("SELECT * FROM product WHERE id='$product_id'");
$aa = $product_data_sql->fetch_assoc();
echo json_encode($aa);

?>