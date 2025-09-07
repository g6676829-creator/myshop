<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Detail Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .order-details {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .order-summary {
            background-color: #f8f8f8;
            border-radius: 10px;
            padding: 15px;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <h1 class="mb-4 text-center">Order Details</h1>
        <div class="row">
            <!-- Order Details Section -->
            <div class="col-lg-8 order-details mb-4">
                <h3 class="mb-3">Order #12345</h3>
                <p><strong>Order Date:</strong> January 13, 2025</p>
                <p><strong>Status:</strong> <span class="badge bg-success">Shipped</span></p>
                
                <!-- Items Purchased -->
                <h4 class="mt-4">Items Purchased</h4>
                <div class="order-summary my-3">
                    <div class="row mb-2">
                        <div class="col-8">
                            <h6>Product 1</h6>
                            <p>Quantity: 2</p>
                        </div>
                        <div class="col-4 text-end">
                            <p>$40.00</p>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-8">
                            <h6>Product 2</h6>
                            <p>Quantity: 1</p>
                        </div>
                        <div class="col-4 text-end">
                            <p>$20.00</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-8">
                            <h6>Total</h6>
                        </div>
                        <div class="col-4 text-end">
                            <h6>$60.00</h6>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Shipping Details Section -->
            <div class="col-lg-4 order-details">
                <h4>Shipping Details</h4>
                <p><strong>Recipient:</strong> John Doe</p>
                <p><strong>Address:</strong> 123 Main Street, Cityville, USA</p>
                <p><strong>Contact:</strong> (123) 456-7890</p>
                <hr>
                <h4>Payment</h4>
                <p><strong>Method:</strong> Credit Card</p>
                <p><strong>Card:</strong> **** **** **** 1234</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



<!-- edited -->

<?php require("php/db.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;600&family=Raleway:wght@400;700&display=swap');
        body {
            font-family: "Josefin Sans", sans-serif;
            background-color: #f9f9f9;
        }
        .card {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .card img {
            border-radius: 8px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            transition: background-color 0.3s, border-color 0.3s;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        textarea, input[type="number"] {
            resize: none;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <?php require("elements/nav.php"); ?>

    <?php
    $product_id = $_GET['id'] ?? 0;
    $product = $db->query("SELECT * FROM product WHERE id='$product_id'")->fetch_assoc();
    $email = isset($_COOKIE['_enter_u_']) ? base64_decode($_COOKIE['_enter_u_']) : '';
    $user = $db->query("SELECT * FROM users WHERE email='$email'")->fetch_assoc();
    ?>

    <div class="container my-5">
        <h1 class="text-center mb-4">Order Details</h1>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card p-4">
                    <div class="d-flex">
                        <div>
                            <img src="product_images/<?= $product['image_name'] ?>" width="150" alt="Product">
                        </div>
                        <div class="ms-4 d-flex flex-column justify-content-center">
                            <h2><?= $product['title'] ?></h2>
                            <h4 class="text-primary">&#8377;<?= $product['amount'] ?></h4>
                        </div>
                    </div>
                    <hr>
                    <h3>Customer Details</h3>
                    <table class="table table-bordered">
                        <tr>
                            <th>Name</th>
                            <td><?= htmlspecialchars($user['name'] ?? 'N/A') ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?= htmlspecialchars($user['email'] ?? 'N/A') ?></td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td><?= htmlspecialchars($user['phone'] ?? 'N/A') ?></td>
                        </tr>
                    </table>
                    <hr>
                    <form>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" id="quantity" name="quantity" class="form-control" placeholder="Enter product quantity" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Shipping Address</label>
                            <textarea id="address" name="address" class="form-control" rows="4" placeholder="Enter your shipping address" required></textarea>
                        </div>
                        <label class="form-label">Payment Options</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="online" value="online" required>
                            <label class="form-check-label" for="online">Online</label>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod" required>
                            <label class="form-check-label" for="cod">Cash on Delivery</label>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Place Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

