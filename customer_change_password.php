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
                    <li><a href="customer_reviews.php?id=<?php echo $id?>">Reviews</a></li>
                    <li><a href="customer_change_password.php?id=<?php echo $id?>"><b>Change Password</b></a></li>
                    <li><a href="logout.php" onclick="return confirm('Are you sure to logout?');">Logout</a></li>
                </ul>
            </div>
        </div>

        <!-- MY ACCOUNT -->
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9 p-3">
            <div class="h3 mb-3"><strong>CHANGE PASSWORD</strong></div>
            <form method="POST" action="c_change_password.php?id=<?php echo $id; ?>">
                <?php
                    if (isset($_SESSION['errorchangePassword'])) {
                        echo "<p style='color:red; text-align:center'>" . $_SESSION['errorchangePassword'] . "</p> ";
                    }
                ?>
                <div class="form-group py-3 px-3">
                    <label for="currentPassword" class="mb-2"><b>Current Password: </b></label>
                    <input name="currentPassword" type="text" class="form-control" placeholder="Enter your old password">
                </div>
                <div class="form-group pb-3 px-3">
                    <label for="newPassword" class="mb-2"><b>New Password: </b></label>
                    <input name="newPassword" type="text" class="form-control" placeholder="Enter your new password">
                </div>
                <div class="form-group pb-3 px-3">
                    <label for="renewPassword" class="mb-2"><b>Confirm New Password: </b></label>
                    <input name="renewPassword"type="text" class="form-control" placeholder="Confirm your new password">
                </div>
                <div class="form-group pb-3 text-center">
                    <button class="btn btn-success px-4" style="color: white;" type="submit" name="changePassword">CHANGE PASSWORD</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
    include "end.php";
    include "main-footer.php";
?>