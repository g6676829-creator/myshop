<?php
//human version code
require("db.php");
$cat_name = $_POST['category_name'];
$cat_url = strtolower($cat_name);
$cat_url = str_replace(' ', '-', $cat_url);


$db->query("CREATE TABLE IF NOT EXISTS category(
    id INT(11) NOT NULL AUTO_INCREMENT,
    category_name VARCHAR(255),
    category_url VARCHAR(255),
    PRIMARY KEY(id)
)");

if ($cat_name == "") {

    echo "please enter a category name !";
}
else{
    $data_store = $db->query("INSERT INTO category(category_name,category_url) VALUES('$cat_name','$cat_url')");
    if($data_store){
        echo "Success";
    }
    else{
        echo "Data store failed";
    }
}


?>