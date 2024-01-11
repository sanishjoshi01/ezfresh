<?php
    include "../start.php";
    include "a_header.php";
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
            <form method="POST" action="a_edit_profile.php">
                <div class="row m-1 p-3 border border-dark-light">
                    <?php
                        if(isset($_GET['aid']))
                        {
                            $aid = $_GET['aid'];

                            $sql = "SELECT * FROM ADMIN WHERE ADMIN_ID='$aid'";
                            include "connect.php";

                            $qry = oci_parse($conn, $sql);
                            oci_execute($qry);

                            if($qry){
                                while($row = oci_fetch_assoc($qry))
                                {
                                    $a_id = $row['ADMIN_ID'];
                                    $a_username = $row['USERNAME'];
                                    $a_profile = $row['PROFILE_IMG'];
                                    $a_email = $row['EMAIL'];
                                }
                            }
                        }
                    ?>
                    <div id="customerProfile" class="col-sm-12 col-xl-4">
                        <div class="text-center">
                            <div class="<?php
                                    if(empty($a_profile)){
                                        echo 'border border-dark-light';
                                    }
                                ?> d-flex justify-content-center align-items-center mx-5" style="width: 18rem; height: 18rem; float:center;">
                                <img style="width: 16rem; height: 16rem;" class="img-fluid border rounded-circle shadow" src="<?php echo $a_profile; ?>" >
                            </div>
                            
                            <div>
                                <input type='hidden' name='profilePicPath' value="images/"/>
                                    <label for="file-upload" class="btn btn-outline-success">
                                        <?php
                                            if(empty($a_profile))
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
                    
                        <input type="hidden" name="tid" value="<?php echo $a_id; ?>" />
                        <div class="form-group py-3 px-3">
                            <label for="a_fullname" class="mb-2"><b>Full Name: </b></label>
                            <input name="a_fullname" type="text" class="form-control" value="<?php echo $a_username; ?>">
                        </div>
                        <div class="form-group py-3 px-3">
                            <label for="a_email" class="mb-2"><b>Email: </b></label>
                            <input name="a_email" type="text" class="form-control" value="<?php echo $a_email; ?>" disabled>
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