<?php
     include "../start.php";
     include "t_header.php";

     if(isset($_GET['trader_id']))
     {
         $tid = $_GET['trader_id'];
     }
?>

<div class="container">
    <div class="h4 text-center">ADD SHOP</div>
    <div class="row d-flex justify-content-center">
        <div class="col-8 border border-dark-light bg-light">
            <form action="t_add_shop.php?trader_id=<?php echo $tid; ?>" method="POST">
                <div class="form-group py-3 px-5">
                    <label class="mb-2" for="shop_name"><b>Shop Name: </b></label>
                    <input type="text" class="form-control" placeholder="Enter your shop name here..." name="shop_name" value="" required>
                </div>

                <div class="form-group py-3 px-5">
                    <label class="mb-2" for="shop_desc"><b>Shop Description: </b></label>
                    <input type="text" class="form-control" placeholder="Enter your shop description here..." name="shop_desc" value="" required>
                </div>

                <div class="form-group py-3 px-5">
                    <label class="mb-2" for="shop_loc"><b>Shop Location: </b></label>
                    <input type="text" class="form-control" placeholder="Enter your shop location here..." name="shop_loc" value="" required>
                </div>
                <div class="form-group py-3 px-5">
                    <button class="btn btn-success" name="addShop">SUBMIT</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
    include "../main-footer.php";
    include "../end.php";
?>