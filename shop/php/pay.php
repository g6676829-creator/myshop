<?php
require("db.php");

// Fetch product data
$id = $_GET['orid'];
$prd_qty = $_GET['qty'];
$payby = $_GET['pay'];

$prd_sql = $db->query("SELECT * FROM product WHERE id='$id'");
$prd_aa = $prd_sql->fetch_assoc();
$prd_name = $prd_aa['title'];
$prd_amount = $prd_aa['amount'];
$ttl_amount = $prd_amount * $prd_qty;



// Fetch user details
$email = base64_decode($_COOKIE['_enter_u_']);
$user_data_sql = $db->query("SELECT * FROM users WHERE email = '$email'");
$user_aa = $user_data_sql->fetch_assoc();
$cname = $user_aa['name'];
$cemail = $user_aa['email'];
$cphone = $user_aa['phone'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
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
        body {
            background-color: #f9f9f9;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background: #ffffff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }

        .container h1 {
            margin: 0;
            padding: 0;
            color: #333;
            margin-bottom: 10px;
        }

        .product-details {
            text-align: left;
            margin-bottom: 20px;
        }

        .product-details p {
            margin: 5px 0;
            color: #555;
        }

        #rzp-button1 {
            background-color: #3399cc;
            color: #fff;
            border: none;
            padding: 15px 25px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        #rzp-button1:hover {
            background-color: #287ab5;
        }

        footer {
            margin-top: 20px;
            font-size: 14px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="fs-2">Secure Payment</h1><hr>
        <div class="row">
            <div class="col-md-6 p-4"><img src="../product_images/<?php echo $prd_aa['image_name']; ?>" width="100%"></div>
            <div class="product-details col-md-6 p-4">
                <p><strong class="fs-5">Product :</strong> <?php echo $prd_name; ?></p>
                <p><strong class="fs-5">Quantity :</strong> <?php echo $prd_qty; ?></p>
                <p><strong class="fs-5">Price :</strong> ₹<?php echo $prd_amount; ?> per unit</p>
                <p><strong class="fs-5">Total Amount :</strong> ₹<?php echo $ttl_amount; ?></p>
            </div>
        </div>
        
        <button id="rzp-button1">Pay ₹<?php echo $ttl_amount; ?> Now</button>
    </div>

    <footer>
        Powered by MyShop - Secure Payments with Razorpay
    </footer>
    
    <script>
        var options = {
            "key": "rzp_test_GTXykFmVlFt1ru", // Replace with your Razorpay key ID
            "amount": "<?php echo $ttl_amount * 100; ?>", // Amount is in currency subunits
            "currency": "INR",
            "name": "MyShop",
            "description": "Online e-commerce business",
            "handler": function (response) {
                if(response.razorpay_payment_id!=""&&response.razorpay_order_id!=""&&response.razorpay_signature!="")
                {
                    window.location.href="receive_order.php?orid=<?php echo $id; ?>&qty=<?php echo $prd_qty; ?>&pay=<?php echo $payby ; ?>";
                }
                else
                {
                    die("Payment failed ?");
                }
            },
            "prefill": {
                "name": "<?php echo $cname; ?>",
                "email": "<?php echo $cemail; ?>",
                "contact": "<?php echo $cphone; ?>"
            },
            "notes": {
                "address": "Ramanuj : Gram gulariha gazipur kaisarganj baharaich 271903"
            },
            "theme": {
                "color": "#3399cc"
            }
        };
        var rzp1 = new Razorpay(options);
        document.getElementById('rzp-button1').onclick = function (e) {
            rzp1.open();
            e.preventDefault();
        }
    </script>
</body>
</html>
