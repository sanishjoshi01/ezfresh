<?php 
    include "start.php"; 
    include "head.php";
    session_start();
?>
<style> 
    .col-1,.col-2,.col-3,.col-4,.col-5,.col-6,.col-7,.col-8,.col-9,.col-10,.col-11, .col-12{
        border: 2px solid black;
    }
</style>

<div class="container my-5">
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-xl-10 p-5">
            <form method="POST" action="Customer/c_signin.php">
                <h4 class="text-center"><b>CUSTOMER LOGIN</b></h4>
                <?php
                if (isset($_SESSION['cierror'])) {
                    echo "<p style='color:red; text-align:center'>" . $_SESSION['cierror'] . "</p> ";
                }
                ?>
                <div class="form-group py-3 px-5">
                    <label class="mb-2" for="username"><b>Username: </b></label>
                    <input type="text" class="form-control" placeholder="Enter your username" name="username" value="<?php if (isset($_COOKIE["user"])) {
																																echo $_COOKIE["user"];
																															}  ?>">
                </div>
                <div class="form-group pb-3 px-5">
                    <label class="mb-2" for="password"><b>Password: </b></label>
                    <input type="password" class="form-control" placeholder="Enter your password" name="password" value="<?php if (isset($_COOKIE["password"])) {
																																echo $_COOKIE["password"];
																															}  ?>">
                </div>
                <div class="form-group pb-3 px-5">
                    <div class="form-check">
                        <input style="height: 15px; width: 15px" type="checkbox" class="form-check-input" name="staySigned" id="staySigned"  <?php
                            if(isset($_COOKIE['user']) && isset($_COOKIE['password']))
                            {
                                echo 'checked';
                            }
                        ?>>
                        <label for="staySigned" class="form-check-label">Stay signed in</label>
                    </div>
                </div>
                <div class="form-group pb-3 text-center">
                    <button class="btn btn-success px-4" style="background: white; color: black; border: 2px solid black" type="submit" name="clogin"><b>SIGN IN</b></button>
                </div>
                <div class="text-center">
                    <small>Don't have an account? <a class="text-decoration-none" style="color:blue;" href="signup_customer.php">Sign Up here</a></small>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include "main-footer.php";
include "end.php" ?>