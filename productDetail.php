<?php
    include "start.php";
    include "main-header.php";
    include 'connect.php'; 

    if (isset($_GET['product_id'])) {
        $product_id = $_GET['product_id'];

        $query = "SELECT * FROM PRODUCT WHERE PRODUCT_ID = '$product_id'";

        $result = oci_parse($conn, $query);
        oci_execute($result);

        while ($row = oci_fetch_assoc($result)) {
            $product_id = $row['PRODUCT_ID'];
            $product_name = $row['PRODUCT_NAME'];
            $product_type = $row['PRODUCT_TYPE'];
            $product_desc = $row['PRODUCT_DESCRIPTION'];
            $product_price = $row['PRODUCT_PRICE'];
            $product_image = $row['PRODUCT_IMAGE'];
            $product_stock = $row['PRODUCT_STOCK'];
        }
    } else {
        // header('Location: homeEZFRESH.php');
        // exit();
    }
?>
<style>
    #inStock{
        color: #1dcc11;
    }
    #outStock{
        color: rgb(232, 2, 2);
    }
    #detail .h2, #detail .h4{
        line-height: 50px !important;
    }
    #detail .h5{
        color: #808080;
    }

    @media (max-width: 500px){
        #detail > div{
            font-size: medium;
        }
        #addPD > a{
            font-size: small;
        }
    }
    #add {
    opacity: 0;
    position: absolute;
    margin-top: 70px;
    text-align: center;
    }
    .card:hover #add {
        opacity: 1;
        transition: .5s;
    }
    #add a:hover{
        transform: scale(1.09);
        transition: .5s;
    }
    #productDetails{
        color: black;
        text-decoration: none;
    }
    #productDetails h4:hover{
        text-decoration: underline;
    }
    /* product hover effect homepage */
    #productDetails img:hover{
        transition: .3s ease;
        transform: scale(1.1);
    }
</style>

<!-- SECTION 1 -->
<div class="container d-flex my-4 p-3" id="section-1">
    <div class="row d-flex w-100 justify-content-center">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 d-flex justify-content-around">
            <img id='pimg' style="width: 26rem; height: 26rem;" class="img-fluid border border-dark-light p-3" src="<?php echo $product_image?>" alt="Card image cap">
        </div>

        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 p-4" id="detail">
            <!-- product name -->
            <div class="h2">
                <div class="row">
                    <div class="col-8">
                        <strong><?php echo $product_name ?></strong>
                    </div>
                    <div class="col-4">
                        <form action="manage_wishlist.php" method="POST">
                            <button type="submit" name="addtowishlist" style='border: none; background-color: white;'>
                                <i class="fa-regular fa-heart btn btn-outline-danger"></i>
                                <input type='hidden' name='product_id' value='<?php echo $product_id; ?>'>
                                <input type='hidden' name='product_image' value='<?php echo $product_image; ?>'>
                                <input type='hidden' name='product_name' value='<?php echo $product_name; ?>'>
                                <input type='hidden' name='product_price' value='<?php echo $product_price; ?>'>
                                <input type='hidden' name='product_stock' value='<?php echo $product_stock; ?>'>
                                <input type='hidden' name='pid' value='<?php echo $product_id; ?>'>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Description -->
            <div class="h5">
                <?php echo $product_desc ?>
            </div>

            <!-- Availability -->
            <div class="h4">Availability:
                <?php
                    if($product_stock > 0){
                        echo "<span id='inStock'><b>In Stock ($product_stock left)</b></span>";
                    }
                    else{
                        echo "<span id='outStock'><b>OUT OF STOCK</b></span>";
                    }
                ?>
            </div>

            <!-- Product price -->
            <div class="h4">
                Price: <b style='color: #f57224'>$<?php echo $product_price ?></b>
            </div>

            <form action="manage_cart.php" method="POST">
                <div class="h4">
                    Quantity: <input type="number" name="quantity" class="w-25 h-25 text-center" title="Enter quantity" placeholder="0" min="1" max="<?php echo $product_stock ?>" required>
                </div>
                <div id="addPD" class="d-flex align-items-center mt-4">
                    <button type="submit" name="addtocart" style="color: white; background-color: #08cb16; border-radius: 20px;" class="btn p-2 px-4"><i class="fa-solid fa-cart-shopping fa-lg"></i><strong>&nbsp;ADD TO CART</strong></button>

                    <input type='hidden' name='product_id' value='<?php echo $product_id; ?>'>
                    <input type='hidden' name='product_image' value='<?php echo $product_image; ?>'>
                    <input type='hidden' name='product_name' value='<?php echo $product_name; ?>'>
                    <input type='hidden' name='product_price' value='<?php echo $product_price; ?>'>
                    <input type='hidden' name='product_stock' value='<?php echo $product_stock; ?>'>
                    <input type='hidden' name='pid' value='<?php echo $product_id; ?>'>
            </form>
            </div>
        </div>
    </div>
