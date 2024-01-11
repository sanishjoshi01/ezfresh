<?php
    include "start.php";
    include "main-header.php";

    $username = $_SESSION['username'];
    $id = $_SESSION['cid'];
    $fname = $_SESSION['fname'];
    $lname = $_SESSION['lname'];
    $fullname = $fname .' '. $lname;

    $email = $_SESSION['email'];
    $phone = $_SESSION['phone'];
?>

<style>
    #links a{
        text-decoration: none;
    }
    #links li{
        list-style: none;
        font-size: x-large;
        line-height: 40px;
    }
    #accInfo > .h5{
        line-height: 35px;
    }
    @media (max-width: 1200px){
        #links {
            display: flex;
            justify-content: space-around;
        }
        #dash .h3{
            display: none;
        }
        #customerProfile{
            text-align: center;
        }
    }
    @media (max-width: 960px){
        #links > li{
            font-size: medium;
        }
        #accInfo > div{
            font-size: medium;
        }
    }
    @media (max-width: 540px){
        #links > li{
            font-size: small;
        }
        #accInfo > div{
            font-size: small;
        }
    }
    @media (max-width: 460px){
        #links > li{
            font-size: x-small;
        }
        #accInfo > div{
            font-size: small;
        }
    }
    #lg:hover a {
        color: white !important;
    }
    #lg1:hover a {
        color: white !important;
    }
</style>

<!-- SECTION 1 -->
<div class="container mt-4 p-3">
    <div class="row">
        <!-- DASHBOARD -->
        <div id="dash" class="col-sm-12 col-md-12 col-lg-12 col-xl-3 border border-dark p-3">
            <div class="h3 text-center"><strong>DASHBOARD</strong></div>
            <div class="mt-3">
                <ul id="links">
                    <li><a href="customer_profile.php?id=<?php echo $id?>"><b>Account</b></a></li>
                    <li><a href="customer_order.php?id=<?php echo $id?>">Orders</a></li>
                    <li><a href="customer_reviews.php?id=<?php echo $id?>">Reviews</a></li>
                    <li><a href="customer_change_password.php?id=<?php echo $id?>">Change Password</a></li>
                    <li><a href="logout.php" onclick="return confirm('Are you sure to logout?');">Logout</a></li>
                </ul>
            </div>
        </div>

       <!-- MY ACCOUNT -->
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9 p-3">
                <div class="h3 px-1">
                    <strong>MY ACCOUNT</strong>
                </div>
                <div class="row mt-3">

                    <?php
                        if(isset($_GET['id']))
                        {
                            $edid = $_GET['id'];

                            $sql = "SELECT * FROM CUSTOMER WHERE CUSTOMER_ID='$edid'";
                            include "connect.php";

                            $qry = oci_parse($conn, $sql);
                            oci_execute($qry);

                            if($qry){
                                while($row = oci_fetch_assoc($qry))
                                {
                                    $c_id = $row['CUSTOMER_ID'];
                                    $c_user = $row['USERNAME'];
                                    $c_fname = $row['FIRST_NAME'];
                                    $c_lname = $row['LAST_NAME'];
                                    $c_fullname = $c_fname ." ". $c_lname;

                                    $c_email = $row['EMAIL'];
                                    $c_gender= $row['GENDER'];
                                    $c_address = $row['ADDRESS'];
                                    $c_phone= $row['PHONE_NUMBER'];
                                    $c_pp= $row['PROFILE_PICTURE'];
                                }
                            }   
                        }
                    ?>
                    <!-- PROFILE PICTURE-->
                    <div id="customerProfile" class="col-sm-12 col-md-12 col-lg-12 col-xl-4">
                        
                            <div class="<?php
                                if(empty($c_pp)){
                                    echo 'border border-dark-light';
                                }
                            ?>" style="width: 18rem; height: 18rem;">
                            <img style="width: 16rem; height: 16rem;" class="img-fluid border rounded-circle shadow" src="<?php echo $c_pp; ?>">
                        </div>
                    </div>
                   
                    <!-- Account info-->
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8 border border-dark-light  p-4" id="accInfo">
                        <div class="h4"><b>Account Information</b></div>
                        <div class="h5">Name: <?php echo $c_fullname;?></div>
                        <div class="h5">Email: <?php echo $c_email?></div>
                        <div class="h5">Phone Number: <?php echo $c_phone?></div>
                        
                       
                        <div class='h5'>
                            <div id='lg1' class='btn btn-outline-primary border-2 rounded'>
                                <a href='customer_edit_profile.php?id=<?php echo $id; ?>' style='text-decoration: none; color: blue; letter-spacing: 3px;'>EDIT PROFILE</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SECTION 1 -->
<div class="container border  bg-light mt-4 p-3">
    <div class="row">
        <div class="h3">Recent Orders</div>
                <table class="table">
                        <thead>
                            <tr class="text-center">
                                <th colspan="1" scope="col">Order Number</th>
                                <th colspan="1" scope="col">Product Image</th>
                                <th colspan="1" scope="col">Product Name</th>
                                <th colspan="1"scope="col">Order Date</th>
                                <th colspan="1" scope="col">Total</th>
                            </tr>
                        </thead>
                        <?php
                            // echo $todayDate;
                            if(isset($_GET['id']))
                            {
                                $c_id = $_GET['id'];
                                // echo $c_id;
                                include "connect.php";
                                $qry = "SELECT * FROM ORDERS WHERE CUSTOMER_ID = '$c_id'";
                                $res = oci_parse($conn, $qry);
                                oci_execute($res);

                                while($row = oci_fetch_assoc($res))
                                {
                                    $order_no = $row['ORDER_ID'];
                                    $order_date = $row['ORDER_DATE'];
                                    $order_price = $row['ORDER_PRICE'];
                                    $p_id = $row['PRODUCT_ID'];
                                    $order_quantity = $row['QUANTITY'];

                                    include "connect.php";
                                    $qry2 = "SELECT * FROM PRODUCT WHERE PRODUCT_ID = $p_id";
                                    $res2 = oci_parse($conn, $qry2);
                                    oci_execute($res2);

                                    while($row2 = oci_fetch_assoc($res2))
                                    {
                                        $p_name = $row2['PRODUCT_NAME'];
                                        $p_image = $row2['PRODUCT_IMAGE'];
                                        echo"
                                        <tbody class='border'>
                                            <tr>
                                                <td class='text-center align-middle'>$order_no</td>
                                                <td class='text-center align-middle border border-groove'><img src='$p_image' style='width: 6vw' ></td>
                                                <td class='text-center align-middle'>$p_name</td>
                                                <td class='text-center align-middle border border-groove'>$order_date</td>
                                                <td class='text-center align-middle'>$$order_price</td>
                                            </tr>
                                        </tbody>
                                        ";
                                    }
                                }
                            }
                        ?>
                    </table>
    </div>
</div>

<?php
    include "end.php";
    include "main-footer.php";
?>