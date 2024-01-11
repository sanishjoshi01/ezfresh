<?php
    include "start.php";
    include "main-header.php";
    
    $username = $_SESSION['username'];
    $id = $_SESSION['cid'];
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
    @media (max-width: 769px){
        #links > li{
            font-size: medium;
        }
        #accInfo > div{
            font-size: medium;

        }
    }
    @media (max-width: 420px){
        #links > li{
            font-size: small;
        }
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
                    <li><a href="customer_profile.php?id=<?php echo $id?>">Account</a></li>
                    <li><a href="customer_order.php?id=<?php echo $id?>"><b>Orders</b></a></li>
                    <li><a href="customer_reviews.php?id=<?php echo $id?>">Reviews</a></li>
                    <li><a href="customer_change_password.php?id=<?php echo $id?>">Change Password</a></li>
                    <li><a href="logout.php" onclick="return confirm('Are you sure to logout?');">Logout</a></li>
                </ul>
            </div>
        </div>

        <!-- MY ACCOUNT -->
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9 p-3">
            <div class="h3 mb-3"><strong>MY ORDERS</strong></div>
                <div class="row border border-dark-light bg-light p-3">
                    <table class="table">
                        <div class="h5"><strong>All Orders</strong></div>
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
                            if(isset($_GET['id']))
                            {
                                $c_id = $_GET['id'];
                                // echo $c_id;
                                include "connect.php";
                                $qry = "SELECT * FROM ORDERS WHERE CUSTOMER_ID = $c_id";
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
        </div>
    </div>
</div>
<?php
    include "end.php";
    include "main-footer.php";
?>