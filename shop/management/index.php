<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"/>
    <script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script> -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style type="text/css">

		@import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap');
    	*{
    		margin: 0;
    		padding: 0;
    		box-sizing: border-box;
    		font-family: "Josefin Sans", sans-serif;
    	}
    	.main{
    		height: 100vh;
    		width: 100%;
    		background: rgba(0, 175, 239,0.1);
    	}
    	.left{
    		width: 17%;
    		height: 100vh;
    		background-color: #00164c;
    	}
    	.left ul{
    		padding: 0;
    		margin: 0;
    		list-style: none;
    	}
    	.left ul li{
    		width: 100%;
    		border-bottom: 1px solid #fff;
    		color: #fff;
			font-optical-sizing: auto;
			font-weight: 400;
			font-style: normal;	
    	}
    	.left li:hover{
    		cursor: pointer;
    		background-color: #fff;
    		color: #00164c;
    		transition: 0.3s;
    	}
    	.right{
    		width: 83%;
    		height: 100vh;
    		/*background-color: rgba(164, 255, 53, 0.2);*/
    		position: relative;
    		overflow: auto;
    	}
    	.msgLoading{
    		width: 100%;
    		height: 100%;
    		background-color: rgba(0, 0, 0, 0.3);
    		position: fixed;
    		top: 0;
    		left: 0;
    		display: flex;
    		justify-content: center;
    		align-items: center;
    		z-index: 1000000;
    	}

    </style>
</head>
<body>
	<div class="main d-flex">

		<div class="left">
			<ul>
				<li class="py-2 px-4 menu" page_link="category">Category</li>
				<li class="py-2 px-4 menu" page_link="add_product">Add Products</li>
				<li class="py-2 px-4 menu" page_link="all_product">All Products</li>
				<li class="py-2 px-4 menu" page_link="orders">Orders</li>
			</ul>
		</div>

		<div class="right p-4">

			<div class="msgLoading d-none display-1"></div>
		</div>
		
	</div>

	




	<script type="text/javascript">
		$(document).ready(function(){
			$('.menu').each(function(){
				$(this).click(function(){
					var page = $(this).attr("page_link");

					$.ajax({
						type : 'POST',
						url : 'php/pages/'+page+'.php',
						beforeSend : function(){
							$('.msgLoading').removeClass('d-none');
							$('.msgLoading').html('Loading...<i class="fa-solid fa-spinner fa-spin"></i>');
						},
						success : function(response){
							$('.msgLoading').addClass('d-none');
							$('.right').html(response);
						}
					})
				})
			})

			//set as default screen
			function add_product() {
                $('[page_link="add_product"]').click();
            }
            add_product();
		})
	</script>
</body>
</html>