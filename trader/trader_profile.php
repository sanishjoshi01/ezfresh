<?php
    include "../start.php";
    include "t_header.php";

    // $username = $_SESSION['tfullname'];
    // $id = $_SESSION['cid'];
    // $fname = $_SESSION['fname'];
    // $lname = $_SESSION['lname'];
    // $fullname = $fname .' '. $lname;

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
    @media (max-width: 960px){
        #links > li{
            font-size: medium;
        }
        #accInfo > div{
            font-size: medium;
        }
    }
    @media (max-width: 540px){
        #links > li{
            font-size: small;
        }
        #accInfo > div{
            font-size: small;
        }
    }
    @media (max-width: 460px){
        #links > li{
            font-size: x-small;
        }
        #accInfo > div{
            font-size: small;
        }
    }
    #lg:hover a {
        color: white !important;
    }
    #lg1:hover a {
        color: white !important;
    }
</style>

<div class="container mt-4 p-3">
    <div class="row d-flex justify-content-center">
        <div class="h3 px-3 mb-5">
            <strong>TRADER ACCOUNT</strong>
        </div>
        <?php
            if(isset($_GET['id']))
            {
                $tid = $_GET['id'];

                $sql = "SELECT * FROM TRADER WHERE TRADER_ID='$tid'";
                include "connect.php";

                $qry = oci_parse($conn, $sql);
                oci_execute($qry);

                if($qry){
                    while($row = oci_fetch_assoc($qry)) {
                        $tid = $row['TRADER_ID'];
                        $t_fullname = $row['FULL_NAME'];
                        $t_email = $row['EMAIL'];
                        $t_phone = $row['PHONE_NUMBER'];
                        $t_desc = $row['TRADER_DESC'];
                        $t_pp= $row['PROFILE_PICTURE'];
                    }
                }   
            }
        ?>
        <div class="col-4 d-flex justify-content-center">
            <div id="customerProfile">
                    <div class="<?php
                        if(empty($t_pp)){
                            echo 'border border-dark-light';
                        }
                    ?>" style="width: 18rem; height: 18rem;">
                    <img style="width: 16rem; height: 16rem;" class="img-fluid border rounded-circle shadow" src="<?php echo $t_pp; ?>">
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="border border-dark-light bg-light p-4" id="accInfo">
                <div class="h4"><b>Account Information</b></div>
                <div class="h5">Name: <?php echo $t_fullname;?></div>
                <div class="h5">Email: <?php echo $t_email?></div>
                <div class="h5">Phone Number: <?php echo $t_phone?></div>
                
                <div class='h5'>
                    <div id='lg1' class='btn btn-outline-primary rounded'>
                        <a href='trader_edit_profile.php?id=<?php echo $tid; ?>' style='text-decoration: none; color: blue; letter-spacing: 3px;'>EDIT PROFILE</a>
                    </div>
                </div>
                <div id='lg' class="btn btn-outline-danger"><a style='text-decoration: none; color: red; letter-spacing: 3px;' href="logout.php" onclick="return confirm('Are you sure to logout?');">LOGOUT</a></div>
            </div>
        </div>
    </div>
</div>
<?php
    include "../main-footer.php";
    include "../end.php";
?>