</div>

<!-- SECTION 2 Related Products -->
<div class="container my-4 p-3 border border-dark-light" id="section-2">
    <div class="row text-center"><h3>Related Products</h3></div>
    <div class="row d-flex justify-content-around my-4">

        <?php
        include 'connect.php';
        if (isset($_GET['product_id'])) {
            $product_id = $_GET['product_id'];

            $query = "select PRODUCT_TYPE from product where PRODUCT_ID = '$product_id'";

            $result = oci_parse($conn, $query);
            oci_execute($result);

            while ($row = oci_fetch_assoc($result)) {
                $product_type1 = $row['PRODUCT_TYPE'];

                $query1 = "select * from product,shop where PRODUCT_TYPE = '$product_type1' AND SHOP.SHOP_ID = PRODUCT.SHOP_ID AND PRODUCT_VERIFICATION='1' AND SHOP_VERIFICATION='1'";

                $result1 = oci_parse($conn, $query1);
                oci_execute($result1);

                while ($row = oci_fetch_assoc($result1)) {
                    $pid = $row['PRODUCT_ID'];
                    $product_name1 = $row['PRODUCT_NAME'];
                    $product_price1 = $row['PRODUCT_PRICE'];
                    $product_image1 = $row['PRODUCT_IMAGE'];

                    echo "
                        <div class='card border-0' style='width: 14rem;'>
                            <a id='productDetails' href='productDetail.php?product_id=$pid'>
                                <img style='width: 12rem; height: 12rem;' class='card-img-top border shadow p-3' src='$product_image1' alt='Card image cap'>
                                <div class='card-body text-center'>
                                    <h5 class='card-title'><strong>$product_name1</strong></h5>
                                    <h5 class='card-title'>$$product_price1</h5>
                                </div>
                            </a>
                        </div>
                    ";
                }
            }
        }
        ?>
    </div>
