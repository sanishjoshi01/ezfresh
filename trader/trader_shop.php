<?php
     include "../start.php";
     include "t_header.php";
?>
<div class="container">
    <div class="h4 text-center">YOUR SHOPS</div>
    <div class="d-flex justify-content-center">
        <div class="col-12 border border-dark-light bg-light p-5 mt-4">
            <table class="table mt-3">
                <thead>
                    <tr class='text-center'>
                        <th colspan='1' scope='col'>SN</th>
                        <th colspan='1' scope='col'>Shop ID</th>
                        <th colspan='1' scope='col'>Shop Name</th>
                        <th colspan='1'scope='col'>Shop Description</th>
                        <th colspan='1' scope='col'>Shop Location</th>
                        <th colspan='1' scope='col'>Status</th>
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
                            $sn = 0;

                            while($r = oci_fetch_assoc($res))
                            {
                                $shop_id = $r['SHOP_ID'];
                                $shop_name = $r['SHOP_NAME'];
                                $shop_desc = $r['SHOP_DESCRIPTION'];
                                $shop_loc = $r['SHOP_LOCATION'];
                                $shop_verify = $r['SHOP_VERIFICATION'];
                                $sn = $sn + 1;
                                echo    
                                "
                                    <tr>
                                        <td class='text-center border border-groove p-3'>$sn</td>
                                        <td class='text-center border border-groove p-3'>$shop_id</td>
                                        <td class='text-center border border-groove align-middle'>$shop_name</td>
                                        <td class='border border-groove align-middle w-50'>$shop_desc</td>
                                        <td class='text-center border border-groove align-middle'>$shop_loc</td>
                                        <td class='text-center border border-groove align-middle'>
                                ";
                                        if($shop_verify == 1)
                                        {
                                            echo "<b style='color: #2cdb40;'>Verified</b>";
                                        }
                                        else{
                                            echo "<b style='color: red;'>Not Verified</b>";
                                        }
                                echo"
                                        </td>
                                    </tr>
                                ";
                            }
                            // include "connect.php";
                            // $sqly = "SELECT * FROM SHOP WHERE TRADER_ID = $tid";
                            // $resy = oci_parse($conn, $sqly);
                            // oci_execute($resy);
                            
                            // $count = oci_fetch_all($resy, $res2s);
                                echo"
                                </div>
                                <div class='d-flex justify-content-between align-items-center'>
                                    <div>
                                        <form action='add_shop.php' method='GET'>
                                            <input type='hidden' name='trader_id' value='$tid'>
                                            <button class='btn btn-outline-success border-3' style='font-weight:bold;' type='submit'>ADD SHOP</button>
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