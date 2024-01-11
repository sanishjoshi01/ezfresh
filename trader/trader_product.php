<?php
include "../start.php";
include "t_header.php";
error_reporting(0);
?>
<div class="container">
    <div class="h4 text-center">YOUR PRODUCTS</div>
    <div class="d-flex justify-content-center">
        <div class="col-12 border border-dark-light bg-light p-5 mt-4">
            <table class="table mt-3">
                <thead>
                    <tr class='text-center'>
                        <th colspan='1' scope='col'>SN</th>
                        <th colspan='1' scope='col'>Image</th>
                        <th colspan='1' scope='col'>Name</th>
                        <th colspan='1' scope='col'>Type</th>
                        <th colspan='1' scope='col'>Price</th>
                        <th colspan='1' scope='col'>Stock</th>
                        <th colspan='1' scope='col'>Status</th>
                        <th colspan='1' scope='col'>Actions</th>
                    </tr>
                </thead>

                <tbody class="border">
                    <?php
                    if (isset($_GET['id'])) {
                        $tid = $_GET['id'];

                        include "connect.php";
                        $sql1 = "SELECT * FROM SHOP WHERE TRADER_ID='$tid'";
                        $res1 = oci_parse($conn, $sql1);
                        oci_execute($res1);
                        $sn = 0;

                        while ($r = oci_fetch_assoc($res1)) {
                            $shop_id = $r['SHOP_ID'];
                            // echo $shop_id;

                            include "connect.php";
                            $sql = "SELECT * FROM PRODUCT WHERE SHOP_ID = '$shop_id'";
                            $res = oci_parse($conn, $sql);
                            oci_execute($res);

                            while ($r = oci_fetch_assoc($res)) {
                                $pid = $r['PRODUCT_ID'];
                                $pname = $r['PRODUCT_NAME'];
                                $ptype = $r['PRODUCT_TYPE'];
                                // $pdesc = $r['PRODUCT_DESCRIPTION'];
                                $pprice = $r['PRODUCT_PRICE'];
                                $pimage = $r['PRODUCT_IMAGE'];
                                $pstock = $r['PRODUCT_STOCK'];
                                $p_verify = $r['PRODUCT_VERIFICATION'];

                                $pimgpath = '../';

                                $final_pimage = $pimgpath . $pimage;

                                $sn = $sn + 1;

                                echo
                                "
                                        <tr>
                                            <td class='text-center border border-groove align-middle'>$sn</td>
                                            <td class='text-center border border-groove p-3'><img src='$final_pimage' style='width:5vw' ></td>
                                            <td class='text-center border border-groove align-middle'>$pname</td>
                                            <td class='text-center border border-groove align-middle'>$ptype</td>
                                            <td class='text-center border border-groove align-middle'>$pprice</td>
                                            <td class='text-center border border-groove align-middle'>$pstock</td>
                                            <td class='text-center border border-groove align-middle'>
                                    ";
                                if ($p_verify == 1) {
                                    echo "<b style='color: #2cdb40;'>Enabled</b>";
                                } else {
                                    echo "<b style='color: red;'>Disabled</b>";
                                }
                                echo "
                                            </td>
                                            <td class='text-center border border-groove align-middle'>
                                    ";
                                if ($p_verify == 1) {
                                    echo "
                                        <div class='btn'>
                                            <a title='Edit' style='color: #3b91bc; text-decoration:none;' href='edit_product.php?pid=$pid'><i class='fas fa-edit btn btn-outline-info py-2'></i></a>
                                        </div>
                                        ";
                                } else {

                                    echo "
                                        <div class='btn'>
                                            <a title='Disabled Product' style='pointer-events: none; color: #3b91bc; text-decoration:none;'><i class='fas fa-edit btn btn-outline-info py-2'></i></a>
                                        </div>
                                    ";
                                }
                                if ($p_verify == 1) {
                                    echo "
                                            <div class='btn'>
                                                <a title='Delete' style='color: #3b91bc; text-decoration:none;' href='t_delete_product.php?pid=$pid&tid=$tid ' onclick=\"return confirm('Are you sure to you want to delete this product. This cannot be undone!?');\"><i class='fa-regular fa-trash-can btn btn-outline-danger py-2'></i></a>
                                            </div>
                                        ";
                                } else {
                                    echo "
                                        <div class='btn'>
                                            <a title='Disabled Product' style='pointer-events: none; color: #3b91bc; text-decoration:none;'><i class='fa-regular fa-trash-can btn btn-outline-danger py-2'></i></a>
                                        </div>
                                        ";
                                }
                            }
                            echo "
                                </td>
                                </tr>
                                ";
                        }
                        // include "connect.php";
                        // $sqlx = "SELECT * FROM PRODUCT WHERE PRODUCT_TYPE = '$ptype'";
                        // $resx = oci_parse($conn, $sqlx);
                        // oci_execute($resx);

                        // $count = oci_fetch_all($resx, $res1s);
                        echo "
                            </div>

                            <div class='d-flex justify-content-between align-items-center'>
                                <div>
                                    <form action='add_product.php' method='GET'>
                                        <input type='hidden' name='trader_id' value='$tid'>
                                        <button class='btn btn-outline-success border-3' style='font-weight:bold;' type='submit'>ADD PRODUCT</button>
                                    </form>
                                </div>
                                <div style='color: blue; font-size: 1.3vw;'>
                                    TOTAL PRODUCTS: <b>($sn)</b>
                                </div>
                            </div>
                    </tbody>
                </table>
                                ";
                    }
                    ?>
        </div>
    </div>
</div>

<?php
include "../main-footer.php";
include "../end.php";
?>