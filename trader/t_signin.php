<?php
    session_start();
    if(isset($_POST['tlogin']))
    {
        if(!empty($_POST['temail']) && !empty($_POST['tpassword']))
        {
            $email = trim($_POST['temail']);
            $pass = $_POST['tpassword'];

            $sql = "SELECT * FROM TRADER WHERE EMAIL = '$email' AND PASSWORD = '$pass' AND TRADER_VERIFICATION='1'";

            include "connect.php";

            $qry = oci_parse($conn, $sql);
            oci_execute($qry);

            $count = oci_fetch_all($qry, $res);     //returns 1 if user is in the table if not then returns 0.
            // echo "$count rows fetched<br>\n";
            oci_execute($qry);
            
            if($count == 1){
                while($row = oci_fetch_assoc($qry)){
                    $_SESSION['tid'] = $row['TRADER_ID'];
                    $_SESSION['tfullname'] = $row['FULL_NAME'];
                    $_SESSION['tphone'] = $row['PHONE_NUMBER'];
                    $_SESSION['temail'] = $row['EMAIL'];
                    $_SESSION['tdesc'] = $row['TRADER_DESC'];

                    $id= $_SESSION['tid'];
                    header ('location: trader_dashboard.php?id='.$id.'');
                    // echo "<a href='../logout.php'>LOGOUT</a>";
                }
                if(!empty($_POST['staySigned'])){
                    setcookie("tuser", $email, time() + (1 * 60 * 60), "/");
                    setcookie("tpassword", $pass, time() + (1 * 60 * 60), "/");
                }
                // stay signed in nathichepani set cookie ko lagi
                else{
                    setcookie("tuser", $email, time() - 3600, "/");
                    setcookie("tpassword", $pass, time() - 3600, "/");
                    // if (isset($_COOKIE["user"])) {
                    //     setcookie("user", "$user");
                    // }
                    // if (isset($_COOKIE["password"])) {
                    //     setcookie("password", "$pass");
                    // }
                }
            }
            else{
                $_SESSION['tierror'] = 'User not recognised or not verified!';
                // header ('location: sessions.php');
                header ('location: trader_signin.php');
            }
        }
        else
        {
            $_SESSION['tierror'] = 'Please fill all the fields!';
            header ('location: trader_signin.php');
        }
    }
?> 