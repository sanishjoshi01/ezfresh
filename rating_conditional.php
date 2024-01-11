<?php
include "connect.php";
$sql3 = "SELECT Rating from review where  Product_Id = '$product_id' AND CUSTOMER_ID ='$c_id'";

$result3 = oci_parse($conn, $sql3);
oci_execute($result3);

while ($row3 = oci_fetch_assoc($result3)) {
	$rating = $row3['RATING'];

	// echo "$rating";
}
if ($rating == 1) {
	echo "<span style='color: #ffe234;'><i class='fa fa-star fa-lg'></i> <i class='far fa-star fa-lg'></i> <i class='far fa-star fa-lg'></i> <i class='far fa-star fa-lg'></i> <i class='far fa-star fa-lg'></i></span>";
} elseif ($rating == 2) {
	echo "<span style='color: #ffe234;'><i class='fa fa-star fa-lg'></i> <i class='fa fa-star fa-lg'></i> <i class='far fa-star fa-lg'></i> <i class='far fa-star fa-lg'></i> <i class='far fa-star fa-lg'></i></span>";
} elseif ($rating == 3) {
	echo "<span style='color: #ffe234;'><i class='fa fa-star fa-lg'></i> <i class='fa fa-star fa-lg'></i> <i class='fa fa-star fa-lg'></i> <i class='far fa-star fa-lg'></i> <i class='far fa-star fa-lg'></i></span>";
} elseif ($rating == 4) {
	echo "<span style='color: #ffe234;'><i class='fa fa-star fa-lg'></i> <i class='fa fa-star fa-lg'></i> <i class='fa fa-star fa-lg'></i> <i class='fa fa-star fa-lg'></i> <i class='far fa-star fa-lg'></i></span>";
} elseif ($rating == 5) {
	echo "<span style='color: #ffe234;'><i class='fa fa-star fa-lg'></i> <i class='fa fa-star fa-lg'></i> <i class='fa fa-star fa-lg'></i> <i class='fa fa-star fa-lg'></i> <i class='fa fa-star fa-lg'></i></span>";
} else {
	$rating = "No Rating Available";
	echo $rating;
}