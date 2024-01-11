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
                    <li><a href="customer_order.php?id=<?php echo $id?>">Orders</a></li>
                    <li><a href="customer_reviews.php?id=<?php echo $id?>"><b>Reviews</b></a></li>
                    <li><a href="customer_change_password.php?id=<?php echo $id?>">Change Password</a></li>
                    <li><a href="logout.php" onclick="return confirm('Are you sure to logout?');">Logout</a></li>
                </ul>
            </div>
        </div>

        <!-- MY ACCOUNT -->
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9 p-3">
            <div class="h3 mb-3"><strong>MY REVIEWS</strong></div>
                <div class="row border border-dark-light p-3">
                    <table class="table">
                        <div class="h5"><strong>All Reviews</strong></div>
                        <thead>
                            <tr class="text-center">
                                <th colspan="1" scope="col">Product Details</th>
                                <th colspan="1" scope="col">Reviewed Date</th>
                                <th colspan="1"scope="col">Rating</th>
                                <th colspan="1" scope="col">Comments</th>
                                <th colspan="1" scope="col">Edit</th>
                            </tr>
                        </thead>
                        <?php
                            if(isset($_GET['id']))
                            {
                                $c_id = $_GET['id'];
                                // echo $c_id;
                                include "connect.php";
                                $qry = "SELECT * FROM REVIEW WHERE CUSTOMER_ID = $c_id";
                                $res = oci_parse($conn, $qry);
                                oci_execute($res);

                                while($row = oci_fetch_assoc($res))
                                {
                                    $rating = $row['RATING'];
                                    $rev_desc = $row['REVIEW_DESCRIPTION'];
                                    $rev_date = $row['REVIEW_DATE'];
                                    $product_id = $row['PRODUCT_ID'];

                                    include "connect.php";
                                    $qry2 = "SELECT * FROM PRODUCT WHERE PRODUCT_ID = $product_id";
                                    $res2 = oci_parse($conn, $qry2);
                                    oci_execute($res2);

                                    while($row2 = oci_fetch_assoc($res2))
                                    {
                                        $p_name = $row2['PRODUCT_NAME'];
                                        $p_image = $row2['PRODUCT_IMAGE'];
                                        echo"
                                        <tbody class='border'>
                                            <tr>
                                                <td class='text-center border border-groove align-middle'><img src='$p_image' style='width: 6vw' ><br>$p_name</td>
                                                <td class='text-center text-align-center align-middle'>$rev_date</td>
                                                <td class='text-center border border-groove align-middle'>
                                        ";
                                                    include "rating_conditional.php";
                                        echo"
                                                </td>
                                                <td class='w-25 border border-groove align-middle'>$rev_desc</td>
                                                <td class='text-center align-middle'>
                                                    <form action='editreview.php' method='POST'>
                                                        <button class='btn' name='editReviewBtn'>
                                                            <input type='hidden' name='product_image' value='$p_image'>
                                                            <input type='hidden' name='product_name' value='$p_name'>
                                                            <input type='hidden' name='review_date' value='$rev_date'>
                                                            <input type='hidden' name='review_desc' value='$rev_desc'>
                                                            <input type='hidden' name='product_id' value='$product_id'>
                                                            <input type='hidden' name='customer_id' value='$c_id'>
                                                            <input type='hidden' name='rating' value='$rating'>
                                                            <i class='fa-solid fa-pen'></i>
                                                        </button>
                                                    </form>
                                                </td>
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