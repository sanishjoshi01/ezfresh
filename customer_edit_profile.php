<?php
    include "start.php";
    include "main-header.php";

    // $username = $_SESSION['username'];
    // $fname = $_SESSION['fname'];
    // $lname = $_SESSION['lname'];
    // $gender = $_SESSION['gender'];
    // $address = $_SESSION['address'];   
    // $email = $_SESSION['email'];
    // $phone = $_SESSION['phone'];

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
    input[type="file"] {
        display: none;
    }
</style>

<!-- SECTION 1 -->
<div class="container mt-4 p-3">
    <div class="row">

        <!-- DASHBOARD -->
        <div id="dash" class="col-sm-12 col-md-12 col-lg-12 col-xl-3 border border-dark p-3">
            <div class="h3 text-center">
                <strong>DASHBOARD</strong>
            </div>
            <div class="mt-3">
                <ul id="links">
                    <li><a href="customer_profile.php?id=<?php echo $id?>"><b>Account</b></a></li>
                    <li><a href="customer_order.php?id=<?php echo $id?>">Orders</a></li>
                    <li><a href="customer_reviews.php?id=<?php echo $id?>">Reviews</a></li>
                    <li><a href="customer_change_password.php?id=<?php echo $id?>">Change Password</a></li>
                    <li><a href="logout.php" onclick="return confirm('Are you sure to logout?');">Logout</a></li>
                </ul>
            </div>
        </div>

        <!-- EDIT ACCOUNT -->
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9 p-3">
            <div class="h3 px-1">
                <strong>EDIT PROFILE</strong>
            </div>

                <!-- PROFILE PICTURE-->
            <form method="POST" action="c_edit_profile.php">
                <div class="row m-1 p-3 border border-dark">
                    <?php
                        if(isset($_GET['id']))
                        {
                            $edid = $_GET['id'];

                            $sql = "SELECT * FROM CUSTOMER WHERE CUSTOMER_ID='$edid'";
                            include "connect.php";

                            $qry = oci_parse($conn, $sql);
                            oci_execute($qry);

                            if($qry){
                                while($row = oci_fetch_assoc($qry))
                                {
                                    $c_id = $row['CUSTOMER_ID'];
                                    $c_user = $row['USERNAME'];
                                    $c_fname = $row['FIRST_NAME'];
                                    $c_lname = $row['LAST_NAME'];
                                    $c_email = $row['EMAIL'];
                                    $c_gender= $row['GENDER'];
                                    $c_address = $row['ADDRESS'];
                                    $c_phone= $row['PHONE_NUMBER'];
                                    $c_pp= $row['PROFILE_PICTURE'];
                                }
                            }   
                        }
                    ?>
                    <div id="customerProfile" class="col-sm-12 col-xl-4 text-center">
                        <div class="<?php
                                if(empty($c_pp)){
                                    echo 'border border-dark-light';
                                }
                            ?>" style="width: 18rem; height: 18rem;">
                            <img style="width: 16rem; height: 16rem;" class="img-fluid border rounded-circle shadow" src="<?php echo $c_pp; ?>" >
                        </div>
                        <input type='hidden' name='profilePicPath' value="images/profile/"/>
                        <label for="file-upload" class="btn btn-outline-success">
                        <?php
                            if(empty($c_pp))
                            {
                                echo "Upload Profile Picture";
                            }
                            else{
                                echo "Change Profile Picture";
                            }
                        ?>
                        </label>
                        <input id="file-upload" class="text-center" type='file' name='profilePic' onchange="getFileData(this);"/><br><br>
                        <script>
                                function getFileData(myFile){
                                    var file = myFile.files[0];  
                                    var filename = file.name;

                                    document.getElementById("file-name").innerHTML = "Selected file: " + filename;
                                }
                            </script>
                             <h6 id="file-name" class="text-center" disabled></h6>
                    </div>

                    <!-- Account info-->
                    <div class="col-sm-12 col-xl-8 p-4" id="accInfo">
                    
                        <input type="hidden" name="cid" value="<?php echo $cid; ?>" />
                        <div class="form-group py-3 px-3">
                            <label for="u_username" class="mb-2"><b>Username: </b></label>
                            <input name="u_username" type="text" class="form-control" value="<?php echo $c_user; ?>">
                        </div>
                        <div class="form-group pb-3 px-3">
                            <label for="u_firstname" class="mb-2"><b>First Name: </b></label>
                            <input name="u_firstname" type="text" class="form-control" value="<?php echo $c_fname?>">
                        </div>
                        <div class="form-group pb-3 px-3">
                            <label for="u_lastname" class="mb-2"><b>Last Name: </b></label>
                            <input name="u_lastname" type="text" class="form-control" value="<?php echo $c_lname?>">
                        </div>
                        <div class="form-group pb-3 px-3">
                            <label class="mb-2"><b>Gender: </b></label>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="u_gender" id="male" value="Male" <?php if($c_gender == 'Male'){
                                                                                                                    echo 'checked';               
                                                                                                                    }
                                    ?>>
                                <label for="male" class="form-check-label">Male</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="u_gender" id="female" value="Female" <?php if($c_gender == 'Female'){
                                                                                                                    echo 'checked';               
                                                                                                                    }
                                    ?>>
                                <label for="female" class="form-check-label">Female</labesl>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="u_gender" id="other" value="Other" <?php if($c_gender == 'Other'){
                                                                                                                    echo 'checked';               
                                                                                                                    }
                                    ?>>
                                <label for="other" class="form-check-label">Other</label>
                            </div>
                        </div>
                        <div class="form-group pb-3 px-3">
                            <label for="u_address" class="mb-2"><b>Address: </b></label>
                            <input name="u_address" type="text" class="form-control" value="<?php echo $c_address?>">
                        </div>
                        <div class="form-group pb-3 px-3">
                            <label for="u_phone" class="mb-2"><b>Phone Number: </b></label>
                            <input name="u_phone" type="text" class="form-control" value="<?php echo $c_phone?>">
                        </div>
                        <div class="form-group pb-3 text-center">
                            <button class="btn btn-success rounded px-4" style="color: white;" type="submit" name="updateProfile">Save Changes</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
    include "end.php";
    include "main-footer.php";
?>