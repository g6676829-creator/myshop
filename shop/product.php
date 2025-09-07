<?php require("php/db.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>products</title>
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
      .logo {
        padding: 0;
        margin: 0;
        font-family: 'Courier New', Courier, monospace;
        font-size: 40px;
        font-weight: bold;
        color: #e67e22; /* Nice orange color */
        text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3); /* Adds a soft shadow */
        letter-spacing: 2px; /* Adds a bit of space between letters */
        background: linear-gradient(135deg, #2d0cff 0%, #6ef49f 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
      }
      .box_shadow{
        box-shadow: 0px 0px 10px #ddd;
      }
  </style>
</head>
<body>
	<?php
		require("elements/nav.php");
	?>

	<?php
		//get the category url with get
		$cat_url = $_GET['product_category'];
		$heading = str_replace("-", " ", $cat_url);
		$heading = ucfirst($heading);
		$product_sql = $db->query("SELECT * FROM product WHERE category='$cat_url' ORDER BY id DESC");
      echo '<div class="row px-3">
      <h1 class="text-center py-4">'.$heading.'</h1>
      ';
      while($product_data = $product_sql->fetch_assoc())
      {
        echo '
          <div class="col-md-3">
            <a href="http://localhost:8080/shop/product-detail/'.$product_data['id'].'">
              <div class="card mt-3">
                <img src="http://localhost:8080/shop/product_images/'.$product_data['image_name'].'" class="w-80 m-3">
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
<?php require("elements/footer.php"); ?>
</body>
</html>