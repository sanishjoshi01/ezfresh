<?php
    session_start();
    $id = $_SESSION['cid'];
    $user = $_SESSION['username'];

    $sql = "SELECT * FROM CUSTOMER WHERE USERNAME='$user'";
    include "connect.php";

    $qry = oci_parse($conn, $sql);
    oci_execute($qry);

    while($row = oci_fetch_assoc($qry))
    {
        $c_id = $row['CUSTOMER_ID'];
    }
    if(isset($_POST['updateProfile']))
    {
        $n_username = $_POST['u_username'];
        $n_fname = $_POST['u_firstname'];
        $n_lname = $_POST['u_lastname'];
        $n_gender = $_POST['u_gender'];
        $n_address = $_POST['u_address'];
        $n_phone = $_POST['u_phone'];
        $n_ppPath = $_POST['profilePicPath'];   // FOR - images/profile/ path
        
        if(!empty($_POST['profilePicPath']) && !empty($_POST['profilePic']))
        {
            $n_pp = $_POST['profilePic'];           // FOR profile picture value - imagesname.png

            $new_pp = $n_ppPath . $n_pp;            //concacenating to get = images/profile/imagesname.png
        }
        else{
            include "connect.php";
            $qry = "SELECT * FROM CUSTOMER WHERE CUSTOMER_ID = $id";

            $res = oci_parse($conn, $qry);
            oci_execute($res);
            
            while($r = oci_fetch_assoc($res))
            {
                $cpp = $r['PROFILE_PICTURE'];

                $new_pp = $cpp;
            }
            
        }

        $sql1 = "UPDATE CUSTOMER SET USERNAME='$n_username', FIRST_NAME='$n_fname', LAST_NAME='$n_lname', GENDER='$n_gender', ADDRESS='$n_address', PHONE_NUMBER='$n_phone', PROFILE_PICTURE='$new_pp' WHERE CUSTOMER_ID=$c_id";

        include "connect.php";

        $qry1 = oci_parse($conn, $sql1);
        oci_execute($qry1);

        if($qry1){
            echo
            "
                <script>
                alert('Profile Updated');
                window.location.href = 'customer_edit_profile.php?id=$id';
                </script>            
            ";
        }
    }
?>