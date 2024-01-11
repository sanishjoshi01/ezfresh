<?php
    session_start();
    if(isset($_SESSION['username']))
    {
        unset($_SESSION['username']);
        unset($_SESSION['cart']);

        if(!isset($_SESSION['cart']))
        {
            $qry = "DELETE FROM CART";
            include "connect.php";

            $result = oci_parse($conn, $qry);
            oci_execute($result);
        }
        session_destroy();
    }
    header("Location: signin_customer.php?msg=Successfully logged out");
?>