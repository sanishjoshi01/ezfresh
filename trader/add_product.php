<?php
     include "../start.php";
     include "t_header.php";

     if(isset($_GET['trader_id']))
     {
         $tid = $_GET['trader_id'];
     }

     include "connect.php";
     $ss= "SELECT * FROM SHOP WHERE TRADER_ID=$tid";
     $rr = oci_parse($conn, $ss);
     oci_execute($rr);

     $cr = oci_fetch_all($rr, $rcr);
?>
<style>
     input[type="file"] {
        display: none;
    }
    #req{
        color: red;
    }
    #re:hover #req{
        color: white;
    }
</style>

<?php

if($cr == 0)
{
    echo"
    <script>
        alert('You do not have any shop yet. First add a shop to add product!');
        window.location.href = 'trader_shop.php?id=$tid';
    </script>
";
}
?>
<div class="container">
    <div class="h4 text-center">ADD PRODUCT</div>
    <div class="row d-flex justify-content-center">
        <div class="col-8 border border-dark-light bg-light">
            <form action="t_add_product.php?trader_id=<?php echo $tid; ?>" method="POST">

                <div class="form-group py-3 px-5 d-flex justify-content-center">
                    <div class="text-center">
                        <div class="mx-5" style="width: 14rem; height: 14rem; float:center;">
                            <img style="width: 12rem; height: 12rem;" class="img-fluid" src="<?php echo $finimage; ?>" >
                        </div>
                        <div>
                            <input type='hidden' name='productPicPath' value="images/products/"/>
                                <label id='re' for="file-upload" class="btn btn-outline-success btn-sm border-3" style="font-weight: bold;">
                                    <?php
                                        if(empty($finimage))
                                        {
                                            echo "Upload Product Image <strong id='req'>*REQUIRED*</strong>";
                                        }
                                        else{
                                            echo "Change Product Image";
                                        }
                                    ?>
                                </label>
                            <input required id="file-upload" class="text-center" type='file' name='productPic' onchange="getFileData(this);"/><br><br>
                            <script>
                                function getFileData(myFile){
                                    var file = myFile.files[0];  
                                    var filename = file.name;

                                    document.getElementById("file-name").innerHTML = "Selected file: " + filename;
                                }
                            </script>
                             <h6 id="file-name" class="text-center" disabled></h6>
                        </div>
                    </div>
                </div>

                <div class="form-group py-3 px-5">
                    <label class="mb-2" for="p_name"><b>Product Name: </b></label>
                    <input type="text" class="form-control" placeholder="Enter your product name here..." name="p_name" value="" required>
                </div>
                <?php
                    include "connect.php";

                    $qr2 = "SELECT * FROM SHOP WHERE TRADER_ID = $tid";
                    $re2 = oci_parse($conn, $qr2);
                    oci_execute($re2);
                    while($r = oci_fetch_assoc($re2))
                    {
                        $shop_id = $r['SHOP_ID'];
                        $shop_name = $r['SHOP_NAME'];

                        include "connect.php";
                        $qrt = "SELECT * FROM PRODUCT WHERE SHOP_ID = $shop_id";
                        $ret = oci_parse($conn, $qrt);
                        oci_execute($ret);

                        while($r = oci_fetch_assoc($ret))
                        {
                            $p_type= $r['PRODUCT_TYPE'];
                        }
                    }
                ?>
                <div class="form-group py-3 px-5">
                    <label class="mb-2" for="p_type"><b>Product Type: </b></label>
                    <input type="text" class="form-control" placeholder="Enter your product type here..." name="p_type" value="" required>
                </div>

                <div class="form-group py-3 px-5">
                    <label class="mb-2" for="p_desc"><b>Product Description: </b></label>
                    <input type="text" class="form-control" placeholder="Enter your product description here..." name="p_desc" value="" required>
                </div>

                <div class="form-group py-3 px-5">
                    <label class="mb-2" for="p_price"><b>Product Price: </b></label>
                    <input type="number" step="0.01" class="form-control" placeholder="Enter your product price here..." name="p_price" value="" required>
                </div>

                <div class="form-group py-3 px-5">
                    <label class="mb-2" for="p_stock"><b>Product Stock: </b></label>
                    <input type="number" class="form-control" placeholder="Enter your product stock here..." name="p_stock" value="" required min="1" max="20">
                </div>
                            
                <div class="form-group py-3 px-5">
                    <label class="mb-2" for="shop_name"><b>Shop Name: </b></label>
                    <select class='form-select' name="shop_name" required>
                        <option selected disabled>Select the shop you want to keep this product on...</option>
                            <?php
                                include "connect.php";

                                $qr = "SELECT * FROM SHOP WHERE TRADER_ID=$tid AND SHOP_VERIFICATION='1'";
                                $re = oci_parse($conn, $qr);
                                oci_execute($re);
                               
                                while($r = oci_fetch_assoc($re))
                                {
                                    $shop_id = $r['SHOP_ID'];
                                    $shop_name = $r['SHOP_NAME'];
                                   
                                    echo"
                                        <option value='$shop_name'>$shop_name</option>
                                        
                                    ";
                                }
                            ?>
                    </select>
                </div>
                <div class="form-group py-3 px-5">
                    <button class='btn btn-success' name='addProduct'>ADD PRODUCT</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
    include "../main-footer.php";
    include "../end.php";
?>