</div>

    <?php
        if(isset($_SESSION['username']))
        {
            $cid = $_SESSION['cid'];
    ?>

            <!-- SECTION 3 Ratings & Reviews -->
            <div class="container my-4 p-3" id="section-2">
                <div class="row border border-dark-light bg-light p-3">
                    <div class="row text-center"><h3>Ratings & Reviews</h3></div>
                    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
                    <style>
                        @import url(https://fonts.googleapis.com/css?family=Roboto:500,100,300,700,400);
                        
                        input.rating{
                            display: none;
                        }
                        
                        label.rating {
                            float: right;
                            padding: 10px;
                            font-size: 36px;
                            color: #444;
                        }
                        
                        input.rating:checked ~ label.rating:before {
                            content:'\f005';
                            color: #FD4;
                            transition: all .25s;
                        }
                        
                        input.rating5:checked ~ label.rating:before {
                        color:#FE7;
                        text-shadow: 0 0 20px #952;
                        }
                        
                        input.rating1:checked ~ label.rating:before {
                        color: #F62;
                        }
                        
                        label.rating:hover{
                        transform: rotate(-15deg) scale(1.3);
                        }
                        
                        label.rating:before{
                        content:'\f006';
                        font-family: FontAwesome;
                        }
                    </style>
                    <form action="review_product.php?cid=<?php echo $cid; ?>&product_id=<?php echo $product_id ?>" method="POST">
                        <div class="row">
                            <!-- <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center mt-5 h3">
                                Review Product : <?php echo $product_name ?>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center mt-5">
                                <img src="<?php echo $product_image ?>">
                            </div> -->
                            <div class="d-flex flex-row-reverse justify-content-center ratings d-inline-block text-center">
                                <input class='rating rating5' type="radio" name="rating" id="rating5" value="5">&nbsp;&nbsp;
                                <label class='rating rating5' for="rating5"></label>
                                
                                <input class='rating rating4' type="radio" name="rating" id="rating4" value="4">&nbsp;&nbsp;
                                <label class='rating rating4' for="rating4"></label>

                                <input class='rating rating3' type="radio" name="rating" id="rating3" value="3">&nbsp;&nbsp;
                                <label class='rating rating3' for="rating3"></label>

                                <input class='rating rating2' type="radio" name="rating" id="rating2" value="2">&nbsp;&nbsp;
                                <label class='rating rating2' for="rating2"></label>

                                <input class='rating rating1' type="radio" name="rating" id="rating1" value="1" >&nbsp;&nbsp;
                                <label class='rating rating1' for="rating1"></label>
                            </div>

                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">
                                <textarea class="w-75 mt-4 p-2" placeholder="Write your review here......" name="description" style="height: 6vw;" required></textarea>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center mt-3">
                                <?php
                                
                                include "connect.php";
                                $v = "SELECT * FROM REVIEW WHERE PRODUCT_ID=$product_id AND CUSTOMER_ID=$cid";
                                $r = oci_parse($conn, $v);
                                oci_execute($r);

                                $co = oci_fetch_all($r, $re);

                                // echo "$co";
                                if($co == 1){
                                    echo"
                                        <b style='color: #2cdb40;'>You have already reviewed this product!!<a class='btn' style='color: #40E0D0; text-decoration:none;' href='customer_reviews.php?id=$cid'> Edit Review</a></b><br>
                                        <button disabled type='submit' class='btn btn-success my-3' name='review'>Submit Review</button>
                                    ";
                                }
                                else{
                                    echo"
                                        <button type='submit' class='btn btn-success mb-3' name='review'>Submit Review</button>
                                    ";
                                }
                                ?>
                            </div>
                        </div>
                    </form>
                </div>

    <?php
        }
        else
        {
            echo "<h5 class='text-center' style='color: #fc0341; padding: 20px;'><i class='fa-solid fa-circle-exclamation fa-lg'></i> Only Registered users can write reviews. Please <a href='signin_customer.php'>Sign in</a> or <a href='signup_customer.php'>Create an account</a></h5>";
        }
    ?>
    <div class="container">
        <div class="row border border-dark-light p-3 my-5">
            <div class='row text-center'>
                <h3>Other Reviews</h3>
            </div>
            <table class="table">
                <thead>
                    <tr class="text-center h4">
                        <th>Details</th>
                        <th>Comments</th>
                    </tr>
                </thead>
            <?php
                if (isset($_GET['product_id'])) {
                        $product_id = $_GET['product_id'];

                        include "connect.php";
                        $sql = "SELECT * FROM REVIEW WHERE PRODUCT_ID = '$product_id'";
                        $resu = oci_parse($conn, $sql);
                        oci_execute($resu);
                        
                        while ($row = oci_fetch_assoc($resu)) {
                            $rating = $row['RATING'];
                            $rev_desc = $row['REVIEW_DESCRIPTION'];
                            $c_id = $row['CUSTOMER_ID'];
                            $review_date = $row['REVIEW_DATE'];

                            include "connect.php";
                            $sql2 = "SELECT * FROM CUSTOMER WHERE CUSTOMER_ID = '$c_id'";
                            $resu2 = oci_parse($conn, $sql2);
                            oci_execute($resu2);
                            
                            while($row2 = oci_fetch_assoc($resu2))
                            {
                                $c_fname = $row2['FIRST_NAME'];
                                $c_lname = $row2['LAST_NAME'];
                                $c_pp = $row2['PROFILE_PICTURE'];

                                echo"
                                <tbody class='border'>
                                    <div class='row'>
                                        <tr>
                                            <td class='text-center col-4'>
                                                <div class='h3 mt-1'>
                                                    <img style='width: 4rem; height: 4rem;' class='img-fluid border rounded-circle shadow' src='$c_pp'> $c_fname $c_lname
                                                </div>

                                                <div class=''>
                                ";
                                            include "rating_conditional.php";
                                echo"
                                                </div>
                                                <div class='h5 mt-3'>
                                                    Reviewed Date: <b>$review_date</b>
                                                </div>
                                            </td>
                                            
                                            <td class='col-8 border bg-light h4 mt-4 w-100 p-3'>
                                                <p class='w-100 text-justify' placeholder='Lorem' disabled style='height: 4vw;'>
                                                    $rev_desc
                                                </p>
                                            </td>
                                        </tr>
                                </tbody>
                                ";
                            }
                            }
                }
                else
                {
                    echo "not fund";
                } 
            ?>
            </table>
        </div>
    </div>
</div>

<?php
    include "end.php";
    include "main-footer.php";
?>