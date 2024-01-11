<?php
include "../start.php";
include "a_header.php";
//  error_reporting(0);
?>
<div class="container">
    <div class="h4 text-center">PRODUCT MANAGEMENT</div>
    <div class="d-flex justify-content-center">
        <div class="col-12 border border-dark-light bg-light p-5 mt-4">
            <form action='admin_product.php' method="GET">
                <div class="d-flex w-25">
                    <select class="form-select" name='traders' onchange="this.form.submit()">
                        <option selected>Select Traders</option>
                        <option value="All Traders">All Traders</option>
                        <?php
                        include "connect.php";
                        $q = "SELECT * FROM TRADER";
                        $r = oci_parse($conn, $q);
                        oci_execute($r);

                        while ($row = oci_fetch_assoc($r)) {
                            $trader_id = $row['TRADER_ID'];
                            $trader_name = $row['FULL_NAME'];
                            echo "
                                <option value='$trader_name'>$trader_name</option>
                            ";
                        }
                        ?>
                    </select>
                </div>
            </form>

            <table class="table mt-3">
                <thead>
                    <tr class='text-center'>
                        <th colspan='1' scope='col'>SN</th>
                        <th colspan='1' scope='col'>Shop</th>
                        <th colspan='1' scope='col'>Product Image</th>
                        <th colspan='1' scope='col'>Product Name</th>
                        <th colspan='1' scope='col'>Product Category</th>
                        <th colspan='1' scope='col'>Status</th>
                        <th colspan='1' scope='col'>Actions</th>
                    </tr>
                </thead>
                <tbody class="border">
                    <?php
                    if (isset($_GET['traders'])) {
                        $trader_nam = $_GET['traders'];

                        echo "<div class='mt-3'>Selected Trader: <b>" . $trader_nam . "</b></div>";

                        $sn = 0;

                        include "connect.php";
                        $t = "SELECT * FROM TRADER WHERE FULL_NAME='$trader_nam'";
                        $tr = oci_parse($conn, $t);
                        oci_execute($tr);
                        while ($r = oci_fetch_assoc($tr)) {
                            $tr_id = $r['TRADER_ID'];

                            $t1 = "SELECT * FROM SHOP WHERE TRADER_ID=$tr_id";
                            $tr1 = oci_parse($conn, $t1);
                            oci_execute($tr1);
                            while ($r = oci_fetch_assoc($tr1)) {
                                $s_id = $r['SHOP_ID'];
                                $s_name = $r['SHOP_NAME'];
                                // echo $s_name;

                                $t2 = "SELECT * FROM PRODUCT WHERE SHOP_ID=$s_id";
                                $tr2 = oci_parse($conn, $t2);
                                oci_execute($tr2);
                                while ($r = oci_fetch_assoc($tr2)) {
                                    $p_id = $r['PRODUCT_ID'];
                                    $p_img = $r['PRODUCT_IMAGE'];
                                    $i_path = '../';
                                    $f_img = $i_path . $p_img;
                                    $p_name = $r['PRODUCT_NAME'];
                                    $p_type = $r['PRODUCT_TYPE'];
                                    $p_verify = $r['PRODUCT_VERIFICATION'];
                                    $sn = $sn + 1;

                                    echo "
                                        <tr>
                                            <form action='manage_product.php' method='POST'>
					                        <input type='hidden' name='pid' value='$p_id'>
                                                <td class='text-center border border-groove align-middle p-3'>$sn</td>
                                                <td class='text-center border border-groove align-middle p-3'>$s_name</td>
                                                <td class='text-center border border-groove align-middle p-3'><img src='$f_img' style='width:5vw'></td>
                                                <td class='text-center border border-groove align-middle p-3'>$p_name</td>
                                                <td class='text-center border border-groove align-middle p-3'>$p_type</td>
                                                <td class='text-center border border-groove align-middle p-3'>
                                    ";
                                    if ($p_verify == 1) {
                                        echo "
                                                        <b style='color: #2cdb40;'>Active</b>
                                                    ";
                                    } else {
                                        echo "
                                                        <b style='color: red;'>Disabled</b>
                                                    ";
                                    }
                                    echo "
                                                </td>
                                                <td class='text-center border border-groove align-middle p-3'>
                                    ";
                                    if ($p_verify == 1) {
                                        echo "
                                                        <button type='submit' class='btn btn-success' name='submit' disabled >Enable</button>
                                                        <br><br>
                                                        <button type='submit' class='btn btn-danger' name='submit1' >Disable</button>
                                                        ";
                                    } else {
                                        echo "
                                                        <button type='submit' class='btn btn-success' name='submit'  >Enable</button>
                                                        <br><br>
                                                        <button type='submit' class='btn btn-danger' name='submit1' disabled >Disable</button>
                                                        ";
                                    }
                                    echo "
                                                </td>
                                            </form>
                                        </tr>
                                    ";
                                }
                            }
                        }
                    }

                    if (isset($_GET['traders'])) {
                        if ($_GET['traders'] == 'All Traders') {
                            include "connect.php";
                            $sql = "SELECT * FROM product, shop, trader where trader.Trader_Id=shop.Trader_id and shop.Shop_Id=product.Shop_Id";
                            $qry = oci_parse($conn, $sql);
                            oci_execute($qry);

                            $sn = 0;
                            while ($row = oci_fetch_assoc($qry)) {
                                $s_name = $row['SHOP_NAME'];
                                $p_img = $row['PRODUCT_IMAGE'];
                                $i_path = '../';
                                $f_img = $i_path . $p_img;
                                $p_name = $row['PRODUCT_NAME'];
                                $p_type = $row['PRODUCT_TYPE'];
                                $p_type = $row['PRODUCT_TYPE'];
                                $p_verify = $row['PRODUCT_VERIFICATION'];
                                $p_id = $row['PRODUCT_ID'];
                                $sn = $sn + 1;

                                echo "
                                <tr>
                                    <form action='manage_product.php' method='POST'>
                                    <input type='hidden' name='pid' value='$p_id'>
                                        <td class='text-center border border-groove align-middle p-3'>$sn</td>
                                        <td class='text-center border border-groove align-middle p-3'>$s_name</td>
                                        <td class='text-center border border-groove align-middle p-3'><img src='$f_img' style='width:5vw'></td>
                                        <td class='text-center border border-groove align-middle p-3'>$p_name</td>
                                        <td class='text-center border border-groove align-middle p-3'>$p_type</td>
                                        <td class='text-center border border-groove align-middle p-3'>
                                        
                            ";
                                if ($p_verify == 1) {
                                    echo "
                                                            <b style='color: #2cdb40;'>Active</b>
                                                        ";
                                } else {
                                    echo "
                                                            <b style='color: red;'>Disabled</b>
                                                        ";
                                }
                                echo "
                                                    </td>
                                                    <td class='text-center border border-groove align-middle p-3'>
                                        ";
                                if ($p_verify == 1) {
                                    echo "
                                                            <button type='submit' class='btn btn-success' name='submit' disabled >Enable</button>
                                                            <br><br>
                                                            <button type='submit' class='btn btn-danger' name='submit1' >Disable</button>
                                                            ";
                                } else {
                                    echo "
                                                            <button type='submit' class='btn btn-success' name='submit'  >Enable</button>
                                                            <br><br>
                                                            <button type='submit' class='btn btn-danger' name='submit1' disabled >Disable</button>
                                                            ";
                                }
                                echo "
                                                    </td>
                                                </form>
                                            </tr>
                                        ";
                            }
                        }
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