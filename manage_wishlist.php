<?php
session_start();
// session_destroy();

if($_SERVER["REQUEST_METHOD"] == "POST")
{       
    if(isset($_SESSION['username']))
    {
        $c_id = $_SESSION['cid'];
    }
    else{
        $c_id = 0;
    }

    if(isset($_POST['addtowishlist']))
    {
        if(isset($_SESSION['wishlist']))
        {
            $myitems = array_column($_SESSION['wishlist'], 'product_name');
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
                $count = count($_SESSION['wishlist']);
                $_SESSION['wishlist'][$count] = array('product_id'=>$_POST['product_id'], 'product_image'=>$_POST['product_image'], 'product_name'=>$_POST['product_name'],'product_price'=>$_POST['product_price']);
                echo
                "
                <script>
                    alert('Product added to wishlist');
                    window.location.href = 'index.php';
                </script>
                ";

                // FOR INSERTING INTO wishlist TABLE
                $p_id = $_POST['product_id'];
                $p_name = $_POST['product_name'];

                include "connect.php";
                $qry = "INSERT INTO WISHLIST (PRODUCT_NAME, CUSTOMER_ID, PRODUCT_ID) VALUES ('$p_name', $c_id, $p_id)";

                $res = oci_parse($conn, $qry);
                oci_execute($res);
            }
        }
        else
        {
            $_SESSION['wishlist'][0] = array('product_id'=>$_POST['product_id'], 'product_image'=>$_POST['product_image'], 'product_name'=>$_POST['product_name'], 'product_price'=>$_POST['product_price']);
            echo
            "
            <script>
                alert('Product added to wishlist');
                window.location.href = 'index.php';
            </script>
            ";

            // FOR INSERTING INTO wishlist TABLE
            $p_id = $_POST['product_id'];
            $p_name = $_POST['product_name'];
            
            include "connect.php";
            $qry = "INSERT INTO WISHLIST (PRODUCT_NAME, CUSTOMER_ID, PRODUCT_ID) VALUES ('$p_name', $c_id, $p_id)";

            $res = oci_parse($conn, $qry);
            oci_execute($res);
        }
    }
    // TO DELETE ITEMS
    if(isset($_POST['delete']))
    {
        foreach($_SESSION['wishlist'] as $key => $value)
        {
            if($value['product_name']==$_POST['product_name'])
            {
                $p_name = $value['product_name'];

                unset($_SESSION['wishlist'][$key]);
                $_SESSION['wishlist'] = array_values($_SESSION['wishlist']);
                echo
                "
                    <script>
                        alert('Product Removed');
                        window.location.href = 'mywishlist.php';
                    </script>
                ";

                    // TO DELETE ITEMS FROM wishlist TABLE
                include "connect.php";
                $qry = "SELECT * FROM PRODUCT WHERE PRODUCT_NAME = '$p_name'";

                $res = oci_parse($conn, $qry);
                oci_execute($res);

                while($row = oci_fetch_assoc($res))
                {
                    $pro_id = $row['PRODUCT_ID'];

                    include "connect.php";
                    $qry1 = "SELECT * FROM WISHLIST WHERE PRODUCT_ID = $pro_id";

                    $res1 = oci_parse($conn, $qry1);
                    oci_execute($res1);

                    while($row = oci_fetch_assoc($res1))
                    {
                        $wishlist_id = $row['WISHLIST_ID'];

                        include "connect.php";
                        $qry2 = "DELETE FROM WISHLIST WHERE WISHLIST_ID = $wishlist_id";

                        $res2 = oci_parse($conn, $qry2);
                        oci_execute($res2);
                    }
                }
            }
        }
    }
    // FOR QUANTITY INCREMENT AND DECREMENT AUTO UPDATE

    // to clear wishlist
    if(isset($_POST['clearWishlist']))
    {
        unset($_SESSION['wishlist']);
        header('location: mywishlist.php');

        // DELETING ALL ROWS FROM wishlist TABLE WHEN CLEAR wishlist BUTTON IS PRESSED
        include "connect.php";
        $qry = "DELETE FROM WISHLIST";

        $res = oci_parse($conn, $qry);
        oci_execute($res);
    }
}   
?>