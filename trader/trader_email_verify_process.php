<?php
session_start();
if (isset($_POST['emailVerify'])) {
    $email = $_POST['email'];
    $pincode = $_POST['code'];
    if (!empty($email) && !empty($pincode)) {

        include('connect.php');

        $sql = "SELECT * FROM TRADER WHERE EMAIL='$email' AND TRADER_VERIFICATION='$pincode'";
        $result = oci_parse($conn, $sql);
        oci_execute($result);

        // if($pincode == $_POST['code']){
        //     echo "VERFIED";
        // }

        $count = oci_fetch_all($result, $res);
        oci_execute($result);

        if ($count >= 1) {
            echo $count;

            include 'connect.php';
            $sql2 = "UPDATE TRADER set TRADER_VERIFICATION='0' where EMAIL = '$email' and TRADER_VERIFICATION='$pincode'";
            $qry = oci_parse($conn, $sql2);
            oci_execute($qry);
   
            header('Location: trader_signin.php?message=Email Successfully Verified');
            exit();
        } else {
            header('Location: trader_email_verify.php?msg=Invalid Email / Pin Code');
            exit();
        }
    } else {
        header('Location: trader_email_verify_process.php?msg=User not Registered!');
        exit();
    }
}
?>