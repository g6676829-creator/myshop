<?php
require("../db.php");


?>

<style type="text/css">
    .box{
        box-shadow: 0px 0px 10px #ccc;
        border-radius: 10px;
        /*background-color: aliceblue;*/
    }
    .del:hover , .edit:hover{
		cursor: pointer;
		font-size: 17px;
		transition: .3s;
	}
    #msg{
		width: 100%;
		height: 100vh;
		background-color: rgba(0, 0, 0, 0.7);
		display: flex;
		justify-content: center;
		align-items: center;
		color: white;
		position: fixed;
		top: 0;
		left: 0;
		z-index: 100000;
	}
</style>


<h1 class="text-center">All Products</h1>
<div class="box p-4 bg-white">

    <div id="msg" class="msg d-none"></div>

    <table class="table table-hover bg-primary">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Image</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Category</th>
                <th scope="col">Quantity</th>
                <th scope="col">Amount</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $data = $db->query("SELECT * FROM product");
                //fetch data by while loop
                while ($aa = $data->fetch_assoc()) {
                    echo "<tr>
                        <td>".$aa['id']."</td>
                        <td><img src='../product_images/".$aa['image_name']."' width='100'></td>
                        <td>".$aa['title']."</td>
                        <td>".$aa['description']."</td>
                        <td>".$aa['category']."</td>
                        <td>".$aa['quantity']."</td>
                        <td>".$aa['amount']."</td>
                        <td><i class='fa-regular fa-edit text-primary edit' id='".$aa['id']."'></i></td>
                        <td><i class='fa-regular fa-trash-can text-danger del' id='".$aa['id']."'></i></td>
                    </tr>";
                }

            ?>
        </tbody>
    </table>
</div>

<div class="modal fade" tabindex="-1" id="pro_edit_modal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form class="edit_product_frm">
				<label class="mb-2">Select Category</label>
				<select class="form-control mb-3" name="category" id="category">
					<option value="none">Select Category</option>
					<?php
			 			$data = $db->query("SELECT * FROM category");
			 			//fetch data by while loop
			 			while ($aa = $data->fetch_assoc()) {
			 				echo "<option value='".$aa['category_url']."'>".$aa['category_name']."</option>";
			 			}
			 		?>
				</select>

				<label class="mb-2">Upload Image</label>
				<input type="file" name="product_image" class="form-control mb-3" accept="image/*">
				<label class="mb-2">Title</label>
				<input type="text" name="title" class="form-control mb-3" id="title">
				<label class="mb-2">Description</label>
				<textarea cols="30" rows="8" name="description" class="form-control mb-3" id="description"></textarea>
				<label class="mb-2">Quantity</label>
				<input type="number" name="quantity" class="form-control mb-3" id="quantity">
				<label class="mb-2">Amount</label>
				<input type="number" name="amount" class="form-control mb-3" id="amount">

                <input type="hidden" id="product_id" name="id">
                <input type="hidden" id="old_image_name" name="old_image_name">

				<button type="submit" class="btn btn-primary add_product_btn">Update Now !</button>
			</form>
      </div>
      
    </div>
  </div>
</div>



<script type="text/javascript">
    $(document).ready(function(){
        var myModal = new bootstrap.Modal(document.getElementById('pro_edit_modal'), {keyboard: false});
        $(".edit").each(function(){
            $(this).click(function(){
               var product_id = $(this).attr("id");
               
               $.ajax({
                type:"POST",
                url:"php/product_data.php",
                data:{id:product_id},
                success:function(response){
                    var pro_data = JSON.parse(response);
                    $("#category").val(pro_data.category);
                    $("#title").val(pro_data.title);
                    $("#description").val(pro_data.description);
                    $("#quantity").val(pro_data.quantity);
                    $("#amount").val(pro_data.amount);
                    $("#product_id").val(pro_data.id);
                    $("#old_image_name").val(pro_data.image_name);
                    
                    myModal.show();
                }
               });
            });
        });

        $(".edit_product_frm").submit(function(e){
            e.preventDefault();
            $.ajax({
                type:"POST",
                url:"php/update_product.php",
                data:new FormData(this),
                contentType:false,
                processData:false,
                success:function(response){
                    if(response.trim() === "success") {
                    $(".msg").removeClass("d-none");
                    var div = document.createElement("DIV");
                    div.className="alert alert-primary fs-1 p-5 text-center";
                    div.innerHTML = "Product Updated Successfully <br><i class='fa-solid fa-square-check display-1'></i>";
                    $(".msg").html(div);
                        setTimeout(function(){
                            $(".msg").addClass("d-none");
                            $(".msg").html("");
                            myModal.hide();
                            $('[page_link="all_product"]').click();
                        },2000);
                    }
                }
            });
        });

        //DELETE PRODUCT CODE
        $(".del").each(function(){
            $(this).click(function(){
                var prd_del_id = $(this).attr("id");
                $.ajax({
                    type:"POST",
                    url:"php/del_prd.php",
                    data:{id:prd_del_id},
                    success:function(response){
                        if(response.trim() === "success") {
                        $(".msg").removeClass("d-none");
                        var div = document.createElement("div");
                        div.className="alert alert-danger fs-1 p-5 text-center";
                        div.innerHTML = "Product Deleted Successfully <br><i class='fa-solid fa-trash display-1'></i>";
                        $(".msg").html(div);
                            setTimeout(function(){
                            $(".msg").addClass("d-none");
                            $(".msg").html("");
                            $('[page_link="all_product"]').click();
                            },2000);
                        }
                        else
                        {
                        alert(response);
                        $('[page_link="all_product"]').click();
                        }
                    }
                });
            });
        });
    });
</script>
