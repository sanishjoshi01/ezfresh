<?php
    session_start();
    if(isset($_POST['clogin']))
    {
        if(!empty($_POST['username']) && !empty($_POST['password']))
        {
            $user = $_POST['username'];
            $pass = $_POST['password'];

            $sql = "SELECT * FROM CUSTOMER WHERE USERNAME = '$user' AND PASSWORD = '$pass'";

            include "../connect.php";

            $qry = oci_parse($conn, $sql);
            oci_execute($qry);

            $count = oci_fetch_all($qry, $res);     //returns 1 if user is in the table if not then returns 0.
            // echo "$count rows fetched<br>\n";
            oci_execute($qry);

            if($count == 1){
                while($row = oci_fetch_assoc($qry)){
                    $_SESSION['cid'] = $row['CUSTOMER_ID'];
                    $_SESSION['username'] = $row['USERNAME'];
                    $_SESSION['fname'] = $row['FIRST_NAME'];
                    $_SESSION['lname'] = $row['LAST_NAME'];
                    $_SESSION['email'] = $row['EMAIL'];
                    $_SESSION['gender'] = $row['GENDER'];
                    $_SESSION['address'] = $row['ADDRESS'];
                    $_SESSION['phone'] = $row['PHONE_NUMBER'];
                    header ('location: ../index.php');
                    // echo "<a href='../logout.php'>LOGOUT</a>";
                }
                if(!empty($_POST['staySigned'])){
                    setcookie("user", $user, time() + (1 * 60 * 60), "/");
                    setcookie("password", $pass, time() + (1 * 60 * 60), "/");
                }
                // stay signed in nathichepani set cookie ko lagi
                else{
                    setcookie("user", $user, time() - 3600, "/");
                    setcookie("password", $pass, time() - 3600, "/");
                    // if (isset($_COOKIE["user"])) {
                    //     setcookie("user", "$user");
                    // }
                    // if (isset($_COOKIE["password"])) {
                    //     setcookie("password", "$pass");
                    // }
                }
            }
            else{
                $_SESSION['cierror'] = 'User not recognised!';
                // header ('location: sessions.php');
                header ('location: ../signin_customer.php');
            }
        }
        else
        {
            $_SESSION['cierror'] = 'Please fill all the fields!';
            header ('location: ../signin_customer.php');
        }
    }
?> 