<?php require("php/db.php"); ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>order details</title>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

	<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
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
	<!-- require the navbar -->
	<?php require("elements/nav.php");?>

	<?php
	$product_id = $_GET['id'];
	$sql = $db->query("SELECT * FROM product WHERE id='$product_id'");
	$aa = $sql->fetch_assoc();

	//user information detecting
	$email = base64_decode($_COOKIE['_enter_u_']);
	$user_data_sql = $db->query("SELECT * FROM users WHERE email = '$email'");
	$user_aa = $user_data_sql->fetch_assoc();
	?>
	<div class="container">
		<h1 class="text-center mt-4 fs-2">Order Details</h1>
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6 p-4 rounded" style="box-shadow:0px 0px 10px #ccc">
				<div class="d-flex">
					<div><img src="http://localhost:8080/shop/product_images/<?php echo $aa['image_name']; ?>" width="150px"></div>
					<div class="d-flex flex-column justify-content-center">
						<h3 class="ms-4"><?php echo $aa['title']; ?></h3>
						<p class="fs-5 ms-4 text-primary">&#8377;<?php echo $aa['amount']; ?></p>
					</div>
				</div>
				<hr>
				<h4>Customer Details</h4>
				<table class="table table-bordered">
					<tr>
						<th>Name</th>
						<td><?php echo $user_aa['name']; ?></td>
					</tr>
					<tr>
						<th>Email</th>
						<td><?php echo $user_aa['email']; ?></td>
					</tr>
					<tr>
						<th>Phone</th>
						<td><?php echo $user_aa['phone']; ?></td>
					</tr>
					<tr>
						<th>Shipping Address</th>
						<td><?php echo $user_aa['address']; ?></td>
					</tr>
				</table>
				<hr>
				<form class="order_frm">
					<label for="quantity" class="form-label">Quantity</label>
					<input type="number" value="1" class="form-control mb-2 ordqty">
					<label for="quantity" class="form-label">Payment Options</label>
					<div class="form-check">
					<input class="form-check-input" type="radio" name="payment_method" id="flexRadioDefault1" value="online">
					<label class="form-check-label" for="flexRadioDefault1">
						Online
					</label>
					</div>
					<div class="form-check">
					<input class="form-check-input" type="radio" name="payment_method" id="flexRadioDefault2" value="cod">
					<label class="form-check-label" for="flexRadioDefault2">
						Cash on delivery
					</label>
					</div>
					<hr>
					<button type="submit" class="btn btn-primary" id="payon">Place Order</button>
				</form>	
				<div class="msg"></div>
			</div>
			<div class="col-md-3"></div>
		</div>		
	</div>
<?php require("elements/footer.php"); ?>

<script>
	$(document).ready(function(){
		$(".order_frm").submit(function(e){
			e.preventDefault();
			var pay_meth = $('[name="payment_method"]:checked').val();
			if(pay_meth)
			{
				if(pay_meth =="online")
				{					
					window.location.href="http://localhost:8080/shop/php/pay.php?orid=<?php echo $product_id; ?>&qty="+$(".ordqty").val()+"&pay="+pay_meth;					
				}
				else if(pay_meth == "cod")
				{
					var div = document.createElement("DIV");
					div.className = "alert alert-success mt-3";
					div.innerHTML = "Item ordered successfully <i class='fa-solid fa-check fa-shake'></i>";
					$(".msg").html(div);
					//remove the massasge after few second
					setTimeout(function(){
						$(".msg").html("");
						window.location.href="http://localhost:8080/shop/php/receive_order.php?orid=<?php echo $product_id; ?>&qty="+$(".ordqty").val()+"&pay="+pay_meth;
					},3000);
					
				}
			}
			else
			{
				alert("Please select the payment method");
			}
		});
	});
</script>
</body>
</html>