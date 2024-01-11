<?php
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $id = $_SESSION['cid'];
}

include "start.php";
?>
<link rel="stylesheet" href="css/main-header.css">

<div class="header">
    <header class="container d-flex w-100 justify-content-center">
        <div id="rHeader" class="row w-100">
            <div id='logcol' class="col-2 d-flex align-items-center justify-content-center">
                <a href="index.php"><img id="logo" src="./logo/logo.png"></a>
            </div>

            <!-- search bar here -->
            <div id='searchcol' class="col-4 d-flex align-items-center justify-content-center">
                <form action="product_search.php" method="GET" class="d-flex w-100">
                    <div class="searchbar d-flex w-100">
                        <input name="searchtxt" type="text" placeholder="Search here..." class="form-control"
                            style="border-bottom-left-radius: 20px; border-top-left-radius: 20px;"
                            value="<?php
                                                                                                                                                                                            if (isset($_GET['searchtxt'])) {
                                                                                                                                                                                                echo $_GET['searchtxt'];
                                                                                                                                                                                            }
                                                                                                                                                                                            ?>">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-2 d-flex align-items-center justify-content-center">
                <div class="categoryDrop w-100">
                    <form action="product_search.php" method="GET">
                        <select onchange="this.form.submit()" name="category" class="form-select "
                            aria-label="Default select example"
                            style="border-bottom-right-radius: 20px; border-top-right-radius: 20px;">
                            <option selected>Choose Category</option>
                            <option value="All">All</option>
                            <option value="Bakery">Bakery</option>
                            <option value="Fishmonger">Fishmonger</option>
                            <option value="Butchers">Butchers</option>
                            <option value="Greengrocer">Greengrocer</option>
                            <option value="Delicatessen">Delicatessen</option>
                        </select>
                    </form>
                </div>
            </div>

            <div id='iconcol' class="col-4 d-flex align-items-center justify-content-around">
                <div class="icons">

                    <a href="mywishlist.php"><i class="fa-regular fa-heart px-3 fa-lg" title="Wishlist"></i><span
                            class="menuItems">Wishlist (0)</span></a>

                    <?php
                    $count = 0;
                    if (isset($_SESSION['cart'])) {
                        $count = count($_SESSION['cart']);
                    }
                    ?>
                    <a href="mycart.php"><i class="fa-solid fa-cart-shopping px-3 fa-lg" title="Cart"></i><span
                            class="menuItems">Cart (<?php echo $count ?>)</span></a>
                    <a href="trader/trader_signup.php"><i class="fa-solid fa-user px-3 fa-lg"
                            title="Be a Trader"></i><span class="menuItems">Be a trader</span></a>

                    <?php
                    if (isset($_SESSION['username'])) {
                        $username = ucfirst($_SESSION['username']);
                        echo "
                        <a id='drophover' href='customer_profile.php?id=$id' style='text-decoration: none' title='Go to your dashboard'><i class='fa-regular fa-user px-3 fa-lg' title='Sign In'></i><span>$username</span></a>
                        ";
                    } elseif (!isset($_SESSION['username'])) {
                        echo "<a href='signin_customer.php'><i class='fa-regular fa-user px-3 fa-lg' title='Sign In'></i><span class='menuItems'>Sign in</span></a>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </header>
</div>
<?php include "end.php"; ?>