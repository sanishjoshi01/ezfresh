<?php
    if(isset($_GET['trader_id']))
    {
        $trader_id = $_GET['trader_id'];
        // echo $trader_id;
        
        if(isset($_POST['addProduct']))
        {
            $n_ppPath = $_POST['productPicPath'];   // FOR - images/profile/ path
            
            if(!empty($_POST['productPicPath']) && !empty($_POST['productPic']))
            {
                $n_pp = $_POST['productPic'];           // FOR profile picture value - imagesname.png
    
                $new_pp = $n_ppPath.$n_pp;            //concacenating to get = images/profile/imagesname.png
            }

            $p_name = $_POST['p_name'];
            $p_type = $_POST['p_type'];
            $p_desc = $_POST['p_desc'];
            $p_price = $_POST['p_price'];
            $p_stock = $_POST['p_stock'];
            $shop_name = $_POST['shop_name'];
            // echo $shop_name;

            include "connect.php";

            $sql = "SELECT * FROM SHOP WHERE SHOP_NAME='$shop_name'";
            $run = oci_parse($conn, $sql);
            oci_execute($run);

            while($ro = oci_fetch_assoc($run))
            {
                $shop_id = $ro['SHOP_ID'];
            }

            // echo $shop_id;

            include "connect.php";
            $qry = "INSERT INTO PRODUCT(PRODUCT_NAME, PRODUCT_TYPE, PRODUCT_DESCRIPTION, PRODUCT_PRICE, PRODUCT_IMAGE, PRODUCT_STOCK, SHOP_ID, PRODUCT_VERIFICATION) VALUES ('$p_name', '$p_type', '$p_desc', '$p_price', '$new_pp', '$p_stock', $shop_id, '0')";
            $res = oci_parse($conn, $qry);
            oci_execute($res);

            if($res)
            {
                echo"
                    <script>
                        alert('NEW PRODUCT ADDED!');
                        window.location.href = 'trader_product.php?id=$trader_id';
                    </script>
                ";
            }
            else{
                echo"
                    <script>
                        alert('ERROR!');
                        window.location.href = 'trader_product.php?id=$trader_id';
                    </script>
                ";
            }
        }
    }
?>