<?php
     include "../start.php";
     include "a_header.php";
    //  error_reporting(0);

?>
<div class="container">
    <div class="h4 text-center">SHOP MANAGEMENT</div>
    <div class="d-flex justify-content-center">
        <div class="col-12 border border-dark-light bg-light p-5 mt-4">
        <form action='admin_shop.php' method="GET">
            <div class="d-flex w-25">
                <select class="form-select" name='shops' onchange="this.form.submit()">
                    <option selected>Select Shops</option>
                    <option value="All Shops">All Shops</option>
                    <?php
                        include "connect.php";
                        $q = "SELECT * FROM SHOP";
                        $r = oci_parse($conn, $q);
                        oci_execute($r);

                        while($row = oci_fetch_assoc($r)){
                            $shop_id = $row['SHOP_ID'];
                            $shop_name = $row['SHOP_NAME'];
                            echo"
                                <option value='$shop_name'>$shop_name</option>
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
                        <th colspan='1' scope='col'>Shop Name</th>
                        <th colspan='1'scope='col'>Shop Description</th>
                        <th colspan='1'scope='col'>Shop Location</th>
                        <th colspan='1' scope='col'>Status</th>
                        <th colspan='1' scope='col'>Actions</th>
                    </tr>
                </thead>
                <tbody class="border">
                    <?php
                    if(isset($_GET['shops']))
                    {
                        $shop_nam = $_GET['shops'];

                        echo "<div class='mt-3'>Selected Shop: <b>".$shop_nam."</b></div>";

        				$sn = 0;

                        include "connect.php";
                        $t = "SELECT * FROM SHOP WHERE SHOP_NAME='$shop_nam'";
                        $tr = oci_parse($conn, $t);
                        oci_execute($tr);
                        while($r = oci_fetch_assoc($tr))
                        {
                            $sh_id = $r['SHOP_ID'];
                            $sh_name = $r['SHOP_NAME'];
                            $sh_desc = $r['SHOP_DESCRIPTION'];
                            $sh_loc = $r['SHOP_LOCATION'];
                            $sh_verify = $r['SHOP_VERIFICATION'];
                            $sn =$sn +1;

                            echo"
                                <tr>
                                    <form action='manage_shop.php' method='POST'>
                                    <input type='hidden' name='sid' value='$sh_id'>
                                        <td class='text-center border border-groove align-middle p-3'>$sn</td>
                                        <td class='text-center border border-groove align-middle p-3'>$sh_name</td>
                                        <td class='border border-groove align-middle p-3'>$sh_desc</td>
                                        <td class='text-center border border-groove align-middle p-3'>$sh_loc</td>
                                        <td class='text-center border border-groove align-middle p-3'>
                            ";
                                        if($sh_verify == 1)
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
                                            if ($sh_verify == 1) {
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
                    }

                    if(isset($_GET['shops']))
                    {
                        if($_GET['shops'] == 'All Shops')
                        {
                            include "connect.php";
                            $sql = "SELECT * FROM SHOP";
                            $qry = oci_parse($conn, $sql);
                            oci_execute($qry);

                            $sn = 0;
                            while($row = oci_fetch_assoc($qry))
                            {
                                $sh_id = $row['SHOP_ID'];
                                $sh_name = $row['SHOP_NAME'];
                                $sh_desc = $row['SHOP_DESCRIPTION'];
                                $sh_loc = $row['SHOP_LOCATION'];
                                $sh_verify = $row['SHOP_VERIFICATION'];
                                $sn =$sn +1;

                                echo"
                                <tr>
                                    <form action='manage_shop.php' method='POST'>
                                    <input type='hidden' name='sid' value='$sh_id '>
                                        <td class='text-center border border-groove align-middle p-3'>$sn</td>
                                        <td class='text-center border border-groove align-middle p-3'>$sh_name</td>
                                        <td class='border border-groove align-middle p-3'>$sh_desc</td>
                                        <td class='text-center border border-groove align-middle p-3'>$sh_loc</td>
                                        <td class='text-center border border-groove align-middle p-3'>
                                        
                                ";
                                        if($sh_verify == 1)
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
                                                        if ($sh_verify == 1) {
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