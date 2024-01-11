<?php
     include "../start.php";
     include "t_header.php";
?>
<div class="container">
    <div class="h4 text-center">ORDERS</div>
    <div class="d-flex justify-content-center">
        <div class="col-12 border border-dark-light bg-light p-5 mt-4">
            <table class="table mt-3">
                <thead>
                    <tr class='text-center'>
                        <th colspan='1' scope='col'>Order Date</th>
                        <th colspan='1' scope='col'>Product Image</th>
                        <th colspan='1' scope='col'>Product Name</th>
                        <th colspan='1' scope='col'>Buyer Name</th>
                        <th colspan='1' scope='col'>Quantity</th>
                        <th colspan='1' scope='col'>Total</th>  
                    </tr>
                </thead>

                <tbody class="border">
                    <?php
                        if(isset($_GET['id']))
                        {
                            $tid = $_GET['id'];

                            include "connect.php";
                            $sql = "SELECT * FROM SHOP WHERE TRADER_ID='$tid'";
                            $res = oci_parse($conn, $sql);
                            oci_execute($res);

                            while($r = oci_fetch_assoc($res))
                            {
                                $shop_id = $r['SHOP_ID'];
                                $shop_name = $r['SHOP_NAME'];

                                include "connect.php";
                                $sql2 = "SELECT * FROM PRODUCT WHERE SHOP_ID=$shop_id";
                                $res2 = oci_parse($conn, $sql2);
                                oci_execute($res2);

                                while($r2 = oci_fetch_assoc($res2))
                                {
                                    $p_id = $r2['PRODUCT_ID'];
                                    $p_name = $r2['PRODUCT_NAME'];
                                    $p_image = $r2['PRODUCT_IMAGE'];
                                    
                                    $imgPath ='../';

                                    $f_img= $imgPath.$p_image;

                                    // echo $p_name;
                                    include "connect.php";
                                    $sql3 = "SELECT * FROM ORDERS WHERE PRODUCT_ID=$p_id";
                                    $res3 = oci_parse($conn, $sql3);
                                    oci_execute($res3);

                                    while($r3 = oci_fetch_assoc($res3))
                                    {
                                        $o_id = $r3['ORDER_ID'];
                                        $o_date = $r3['ORDER_DATE'];
                                        $o_quan = $r3['QUANTITY'];
                                        $o_price = $r3['ORDER_PRICE'];
                                        $c_id = $r3['CUSTOMER_ID'];

                                        include "connect.php";
                                        $sql4 = "SELECT * FROM CUSTOMER WHERE CUSTOMER_ID=$c_id";
                                        $res4 = oci_parse($conn, $sql4);
                                        oci_execute($res4);

                                        $r4 = oci_fetch_assoc($res4);
                                        $c_fname = $r4['FIRST_NAME'];
                                        $c_lname = $r4['LAST_NAME'];

                                        $c_fullname = $c_fname.' '.$c_lname;

                                        echo
                                        "
                                        <tr>
                                            <td class='text-center border border-groove align-middle p-3'>$o_date</td>
                                            <td class='text-center border border-groove p-3'><img src='$f_img' style='width:5vw' ></td>
                                            <td class='text-center border border-groove align-middle'>$p_name</td>
                                            <td class='text-center border border-groove align-middle'>$c_fullname </td>
                                            <td class='text-center border border-groove align-middle'>$o_quan</td>
                                            <td class='text-center border border-groove align-middle'>$$o_price</td>
                                        </tr>
                                        ";
                                    }
                                }
                            }
                            echo"
                            <div class='d-flex justify-content-between align-items-center'>
                                <div style='font-size: 1.3vw;'>
                                    <b>All Orders</b>
                                </div>
                            </div>
                            ";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
    include "../main-footer.php";
    include "../end.php";
?>