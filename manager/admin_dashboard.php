<?php

    include "a_header.php";

    // trader id
    if(isset($_GET['aid']))
    {
        $aid = $_GET['aid'];

        // echo $aid;
        include "connect.php";
        $qryy = "SELECT * FROM ADMIN WHERE ADMIN_ID=$aid";
        $res = oci_parse($conn, $qryy);
        oci_execute($res);

        while($row = oci_fetch_assoc($res))
        {
            $a_username = $row['USERNAME'];
        }
    }
?>
<div class="container">
    <!-- <div class="container w-75 border border-dark">
        <div class="h4 p-2">WELCOME <b>'<?php echo $a_username ?>'</b>. This is your dashboard</div>
    </div> -->
    <?php
                if(isset($_GET['aid']))
                {
                    $aid = $_GET['aid'];

                    include "connect.php";
                    $sql1 = "SELECT * FROM TRADER WHERE TRADER_VERIFICATION='1'";
                    $res1 = oci_parse($conn, $sql1);
                    oci_execute($res1);
                    $totalTraders = oci_fetch_all($res1, $re);
                    // echo $countProducts;

                    include "connect.php";
                    $sql2 = "SELECT * FROM PRODUCT WHERE PRODUCT_VERIFICATION='1'";

                    $res2 = oci_parse($conn, $sql2);
                    oci_execute($res2);
                    $totalProducts = oci_fetch_all($res2, $re2);
                    // echo $countProducts;

                    include "connect.php";
                    $sql3 = "SELECT * FROM SHOP WHERE SHOP_VERIFICATION='1'";

                    $res3 = oci_parse($conn, $sql3);
                    oci_execute($res3);

                    $totalShops = oci_fetch_all($res3, $re2);

                    // $total_pay = $r['TOTAL_PAYMENT'];

                    // $totalEarnings = oci_fetch_all($res3, $re3);
                    // echo $countProducts;
                }
            ?>  
        <div class="container w-75 mt-4">
            <div class="row d-flex justify-content-center">
                <div class="col-4 border border-dark d-flex flex-column align-items-center justify-content-center">
                    <span style="font-size: 7vw; color: #0fabff;"><?php echo $totalProducts; ?></span><br>
                    <h4 style="font-size: 1.5vw;" class="mb-5"><b>TOTAL PRODUCTS</b></h4>
                </div>
                <div class="col-4 border border-dark d-flex flex-column align-items-center justify-content-center">
                    <span style="font-size: 7vw; color: #c97c40;"><?php echo $totalTraders; ?></span><br>
                    <h4 style="font-size: 1.5vw;" class="mb-5"><b>TOTAL TRADERS</b></h4>
                </div>
                <div class="col-4 border border-dark d-flex flex-column align-items-center justify-content-center">
                    <span style="font-size: 7vw; color: #23db95;"><?php echo $totalShops; ?></span><br>
                    <h4 style="font-size: 1.5vw;" class="mb-5"><b>TOTAL SHOPS</b></h4>
                </div>
            </div>
        </div>
        <div class="border border-dark text-center my-3 p-4">
            <h4 style="font-size: 1.5vw;" ><b>GO TO YOUR ORACLE: </b></h4>
            <a target="_blank" href='http://localhost:8080/apex/f?p=105:LOGIN_DESKTOP:14175732088283:::::' class='btn btn-outline-success border-3' style="font-size: 3vw;">DASHBOARD</a>
        </div>
</div>
<?php
    include "../main-footer.php";
?>