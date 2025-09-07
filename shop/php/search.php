<?php
require("db.php");
$query=$_POST['query'];


$product_sql = $db->query("SELECT * FROM product WHERE title LIKE '%$query%'");
echo '<div class="row">
<h1 class="text-center py-4">Search Result...</h1>
';
while($product_data = $product_sql->fetch_assoc())
{
echo '
  <div class="col-md-3">
    <a href="http://localhost:8080/shop/product-detail/'.$product_data['id'].'">
      <div class="card">
        <img src="product_images/'.$product_data['image_name'].'" class="w-80 m-3">
        <div class="card-body" style="background-color:#e5e5e5;">
          <label class="fs-6">'.$product_data['title'].'</label><br>
          <label class="fs-5 text-dark">&#8377;'.$product_data['amount'].'</label>              
        </div>
      </div>
    </a>  
  </div>
';
}
echo '</div>';






?>