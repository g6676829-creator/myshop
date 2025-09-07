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
</style>


<div class="row">
	<div class="col-md-6">
		<div class="box p-4 bg-white">
			<h1>Add Category</h1>
			<hr>
			<div class="msg"></div>
			<form class="cat_frm">
				<div class="form-group">
					<label for="category_name" class="mb-2">Category name</label>
					<input type="text" name="category_name" id="category_name" class="form-control mb-3">
				</div>

				<button type="submit" class="btn btn-primary cat_btn">Add category</button>
			</form>
		</div>
	</div>

	<div class="col-md-6">
		<div class="box p-4 bg-white">

			<div class="delmsg"></div>

			<table class="table table-hover ">
			 	<thead>
			   		<tr>
			        	<th scope="col">Id</th>
			        	<th scope="col">Category Name</th>
			        	<th scope="col">Edit</th>
			        	<th scope="col">Delete</th>
			    	</tr>
			 	</thead>
			 	<tbody>
			 		<?php
			 			$data = $db->query("SELECT * FROM category");
			 			//fetch data by while loop
			 			while ($aa = $data->fetch_assoc()) {
			 				echo "<tr>
			 					<td>".$aa['id']."</td>
			 					<td>".$aa['category_name']."</td>
			 					<td><i class='fa-regular fa-edit text-primary edit' id='".$aa['id']."'></i></td>
			 					<td><i class='fa-regular fa-trash-can text-danger del' id='".$aa['id']."'></i></td>
			 				</tr>";
			 			}

			 		?>
			 	</tbody>
			 </table>
		</div>
	</div>
</div>

<div class="modal fade" tabindex="-1" id="cat_edit_modal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        	<form class="edit_cat_frm">
				<div class="form-group">
					<label for="category_name" class="mb-2">Category name</label>
					<input type="text" name="edit_cat_name" id="edit_cat_name" class="form-control mb-3">
				</div>
				<input type="hidden" id="edit_cat_id" name="edit_cat_id">

				<button type="submit" class="btn btn-primary save_cat_btn">Save</button>
			</form>
      </div>
      
    </div>
  </div>
</div>

<script type="text/javascript">
	$(document).ready(function(){

		var myModal = new bootstrap.Modal(document.getElementById('cat_edit_modal'), {keyboard: false});

		$('.cat_frm').submit(function(e){
			e.preventDefault();
			
			$.ajax({
				type:'POST',
				url:'php/add_category.php',
				data:new FormData(this),
				processData:false,
				contentType:false,
				beforeSend:function(){
					$('.cat_btn').html('Please wait...');
					$('.cat_btn').attr('disabled','disabled');
				},
				success:function(response){
					if(response.trim() == "please enter a category name !")
					{
						var div = document.createElement("DIV");
						div.className = "alert alert-danger mt-3";
						div.innerHTML = response;
						$(".msg").append(div);
						//remove the massage and reset form
						setTimeout(function(){
							$(".msg").html("");
							$('.cat_btn').html('Add category');
							$('.cat_btn').removeAttr('disabled');
							$(".cat_frm").trigger('reset');
						},3000);
					}
					else{
						var div = document.createElement("DIV");
						div.className = "alert alert-success mt-3";
						div.innerHTML = response;
						$(".msg").append(div);
						//remove the massage and reset form
						setTimeout(function(){
							$(".msg").html("");
							$('.cat_btn').html('Add category');
							$('.cat_btn').removeAttr('disabled');
							$(".cat_frm").trigger('reset');
							$('[page_link="category"]').click();
						},3000);
					}
				}
			})
		})

		//category edit form
		$(".edit").each(function(){
			$(this).click(function(){
				var cat_id = $(this).attr("id");
				
				//ajax to get data for update
				$.ajax({
					type:"POST",
					url:"php/get_cat_data.php",
					data:{
						id:cat_id
					},
					success:function(response){
						var cat_data = JSON.parse(response);
						$("#edit_cat_name").val(cat_data.category_name);
						$("#edit_cat_id").val(cat_data.id);

						myModal.show();
					}
				})
			})
		})

		//ajax to save updated category
		$(".edit_cat_frm").submit(function(e){
			e.preventDefault();
			$.ajax({
				type:"POST",
				url:"php/edit_cat.php",
				data:new FormData(this),
				contentType:false,
				processData:false,
				success:function(response){
					if(response.trim() == "success"){
						myModal.hide();
						$('[page_link="category"]').click();
					}
				}
			})
		})


		//delete category
		$(".del").each(function(){
			$(this).click(function(){
				var cat_del_id = $(this).attr("id");
				//ajax for delete file
				$.ajax({
					type:"POST",
					url:"php/del_cat.php",
					data:{
						id:cat_del_id
					},
					success:function(response){
						if(response.trim() == "success"){
							var div = document.createElement("DIV");
							div.className = "alert alert-danger mt-3";
							div.innerHTML = "category deleted successfully !";
							$(".delmsg").append(div);
							//remove the massage and reset form
							setTimeout(function(){
								$(".delmsg").html("");
								$('[page_link="category"]').click();
							},3000);
						}
					}
				})
			})
		})
	})
</script>