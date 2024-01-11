<?php
    if(isset($_POST['updateReviewBtn']))
    {
        $rating = $_POST['rating'];
        $rev_desc = $_POST['desc'];
        $product_id = $_POST['product_id'];
        $c_id = $_POST['customer_id'];
    }

    include "connect.php";

    $upd = "UPDATE REVIEW SET RATING = '$rating', REVIEW_DESCRIPTION = '$rev_desc', REVIEW_DATE = SYSDATE WHERE PRODUCT_ID= $product_id AND CUSTOMER_ID = $c_id";
    $ress = oci_parse($conn, $upd);

    oci_execute($ress);

    if($ress)
    {
        echo"
        <script>
            alert('Review Updated!');
            window.location.href = 'customer_reviews.php?id=$c_id';
        </script>
        ";
    }
?>