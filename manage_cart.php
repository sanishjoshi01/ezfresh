<?php
session_start();
// session_destroy();

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(isset($_SESSION['username']))
    {
        $c_id = $_SESSION['cid'];

        if(isset($_POST['addtocart']))
        {
            $quan = $_POST['quantity'];
            if(isset($_SESSION['cart']))
            {
                $myitems = array_column($_SESSION['cart'], 'product_name');
                if(in_array($_POST['product_name'], $myitems))
                {
                    echo
                    "
                    <script>
                        alert('Product already added');
                        window.location.href = 'index.php';
                    </script>
                    ";
                }
                else
                {
                    $count = count($_SESSION['cart']);
                    $_SESSION['cart'][$count] = array('product_id'=>$_POST['product_id'], 'product_image'=>$_POST['product_image'], 'product_name'=>$_POST['product_name'],'product_price'=>$_POST['product_price'], 'quantity'=>$_POST['quantity']);
                    echo
                    "
                    <script>
                        alert('Product added to cart');
                        window.location.href = 'index.php';
                    </script>
                    ";

                    // FOR INSERTING INTO CART TABLE
                    $p_id = $_POST['product_id'];

                    include "connect.php";
                    $qry = "INSERT INTO CART (TOTAL_QUANTITY, CUSTOMER_ID, PRODUCT_ID) VALUES ($quan, $c_id, $p_id)";

                    $res = oci_parse($conn, $qry);
                    oci_execute($res);
                }
            }
            else
            {
                $_SESSION['cart'][0] = array('product_id'=>$_POST['product_id'], 'product_image'=>$_POST['product_image'], 'product_name'=>$_POST['product_name'], 'product_price'=>$_POST['product_price'], 'quantity'=>$_POST['quantity']);
                echo
                "
                <script>
                    alert('Product added to cart');
                    window.location.href = 'index.php';
                </script>
                ";

                // FOR INSERTING INTO CART TABLE
                $p_id = $_POST['product_id'];
                
                include "connect.php";
                $qry = "INSERT INTO CART (TOTAL_QUANTITY, CUSTOMER_ID, PRODUCT_ID) VALUES ($quan, $c_id, $p_id)";

                $res = oci_parse($conn, $qry);
                oci_execute($res);
            }
        }
        // TO DELETE ITEMS
        if(isset($_POST['delete']))
        {
            foreach($_SESSION['cart'] as $key => $value)
            {
                if($value['product_name']==$_POST['product_name'])
                {
                    $p_name = $value['product_name'];

                    unset($_SESSION['cart'][$key]);
                    $_SESSION['cart'] = array_values($_SESSION['cart']);
                    echo
                    "
                        <script>
                            alert('Product Removed');
                            window.location.href = 'mycart.php';
                        </script>
                    ";

                     // TO DELETE ITEMS FROM CART TABLE
                    include "connect.php";
                    $qry = "SELECT * FROM PRODUCT WHERE PRODUCT_NAME = '$p_name'";

                    $res = oci_parse($conn, $qry);
                    oci_execute($res);

                    while($row = oci_fetch_assoc($res))
                    {
                        $pro_id = $row['PRODUCT_ID'];

                        include "connect.php";
                        $qry1 = "SELECT * FROM CART WHERE PRODUCT_ID = $pro_id";

                        $res1 = oci_parse($conn, $qry1);
                        oci_execute($res1);

                        while($row = oci_fetch_assoc($res1))
                        {
                            $cart_id = $row['CART_ID'];

                            include "connect.php";
                            $qry2 = "DELETE FROM CART WHERE CART_ID = $cart_id";

                            $res2 = oci_parse($conn, $qry2);
                            oci_execute($res2);
                        }
                    }
                }
            }
        }

        // FOR QUANTITY INCREMENT AND DECREMENT AUTO UPDATE
        if(isset($_POST['Mod_Quantity']))
        {
            $u_quan = $_POST['Mod_Quantity'];
            $p_name = $_POST['product_name'];

            include "connect.php";
            $qry3 = "SELECT * FROM PRODUCT WHERE PRODUCT_NAME='$p_name'";

            $res3 = oci_parse($conn, $qry3);
            oci_execute($res3);

            while($r = oci_fetch_assoc($res3))
            {
                $p_id = $r['PRODUCT_ID'];
                foreach($_SESSION['cart'] as $key => $value)
                {
                    if($value['product_name']==$_POST['product_name'])
                    {
                        $_SESSION['cart'][$key]['quantity'] = $_POST['Mod_Quantity'];
                        // FOR INSERTING INTO CART TABLE
                        
                        include "connect.php";
                        $qry4 = "UPDATE CART SET TOTAL_QUANTITY = $u_quan WHERE CUSTOMER_ID = $c_id AND PRODUCT_ID = $p_id";
    
                        $res4 = oci_parse($conn, $qry4);
                        oci_execute($res4);

                        echo
                        "
                            <script>
                                window.location.href = 'mycart.php';
                            </script>
                        ";
                    }
                }
            }
        }
        // to clear cart
        if(isset($_POST['clearCart']))
        {
            unset($_SESSION['cart']);
            header('location: mycart.php');

            // DELETING ALL ROWS FROM CART TABLE WHEN CLEAR CART BUTTON IS PRESSED
            include "connect.php";
            $qry = "DELETE FROM CART";

            $res = oci_parse($conn, $qry);
            oci_execute($res);
        }
    }
    elseif(!isset($_SESSION['username']))
    {
        echo
        "
            <script>
                alert('Please sign in before adding to cart');
                window.location.href = 'signin_customer.php';
            </script>
        ";
    }
}   
?>