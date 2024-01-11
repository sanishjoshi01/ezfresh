<?php 
    include "../start.php"; 
    include "ahead.php";
    session_start();
?>
<style> 
    .col-1,.col-2,.col-3,.col-4,.col-5,.col-6,.col-7,.col-8,.col-9,.col-10,.col-11, .col-12{
        border: 2px solid black;
    }
</style>
<!-- 
xl >= 1200
lg >= 992
md >= 768
sm >= 576 -->

<div class="container my-5">
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-xl-10 p-5">
            <form method="POST" action="a_login.php">
                <h4 class="text-center"><b>ADMIN LOGIN</b></h4>
                <?php
                if (isset($_SESSION['aierror'])) {
                    echo "<p style='color:red; text-align:center'>" . $_SESSION['aierror'] . "</p> ";
                }
                ?>
                <div class="form-group py-3 px-5">
                    <label class="mb-2" for="email"><b>Email: </b></label>
                    <input type="text" class="form-control" placeholder="Enter your email" name="email" value="<?php if (isset($_COOKIE["auser"])) {
																																echo $_COOKIE["auser"];
																															}  ?>">
                </div>
                <div class="form-group pb-3 px-5">
                    <label class="mb-2" for="password"><b>Password: </b></label>
                    <input type="password" class="form-control" placeholder="Enter your password" name="password" value="<?php if (isset($_COOKIE["apassword"])) {
																																echo $_COOKIE["apassword"];
																															}  ?>">
                </div>
                <div class="form-group pb-3 px-5">
                    <div class="form-check">
                        <input style="height: 15px; width: 15px" type="checkbox" class="form-check-input" name="staySigned" id="staySigned"  <?php
                            if(isset($_COOKIE['auser']) && isset($_COOKIE['apassword']))
                            {
                                echo 'checked';
                            }
                        ?>>
                        <label for="staySigned" class="form-check-label">Stay signed in</label>
                    </div>
                </div>
                <div class="form-group pb-3 text-center">
                    <button class="btn btn-success px-4" style="background: white; color: black; border: 2px solid black" type="submit" name="alogin"><b>LOG IN</b></button>
                </div>
                <!-- <div class="text-center">
                    <small>Don't have an account? <a class="text-decoration-none" style="color:blue;" href="signup_customer.php">Sign Up here</a></small>
                </div> -->
            </form>
        </div>
    </div>
</div>

<?php include "../main-footer.php";
include "../end.php" ?>