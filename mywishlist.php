<?php
    include "start.php";
    include "main-header.php";
?>

<div class="container">
    <div class="h2 text-center mt-3"><strong>MY WISHLIST<i class="fa-regular fa-heart px-3 fa-md" title="Wishlist"></i></strong></div>

    <div class="row">
                <?php
                    if(isset($_SESSION['wishlist'])){
                        if(empty($_SESSION['wishlist'])){
                            echo "<div class='h3 text-center'>
                                <img class='text-center' style='width: 18rem; height: 18rem;' src='images/icons/wishlist_empty.png'><br>
                                Your Wishlist is Currently Empty!<br>
                                <h4 class='mt-2'>Add Favourite Products Now.</h4>
                            </div>";
                        }
                    }
                ?>
        <!-- <form method="POST" action="checkout.php"> -->
            <div class="col-12">
                <table class="table">
                    <?php
                        if(isset($_SESSION['wishlist'])){
                                    $countCart = count($_SESSION['wishlist']);
                                    if($countCart > 0){
                                        echo"<thead>
                                            <tr class='text-center'>
                                                <th colspan='1' scope='col'>Product Image</th>
                                                <th colspan='1' scope='col'>Product Name</th>
                                                <th colspan='1'scope='col'>Price</th>
                                                <th colspan='1' scope='col'>Remove</th>
                                                <th colspan='1' scope='col'>View Product</th>
                                            </tr>
                                        </thead>";
                                    }
                        }
                    ?>
                    <tbody class="border">
                        <?php
                            $total=0;
                        
                            if(isset($_SESSION['wishlist']))
                            {
                                foreach($_SESSION['wishlist'] as $key => $value)
                                {
                                    $total=$total+$value['product_price'];
                                    
                                    echo
                                    "
                                        <tr>
                                        <input type='hidden' name='product_id' value='$value[product_id]'>
                                        <td class='text-center border border-groove'><img src='$value[product_image]' style='width: 8vw' ></td>
                                        <td class='text-center border border-groove align-middle'>$value[product_name]</td>
                                        <td class='text-center border border-groove align-middle'>$$value[product_price]</td>
                                        <td class='text-center align-middle'>
                                            <form action='manage_wishlist.php' method='POST'>
                                                <button name='delete' class='btn btn-outline-danger'><i class='fa-regular fa-trash-can'></i></button>
                                                <input type='hidden' name='product_name' value='$value[product_name]'>
                                            </form>
                                        </td>
                                        </td>
                                        <td class='text-center align-middle'><a style='text-decoration: none; color: #179dfc;' href='productDetail.php?product_id=$value[product_id]'<i class='fas fa-eye fa-lg'></i>
                                    ";
                                }
                            }
                        ?>
                    </tbody>
                </table>
                <?php
                    if(isset($_SESSION['wishlist'])){
                        $countWishlist = count($_SESSION['wishlist']);
                        if($countWishlist > 0){
                            echo "
                            <form action='manage_wishlist.php' method='POST' class='d-flex justify-content-end'>
                                <button type='submit' class='btn btn-info' name='clearWishlist' onclick=\"return confirm('Do you want to clear the wishlist?');\">Clear Wishlist</button>
                                <input type='hidden' name='product_id' value='$value[product_id]'>
                            </form>
                            ";
                        }
                    }
                ?>
            </div>
    </div>
</div>

<?php
    include "end.php";
    include "main-footer.php";
?>