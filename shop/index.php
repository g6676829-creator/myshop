<?php require("php/db.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>homepage</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap');
    *{
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Josefin Sans", sans-serif;
    }
   

  </style>
</head>
<body>
<?php require("elements/nav_withsearch.php"); ?>


<div id="carouselExample" class="carousel slide">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="images/poster.webp" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="images/poster2.webp" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="images/poster3.webp" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="images/offerslide.webp" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="images/offerslide2.webp" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>


  <div class="container content">
  <?php
    $cat_sql = $db->query("SELECT * FROM category");
    while($cat_data = $cat_sql->fetch_assoc())
    {
      $cat = $cat_data['category_url'];
      $product_sql = $db->query("SELECT * FROM product WHERE category='$cat' ORDER BY id DESC LIMIT 4");
      echo '<div class="row">
      <h1 class="text-center py-4">'.$cat_data['category_name'].'</h1>
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
    }
  
  ?>
  </div>


 
<?php require("elements/footer.php"); ?>


<script type="text/javascript">
  $(document).ready(function(){
    $(".search_btn").click(function(){
      var keywords = $(".search_input").val();
      //ajax for search result
      $.ajax({
        type:"POST",
        url:"php/search.php",
        data:{query:keywords},
        success:function(result){
          $(".content").html(result);
        }
      });
    });
  });


</script>
</body>
</html>