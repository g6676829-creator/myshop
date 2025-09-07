<?php
require("db.php");

$prd_del_id = $_POST['id'];

$query = $db->query("SELECT * FROM product WHERE id='$prd_del_id'");

$aa = $query->fetch_assoc();
//get image name output
$image_name = $aa['image_name'];

$delete = unlink("../../product_images/".$image_name);

if($delete)
{
    $delete_data = $db->query("DELETE FROM product WHERE id='$prd_del_id'");
    if($delete_data)
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
    echo "image can not delete !";
}
?>