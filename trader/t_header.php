<?php 
session_start();

if(isset($_SESSION['tfullname']))
{
    $username = $_SESSION['tfullname'];
    $tid = $_SESSION['tid'];
}

include "../start.php";
?>
<link rel="stylesheet" href="css/t_header.css" >

<div class="header mb-4">
    <header class="container d-flex w-100 justify-content-center">
        <div id="rHeader" class="row w-100">
            <div id='logcol' class="col-2 d-flex align-items-center justify-content-center">
                <a href="trader_dashboard.php?id=<?php echo $tid?>"><img id="logo" src="../logo/logo.png"></a>
            </div>
            <style>
                #links2 > ul{
                    margin-top: 20px;
                    display: flex;
                    flex-direction: row;
                    justify-content: space-around;
                    align-items: center;
                }
                #links2 a{
                    text-decoration: none;
                    font-size: larger;
                }
                #links2 li{
                    list-style: none;
                }
            </style>
            <div class="col-8" id="links2">
                <ul>
                    <li><a href="trader_dashboard.php?id=<?php echo $tid?>">Dashboard</a></li>
                    <li><a href="trader_shop.php?id=<?php echo $tid?>">Shop</a></li>
                    <li><a href="trader_product.php?id=<?php echo $tid?>">Product</a></li>
                    <li><a href="trader_order.php?id=<?php echo $tid?>">Orders</a></li>
                    <li><a href="trader_review.php?id=<?php echo $tid?>">Reviews</a></li>
                </ul>
            </div>
            
            <div id='iconcol' class="col-2 d-flex align-items-center justify-content-around">
                <div class="icons">
                    <?php
                        if(isset($_SESSION['tfullname'])){ 
                            $username = ucfirst($_SESSION['tfullname']);
                            echo"
                            <a id='drophover' href='trader_profile.php?id=$tid' style='text-decoration: none' title='Go to your dashboard'><i class='fa-regular fa-user px-3 fa-lg' title='Sign In'></i><span>$username</span></a>
                            ";
                        }
                        elseif(!isset($_SESSION['tfullname'])){
                            echo "<a href='trader_signin.php'><i class='fa-regular fa-user px-3 fa-lg' title='Sign In'></i><span class='menuItems'>Sign in</span></a>";
                        }
                    ?>
                </div>
            </div>
        </div>
    </header>
</div>
<?php include "../end.php";?>