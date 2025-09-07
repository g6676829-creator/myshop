<?php
require("db.php");

$status=$_POST['status'];
$date=$_POST['date'];

$order_sql=$db->query("SELECT * FROM received_order WHERE ordered='$date' AND order_status='$status'");
$alldata = [];
while ($data = $order_sql->fetch_assoc()) {
	array_push($alldata, $data);
}
echo json_encode($alldata);

?>