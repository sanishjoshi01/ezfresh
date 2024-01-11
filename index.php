<?php
include "start.php";
include "main-header.php";
?>
<link rel="stylesheet" href="css/homeEZFRESH.css">


<!-- SLIDER -->
<div class="container my-4">
    <div class="row mx-4">
        <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner" style="width:100%; ">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>

                <div class="carousel-item active">
                    <img src="./images/banner/banner-1.png" class="d-block w-100" alt="First Sliding Image">
                </div>
                <div class="carousel-item">
                    <img src="./images/banner/banner-2.png" class="d-block w-100" alt="Second Sliding Image">
                </div>
                <div class="carousel-item">
                    <img src="./images/banner/banner-3.png" class="d-block w-100" alt="Third Sliding Image">
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</div>
<style>

</style>
<!-- POPULAR PRODUCTS -->
<div class="container">
    <div class="row p-3">
        <div class="row text-center">
            <h3><b>Popular Products</b></h3>
        </div>

        <div class="row d-flex justify-content-around my-4">
            <div class="card border-0" style="width: 14rem;">

                <!-- ====================addtocart and wishlist====================== -->
                <!-- <div id="add">
                    <a href="#" style="color: white; background-color: #08cb16; border-radius: 20px;" class="btn p-2 px-3"><i class="fa-solid fa-cart-shopping fa-lg"></i><strong>&nbsp;ADD TO CART</strong></a>
                    <a href="#" style="color: white; background-color: #fa0478; border-radius: 20px;" class="mt-4 btn  p-2 px-3"><i class="fa-regular fa-heart fa-lg"></i><strong>&nbsp;WISHLIST</strong></a>
                </div> -->
                <a id="productDetails" href="productDetail.php?product_id=1008">
                    <img style="width: 12rem; height: 12rem;" class="card-img-top border shadow p-3"
                        src="images/products/apples.png" alt="Card image cap">

                    <div class="card-body text-center">
                        <h5 class="card-title"><strong>Apple</strong></h5>
                        <h5 class="card-title">$1</h5>
                    </div>
                </a>
            </div>
            <div class="card border-0" style="width: 14rem;">
                <a id="productDetails" href="productDetail.php?product_id=1007">
                    <img style="width: 12rem; height: 12rem;" class="card-img-top border shadow p-3"
                        src="images/products/berries.png" alt="Card image cap">
                    <div class="card-body text-center">
                        <h5 class="card-title"><strong>Berries</strong></h5>
                        <h5 class="card-title">$3.5</h5>
                    </div>
                </a>
            </div>
            <div class="card border-0" style="width: 14rem;">
                <a id="productDetails" href="productDetail.php?product_id=1021">
                    <img style="width: 12rem; height: 12rem;" class="card-img-top border shadow p-3"
                        src="images/products/lobster.png" alt="Card image cap">
                    <div class="card-body text-center">
                        <h5 class="card-title"><strong>Lobster</strong></h5>
                        <h5 class="card-title">$13</h5>
                    </div>
                </a>
            </div>
            <div class="card border-0" style="width: 14rem;">
                <a id="productDetails" href="productDetail.php?product_id=1040">
                    <img style="width: 12rem; height: 12rem;" class="card-img-top border shadow p-3"
                        src="images/products/snackcake.png" alt="Card image cap">
                    <div class="card-body text-center">
                        <h5 class="card-title"><strong>Snack Cake</strong></h5>
                        <h5 class="card-title">$4</h5>
                    </div>
                </a>
            </div>
            <div class="card border-0" style="width: 14rem;">
                <a id="productDetails" href="productDetail.php?product_id=1011">
                    <img style="width: 12rem; height: 12rem;" class="card-img-top border shadow p-3"
                        src="images/products/beef.png" alt="Card image cap">
                    <div class="card-body text-center">
                        <h5 class="card-title"><strong>Beef</strong></h5>
                        <h5 class="card-title">$15</h5>
                    </div>
                </a>
            </div>
            <!-- // -->
        </div>
    </div>
</div>

