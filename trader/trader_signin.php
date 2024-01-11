<?php 
    include "../start.php"; 
    include "thead.php";
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
            <form method="POST" action="t_signin.php">
                <h4 class="text-center"><b>TRADER LOGIN</b></h4>
                <?php
                if (isset($_SESSION['tierror'])) {
                    echo "<p style='color:red; text-align:center'>" . $_SESSION['tierror'] . "</p> ";
                }
                ?>
                <div class="form-group py-3 px-5">
                    <label class="mb-2" for="temail"><b>Email: </b></label>
                    <input type="text" class="form-control" placeholder="Enter your email here..." name="temail" value="<?php if (isset($_COOKIE["tuser"])) {
																																echo $_COOKIE["tuser"];
																															}  ?>">
                </div>
                <div class="form-group pb-3 px-5">
                    <label class="mb-2" for="tpassword"><b>Password: </b></label>
                    <input type="password" class="form-control" placeholder="Enter your password here..." name="tpassword" value="<?php if (isset($_COOKIE["tpassword"])) {
																																echo $_COOKIE["tpassword"];
																															}  ?>">
                </div>
                <div class="form-group pb-3 px-5">
                    <div class="form-check">
                        <input style="height: 15px; width: 15px" type="checkbox" class="form-check-input" name="staySigned" id="staySigned" <?php
                            if(isset($_COOKIE['tuser']) && isset($_COOKIE['tpassword']))
                            {
                                echo 'checked';
                            }
                        ?>
                        >
                        <label for="staySigned" class="form-check-label">Stay signed in</label>
                    </div>
                </div>
                <div class="form-group pb-3 text-center">
                    <button class="btn btn-success px-4" style="background: white; color: black; border: 2px solid black" type="submit" name="tlogin"><b>SIGN IN</b></button>
                </div>
                <div class="text-center">
                    <small>Don't have an account? <a class="text-decoration-none" style="color:blue;" href="trader_signup.php">Sign Up here</a></small>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include "../main-footer.php";
include "end.php" ?>