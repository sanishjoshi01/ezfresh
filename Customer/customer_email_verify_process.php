<?php
session_start();
if (isset($_POST['emailVerify'])) {
    $email = $_POST['email'];
    $pincode = $_POST['code'];
    if (!empty($email) && !empty($pincode)) {

        include('../connect.php');

        $sql = "SELECT * FROM CUSTOMER WHERE EMAIL='$email' AND EMAIL_VERIFY='$pincode'";
        $result = oci_parse($conn, $sql);
        oci_execute($result);

        // if($pincode == $_POST['code']){
        //     echo "VERFIED";
        // }

        $count = oci_fetch_all($result, $res);
        oci_execute($result);

        if ($count >= 1) {
            echo $count;

            include '../connect.php';
            $sql2 = "UPDATE CUSTOMER set EMAIL_VERIFY='0' where EMAIL = '$email' and EMAIL_VERIFY='$pincode'";
            $qry = oci_parse($conn, $sql2);
            oci_execute($qry);
   
            header('Location:../signin_customer.php?message=Email Successfully Verified');
            exit();
        } else {
            header('Location:../customer_email_verify.php?msg=Invalid Email / Pin Code');
            exit();
        }
    } else {
        header('Location:customer_email_verify_process.php?msg=User not Registered!');
        exit();
    }
}
?>