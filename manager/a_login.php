<?php
    session_start();
    include "connect.php";
    $qry = "SELECT * FROM ADMIN";
    $res = oci_parse($conn, $qry);
    oci_execute($res);

    $r = oci_fetch_assoc($res);
    $admin_id = $r['ADMIN_ID'];

    if(isset($_POST['alogin']))
    {
        if(!empty($_POST['email']) && !empty($_POST['password']))
        {
            $email = $_POST['email'];
            $pass = $_POST['password'];

            $sql = "SELECT * FROM ADMIN WHERE EMAIL = '$email' AND PASSWORD = '$pass'";

            include "connect.php";

            $qry = oci_parse($conn, $sql);
            oci_execute($qry);

            $count = oci_fetch_all($qry, $resre);     //returns 1 if user is in the table if not then returns 0.
            // echo "$count rows fetched<br>\n";
            oci_execute($qry);

            if($count == 1){
                while($row = oci_fetch_assoc($qry)){
                    $_SESSION['a_username'] = $row['USERNAME'];
                    header ('location: admin_dashboard.php?aid='.$admin_id.'');
                    // echo "<a href='../logout.php'>LOGOUT</a>";
                }
                if(!empty($_POST['staySigned'])){
                    setcookie("auser", $email, time() + (1 * 60 * 60), "/");
                    setcookie("apassword", $pass, time() + (1 * 60 * 60), "/");
                }
                // stay signed in nathichepani set cookie ko lagi
                else{
                    setcookie("auser", $email, time() - 3600, "/");
                    setcookie("apassword", $pass, time() - 3600, "/");
                    // if (isset($_COOKIE["user"])) {
                    //     setcookie("user", "$user");
                    // }
                    // if (isset($_COOKIE["password"])) {
                    //     setcookie("password", "$pass");
                    // }
                }
            }
            else{
                $_SESSION['aierror'] = 'User not recognised!';
                // header ('location: sessions.php');
                header ('location: admin_login.php');
            }
        }
        else
        {
            $_SESSION['aierror'] = 'Please fill all the fields!';
            header ('location: admin_login.php');
        }
    }
?> 