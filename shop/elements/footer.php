
<style>
    .footer {
        color: #ffffff;
        padding: 40px 0;
    }
    .footer a {
        color: #ffffff;
        text-decoration: none;
    }
    .footer a:hover {
        color: #ffc107;
        text-decoration: underline;
    }
    .footer h5 {
        color: #00afef;
        border-bottom: 2px solid #ffc107;
        display: inline-block;
        padding-bottom: 5px;
    }
    .footer .social-icons a {
        margin: 0 10px;
        font-size: 18px;
    }
    .footer-bottom {
        background-color: #23272b;
        color: #aaa;
        padding: 10px 0;
        text-align: center;
    }
</style>

<!-- Footer Section -->
<footer class="footer mt-3 bg-dark">
    <div class="container">
        <div class="row">
            <!-- About Section -->
            <div class="col-lg-4 col-md-6 mb-4">
                <h5>About Us</h5>
                <p class="mt-3">
                    Welcome to ShopEase, your one-stop destination for quality products at the best prices. We’re committed to delivering a seamless shopping experience.
                </p>
            </div>
            <!-- Quick Links Section -->
            <div class="col-lg-2 col-md-6 mb-4">
                <h5>Quick Links</h5>
                <ul class="list-unstyled mt-3">
                    <?php
                    $cat_sql = $db->query("SELECT * FROM category");
                    while($cat_data = $cat_sql->fetch_assoc())
                    {
                      echo '
                        <li><a class="dropdown-item" href="http://localhost:8080/shop/category/'.$cat_data['category_url'].'">'.$cat_data['category_name'].'</a></li>
                      
                      ';
                    }
                    
                    ?>
                </ul>
            </div>
            <!-- Customer Service Section -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h5>Customer Service</h5>
                <ul class="list-unstyled mt-3">
                    <li><a href="#">FAQs</a></li>
                    <li><a href="#">Return Policy</a></li>
                    <li><a href="#">Shipping Info</a></li>
                    <li><a href="#">Track Order</a></li>
                </ul>
            </div>
            <!-- Follow Us Section -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h5>Follow Us</h5>
                <div class="social-icons mt-3">
                    <a href="#" class="text-white"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-white"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="text-white"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-white"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Bottom -->
    <hr>
    <p class="mb-0 text-center">&copy; 2025 ShopEase. All Rights Reserved.</p>
</footer>


<!-- Bootstrap Icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">

