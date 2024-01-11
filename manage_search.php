<?php
$count = 0;
include "connect.php";

if(isset($_GET['searchtxt']))
{
    if(!empty($_GET['searchtxt']))
    {
        $searchtxt = $_GET['searchtxt'];
    
        $qry = "SELECT * FROM PRODUCT,SHOP WHERE (lower(PRODUCT_NAME) LIKE '%$searchtxt%' OR PRODUCT_NAME LIKE '%$searchtxt%' OR upper(PRODUCT_NAME) LIKE '%$searchtxt%') AND PRODUCT.SHOP_ID = SHOP.SHOP_ID AND PRODUCT_VERIFICATION='1' AND SHOP_VERIFICATION='1'";
    
        $result = oci_parse($conn, $qry);
        oci_execute($result);
    
        while($row = oci_fetch_assoc($result)) 
        {
            $product_id[$count] = $row['PRODUCT_ID'];
            $product_name[$count] = $row['PRODUCT_NAME'];
            $product_type[$count] = $row['PRODUCT_TYPE'];
            $product_desc[$count] = $row['PRODUCT_DESCRIPTION'];
            $product_price[$count] = $row['PRODUCT_PRICE'];
            $product_image[$count] = $row['PRODUCT_IMAGE'];
            $product_stock[$count] = $row['PRODUCT_STOCK'];
            $count = $count + 1;
        }
    }
}
if(isset($_POST['shopSubmit']))
{
    if(!empty($_POST['shops']))
    {
        $shopname = $_POST['shops'];
    
        $qry = "SELECT * FROM PRODUCT, SHOP WHERE PRODUCT.SHOP_ID = SHOP.SHOP_ID AND SHOP_NAME = '$shopname' AND PRODUCT_VERIFICATION='1' AND SHOP_VERIFICATION='1'";
    
        $result = oci_parse($conn, $qry);
        oci_execute($result);
        
        if($result)
        {
            while($row = oci_fetch_assoc($result)) 
            {
                $product_id[$count] = $row['PRODUCT_ID'];
                $product_name[$count] = $row['PRODUCT_NAME'];
                $product_type[$count] = $row['PRODUCT_TYPE'];
                $product_desc[$count] = $row['PRODUCT_DESCRIPTION'];
                $product_price[$count] = $row['PRODUCT_PRICE'];
                $product_image[$count] = $row['PRODUCT_IMAGE'];
                $product_stock[$count] = $row['PRODUCT_STOCK'];
                $count = $count + 1;
            }
        } 
    }
    else
    {
        echo 
        "
            <script>
                alert('Please select shop name');
                window.location.href = 'product_search.php?category=All';
            </script>
        ";
    }
}
if(isset($_POST['minmax']))
{
    if(!empty($_POST['min']) && !empty($_POST['max']))
    {
        $min = $_POST['min'];
        $max = $_POST['max'];
    
        $qry = "SELECT * FROM PRODUCT,SHOP WHERE SHOP.SHOP_ID = PRODUCT.SHOP_ID AND PRODUCT_PRICE BETWEEN $min AND $max AND PRODUCT_VERIFICATION='1' AND SHOP_VERIFICATION='1'";
    
        $result = oci_parse($conn, $qry);
        oci_execute($result);
    
        if($result)
        {
            while($row = oci_fetch_assoc($result))
            {
                $product_id[$count] = $row['PRODUCT_ID'];
                $product_name[$count] = $row['PRODUCT_NAME'];
                $product_type[$count] = $row['PRODUCT_TYPE'];
                $product_desc[$count] = $row['PRODUCT_DESCRIPTION'];
                $product_price[$count] = $row['PRODUCT_PRICE'];
                $product_image[$count] = $row['PRODUCT_IMAGE'];
                $product_stock[$count] = $row['PRODUCT_STOCK'];
                $count = $count + 1;
            }
        }
    }
    else
    {
        echo 
        "
            <script>
                alert('Please select price range!');
                window.location.href = 'product_search.php?category=All';
            </script>
        ";
    }
}
if(isset($_GET['category']))
{
    $category = $_GET['category'];

    include "connect.php";
    $qry = "SELECT * FROM PRODUCT,SHOP WHERE PRODUCT_TYPE = '$category' AND SHOP.SHOP_ID = PRODUCT.SHOP_ID AND PRODUCT_VERIFICATION='1' AND SHOP_VERIFICATION='1'";
    
    $result = oci_parse($conn, $qry);
    oci_execute($result);

    if($result)
    {
        while($row = oci_fetch_assoc($result))
        {
            $product_id[$count] = $row['PRODUCT_ID'];
            $product_name[$count] = $row['PRODUCT_NAME'];
            $product_type[$count] = $row['PRODUCT_TYPE'];
            $product_desc[$count] = $row['PRODUCT_DESCRIPTION'];
            $product_price[$count] = $row['PRODUCT_PRICE'];
            $product_image[$count] = $row['PRODUCT_IMAGE'];
            $product_stock[$count] = $row['PRODUCT_STOCK'];
            $count = $count + 1;
        }
    }
    if($_GET['category'] == 'All')
    {
        $qry1 = "SELECT * FROM PRODUCT,SHOP WHERE SHOP.SHOP_ID = PRODUCT.SHOP_ID AND PRODUCT_VERIFICATION='1' AND SHOP_VERIFICATION='1'";
        
        $result1 = oci_parse($conn, $qry1);
        oci_execute($result1);

        if($result1)
        {
            while($row = oci_fetch_assoc($result1))
            {
                $product_id[$count] = $row['PRODUCT_ID'];
                $product_name[$count] = $row['PRODUCT_NAME'];
                $product_type[$count] = $row['PRODUCT_TYPE'];
                $product_desc[$count] = $row['PRODUCT_DESCRIPTION'];
                $product_price[$count] = $row['PRODUCT_PRICE'];
                $product_image[$count] = $row['PRODUCT_IMAGE'];
                $product_stock[$count] = $row['PRODUCT_STOCK'];
                $count = $count + 1;
            }
        }
    }
}
?>
