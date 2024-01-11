<?php
    if(isset($_GET['tid']))
    {
        $tid = $_GET['tid'];
        
        if(isset($_GET['pid']))
        {
            $product_id = $_GET['pid'];

            include "connect.php";
            $del = "DELETE FROM PRODUCT WHERE PRODUCT_ID = $product_id";
            $result = oci_parse($conn, $del);
            oci_execute($result);

            if($result)
            {
            echo
                "
                <script>
                    alert('Product Deleted Successfully');
                    window.location.href = 'trader_product.php?id=$tid';
                </script>
                ";
            }
        }
    }
?>