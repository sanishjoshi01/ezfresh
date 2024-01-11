<?php
    include "start.php";
    include "main-header.php";
    // session_destroy();

    if (isset($_POST['check'])) {

        $taskoption = $_POST['taskoption'];
        $timeoption = $_POST['timeoption'];

        if (isset($_SESSION['collectionslot'])) {

            $_SESSION['collectionslot'][0] = array('task_option' => $_POST['taskoption'], 'time_option' => $_POST['timeoption']);

            echo " <script>
                    alert('Collection Slot added');
                    window.location.href='checkout.php?ok&taskoption=$taskoption&timeoption=$timeoption';
                </script>";
        } else {
            $_SESSION['collectionslot'][0] = array('task_option' => $_POST['taskoption'], 'time_option' => $_POST['timeoption']); // if no session of cart then set item deatils in 0 index, using aasociative aaray 

            $taskoption = $_POST['taskoption'];
            $timeoption = $_POST['timeoption'];
            echo " <script>
                    alert('Collection Slot Added');
                    window.location.href='checkout.php?ok&taskoption=$taskoption&timeoption=$timeoption';
                </script>";

            //print_r($_SESSION['collectionslot']);
            //echo "session xaina";
        }
    } else {
        //echo "check xaina";
    }
?>

<div class="container">
    <div class="h2 text-center mt-3">
        <strong>CHECKOUT</strong>
    </div>
    <form method="POST" action="checkout.php">
        <div class="row">
            <div class="col-md-12 col-lg-8 col-xl-9">
                <div class="h d-flex justify-content-between align-items-center">
                    <h4><b>Order Summary:</b></h4>
                    <a href="mycart.php" class="btn btn-outline-info"><b>EDIT CART</b></a>
                </div>
                <table class="table mt-3">
                    <thead>
                        <tr class="text-center">
                            <th colspan="1" scope="col">Product Image</th>
                            <th colspan="1" scope="col">Product Name</th>
                            <th colspan="1"scope="col">Price</th>
                            <th colspan="1" scope="col">Quantity</th>
                            <th colspan="1" scope="col">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="border">
                        <?php
                            $total=0;
                        
                            if(isset($_SESSION['cart']))
                            {
                                foreach($_SESSION['cart'] as $key => $value)
                                {
                                    $total=$total+$value['product_price'];

                                    $subtotal = $value['product_price'] * $value['quantity'];
                                    echo
                                    "
                                        <tr>
                                        <input type='hidden' name='product_id' value='$value[product_id]'>
                                        <input type='hidden' name='product_image' value='$value[product_image]'>
                                        <td class='text-center border border-groove'><img src='$value[product_image]' style='width: 6vw' ></td>
                                        <td class='text-center border border-groove align-middle'>$value[product_name]</td>
                                        <td class='text-center border border-groove align-middle'>
                                            $$value[product_price]
                                            <input type='hidden' class='iprice' value='$value[product_price]'>
                                        </td>
                                        <td class='text-center border border-groove align-middle'>
                                            $value[quantity]
                                            <input type='hidden' class='iquan' value='$value[quantity]'>
                                           
                                        </td>
                                        <td class='text-center border border-groove align-middle'>
                                            $$subtotal
                                            <input class='subtotal' type='hidden' value='$subtotal'>
                                        </td>
                                        ";
                                }
                            }
                                // foreach($_SESSION['cart'] as $key => $value)
                                // {
                                //     $pid = $_POST['product_id'];
                                //     $pq = $_POST['product_quantity'];
                                //     $pp = $_POST['product_price'];

                                //     $p = $pq * $pp;
                                // }
                        ?>
                    </tbody>
                </table>
            </div>
                <?php
                     date_default_timezone_set('Asia/Kathmandu');
                     $date = date("Y-m-d");
                     //$date = date("2021-07-01");
                     //echo $date;
                     $day = date("D", strtotime($date));
                     
                     switch ($day) {
                 
                         case "Sun":
                             $aa = strtotime($date . "+ 3 days");
                             $ba = strtotime($date . "+ 4 days");
                             $ca = strtotime($date . "+ 5 days");
                             break;
                 
                         case "Mon":
                             $aa = strtotime($date . "+ 2 days");
                             $ba = strtotime($date . "+ 3 days");
                             $ca = strtotime($date . "+ 4 days");
                             break;
                 
                         case "Tue":
                             $aa = strtotime($date . "+ 1 days");
                             $ba = strtotime($date . "+ 2 days");
                             $ca = strtotime($date . "+ 3 days");
                             break;
                 
                         case "Wed":
                             $aa = strtotime($date . "+ 1 days");
                             $ba = strtotime($date . "+ 2 days");
                             $ca = strtotime($date . "+ 7 days");
                             break;
                 
                         case "Thu":
                             $aa = strtotime($date . "+ 1 days");
                             $ba = strtotime($date . "+ 6 days");
                             $ca = strtotime($date . "+ 7 days");
                             break;
                 
                         case "Fri":
                             $aa = strtotime($date . "+ 5 days");
                             $ba = strtotime($date . "+ 6 days");
                             $ca = strtotime($date . "+ 7 days");
                             break;
                 
                         case "Sat":
                             $aa = strtotime($date . "+ 4 days");
                             $ba = strtotime($date . "+ 5 days");
                             $ca = strtotime($date . "+ 6 days");
                             break;
                     }
                     $x1 = date("D-m-d-Y", $aa);
                     $y2 = date("D-m-d-Y", $ba);
                     $z3 = date("D-m-d-Y", $ca);
                ?>
            <div class='col-md-12 col-lg-4 col-xl-3 mt-3'>
                <form>
                    <h4 style="opacity: 0">DETAILS: </h4>

                    <div class='border bg-light rounded p-4 my-5'>
                        <label><b>Choose your date & pickup time:</b></label>
                        <div class="py-2">
                            <label>Date: </label>
                            <select class="p-1 m-2" required name="taskoption">
                                <option value="<?php echo $x1 ?>" <?php echo (isset($_GET['taskoption']) && $_GET['taskoption'] == "$x1") ? 'selected="selected"' : ''; ?>><?php echo $x1 ?></option>
                                <option value="<?php echo $y2 ?>" <?php echo (isset($_GET['taskoption']) && $_GET['taskoption'] == "$y2") ? 'selected="selected"' : ''; ?>><?php echo $y2 ?></option>
                                <option value="<?php echo $z3 ?>" <?php echo (isset($_GET['taskoption']) && $_GET['taskoption'] == "$z3") ? 'selected="selected"' : ''; ?>><?php echo $z3 ?></option>
                            </select>
                            <label>Time: </label>
                            <select class="p-1 m-2" required name="timeoption">
                                <option value="10-13" <?php echo (isset($_GET['timeoption']) && $_GET['timeoption'] == "10-13") ? 'selected="selected"' : ''; ?>><?php echo "10-13" ?></option>
                                <option value="13-16" <?php echo (isset($_GET['timeoption']) && $_GET['timeoption'] == "13-16") ? 'selected="selected"' : ''; ?>><?php echo "13-16" ?></option>
                                <option value="16-19" <?php echo (isset($_GET['timeoption']) && $_GET['timeoption'] == "16-19") ? 'selected="selected"' : ''; ?>><?php echo "16-19" ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="border bg-light rounded p-4 my-3">
                        <h5 class='mt-3'><b>Grand Total: </b><h6 id='gTotal'></h6></h5>
                        <button class='btn btn-success mt-3 w-100' name="check">ADD COLLECTION SLOT</button>
                    </div>
                </form>
                <?php
                    //Set variables for paypal form
                    $paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr'; //always the same
                    //Test PayPal API URL
                    $paypal_email = 'ezfreshuk@gmail.com'; //merchant account -> gets the money in this account


                    $totall=0;  //cart ko price
                    include('connect.php');

                    $cid2 = $_SESSION['cid'];
                        
                    $sql20 = "SELECT * FROM CART WHERE CUSTOMER_ID = $cid2";
                    $result20 = oci_parse($conn, $sql20);
                    oci_execute($result20);
            
                    while ($row = oci_fetch_array($result20)) {
                        $cpid = $row['PRODUCT_ID'];  //cart ko product id
                        $cq = $row['TOTAL_QUANTITY']; //cart ko quantity
            
                        include('connect.php');
                
                        $sql21 = "SELECT * FROM PRODUCT WHERE PRODUCT_ID = $cpid";
                        $result21 = oci_parse($conn, $sql21);
                        oci_execute($result21);

                        while($row1 = oci_fetch_array($result21)) {
                            $pprice = $row1['PRODUCT_PRICE'];
                            $subtotal = $pprice * $cq;
                        }
                        $totall=$subtotal+$totall;
                    }
                ?>
                <form method="POST" action="<?php echo $paypal_url; ?>">
                    <!-- Paypal business test account email id so that you can collect the payments. -->
                    <input type="hidden" name="business" value="<?php echo $paypal_email; ?>">

                    <!-- Buy Now button. -->
                    <input type="hidden" name="cmd" value="_xclick">
                    <?php
                        $q2 = 0;
                        $p2 = 0;
                        $t2 = 0;

                        $i = 0;
                        foreach($_SESSION['cart'] as $key => $values)
                        {
                            $item_name = $values['product_name'];
                            $quantity = $values['quantity'];
                            $price = $values['product_price'];

                            $q2 = $values['quantity'];
                            $p2 = $values['product_price'];

                            $t2 = $q2 * $p2;
                            $i = $i + 1;

                            // echo "
                            //     <input type='hidden' name='item_name_$i' value='$q2 X $item_name'>
                            //     <input type='hidden' name='item_number_$i' value='$i'>
                            //     <input type='hidden' name='amount_$i' value='$totall'>
                            //     <input type='hidden' name='currency_code' value='USD'>	
                            // ";

                            echo "
                                <input type='hidden' name='item_name' value='$item_name'>
                            ";
                        }
                        echo "
                            <input type='hidden' name='amount' value='$totall'>
                            <input type='hidden' name='currency_code' value='USD'>
                            <input type='hidden' name='item_number' value='$i'>
                        ";
                    ?>
                    <!-- <input type='hidden' name='quantity' value=''> -->
                    <!-- URLs -->
                    <input type='hidden' name='cancel_return' value='http://localhost/ezfresh/cancel.php'>
                    <!--Change according to requirement-->

                    <input type='hidden' name='return' value='http://localhost/ezfresh/successfullCheckout.php'>
                    <div class="d-flex flex-column text-center">
                        <?php
                            if (isset($_GET['ok'])) {
                                echo " 
                                    <input type='image' name='submit' border='0' width='300px' height='60px' class='mb-4'
                                    src='images/icons/paypal.png' alt='Buy now with PayPal' alt='PayPal - The safer, easier way to pay online'>
                                    <img alt='' border='0' width='1' height='1' src='https://www.paypalobjects.com/en_US/i/scr/pixel.gif'>
                                ";
                            } else {
                                echo "
                                    <input style='opacity: 0.6; cursor: not-allowed;' width='300px' height='60px' type='image' name='submit' border='0' disabled src='images/icons/paypal.png' alt='Buy now with PayPal' alt='PayPal - The safer, easier way to pay online'>
                                    <img alt='' border='0' width='1' height='1' src='https://www.paypalobjects.com/en_US/i/scr/pixel.gif' > 
                                ";
                                echo "<br><span class='mb-4'>Please Choose Any Collection Slots Before Checking Out</span>";
                            }
                        ?>
                    </div>
                </form>
            </div>
		</div>
    </form>
</div>

<script>
    var gTotal = document.getElementById('gTotal');
    var iquan = document.getElementsByClassName('iquan');
    var iprice = document.getElementsByClassName('iprice');

    function gtotal()
    {
        gt = 0;
        for(i=0; i < iquan.length; i++)
        {
            gt = gt+((iprice[i].value)*(iquan[i].value));
        }
        gTotal.innerText= "$" + gt;
    }
    gtotal();

</script>

<?php
    include "end.php";
    include "main-footer.php";
?>