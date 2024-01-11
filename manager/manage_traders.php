<?php
if (isset($_POST['submit']) && isset($_POST['tid'])) {

    $tr_id = $_POST['tid'];

    include 'connect.php';

    $sql = "UPDATE TRADER SET TRADER_VERIFICATION='1' where TRADER_ID='$tr_id' ";
    $qry = oci_parse($conn, $sql);
    oci_execute($qry);

    if ($qry) {
        header('Location:admin_trader.php');
    } 
    // else {
    //     header('Location:admin_product.php?msg=Product Disabled');
    // }
} elseif (isset($_POST['submit1']) && isset($_POST['tid'])) {

    $tr_id = $_POST['tid'];

    include 'connect.php';
    $sql = " UPDATE TRADER SET TRADER_VERIFICATION='0' where TRADER_ID='$tr_id' ";
    $qry = oci_parse($conn, $sql);
    oci_execute($qry);

    if ($qry) {
        header('Location:admin_trader.php');
    } 
    // else {
    //     header('Location:admin_product.php?msg=Not Approved');
    // }
} else {
    echo "Location:admin_trader.php?msg=Form Not Submitted";
}
