<?php require("php/db.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>product details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <style>
    @import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap');
    *{
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Josefin Sans", sans-serif;
    }
   .product_image{
    height: 65vh;
   }
  </style>
</head>
<body>
    <!-- require the navbar -->
    <?php require("elements/nav.php");?>

    <?php
    $product_id = $_GET['id'];
    $sql = $db->query("SELECT * FROM product WHERE id='$product_id'");
    $aa = $sql->fetch_assoc();
    ?>
    <div class="container">
    <h1 class="text-center mt-4">Product Details</h1>
    <div class="row">
      <div class="col-md-6 p-4 text-center">
        <img src="http://localhost:8080/shop/product_images/<?php echo $aa['image_name']?>" alt="<?php echo $aa['image_name']?>" class="product_image">
      </div>
      <div class="col-md-6 p-4">
        <h2><?php echo $aa['title']?></h2>
        <hr>
        <h2 class="text-dark">&#8377;<?php echo $aa['amount']?></h2>
        <?php
          if($aa['quantity'] == 0)
          {
            echo "<h5 class='text-danger'>Stoct : Not Available</h5>";
          }
          else{
            echo "<h5 class='text-success'>Stoct : Available</h5>";
          }
        ?>
        <label for="description">
        <?php echo $aa['description']?>
        </label><br>

        <?php
          if(!empty($_COOKIE['_enter_u_']))
          {
            echo '<a href="http://localhost:8080/shop/order-detail/'.$aa['id'].'"><button class="btn btn-sm btn-success mt-3">Make it your</button></a>';
          }
          else
          {
            echo '<a href="http://localhost:8080/shop/login.php"><button class="btn btn-sm btn-success mt-3">Make it your</button></a>';
          }
        ?>
        
      </div>
    </div>
    
  </div>
  
  <?php require("elements/footer.php"); ?>
</body>
</html>