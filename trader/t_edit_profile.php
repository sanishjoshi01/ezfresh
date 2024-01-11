<?php
    session_start();
    $t_id = $_SESSION['tid'];
    $user = $_SESSION['tfullname'];

    $sql = "SELECT * FROM TRADER WHERE FULL_NAME='$user'";
    include "connect.php";

    $qry = oci_parse($conn, $sql);
    oci_execute($qry);

    // while($row = oci_fetch_assoc($qry))
    // {
    //     $t_id = $row['TRADER_ID'];
    // }

    // if(isset($_GET['tid'])){
    //     $tid = $_GET['tid'];
    // }

    if(isset($_POST['updateProfile']))
    {
        $n_fullname = $_POST['t_fullname'];
        $n_phone = $_POST['t_phone'];
        $n_ppPath = $_POST['profilePicPath'];   // FOR - images/profile/ path
        
        if(!empty($_POST['profilePicPath']) && !empty($_POST['profilePic']))
        {
            $n_pp = $_POST['profilePic'];           // FOR profile picture value - imagesname.png

            $new_pp = $n_ppPath . $n_pp;            //concacenating to get = images/profile/imagesname.png
        }
        else{
            include "connect.php";
            $qry = "SELECT * FROM TRADER WHERE TRADER_ID = '$t_id'";

            $res = oci_parse($conn, $qry);
            oci_execute($res);
            
            while($r = oci_fetch_assoc($res))
            {
                $tpp = $r['PROFILE_PICTURE'];
                $new_pp = $tpp;
            }
        }

        $sql1 = "UPDATE TRADER SET FULL_NAME='$n_fullname', PHONE_NUMBER='$n_phone', PROFILE_PICTURE='$new_pp' WHERE TRADER_ID=$t_id";

        include "connect.php";

        $qry1 = oci_parse($conn, $sql1);
        oci_execute($qry1);

        if($qry1){
            echo
            "
                <script>
                alert('Profile Updated');
                window.location.href = 'trader_edit_profile.php?id=$t_id';
                </script>            
            ";
        }
    }
?>