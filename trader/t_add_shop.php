<?php
    if(isset($_GET['trader_id']))
    {
        $trader_id = $_GET['trader_id'];
        // echo $trader_id;
        
        if(isset($_POST['addShop']))
        {
            $shop_name = $_POST['shop_name'];
            $shop_desc = $_POST['shop_desc'];
            $shop_loc = $_POST['shop_loc'];
    
            include "connect.php";
            $qry = "INSERT INTO SHOP(SHOP_NAME, SHOP_DESCRIPTION, SHOP_LOCATION, TRADER_ID, SHOP_VERIFICATION) VALUES ('$shop_name', '$shop_desc', '$shop_loc', $trader_id, '0')";
            $res = oci_parse($conn, $qry);
            oci_execute($res);

            if($res)
            {
                echo"
                    <script>
                        alert('SHOP ADDED!');
                        window.location.href = 'trader_shop.php?id=$trader_id';
                    </script>
                ";
            }
        }
    }
?>