<?php
require("php/db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
    <?php require("elements/nav.php"); ?>
    <div class="container p-5">
        <div class="row p-5" style="box-shadow:0px 0px 30px #ccc">
            <h1 class="fs-2 text-center">Register With Us</h1>
            <hr>
            <div class="col-md-6">
                <form class="reg_frm">
                    <div class="form-group mt-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter your name" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="phone">Phone</label>
                        <input type="number" class="form-control" name="phone" placeholder="Enter your Phone number" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="address" class="form-label">Shipping Address</label>
					    <textarea rows="5" class="form-control" name="address"></textarea>
                    </div>
                    <div class="form-group mt-3">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Create your password" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 register_btn">Register Now</button> 
                </form>
                <div class="msg"></div>
            </div>
            <div class="col-md-6"></div>
        </div>
    </div>

    

    <script>
        $(document).ready(function(){
            $(".reg_frm").submit(function(e){
                e.preventDefault();
                $.ajax({
                    type:"POST",
                    url:"php/signup_backend.php",
                    data: new FormData(this),
                    contentType:false,
                    processData:false,
                    beforeSend:function(){
                        $(".register_btn").html("Please Wait...");
                        $(".register_btn").attr("disabled","disabled");
                    },
                    success:function(response){
                        $(".register_btn").html("Register Now");
                        $(".register_btn").removeAttr("disabled");
                        if(response.trim() == "success")
                        {
                            var div = document.createElement("DIV");
                            div.className = "alert alert-success mt-3";
                            div.innerHTML = "User registered successfully <i class='fa-solid fa-check fa-shake fs-4'></i>";
                            $(".msg").html(div);
                            //remove the massasge after few second
                            setTimeout(function(){
                                $(".msg").html("");
                                location.href = "login.php";
                            },3000);
                        }
                        else
                        {
                            var div = document.createElement("DIV");
                            div.className = "alert alert-danger mt-3";
                            div.innerHTML = response+" !";
                            $(".msg").html(div);
                            //remove the massasge after few second
                            setTimeout(function(){
                                $(".msg").html("");
                            },3000);
                        }
                    }
                });
            });
        })
    </script>
</body>
</html>