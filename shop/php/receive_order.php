<?php 
require("db.php");
//fetch product data
$id = $_GET['orid'];
$prd_qty = $_GET['qty'];
$payby = $_GET['pay'];

//check payment status
$payment_status = "";
if($payby == "online")
{
    $payment_status = "completed";
}
else if($payby == "cod")
{
    $payment_status = "pending";
}

$prd_sql = $db->query("SELECT * FROM product WHERE id='$id'");
$prd_aa = $prd_sql->fetch_assoc();
$prd_name = $prd_aa['title'];
$prd_amount = $prd_aa['amount'];
$prd_img = $prd_aa['image_name'];
$ordered = date("Y-m-d");
$ttl_amount = $prd_amount*$prd_qty;

//fetch user details
$email = base64_decode($_COOKIE['_enter_u_']);
$user_data_sql = $db->query("SELECT * FROM users WHERE email = '$email'");
$user_aa = $user_data_sql->fetch_assoc();
$cname = $user_aa['name'];
$cemail = $user_aa['email'];
$cphone = $user_aa['phone'];
$caddress = $user_aa['address'];

$db->query("
CREATE TABLE IF NOT EXISTS received_order (
    id INT(11) NOT NULL AUTO_INCREMENT,
    ordered DATE NOT NULL,
    prd_name VARCHAR(255) NOT NULL,
    prd_img VARCHAR(255) NOT NULL,
    prd_qty INT(11) NOT NULL,
    prd_amount DECIMAL(10,2) NOT NULL,
    ttl_amount DECIMAL(10,2) NOT NULL,
    cname VARCHAR(255) NOT NULL,
    cemail VARCHAR(255) NOT NULL,
    cphone VARCHAR(15) NOT NULL,
    caddress MEDIUMTEXT NOT NULL,
    payby VARCHAR(255) NOT NULL,
    payment_status VARCHAR(255),
    order_status VARCHAR(255) DEFAULT 'pending',
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
");

$store_data = $db->query("INSERT INTO received_order(ordered,prd_name,prd_img,prd_qty,prd_amount,ttl_amount,cname,cemail,cphone,caddress,payby,payment_status)VALUES('$ordered','$prd_name','$prd_img','$prd_qty','$prd_amount','$ttl_amount','$cname','$cemail','$cphone','$caddress','$payby','$payment_status')");
if($store_data)
{
    header("Location:../my_order.php");
}
else{
    echo "failed to store";
}


?>