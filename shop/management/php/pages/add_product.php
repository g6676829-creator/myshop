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


<div class="row">

    <div id="msg" class="msg d-none"></div>

    <div class="col-md-6">
        <div class="box p-4 bg-white">
            <h1>Add Product</h1>
            <hr>
            <form class="add_product_frm">
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
                <input type="text" name="title" class="form-control mb-3">
                <label class="mb-2">Description</label>
                <textarea cols="30" rows="8" name="description" class="form-control mb-3"></textarea>
                <label class="mb-2">Quantity</label>
                <input type="number" name="quantity" class="form-control mb-3">
                <label class="mb-2">Amount</label>
                <input type="number" name="amount" class="form-control mb-3">
                <button type="submit" class="btn btn-primary add_product_btn">Add Now !</button>
            </form>
        </div>
    </div>

</div>



<script type="text/javascript">
    $(document).ready(function(){
    $(".add_product_frm").submit(function(e){
        e.preventDefault();
        $.ajax({
            type:"POST",
            url:"php/upload_product.php",
            data:new FormData(this),
            contentType:false,
            processData:false,
            beforeSend:function(){
                $(".add_product_btn").attr("disabled","disabled");
                $(".add_product_btn").html("Please Wait...");
            },
            success:function(response){
               
                $(".add_product_btn").removeAttr("disabled");
                $(".add_product_btn").html("Add Now !");
                
                    if(response.trim() === "success") {
                        $(".msg").removeClass("d-none");
                        var div = document.createElement("div");
                        div.className="alert alert-success fs-1 p-5 text-center";
                        div.innerHTML = "Product Added Successfully <br><i class='fa-solid fa-square-check display-1'></i>";
                        $(".msg").html(div);
                        setTimeout(function(){
                            $(".msg").addClass("d-none");
                            $(".msg").html("");
                            $('[page_link="add_product"]').click();
                        },2000);
                    }
                    else
                    {
                    alert(response);
                    $('[page_link="add_product"]').click();
                    }
                }              
            });
        });
    });
</script>
