<?php
    include "start.php";
    include "main-header.php";
    // session_destroy();

    if(isset($_SESSION['username']))
    {
        include "connect.php";
        $user = $_SESSION['username'];

        $qry = "SELECT * FROM CUSTOMER WHERE USERNAME = '$user'";

        $res = oci_parse($conn, $qry);
        oci_execute($res);

        $row = oci_fetch_assoc($res);
        $cid = $row['CUSTOMER_ID'];
    }
    else{
        echo"
        <script>
            alert('Please login to view your cart');
            window.location.href = 'signin_customer.php';
        </script>
        ";
    }
?>

<div class="container">
    <div class="h2 text-center mt-3"><strong>MY CART</strong></div>
        
        <div class="row">
                <?php
                    include 'connect.php';
                    $qry = "SELECT * FROM CART";
                    $res = oci_parse($conn, $qry);
                    oci_execute($res);
                    
                    $numrows = oci_fetch_all($res, $res2);

                    if($numrows == 0)
                    {
                        echo "<div class='h3 mt-3 text-center'>
                            <img class='text-center mb-4' style='width: 16rem; height: 16rem;' src='images/icons/cart_empty.png'><br>
                            Your Cart is Currently Empty.<br>
                        </div>";
                    }
                ?>
            <div class="col-9">
                <table class="table mt-3">
                    <?php
                        if(isset($_SESSION['cart'])){
                            $countCart = count($_SESSION['cart']);
                            if($countCart > 0){
                                echo"
                                    <thead>
                                        <tr class='text-center'>
                                            <th colspan='1' scope='col'>Product Image</th>
                                            <th colspan='1' scope='col'>Product Name</th>
                                            <th colspan='1'scope='col'>Price</th>
                                            <th colspan='1' scope='col'>Quantity</th>
                                            <th colspan='1' scope='col'>Subtotal</th>
                                            <th colspan='1' scope='col'></th>
                                        </tr>
                                    </thead>
                                ";
                            }
                        }
                    ?>
                    <tbody class="border">
                        <?php
                            $total=0;
                    
                            if(isset($_SESSION['cart']))
                            {
                                foreach($_SESSION['cart'] as $key => $value)
                                {
                                    $total=$total+$value['product_price'];

                                    echo
                                    "
                                        <tr>
                                        <input type='hidden' name='product_id' value='$value[product_id]'>
                                        <input type='hidden' name='product_image' value='$value[product_image]'>
                                        <td class='text-center border border-groove'><img src='$value[product_image]' style='width: 8vw' ></td>
                                        <td class='text-center border border-groove align-middle'>$value[product_name]</td>
                                        <td class='text-center border border-groove align-middle'>
                                            $$value[product_price]<input type='hidden' class='iprice' value='$value[product_price]'>
                                        </td>
                                        <td class='text-center border border-groove align-middle'>
                                            <form action='manage_cart.php' method='POST'>
                                                <input type='number' name='Mod_Quantity' class='iquantity w-50 h-25 text-center' onchange='this.form.submit()' value='$value[quantity]' min='1' max='20'>
                                                <input type='hidden' name='product_name' value='$value[product_name]'>
                                            </form>
                                        </td>
                                        <td class='itotal text-center border border-groove align-middle'></td>
                                        <td class='text-center align-middle'>
                                            <form action='manage_cart.php' method='POST'>
                                                <button name='delete' class='btn btn-outline-danger'><i class='fa-regular fa-trash-can'></i></button>
                                                <input type='hidden' name='product_name' value='$value[product_name]'>
                                            </form>
                                        </td>
                                    ";
                                }
                            }
                        ?>
                    </tbody>
                </table>
                <!-- Clear Cart Button -->
                <?php
                    if(isset($_SESSION['cart'])){
                        $countCart = count($_SESSION['cart']);
                        if($countCart > 0){
                            echo "
                            <form action='manage_cart.php' method='POST' class='d-flex justify-content-end mb-5'>
                                <button type='submit' class='btn btn-info' name='clearCart' onclick=\"return confirm('Do you want to clear the cart?');\">Clear Cart</button>
                                <input type='hidden' name='product_id' value='$value[product_id]'>
                            </form>
                            ";
                        }
                    }
                ?>
            </div>

            <div class='col-3 mt-5'>
                <form method="POST" action="checkout.php">
                    <?php
                        if(isset($_SESSION['cart']) && !empty($_SESSION['cart']))
                        {
                            foreach($_SESSION['cart'] as $key => $value)
                            {
                            echo "
                                <input type='hidden' name='product_id' value='$value[product_id]'>
                                <input type='hidden' name='product_quantity' value='$value[quantity]'>
                                <input type='hidden' name='product_price' value='$value[product_price]'>
                                ";
                            }
                        }
                    ?>
                        <?php
                            if(isset($_SESSION['cart'])){
                                $countCart = count($_SESSION['cart']);
                                if($countCart > 0){
                                    echo "
                                    <div class='border bg-light rounded p-4 mt-2'>
                                        <h3 class='text-center'><strong>Details</strong></h3>
                                        <h5 class='mt-3'><b>Total Amount: </b><h6 id='gTotal'></h6></h5>
                                        <button class='btn btn-primary mt-3 w-100' name='checkout'>CHECKOUT</button>
                                    </div>

                                    ";
                                }
                            }
                        ?>
                </form>
            </div>
        </div>
</div>

<script>
    var gt=0;
    var iprice = document.getElementsByClassName('iprice');
    var iquantity = document.getElementsByClassName('iquantity');
    var itotal = document.getElementsByClassName('itotal');
    var gTotal = document.getElementById('gTotal');

    function subTotal()
    {
        gt=0;
        for(i=0; i < iquantity.length; i++)
        {
            itotal[i].innerText = "$" + (iprice[i].value)*(iquantity[i].value);
            gt = gt+((iprice[i].value)*(iquantity[i].value));
        }
        gTotal.innerText= "$" + gt;
    }
    subTotal();
</script>

<?php
    include "end.php";
    include "main-footer.php";
?>