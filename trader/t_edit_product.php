<?php
    session_start();
       
    if(isset($_GET['pid'])){
        $pid = $_GET['pid'];
        // echo $pid;
    }

    if(isset($_POST['editProduct']))
    {
        $n_pname = $_POST['p_name'];
        $n_ptype = $_POST['p_type'];
        $n_pdesc = $_POST['p_desc'];
        $n_pprice = $_POST['p_price'];
        $n_pstock = $_POST['p_stock'];
        $n_ppPath = $_POST['productPicPath'];   // FOR - ../images/profile/ path
        
        if(!empty($_POST['productPicPath']) && !empty($_POST['productPic']))
        {
            $n_pp = $_POST['productPic'];           // FOR profile picture value - imagesname.png

            $new_pp = $n_ppPath.$n_pp;            //concacenating to get = ../images/profile/imagesname.png
        }
        else{
            include "connect.php";
            $qry = "SELECT * FROM PRODUCT WHERE PRODUCT_ID = '$pid'";

            $res = oci_parse($conn, $qry);
            oci_execute($res);
            
            while($r = oci_fetch_assoc($res))
            {
                $tpp = $r['PRODUCT_IMAGE'];
                $new_pp = $tpp;
            }
        }

        $sql1 = "UPDATE PRODUCT SET PRODUCT_NAME = '$n_pname', PRODUCT_TYPE = '$n_ptype', PRODUCT_DESCRIPTION ='$n_pdesc', PRODUCT_PRICE ='$n_pprice', PRODUCT_STOCK ='$n_pstock', PRODUCT_IMAGE='$new_pp' WHERE PRODUCT_ID=$pid";

        include "connect.php";
        $qry1 = oci_parse($conn, $sql1);
        oci_execute($qry1);

        if($qry1){
            echo
            "
                <script>
                    alert('Product Updated');
                    window.location.href = 'edit_product.php?pid=$pid';
                </script>            
            ";
        }
    }
?>