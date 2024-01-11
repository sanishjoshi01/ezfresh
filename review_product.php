<?php
session_start();

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    include 'connect.php';
}

if (isset($_POST['review'])) {

    $un = $_SESSION['username'];
    // echo $un;

    include 'connect.php';
    $qr = "SELECT * FROM CUSTOMER WHERE USERNAME ='$un'";

    $re = oci_parse($conn, $qr);
    oci_execute($re);

    $r = oci_fetch_assoc($re);
    $cid = $r['CUSTOMER_ID'];
    // echo $cid;
    
    include 'connect.php';

    $rating = $_POST['rating'];
    $description = $_POST['description'];

    $sql1 = "INSERT INTO REVIEW(RATING, REVIEW_DESCRIPTION, CUSTOMER_ID, PRODUCT_ID, REVIEW_DATE) VALUES ('$rating', '$description', '$cid','$product_id', SYSDATE)";

    $result1 = oci_parse($conn, $sql1);
    oci_execute($result1);

    if ($result1) {
        echo"
        <script>
            alert('Your review has been submitted!');
            window.location.href = 'productDetail.php?product_id=$product_id';
        </script>
        ";
    } else {           
        echo"
        <script>
            alert('There was an error performing the action!');
            window.location.href = 'productDetail.php?product_id=$product_id';
        </script>
        ";
    }
} else {
    echo "";
}

?>