<!-- NEW ARRIVALS -->
<div class="container">
    <div class="row">
        <div class="row text-center">
            <h3><b>New Arrivals</b></h3>
        </div>
        <div class="row d-flex justify-content-around my-4">

            <div class="card border-0" style="width: 14rem;">
                <a id="productDetails" href="productDetail.php?product_id=1031">
                    <img style="width: 12rem; height: 12rem;" class="card-img-top border shadow p-3"
                        src="images/products/bagels.png" alt="Card image cap">
                    <div class="card-body text-center">
                        <h5 class="card-title"><strong>Bagels</strong></h5>
                        <h5 class="card-title">$3</h5>
                    </div>
                </a>
            </div>
            <div class="card border-0" style="width: 14rem;">
                <a id="productDetails" href="productDetail.php?product_id=1049">
                    <img style="width: 12rem; height: 12rem;" class="card-img-top border shadow p-3"
                        src="images/products/rolls.png" alt="Card image cap">
                    <div class="card-body text-center">
                        <h5 class="card-title"><strong>Rolls</strong></h5>
                        <h5 class="card-title">$3</h5>
                    </div>
                </a>
            </div>
            <div class="card border-0" style="width: 14rem;">
                <a id="productDetails" href="productDetail.php?product_id=1042">
                    <img style="width: 12rem; height: 12rem;" class="card-img-top border shadow p-3"
                        src="images/products/salad.png" alt="Card image cap">
                    <div class="card-body text-center">
                        <h5 class="card-title"><strong>Salad</strong></h5>
                        <h5 class="card-title">$3.5</h5>
                    </div>
                </a>
            </div>
            <div class="card border-0" style="width: 14rem;">
                <a id="productDetails" href="productDetail.php?product_id=1010">
                    <img style="width: 12rem; height: 12rem;" class="card-img-top border shadow p-3"
                        src="images/products/grapes.png" alt="Card image cap">
                    <div class="card-body text-center">
                        <h5 class="card-title"><strong>Grapes</strong></h5>
                        <h5 class="card-title">$3.5</h5>
                    </div>
                </a>
            </div>
            <div class="card border-0" style="width: 14rem;">
                <a id="productDetails" href="productDetail.php?product_id=1004">
                    <img style="width: 12rem; height: 12rem;" class="card-img-top border shadow p-3"
                        src="images/products/peas.png" alt="Card image cap">
                    <div class="card-body text-center">
                        <h5 class="card-title"><strong>Peas</strong></h5>
                        <h5 class="card-title">$1.45</h5>
                    </div>
                </a>
            </div>
            <!-- // -->
        </div>
    </div>
</div>

<div class="container mb-5">
    <div class="row text-center p-3" style="border: 2px solid grey; border-bottom: none;">
        <i class="fa-solid fa-tag fa-2x">&nbsp;GET 10% OFF</i>
        <a href="#" style="text-decoration: none;">
        </a>
    </div>

    <div class="row d-flex justify-content-around p-3" style="border: 2px solid grey;">

        <div class="card border-0" style="width: 14rem;">
            <a id="productDetails" href="productDetail.php?product_id=1018">
                <img style="width: 12rem; height: 12rem;" class="card-img-top border shadow p-3"
                    src="images/products/duck.png" alt="Card image cap">
                <div class="card-body text-center">
                    <h5 class="card-title"><strong>Duck</strong></h5>
                    <h5 class="card-title">$9.99</h5>
                </div>
            </a>
        </div>
        <div class="card border-0" style="width: 14rem;">
            <a id="productDetails" href="productDetail.php?product_id=1019">
                <img style="width: 12rem; height: 12rem;" class="card-img-top border shadow p-3"
                    src="images/products/filet_mignon.png" alt="Card image cap">
                <div class="card-body text-center">
                    <h5 class="card-title"><strong>Filet Mignon</strong></h5>
                    <h5 class="card-title">$13</h5>
                </div>
            </a>
        </div>
        <div class="card border-0" style="width: 14rem;">
            <a id="productDetails" href="productDetail.php?product_id=1028">
                <img style="width: 12rem; height: 12rem;" class="card-img-top border shadow p-3"
                    src="images/products/swordfish.png" alt="Card image cap">
                <div class="card-body text-center">
                    <h5 class="card-title"><strong>Sword Fish</strong></h5>
                    <h5 class="card-title">$11</h5>
                </div>
            </a>
        </div>
        <div class="card border-0" style="width: 14rem;">
            <a id="productDetails" href="productDetail.php?product_id=1037">
                <img style="width: 12rem; height: 12rem;" class="card-img-top border shadow p-3"
                    src="images/products/pies.png" alt="Card image cap">
                <div class="card-body text-center">
                    <h5 class="card-title"><strong>Pies</strong></h5>
                    <h5 class="card-title">$3.5</h5>
                </div>
            </a>
        </div>
        <div class="card border-0" style="width: 14rem;">
            <a id="productDetails" href="productDetail.php?product_id=1045">
                <img style="width: 12rem; height: 12rem;" class="card-img-top border shadow p-3"
                    src="images/products/pizza.png" alt="Card image cap">
                <div class="card-body text-center">
                    <h5 class="card-title"><strong>Pizza</strong></h5>
                    <h5 class="card-title">$8.99</h5>
                </div>
            </a>
        </div>
        <!-- // -->
    </div>
</div>

<!-- 3 column info section -->
<div class="container mb-5" style="border: 2px solid grey; ">
    <div class="row p-4">
        <div class="col-4 text-center" style="border-right-style: groove;">
            <img src="images/icons/secured_payment.png" class="img-fluid" style="width: 8vw;">
            <h3 id="serviceWidget" class="mt-3">Secured Payments</h3>
        </div>
        <div class="col-4 text-center" style="border-right-style: groove;">
            <img src="images/icons/customer_service.png" class="img-fluid" style="width: 8vw;">
            <h3 id="serviceWidget" class="mt-3">Excellent Customer Service</h3>
        </div>
        <div class="col-4 text-center">
            <img src="images/icons/trusted.png" class="img-fluid" style="width: 8vw;">
            <h3 id="serviceWidget" class="mt-3">Trusted Sellers</h3>
        </div>
    </div>
</div>

<?php include "main-footer.php";
include "end.php"; ?>