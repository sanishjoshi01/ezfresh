<?php
if (isset($_POST['submit']) && isset($_POST['sid'])) {

    $sh_id = $_POST['sid'];

    include 'connect.php';

    $sql = "UPDATE SHOP SET SHOP_VERIFICATION='1' WHERE SHOP_ID='$sh_id' ";
    $qry = oci_parse($conn, $sql);
    oci_execute($qry);

    if ($qry) {
        header('Location:admin_shop.php?shops=All Shops&msg=Shop Activated');
    } 
    // else {
    //     header('Location:admin_product.php?msg=Product Disabled');
    // }
} elseif (isset($_POST['submit1']) && isset($_POST['sid'])) {

    $sh_id = $_POST['sid'];

    include 'connect.php';
    $sql = "UPDATE SHOP SET SHOP_VERIFICATION='0' WHERE SHOP_ID='$sh_id' ";
    $qry = oci_parse($conn, $sql);
    oci_execute($qry);

    if ($qry) {
        header('Location:admin_shop.php?shops=All Shops&msg=Shop Disabled');
    } 
    // else {
    //     header('Location:admin_product.php?msg=Not Approved');
    // }
} else {
    echo "Location:admin_shop.php?msg=Form Not Submitted";
}
