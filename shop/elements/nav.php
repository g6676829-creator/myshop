<style type="text/css">
  @media (max-width: 769px) {
  .login_ind{
    display: none;
  }
}
</style>



<nav class="navbar navbar-expand-lg bg-body-tertiary px-5 sticky-top" style="box-shadow:0px 0px 30px #ccc">
  <div class="container-fluid">

    <a class="navbar-brand" href="http://localhost:8080/shop/"><img src="http://localhost:8080/shop/images/logo.png" width="100px" alt="logo"></a>

    <?php
      require("php/db.php");
      if(!empty($_COOKIE['_enter_u_']))
      {
        $email = base64_decode($_COOKIE['_enter_u_']);
        $data = $db->query("SELECT name FROM users WHERE email='$email'");
        $aa = $data->fetch_assoc();
        $name = $aa['name'];
        echo "<small class='text-primary me-auto login_ind'>| Hi..".$name."</small>";

      }
    ?>


    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 fs-5">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="http://localhost:8080/shop/">Home</a>
        </li>
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Category
          </a>
          <ul class="dropdown-menu">
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
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Account</a>
          <ul class="dropdown-menu">
            <?php
              if(empty($_COOKIE['_enter_u_']))
              {
                echo '
                  <li class="nav-item">
                  <a class="nav-link" href="http://localhost:8080/shop/signup.php">Signup</a>
                  </li>
                  <li class="nav-item">
                  <a class="nav-link" href="http://localhost:8080/shop/login.php">Login</a>
                  </li>
                ';
              }
              else
              {
                echo '
                  <li class="nav-item">
                  <a class="nav-link text-primary" href="http://localhost:8080/shop/my_order.php">My Orders</a>
                  </li>
                  <li class="nav-item">
                  <a class="nav-link text-danger" href="signout.php">Logout</a>
                  </li>
                ';
              }
            ?>
            <li class="nav-item">
              <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact</a>
            </li>
          </ul>
        </li>   
      </ul>
    </div>
  </div>
</nav>
