<?php 
    session_start();
    include "start.php";
    include "head.php";
?>
<style> 
    .col-1,.col-2,.col-3,.col-4,.col-5,.col-6,.col-7,.col-8,.col-9,.col-10,.col-11, .col-12{
        border: 2px solid black;
    }
</style>

<div class="container my-5">
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-xl-8 p-5">
            <form method="POST" action="Customer/c_signup.php">
                <h4 class="text-center"><b>CUSTOMER SIGNUP</b></h4>
                <?php
                if (isset($_SESSION['cuerror'])) {
                    echo "<p style='color:red; text-align:center'>" . $_SESSION['cuerror'] . "</p> ";
                }
                ?>
                <div class="form-group py-3 px-5">
                    <label for="c_username" class="mb-2"><b>Username: </b></label>
                    <input name="c_username" type="text" class="form-control" placeholder="Create username" value="<?php
                    if(isset($_GET['c_username'])){
                        echo $_GET['c_username'];
                    }
                    ?>">
                </div>
                <div class="form-group pb-3 px-5">
                    <label for="c_firstName" class="mb-2"><b>First Name: </b></label>
                    <input name="c_firstName" type="text" class="form-control" placeholder="Enter your first name" value="<?php
                    if(isset($_GET['c_firstName'])){
                        echo $_GET['c_firstName'];
                    }
                    ?>">
                </div>
                <div class="form-group pb-3 px-5">
                    <label for="c_lastName" class="mb-2"><b>Last Name: </b></label>
                    <input name="c_lastName" type="text" class="form-control" placeholder="Enter your last name" value="<?php
                    if(isset($_GET['c_lastName'])){
                        echo $_GET['c_lastName'];
                    }
                    ?>">
                </div>
                <div class="form-group pb-3 px-5">
                    <label for="c_email" class="mb-2"><b>Email: </b></label>
                    <input name="c_email" type="email" class="form-control" placeholder="Enter your email" value="<?php
                    if(isset($_GET['c_email'])){
                        echo $_GET['c_email'];
                    }
                    ?>">
                </div>
                <div class="form-group pb-3 px-5">
                    <label class="mb-2"><b>Gender: </b></label>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="gender" id="genderMale" value="Male" 
                        <?php 
                            if (isset($_GET['gender']) && $_GET['gender'] == "Male"){
                                echo "checked";
                            }
                        ?>
                        checked/>
                        <label for="genderMale" class="form-check-label">Male</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="gender" id="genderFemale" value="Female"
                        <?php 
                            if (isset($_GET['gender']) && $_GET['gender'] == "Female"){
                                echo "checked";
                            }
                        ?>
                        />
                        <label for="genderFemale" class="form-check-label">Female</labesl>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="gender" id="genderOther" value="Other" 
                        <?php 
                            if (isset($_GET['gender']) && $_GET['gender'] == "Other"){
                                echo "checked";
                            }
                        ?>
                        />
                        <label for="genderOther" class="form-check-label">Other</label>
                    </div>
                </div>
                <div class="form-group pb-3 px-5">
                    <label for="c_address" class="mb-2"><b>Address: </b></label>
                    <input name="c_address" type="text" class="form-control" placeholder="Enter your address" value="<?php
                    if(isset($_GET['c_address'])){
                        echo $_GET['c_address'];
                    }
                    ?>">
                </div>
                <div class="form-group pb-3 px-5">
                    <label for="c_phoneNumber" class="mb-2"><b>Phone Number: </b></label>
                    <input name="c_phoneNumber" type="text" class="form-control" placeholder="Enter your phone number" value="<?php
                    if(isset($_GET['c_phoneNumber'])){
                        echo $_GET['c_phoneNumber'];
                    }
                    ?>" >
                </div>
                <div class="form-group pb-3 px-5">
                    <label for="c_password" class="mb-2"><b>Password: </b></label>
                    <input name="c_password" type="text" class="form-control" placeholder="Create password">
                </div>
                <div class="form-group pb-3 px-5">
                    <label for="c_confirmPassword" class="mb-2"><b>Confirm Password: </b></label>
                    <input name="c_confirmPassword" type="text" class="form-control" placeholder="Confirm password">
                </div>
                <div class="form-group pb-3 px-5">
                    <div class="form-check">
                        <input style="height: 15px; width: 15px" type="checkbox" class="form-check-input" name="acceptPT" id="acceptPT">
                        <label for="acceptPT" class="form-check-label">I accept the EZFRESH Privacy Policy and Terms & Conditions.</label>
                    </div>
                </div>
                <div class="form-group pb-3 text-center">
                    <button class="btn btn-success px-4" style="background: white; color: black; border: 2px solid black" type="submit" name="signup"><b>SIGN UP</b></button>
                </div>
                <div class="text-center">
                    <small>Already have an account? <a class="text-decoration-none" style="color: blue;" href="signin_customer.php">Sign In here</a></small>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include "main-footer.php";
include "end.php" ?>