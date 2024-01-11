<?php
include "t_header.php";
?>

<?php
// trader id 
if (isset($_GET['id'])) {
    $tid = $_GET['id'];

    include "connect.php";
    $qryy = "SELECT * FROM TRADER WHERE TRADER_ID=$tid";
    $res = oci_parse($conn, $qryy);
    oci_execute($res);

    while ($row = oci_fetch_assoc($res)) {
        $t_fullname = $row['FULL_NAME'];
    }
}
?>

<div class="container">
    <div class="container w-75 border border-dark">
        <div class="h4 p-2">WELCOME <b>'<?php echo $t_fullname ?>'</b>. This is your dashboard</div>
    </div>
    <div class="container w-75 mt-4">
        <div class="d-flex justify-content-around">
            <?php
            if (isset($_GET['id'])) {
                $tid = $_GET['id'];

                include "connect.php";
                $sql1 = "SELECT * FROM SHOP, TRADER, PRODUCT WHERE TRADER.TRADER_ID = SHOP.TRADER_ID AND SHOP.SHOP_ID = PRODUCT.SHOP_ID AND TRADER.TRADER_ID=$tid AND PRODUCT.PRODUCT_VERIFICATION='1'";
                $res1 = oci_parse($conn, $sql1);
                oci_execute($res1);
                $countProducts = oci_fetch_all($res1, $re);
                // echo $countProducts;

                include "connect.php";
                $sql2 = "SELECT * FROM ORDERS O, SHOP S, TRADER T, PRODUCT P
                    WHERE S.TRADER_ID = T.TRADER_ID 
                    AND S.SHOP_ID = P.SHOP_ID 
                    AND P.PRODUCT_ID = O.PRODUCT_ID
                    AND T.TRADER_ID = $tid 
                    AND P.PRODUCT_VERIFICATION='1'
                    ";

                $res2 = oci_parse($conn, $sql2);
                oci_execute($res2);
                $totalOrders = oci_fetch_all($res2, $re2);
                // echo $countProducts;

                include "connect.php";
                $sql3 = "SELECT SUM(ORDER_PRICE) AS SUM_TP FROM ORDERS O, SHOP S, TRADER T, PRODUCT P
                    WHERE S.TRADER_ID = T.TRADER_ID 
                    AND S.SHOP_ID = P.SHOP_ID 
                    AND P.PRODUCT_ID = O.PRODUCT_ID
                    AND T.TRADER_ID = $tid 
                    AND P.PRODUCT_VERIFICATION='1'
                    ";

                $res3 = oci_parse($conn, $sql3);
                oci_execute($res3);

                $r = oci_fetch_assoc($res3);
                $coo = $r['SUM_TP'];
                // $total_pay = $r['TOTAL_PAYMENT'];

                // $totalEarnings = oci_fetch_all($res3, $re3);
                // echo $countProducts;
            }
            ?>
            <div
                class="col-4 m-2 border border-light-dark bg-light d-flex flex-column align-items-center justify-content-center">
                <span style="font-size: 6vw; color: #0fabff;"><?php echo $countProducts; ?></span><br>
                <h4 style="font-size: 1.5vw;" class="mb-5"><b>NO. OF PRODUCTS</b></h4>
            </div>
            <div
                class="col-4 m-2 border border-light-dark bg-light d-flex flex-column align-items-center justify-content-center">
                <span style="font-size: 6vw; color: #8f07d9;"><?php echo $totalOrders; ?></span><br>
                <h4 style="font-size: 1.5vw;" class="mb-5"><b>TOTAL ORDERS</b></h4>
            </div>
            <div
                class="col-4 m-2 border border-light-dark bg-light d-flex flex-column align-items-center justify-content-center">
                <span style="font-size: 6vw; color: #85bb65;">$<?php echo $coo; ?></span><br></span>
                <h4 style="font-size: 1.5vw;" class="mb-5"><b>TOTAL EARNINGS</b></h4>
            </div>
        </div>

        <div class="border border-dark text-center my-3 p-4">
            <h4 style="font-size: 1.5vw;"><b>GO TO YOUR ORACLE: </b></h4>
            <a target="_blank" href='http://localhost:8080/apex/f?p=104:LOGIN_DESKTOP:28481634975708:::::'
                class='btn btn-outline-success border-3' style="font-size: 3vw;">DASHBOARD</a>
        </div>
    </div>
</div>

<?php
include "../main-footer.php";
?>