<?php
require("db.php");

$cat = $_POST['category'];
$title = $_POST['title'];
$description = $_POST['description'];
$quantity = $_POST['quantity'];
$amount = $_POST['amount'];

$image = $_FILES['product_image'];

$image_name = $image['name'];
$location = $image['tmp_name'];

$db->query("CREATE TABLE IF NOT EXISTS product(
    id INT(11) NOT NULL AUTO_INCREMENT,
    category VARCHAR(200),
    title VARCHAR(200),
    image_name VARCHAR(200),
    description MEDIUMTEXT,
    quantity VARCHAR(100),
    amount VARCHAR(100),
    PRIMARY KEY(id)
)");

if(file_exists("../../product_images/".$image_name))
{
    echo "Product allready exist !";
}
else
{
    $upload_image = move_uploaded_file($location, "../../product_images/".$image_name);
    if($upload_image)
    {
        $store_product = $db->query("INSERT INTO product(category,title,image_name,description,quantity,amount) VALUES('$cat','$title','$image_name','$description','$quantity','$amount')");
        if($store_product)
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
        echo "image not uploaded !";
    }
}

?>