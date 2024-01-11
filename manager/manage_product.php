<?php
if (isset($_POST['submit']) && isset($_POST['pid'])) {

    $pid = $_POST['pid'];

    include 'connect.php';

    $sql = "UPDATE PRODUCT SET PRODUCT_VERIFICATION='1' where PRODUCT_ID='$pid' ";
    $qry = oci_parse($conn, $sql);
    oci_execute($qry);

    if ($qry) {
        header('Location:admin_product.php?traders=All Traders&msg=Product Enabled');
    }
    // else {
    //     header('Location:admin_product.php?msg=Product Disabled');
    // }
} elseif (isset($_POST['submit1']) && isset($_POST['pid'])) {

    $pid = $_POST['pid'];

    include 'connect.php';
    $sql = " UPDATE PRODUCT SET PRODUCT_VERIFICATION='0' where PRODUCT_ID='$pid' ";
    $qry = oci_parse($conn, $sql);
    oci_execute($qry);

    if ($qry) {
        header('Location:admin_product.php?traders=All Traders&msg=Product Disabled');
    }
    // else {
    //     header('Location:admin_product.php?msg=Not Approved');
    // }
} else {
    echo "Location:admin_product.php?msg=Form Not Submitted";
}