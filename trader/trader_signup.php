<?php 
    session_start();
    include "../start.php";
    include "thead.php";
?>
<style> 
    .col-1,.col-2,.col-3,.col-4,.col-5,.col-6,.col-7,.col-8,.col-9,.col-10,.col-11, .col-12{
        border: 2px solid black;
    }
</style>

<div class="container my-5">
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-xl-8 p-5">
            <div class="text-center">
                <div class="text-center mb-4 h5 border border-dark-light bg-light rounded d-inline-block p-3">
                    <b>ADMIN LOGIN: <a class="text-decoration-none" style="color:blue;" href="../manager/admin_login.php">LOG IN</a></b>
                </div>
            </div>
            <form method="POST" action="t_signup.php">
                <h4 class="text-center mb-3"><b>TRADER SIGNUP</b></h4>
                <?php
                if (isset($_SESSION['tuerror'])) {
                    echo "<p style='color:red; text-align:center'>" . $_SESSION['tuerror'] . "</p> ";
                }
                ?>
                <div class="form-group pb-3 px-5">
                    <label for="t_fullName" class="mb-2"><b>Full Name: </b></label>
                    <input name="t_fullName" type="text" class="form-control" placeholder="Enter your full name here..." value="<?php
                    if(isset($_GET['t_fullName'])){
                        echo $_GET['t_fullName'];
                    }
                    ?>">
                </div>
                <div class="form-group pb-3 px-5">
                    <label for="t_email" class="mb-2"><b>Email: </b></label>
                    <input name="t_email" type="email" class="form-control" placeholder="Enter your email here..." value="<?php
                    if(isset($_GET['t_email'])){
                        echo $_GET['t_email'];
                    }
                    ?>">
                </div>
                <div class="form-group pb-3 px-5">
                    <label for="t_phoneNumber" class="mb-2"><b>Phone Number: </b></label>
                    <input name="t_phoneNumber" type="text" class="form-control" placeholder="Enter your phone number here..." value="<?php
                    if(isset($_GET['t_phoneNumber'])){
                        echo $_GET['t_phoneNumber'];
                    }
                    ?>" >
                </div>
                <div class="form-group pb-3 px-5">
                    <label for="t_sudesc" class="mb-2"><b>What types of products are you going to list?: </b></label>
                    <textarea name="t_sudesc" type="text" class="form-control" placeholder="Enter your answer here..." value="<?php
                    if(isset($_GET['t_sudesc'])){
                        echo $_GET['t_sudesc'];
                    }
                    ?>" required></textarea>
                </div>
                <div class="form-group pb-3 px-5">
                    <label for="t_password" class="mb-2"><b>Password: </b></label>
                    <input name="t_password" type="text" class="form-control" placeholder="Create password  ">
                </div>
                <div class="form-group pb-3 px-5">
                    <label for="t_confirmPassword" class="mb-2"><b>Confirm Password: </b></label>
                    <input name="t_confirmPassword" type="text" class="form-control" placeholder="Confirm password">
                </div>
                <div class="form-group pb-3 px-5">
                    <div class="form-check">
                        <input style="height: 15px; width: 15px" type="checkbox" class="form-check-input" name="acceptPT" id="acceptPT">
                        <label for="acceptPT" class="form-check-label">I accept the EZFRESH Privacy Policy and Terms & Conditions.</label>
                    </div>
                </div>
                <div class="form-group pb-3 text-center">
                    <button class="btn btn-success px-4" style="background: white; color: black; border: 2px solid black" type="submit" name="t_signup"><b>SIGN UP</b></button>
                </div>
                <div class="text-center">
                    <small>Already a trader? <a class="text-decoration-none" style="color: blue;" href="trader_signin.php">Sign In here</a></small>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include "../main-footer.php";
include "../end.php" ?>