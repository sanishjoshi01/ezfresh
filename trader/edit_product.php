<?php
     include "../start.php";
     include "t_header.php";

     if(isset($_GET['trader_id']))
     {
         $tid = $_GET['trader_id'];
        //  echo $tid;
     }
     if(isset($_GET['pid']))
     {
        $pid = $_GET['pid'];
        //  echo $pid;

        include "connect.php";
        $qry ="SELECT * FROM PRODUCT WHERE PRODUCT_ID=$pid";
        $res = oci_parse($conn, $qry);
        oci_execute($res);

        while($row = oci_fetch_assoc($res))
        {
            $p_image = $row['PRODUCT_IMAGE'];
            $p_name = $row['PRODUCT_NAME'];
            $p_type = $row['PRODUCT_TYPE'];
            $p_desc = $row['PRODUCT_DESCRIPTION'];            
            $p_price = $row['PRODUCT_PRICE'];            
            $p_stock = $row['PRODUCT_STOCK'];
            
            $imgpath = '../';
            $finimage = $imgpath.$p_image;
        }
     }
?>
<style>
    input[type="file"] {
        display: none;
    }
</style>

<div class="container">
    <div class="h4 text-center">EDIT PRODUCT</div>
    <div class="row d-flex justify-content-center">
        <div class="col-8 border border-dark-light bg-light">
            <form action="t_edit_product.php?pid=<?php echo $pid; ?>" method="POST">
                <div class="form-group py-3 px-5 d-flex justify-content-center">
                    <div class="text-center">
                        <div class="mx-5" style="width: 14rem; height: 14rem; float:center;">
                            <img style="width: 12rem; height: 12rem;" class="img-fluid" src="<?php echo $finimage; ?>" >
                        </div>
                        <div>
                            <input type='hidden' name='productPicPath' value="images/products/"/>
                                <label for="file-upload" class="btn btn-outline-success btn-sm border-3" style="font-weight: bold;">
                                    <?php
                                        if(empty($finimage))
                                        {
                                            echo "Upload Product Image";
                                        }
                                        else{
                                            echo "Change Product Image";
                                        }
                                    ?>
                                </label>
                            <input id="file-upload" class="text-center" type='file' name='productPic' onchange="getFileData(this);"/><br><br>
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
                    <label for="p_name" class="mb-2"><b>Product Name: </b></label>
                    <input name="p_name" type="text" class="form-control" value="<?php echo $p_name; ?>" required>
                </div>

                <div class="form-group py-3 px-5">
                    <label for="p_type" class="mb-2"><b>Product Type: </b></label>
                    <input name="p_type" type="text" class="form-control" value="<?php echo $p_type; ?>" disabled>
                    <input name="p_type" type="hidden" class="form-control" value="<?php echo $p_type; ?>">
                </div>

                <div class="form-group py-3 px-5">
                    <label for="p_desc" class="mb-2"><b>Product Description: </b></label>
                    <textarea name="p_desc" type="text" class="form-control" required ><?php echo $p_desc; ?></textarea>
                </div>

                <div class="form-group py-3 px-5">
                    <label for="p_price" class="mb-2"><b>Product Price ($): </b></label>
                    <input name="p_price" type="text" class="form-control" value="<?php echo $p_price; ?>" required>
                </div>

                <div class="form-group py-3 px-5">
                    <label for="p_stock" class="mb-2"><b>Product Stock: </b></label>
                    <input name="p_stock" type="number" class="form-control" value="<?php echo $p_stock; ?>" required min="1" max="20">
                </div>
                                
                <!-- SUBMIT -->
                <div class="form-group py-3 px-5">
                    <button class="btn btn-success" name="editProduct">SUBMIT</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
    include "../main-footer.php";
    include "../end.php";
?>