<?php include('start.php');
include('main-header.php'); 

error_reporting(0);
ini_set('display_errors', 0);
?>

<!-- CHECKOUT SUCCESFUL -->

<?php
    include "connect.php";
    $un = $_SESSION['username'];

	$sqla= "SELECT EMAIL FROM CUSTOMER WHERE USERNAME = '$un'";

	$resulta = oci_parse($conn, $sqla);
	oci_execute($resulta);

	while ($row = oci_fetch_assoc($resulta)) {
		$cemail = $row['EMAIL'];
	}
    // echo "$cemail";
	
    $to_email = "$cemail";
    $subject = "Your order has been received!";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: <sandeshjoshi2211@gmail.com>' . "\r\n";

    if(isset($_GET['PayerID'])) {
        $payerid = $_GET['PayerID'];
    }

    if (!isset($_SESSION['username'])) {
        header('Location:signin_customer.php');
    }
    foreach ($_SESSION['collectionslot'] as $key => $value) {
        $taskoption = $value['task_option'];
        $timeoption = $value['time_option'];
    }

    include "connect.php";

    $un = $_SESSION['username'];
    $sqlb = "SELECT CUSTOMER_ID FROM CUSTOMER WHERE USERNAME = '$un'";

    $resultb = oci_parse($conn, $sqlb);
    oci_execute($resultb);

    while($row = oci_fetch_array($resultb))
    {
        $cid = $row['CUSTOMER_ID'];
        // echo $cid . " ";
        include "connect.php";
        $sqlc = "SELECT MAX(ORDER_ID) as ORDER_ID FROM ORDERS";
        $resultc = oci_parse($conn, $sqlc);
        oci_execute($resultc);

        while ($row = oci_fetch_array($resultc)) {
            $maxid = $row['ORDER_ID'];
        }
        // echo $maxid;

        include "connect.php";

        $sqld = " SELECT * FROM CART WHERE CUSTOMER_ID = $cid";
        $resultd = oci_parse($conn, $sqld);
        oci_execute($resultd);

        while($row = oci_fetch_array($resultd)) 
        {
            $ctid = $row['CART_ID'];
            $pid = $row['PRODUCT_ID'];
            $quantity = $row['TOTAL_QUANTITY'];
            // echo "Cart ID " . $ctid . " ";
            // echo "Payer ID " .$payerid."";
            // echo $pid;
            // echo $quantity;
            include "connect.php";

            $sqle = " SELECT PRODUCT_PRICE, PRODUCT_STOCK FROM PRODUCT WHERE PRODUCT_ID = $pid";
            $resulte = oci_parse($conn, $sqle);
            oci_execute($resulte);

            while ($row = oci_fetch_array($resulte)) {
                $productprice = $row['PRODUCT_PRICE'];
                $productstock = $row['PRODUCT_STOCK'];
                // echo "Product Price " . $productprice . " ";
                // echo "Product Price " . $productstock . " ";

                $gt = $quantity * $productprice; //8
                include "connect.php";

                $sqlf = "INSERT INTO ORDERS(ORDER_DATE, QUANTITY, ORDER_PRICE, CUSTOMER_ID, PRODUCT_ID, DELIVERY_STATUS) VALUES (SYSDATE, $quantity, $gt, $cid, $pid, 0)";

                $resultf = oci_parse($conn, $sqlf);
                oci_execute($resultf);

                if($resultf)
                {
                    unset($_SESSION['cart']);
                    $remquantity = $productstock - $quantity;
                    include "connect.php";

                    // updating product stock after purchase is done
                    $sqlg = "UPDATE PRODUCT SET PRODUCT_STOCK = $remquantity WHERE PRODUCT_ID= $pid";
                    $resultg = oci_parse($conn, $sqlg);
                    oci_execute($resultg);

                    if($resultg)
                    {
                        include "connect.php";

                        $sqlh = "SELECT CART_ID FROM CART WHERE CUSTOMER_ID= $cid";
                        $resulth = oci_parse($conn, $sqlh);
                        oci_execute($resulth);

                        while($row = oci_fetch_array($resulth)) 
                        {
                            $cartid = $row['CART_ID'];
                            include "connect.php";
                            
                            // deleting from cart after purchase is done
                            $sqli = "DELETE FROM CART WHERE CART_ID = $cartid";
                            $resulti = oci_parse($conn, $sqli);
                            oci_execute($resulti);
                        }
                    }
                }
                else{
                    echo "
                        <script>
                            alert('Order Not Placed');
                            window.location.href='checkout.php';
                        </script>
                        ";
                }
            }
        }

        include "connect.php";
        $sql7 = "SELECT * FROM ORDERS WHERE DELIVERY_STATUS=0 AND CUSTOMER_ID='$cid' AND ORDER_DATE=SYSDATE AND ORDER_ID>'$maxid'";
        $result7 = oci_parse($conn, $sql7);
        oci_execute($result7);

        while($row = oci_fetch_assoc($result7)) {
            $oid = $row['ORDER_ID'];
            $oprice = $row['ORDER_PRICE']; //total order price
            // echo $oprice;
            include "connect.php";
            $sql10 = "INSERT INTO COLLECTION_SLOT(COLLECTION_SLOT_DATE, COLLECTION_SLOT_TIME, ORDER_ID, CUSTOMER_ID) VALUES ('$taskoption','$timeoption', $oid, $cid)";
            
            $result10 = oci_parse($conn, $sql10);
            oci_execute($result10);

            include "connect.php";
            $sql11 = "INSERT INTO PAYMENT(PAYMENT_ID, PAYMENT_TYPE, TOTAL_PAYMENT, CUSTOMER_ID, ORDER_ID) VALUES ('$payerid', 'Paypal', $oprice, $cid, $oid)";
            $result11 = oci_parse($conn, $sql11);
            oci_execute($result11);
        }
    }

    include "connect.php";
    $sql15="SELECT * FROM ORDERS INNER JOIN CUSTOMER ON 
    ORDERS.CUSTOMER_ID = CUSTOMER.CUSTOMER_ID INNER JOIN PRODUCT ON ORDERS.PRODUCT_ID = PRODUCT.PRODUCT_ID INNER JOIN SHOP ON PRODUCT.SHOP_ID = SHOP.SHOP_ID INNER JOIN TRADER ON TRADER.TRADER_ID = SHOP.TRADER_ID AND ORDERS.CUSTOMER_ID= $cid AND ORDERS.DELIVERY_STATUS = 0 AND ORDER_ID > $maxid";

    $qry15 = oci_parse($conn, $sql15);
    oci_execute($qry15);

    $s = 0;
    $gt1 = 0;

    $count = oci_fetch_all($qry15, $connss);
    oci_execute($qry15);

    if($count > 0){
            while($row=oci_fetch_assoc($qry15)){
				include "connect.php";
                    $oid = $row['ORDER_ID'];
                    $cname1 = $row['FIRST_NAME'];
                    $cnamelast = $row['LAST_NAME'];
                    $address1 = $row['ADDRESS'];
                    $email1 = $row['EMAIL'];
                    $odate1 = $row['ORDER_DATE'];
        
                    $oprice1 = $row['ORDER_PRICE'];
                    $gt1 = $oprice1 + $gt1;

                    $tname = $row['FULL_NAME'];
                    $sname = $row['SHOP_NAME'];
                    $taddress = $row['SHOP_LOCATION'];
                    // echo "$oid";
            }
		
			include "connect.php";
            $sql20="SELECT * FROM ORDERS INNER JOIN CUSTOMER ON 
			ORDERS.CUSTOMER_ID = CUSTOMER.CUSTOMER_ID INNER JOIN PRODUCT ON ORDERS.PRODUCT_ID = PRODUCT.PRODUCT_ID AND ORDERS.CUSTOMER_ID='$cid' AND ORDERS.DELIVERY_STATUS=0  AND ORDER_ID>'$maxid'";
			$qry20=oci_parse($conn, $sql20);
			oci_execute($qry20);
		
            $message =
            '
            <html>
                <body style="color: #000; font-size: 15px; text-decoration: none; font-family: "ABeeZee", sans-serif; background-color: #efefef; margin: 100px;">
                    <div id="wrapper" style=" max-width: 1100px; margin: auto auto; padding: 20px;">
                        <div id="logo">
                            <center>
                                <h1 style="margin: 0px;">
                                    <a href="http://localhost/ezfresh/index.php" target="_blank">
                                        <img style="max-height: 75px;" src="https://user-images.githubusercontent.com/66363471/169642857-433f7252-c424-4b2c-9298-86749cef2298.png" >
                                    </a>
                                </h1>
                            </center>
                        </div>
            
                        <div style="font-size: 48px; font-weight: bold; color:white; background-color:#4287f5; letter-spacing: 4px; text-align: center;">
                            INVOICE
                        </div>
            
                        <div id="content" style="justify-content:center; font-size: 15px; padding: 25px; background-color: #fff;">
                            <div style="float: right;">   
                                <p>INVOICE NO:<b> '.$payerid.'</b></p>
                                <p>INVOICE DATE:<b> '.$odate1.'</b></p>
                                <p>ORDER DATE:<b> '.$odate1.'</b></p>
                            </div>
                            
                            <div style="display: block;">                
                                <p>Billed To: </p>
                                <p>Customer Name:<b> '.$cname1.' '.$cnamelast.'</b></p>
                                <p>Customer Address:<b> '.$address1.'</b></p>
                            </div>
                                        <br>
                            <div style="display: block;">           
                                <p>Sold By: </p>
                                <p>Trader Name:<b> '.$tname.'</b></p>
                                <p>Shop Name:<b> '.$sname.'</b></p>
                                <p>Address:<b> '.$taddress.'</b></p>
                                <p>Seller Email:<b> '.$email1.'</b></p>
                            </div>
                                        <br>
                            <div style="display: block;">                
                                <p>Payed With:<b> PayPal</b></p>
                            </div>
            
                            <table style="width:100%; border: 1px solid #000000; border-collapse: collapse;">
                                <tr style="text-align: center;">
                                    <th style="border-right-style: groove;">SN</th>
                                    <th style="border-right-style: groove;">Product ID</th>
                                    <th style="border-right-style: groove;">Product Name</th>
                                    <th style="border-right-style: groove;">Product Description</th>
                                    <th style="border-right-style: groove;">Qty</th>
                                    <th style="border-right-style: groove;">Unit Cost</th>
                                    <th style="border-right-style: groove;">Total Price</th>
                                </tr>
                ';

                include 'connect.php';
                    
                while($row=oci_fetch_assoc($qry20)){
                    
                    include 'connect.php';
                    $s = $s + 1;
                    $cnamea = $row['FIRST_NAME'];
                    $cnameb = $row['LAST_NAME'];
                    $cname2 = $cnamea ." ".$cnameb;

                    $message .=
                    '
                                    <tr style="text-align: center; border-bottom-style: solid;">
                                        <td style="border-right-style: groove;">'.$s.'</td>
                                        <td style="border-right-style: groove;">'.$row['PRODUCT_ID'].'</td>
                                        <td style="border-right-style: groove;">'.$row['PRODUCT_NAME'].'</td>
                                        <td style="text-align: left !important; width: 50%; border-right-style: groove;">'.$row['PRODUCT_DESCRIPTION'].'</td>
                                        <td style="border-right-style: groove;">'.$row['QUANTITY'].'</td>
                                        <td style="border-right-style: groove;">$'.$row['PRODUCT_PRICE'].'</td>
                                        <td style="border-right-style: groove;">$'.$row['ORDER_PRICE'].'</td>
                                    </tr>
                    ';
                }
                $message .=
                '
                            </table>
                            <div style="text-align:right;">
                                <h4>Grand Total: $'.$gt1.'</h4>
                            </div>
                        </div>
                    </div>
                </body>
            </html>
            ';
            $message .= 'Dear: '.$cname2.'! Thank you for your recent purchase. We here at EZFRESH are grateful for your patronage and look forward to serving you in the future. Thank you for shopping with us!<br>';
    }
    else{
        echo "order number must be greater than 0";
    }

    if($gt > 0){
        if (mail($to_email, $subject, $message, $headers)) {
            echo "<div class='col-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 d-flex align-items-center justify-content-center mt-3 h4'>Email Successfully Sent to $to_email...</div>";
        } else {
            echo "Email sending failed...";
        }
    }
    else{
        header('Location:index.php');
        //echo "Plz order";
    }
