<?php 
    session_start();

    include "connect.php";
    $qry = "SELECT * FROM ADMIN";
    $res = oci_parse($conn, $qry);
    oci_execute($res);

    $r = oci_fetch_assoc($res);
    
    $admin_id = $r['ADMIN_ID'];
    include "../start.php";
?>
<link rel="stylesheet" href="css/a_header.css">

<div class="header mb-4">
    <header class="container d-flex w-100 justify-content-center">
        <div id="rHeader" class="row w-100">
            <div id='logcol' class="col-2 d-flex align-items-center justify-content-center">
                <a href="admin_dashboard.php?aid=<?php echo $admin_id?>"><img id="logo" src="../logo/logo.png"></a>
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
                    <li><a href="admin_dashboard.php?aid=<?php echo $admin_id?>">Dashboard</a></li>
                    <li><a href="admin_product.php?traders=All Traders&aid=<?php echo $admin_id?>">Manage Products</a></li>
                    <li><a href="admin_trader.php?aid=<?php echo $admin_id?>">Manage Traders</a></li>
                    <li><a href="admin_shop.php?shops=All Shops&aid=<?php echo $admin_id?>">Manage Shops</a></li>
                </ul>
            </div>
            
            <div id='iconcol' class="col-2 d-flex align-items-center justify-content-around">
                <div class="icons">
                    <?php
                        if(isset($_SESSION['a_username'])){ 
                            $username = ucfirst($_SESSION['a_username']);
                            echo"
                            <a id='drophover' href='admin_profile.php?aid=$admin_id' style='text-decoration: none' title='Go to your dashboard'><i class='fa-regular fa-user px-3 fa-lg' title='Sign In'></i><span>$username</span></a>
                            ";
                        }
                        // elseif(!isset($_SESSION['a_username'])){
                        //     echo "<a href='signin_customer.php'><i class='fa-regular fa-user px-3 fa-lg' title='Sign In'></i><span class='menuItems'>Sign in</span></a>";
                        // }
                    ?>
                </div>
            </div>
        </div>
    </header>
</div>
<?php include "../end.php";?>