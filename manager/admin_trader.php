<?php
     include "../start.php";
     include "a_header.php";
    //  error_reporting(0);

?>
<div class="container">
    <div class="h4 text-center">TRADER MANAGEMENT</div>
    <div class="d-flex justify-content-center">
        <div class="col-12 border border-dark-light bg-light p-5 mt-4">
        <form action='admin_product.php' method="GET">
            <!-- <div class="d-flex w-25">
                <select class="form-select" name='traders' onchange="this.form.submit()">
                    <option selected>Select Traders</option>
                    <option value="All Traders">All Traders</option>
                    <?php
                        include "connect.php";
                        $q = "SELECT * FROM TRADER";
                        $r = oci_parse($conn, $q);
                        oci_execute($r);

                        while($row = oci_fetch_assoc($r)){
                            $trader_id = $row['TRADER_ID'];
                            $trader_name = $row['FULL_NAME'];
                            echo"
                                <option value='$trader_name'>$trader_name</option>
                            ";
                        }
                    ?>
                </select>
            </div> -->
        </form>

            <table class="table mt-3">
                <thead>
                    <tr class='text-center'>
                        <th colspan='1' scope='col'>SN</th>
                        <th colspan='1' scope='col'>Profile Picture</th>
                        <th colspan='1' scope='col'>Trader Name</th>
                        <th colspan='1'scope='col'>Email</th>
                        <th colspan='1' scope='col'>Status</th>
                        <th colspan='1' scope='col'>Actions</th>
                    </tr>
                </thead>
                <tbody class="border">
                    <?php
                    // if(isset($_GET['traders']))
                    // {
                        // $trader_nam = $_GET['traders'];

                        // echo "<div class='mt-3'>Selected Trader: <b>".$trader_nam."</b></div>";

        				$sn = 0;

                        include "connect.php";
                        $t = "SELECT * FROM TRADER";
                        $tr = oci_parse($conn, $t);
                        oci_execute($tr);
                        while($r = oci_fetch_assoc($tr))
                        {
                            $tr_id = $r['TRADER_ID'];
                            $tr_pp = $r['PROFILE_PICTURE'];
                            $path = '../trader/';

                            $f_pp = $path.$tr_pp;
                            $tr_name = $r['FULL_NAME'];
                            $tr_email = $r['EMAIL'];
                            $tr_desc = $r['TRADER_DESC'];
                            $tr_verify = $r['TRADER_VERIFICATION'];

                                    $sn =$sn +1;

                                    echo"
                                        <tr>
                                            <form action='manage_traders.php' method='POST'>
					                        <input type='hidden' name='tid' value='$tr_id'>
                                                <td class='text-center border border-groove align-middle p-3'>$sn</td>
                                                <td class='text-center border border-groove align-middle p-3'><img src='$f_pp' style='width:8vw'></td>
                                                <td class='text-center border border-groove align-middle p-3'>$tr_name</td>
                                                <td class='text-center border border-groove align-middle p-3'>$tr_email</td>
                                                <td class='text-center border border-groove align-middle p-3'>
                                    ";
                                                if($tr_verify == 1)
                                                {
                                                    echo"
                                                        <b style='color: #2cdb40;'>Approved</b>
                                                    ";
                                                }
                                                else{
                                                    echo"
                                                        <b style='color: red;'>Not Approved</b>
                                                    ";
                                                }
                                    echo"
                                                </td>
                                                <td class='text-center border border-groove align-middle p-3'>
                                    ";
                                                    if ($tr_verify == 1) {
                                                        echo "
                                                        <button type='submit' class='btn btn-success' name='submit' disabled >Approve</button>
                                                        <br><br>
                                                        <button type='submit' class='btn btn-danger' name='submit1' >Decline</button>
                                                        ";
                                                    }
                                                    else{
                                                        echo "
                                                        <button type='submit' class='btn btn-success' name='submit'  >Approve</button>
                                                        <br><br>
                                                        <button type='submit' class='btn btn-danger' name='submit1' disabled >Decline</button>
                                                        ";
                                                    }
                                                echo"
                                                </td>
                                            </form>
                                        </tr>
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