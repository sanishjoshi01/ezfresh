<?php
    include "../start.php";
    include "t_header.php";

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
        <!-- EDIT ACCOUNT -->
            <div class="h3 px-3">
                <strong>EDIT PROFILE</strong>
            </div>
            <!-- PROFILE PICTURE-->
            <form method="POST" action="t_edit_profile.php">
                <div class="row m-1 p-3 border border-dark-light">
                    <?php
                        if(isset($_GET['id']))
                        {
                            $tid = $_GET['id'];

                            $sql = "SELECT * FROM TRADER WHERE TRADER_ID='$tid'";
                            include "connect.php";

                            $qry = oci_parse($conn, $sql);
                            oci_execute($qry);

                            if($qry){
                                while($row = oci_fetch_assoc($qry))
                                {
                                    $t_id = $row['TRADER_ID'];
                                    $t_fullname = $row['FULL_NAME'];
                                    $t_phone = $row['PHONE_NUMBER'];
                                    $t_email = $row['EMAIL'];
                                    $t_pp= $row['PROFILE_PICTURE'];
                                }
                            }
                        }
                    ?>
                    <div id="customerProfile" class="col-sm-12 col-xl-4">
                        <div class="text-center">
                            <div class="<?php
                                    if(empty($t_pp)){
                                        echo 'border border-dark-light';
                                    }
                                ?> d-flex justify-content-center align-items-center mx-5" style="width: 18rem; height: 18rem; float:center;">
                                <img style="width: 16rem; height: 16rem;" class="img-fluid border rounded-circle shadow" src="<?php echo $t_pp; ?>" >
                            </div>
                            
                            <div>
                                <input type='hidden' name='profilePicPath' value="images/"/>
                                    <label for="file-upload" class="btn btn-outline-success">
                                        <?php
                                            if(empty($t_pp))
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
                        </div>
                    </div>

                    <!-- Account info-->
                    <div class="col-sm-12 col-xl-8 p-4" id="accInfo">
                        <div class="h4"><b>Account Information</b></div>
                    
                        <input type="hidden" name="tid" value="<?php echo $t_id; ?>" />
                        <div class="form-group py-3 px-3">
                            <label for="t_fullname" class="mb-2"><b>Full Name: </b></label>
                            <input name="t_fullname" type="text" class="form-control" value="<?php echo $t_fullname; ?>">
                        </div>
                        <div class="form-group py-3 px-3">
                            <label for="t_email" class="mb-2"><b>Email: </b></label>
                            <input name="t_email" type="text" class="form-control" value="<?php echo $t_email; ?>" disabled>
                        </div>
                        <div class="form-group py-3 px-3">
                            <label for="t_phone" class="mb-2"><b>Phone Number: </b></label>
                            <input name="t_phone" type="text" class="form-control" value="<?php echo $t_phone?>">
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
    include "../main-footer.php";
    include "../end.php";
?>