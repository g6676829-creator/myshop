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


<h1 class="text-center">Orders</h1>
<form class="order_data_form d-flex mb-3">
    <select name="status" class="form-control w-25">
        <option value="pending">pending</option>
        <option value="completed">completed</option>
    </select>
    <input type="date" name="date" class="form-control w-25 ms-2">
    <button type="submit" class="btn btn-primary ms-2">Get Data</button>
</form>

<div class="box p-4 bg-white mb-3">


    <div id="msg" class="msg d-none"></div>

    <table class="table table-hover bg-primary">
        <thead>
            <tr>
                <th scope="col">Id</th>               
                <th scope="col">Image</th>
                 <th scope="col">Title</th>
                <th scope="col">Quantity</th>
                <th scope="col">Amount</th>
                <th scope="col">Name</th>
                <th scope="col">Mobile No.</th>
                <th scope="col">Address</th>
                <th scope="col">Payment</th>
                <th scope="col">Order</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>
</div>





<script type="text/javascript">
    $(document).ready(function(){
        $(".order_data_form").submit(function(e){
            e.preventDefault();
            $("tbody").html("");
            $.ajax({
                type:"POST",
                url:"php/get_order_data.php",
                data:new FormData(this),
                processData:false,
                contentType:false,
                success:function(response){
                    var alldata = JSON.parse(response);
                    var ps="";
                    var os="";
                    var i;
                    for(i=0;i<alldata.length;i++)
                    {
                        //check payment status
                        if(alldata[i].payment_status == "pending")
                        {
                            ps="<i class='fas fa-exclamation-triangle fs-3 text-warning mb-3'></i><br><button class='btn btn-success btn-sm update' oid='"+alldata[i].id+"' btn_type='payment_status'>Update</button>";
                        }
                        else
                        {
                            ps="<i class='fas fa-check-circle fs-3 text-success mb-3'></i>";
                        }

                        //check order status
                        if(alldata[i].order_status == "pending")
                        {
                            os="<i class='fas fa-exclamation-triangle fs-3 text-warning mb-3'></i><br><button class='btn btn-success btn-sm update' oid='"+alldata[i].id+"' btn_type='order_status'>Update</button>";
                        }
                        else
                        {
                            os="<i class='fas fa-check-circle fs-3 text-success mb-3'></i>";
                        }



                        $("tbody").append("<tr><td>"+alldata[i].id+"</td> <td><img src='../product_images/"+alldata[i].prd_img+"' width='100px'></td> <td>"+alldata[i].prd_name+"</td> <td>"+alldata[i].prd_qty+"</td> <td>"+alldata[i].ttl_amount+"</td> <td>"+alldata[i].cname+"</td> <td>"+alldata[i].cphone+"</td> <td>"+alldata[i].caddress+"</td> <td align='center'>"+ps+"</td> <td align='center'>"+os+"</td></tr>");
                    }

                    //ajax for update
                    $(".update").each(function(){
                        $(this).click(function(){
                            var oid = $(this).attr("oid");
                            var btn_type = $(this).attr("btn_type");
                            var tdele = this.parentElement;

                            $.ajax({
                                type:"POST",
                                url:"php/update_order.php",
                                data:{
                                    oid:oid,
                                    btn_type:btn_type
                                },
                                success:function(update){
                                    if(update.trim()=="success")
                                    {
                                        tdele.innerHTML="<i class='fas fa-check-circle fs-3 text-success mb-3'></i>";
                                    }
                                    else
                                    {
                                        alert(update);
                                    }
                                }
                            })
                        })
                    })
                }
            });
        });
    });
    
</script>
