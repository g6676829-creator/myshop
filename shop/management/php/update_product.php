<?php
require("db.php");

$product_id = $_POST['id'];
$category = $_POST['category'];
$title = $_POST['title'];
$description = $_POST['description'];
$quantity = $_POST['quantity'];
$amount = $_POST['amount'];
$old_image_name = $_POST['old_image_name'];

$image = $_FILES['product_image'];

$image_name = $image['name'];
$location = $image['tmp_name'];

if($image_name == "")
{
   $update = $db->query("UPDATE product SET category='$category',title='$title',description='$description',quantity='$quantity',amount='$amount' WHERE id='$product_id'");
   if($update)
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
    $delete = unlink("../../product_images/".$old_image_name);
    if($delete)
    {
        $update_image = move_uploaded_file($location,"../../product_images/".$image_name);
        if($update_image)
        {
            $update = $db->query("UPDATE product SET category='$category',title='$title',image_name='$image_name',description='$description',quantity='$quantity',amount='$amount' WHERE id='$product_id'");
            if($update)
            {
                 echo "success";
            }
            else
            {
                 echo "failed";
            } 
        }
        else{
            echo "image not uploaded !";
        }
    }
    else{
        echo "file not deleted !";
    }
}


?>