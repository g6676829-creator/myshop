<?php require("php/db.php"); ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>my orders</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<style>
    @import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap');
    *{
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Josefin Sans", sans-serif;
    }
    body{
    	background: rgba(0, 175, 239,0.1);
    }
		.order_box{
			padding: 30px;
			/*box-shadow: 0 4px 10px #ccc;*/
			border-radius: 8px;
			margin-top: 20px;
		}
		.content_box{
			background-color: #fff;
	    padding: 20px;
	    border-radius: 8px;
	    box-shadow: 0 4px 10px #ccc;
		}
	</style>
</head>
<body>
	<!-- require the navbar -->
	<?php require("elements/nav.php");?>
	<div class="container">
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6 order_box" >
				<h1 class="fs-3 text-center">My Orders</h1>
				<hr>
				<h2 class="fs-4">Pending Orders <i class='fas fa-exclamation-triangle text-warning'></i></h2>
				<?php
				$email = base64_decode($_COOKIE['_enter_u_']);
				$order_detail_sql = $db->query("SELECT * FROM received_order WHERE cemail='$email' AND order_status='pending' ORDER BY id DESC");
				//start the loop for fetch data multiple time
				while ($result = $order_detail_sql->fetch_assoc()) {
					
					$ordered=$result['ordered'];

					//create formated date
					$date = date_create($ordered);
					$f_date = date_format($date,"d-F-Y");


					echo '
						<div class="content_box d-flex mb-3">
							<div><img src="product_images/'.$result['prd_img'].'" width="150px"></div>
							<div class="ps-4">
								<p class="m-1"><strong>Item :</strong> '.$result['prd_name'].'</p>
								<p class="m-1"><strong>Quantity :</strong> '.$result['prd_qty'].'</p>
            		<p class="m-1"><strong>Total Amount :</strong> <span class="text-primary">₹'.$result['ttl_amount'].'</span></p>
            		<p class="m-1"><strong>Payment status : </strong>'.$result['payment_status'].'</p>
            		<p class="m-1"><strong>Order Id : </strong>'.$result['id'].'</p>
            		<p class="m-1"><strong>Order Date :</strong> '.$f_date.'</p>
							</div>
						</div>
					';
				}

				?>
				<hr>
				<!-- code for completed orders -->
				<h2 class="fs-4 mt-4">Completed Orders <i class='fas fa-check-circle text-success'></i></h2>
				<?php
				$email = base64_decode($_COOKIE['_enter_u_']);
				$order_detail_sql = $db->query("SELECT * FROM received_order WHERE cemail='$email' AND order_status='completed' ORDER BY id DESC");
				//start the loop for fetch data multiple time
				while ($result = $order_detail_sql->fetch_assoc()) {
					
					$ordered=$result['ordered'];

					//create formated date
					$date = date_create($ordered);
					$f_date = date_format($date,"d-F-Y");

					echo '
						<div class="content_box d-flex mb-3">
							<div><img src="product_images/'.$result['prd_img'].'" width="150px"></div>
							<div class="ps-4">
								<p class="m-1"><strong>Item :</strong> '.$result['prd_name'].'</p>
								<p class="m-1"><strong>Quantity :</strong> '.$result['prd_qty'].'</p>
            		<p class="m-1"><strong>Total Amount :</strong> <span class="text-primary">₹'.$result['ttl_amount'].'</span></p>
            		<p class="m-1"><strong>Payment status : </strong> <span class="text-success">'.$result['payment_status'].'</span></p>
            		<p class="m-1"><strong>Order Id : </strong>'.$result['id'].'</p>
            		<p class="m-1"><strong>Order Date :</strong> '.$f_date.'</p>
							</div>
						</div>
					';
				}

				?>
			</div>
			<div class="col-md-3"></div>
		</div>
	</div>

	<?php require("elements/footer.php"); ?>
</body>
</html>