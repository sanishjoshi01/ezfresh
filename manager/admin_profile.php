<?php
    include "../start.php";
    include "a_header.php";

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
            <strong>ADMIN ACCOUNT</strong>
        </div>
        <?php
            if(isset($_GET['aid']))
            {
                $aid = $_GET['aid'];

                $sql = "SELECT * FROM ADMIN WHERE ADMIN_ID='$aid'";
                include "connect.php";

                $qry = oci_parse($conn, $sql);
                oci_execute($qry);

                if($qry){
                    while($row = oci_fetch_assoc($qry)) {
                        $a_id = $row['ADMIN_ID'];
                        $a_username = $row['USERNAME'];
                        $a_profile = $row['PROFILE_IMG'];
                        $a_email = $row['EMAIL'];
                    }
                }   
            }
        ?>
        <div class="col-4 d-flex justify-content-center">
            <div id="customerProfile">
                    <div class="<?php
                        if(empty($a_profile)){
                            echo 'border border-dark-light';
                        }
                    ?>" style="width: 18rem; height: 18rem;">
                    <img style="width: 16rem; height: 16rem;" class="img-fluid border rounded-circle shadow" src="<?php echo $a_profile; ?>">
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="border border-dark-light bg-light p-4" id="accInfo">
                <div class="h4"><b>Account Information</b></div>
                <div class="h5">Username: <?php echo $a_username;?></div>
                <div class="h5">Email: <?php echo $a_email?></div>
                
                <div class='h5'>
                    <div id='lg1' class='btn btn-outline-primary rounded'>
                        <a href='admin_edit_profile.php?aid=<?php echo $a_id; ?>' style='text-decoration: none; color: blue; letter-spacing: 3px;'>EDIT PROFILE</a>
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