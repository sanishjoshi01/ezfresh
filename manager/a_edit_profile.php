<?php
    session_start();
    $ausername = $_SESSION['a_username'];

    $sql = "SELECT * FROM ADMIN WHERE USERNAME='$ausername'";
    include "connect.php";

    $qry = oci_parse($conn, $sql);
    oci_execute($qry);

    while($row = oci_fetch_assoc($qry))
    {
        $a_id = $row['ADMIN_ID'];
    }

    // if(isset($_GET['tid'])){
    //     $tid = $_GET['tid'];
    // }

    if(isset($_POST['updateProfile']))
    {
        $n_username = $_POST['a_fullname'];
        $n_ppPath = $_POST['profilePicPath'];   // FOR - images/profile/ path
        
        if(!empty($_POST['profilePicPath']) && !empty($_POST['profilePic']))
        {
            $n_pp = $_POST['profilePic'];           // FOR profile picture value - imagesname.png

            $new_pp = $n_ppPath . $n_pp;            //concacenating to get = images/profile/imagesname.png
        }
        else{
            include "connect.php";
            $qry = "SELECT * FROM ADMIN WHERE TRADER_ID = '$a_id'";

            $res = oci_parse($conn, $qry);
            oci_execute($res);
            
            while($r = oci_fetch_assoc($res))
            {
                $tpp = $r['PROFILE_PICTURE'];
                $new_pp = $tpp;
            }
        }

        $sql1 = "UPDATE ADMIN SET USERNAME='$n_username', PROFILE_IMG='$new_pp' WHERE ADMIN_ID=$a_id";

        include "connect.php";

        $qry1 = oci_parse($conn, $sql1);
        oci_execute($qry1);

        if($qry1){
            echo
            "
                <script>
                alert('Profile Updated');
                window.location.href = 'admin_edit_profile.php?aid=$a_id';
                </script>            
            ";
        }
    }
?>