?>

			<?php
			include('connect.php');
			$un = $_SESSION['username'];
			$sql1 = " SELECT CUSTOMER_ID FROM CUSTOMER WHERE USERNAME = '$un'";

			$result1 = oci_parse($conn, $sql1);
			oci_execute($result1);

			while ($row = oci_fetch_array($result1)) {

				$cid = $row['CUSTOMER_ID'];
                include "connect.php";

				$sql7 = "SELECT ORDER_ID FROM ORDERS WHERE CUSTOMER_ID= $cid and DELIVERY_STATUS !=1";
				$result7 = oci_parse($conn, $sql7);
				oci_execute($result7);

				while ($row = oci_fetch_array($result7)) {
					$orderid = $row['ORDER_ID'];
					//echo "<div class='h4'>Your order number is $orderid </div>";
				}
			}
			?>
		<?php
		if (isset($_GET['PayerID'])) {
			$payerid = $_GET['PayerID'];
			echo " 
            <div class='container'>
	            <div class='row text-center my-5 p-3' style='border: 0.1vw solid black;'>
		            <div class='col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-3'>
                        <div class='col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12'>
                            <div class='h1 mb-3'>Thank you for your Purchase!</div>
                        </div>
                        <div class='col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12'>
                            <div class='h4 mt-4'>Your invoice number is <b>$payerid</b>.</div>
                            <div class='h4 mt-4'>You can pick up the item in <b>$taskoption</b> Time:<b> $timeoption</b>.</div>
                        </div>
                        <div class='col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12'>
                            <div class='row'>
                                <div class='h4 my-4'><i class='fa-solid fa-envelope fa-lg'></i> An email has been sent including your order details.</div>
                            </div>
                            <a href='index.php' id='button' class='btn btn-lg btn-outline-success'>CONTINUE SHOPPING</a>
                        </div>
                    </div>
                </div>
            </div>
				";
		}
        else {
			echo "There was some issue while checking out";
		}
		?>

<?php include('main-footer.php');
include('end.php'); ?>