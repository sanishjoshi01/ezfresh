<?php
    include "start.php";
    include "main-header.php";
    include "manage_search.php";
?>
<style>
    #productDetails{
        text-decoration: none;
    }
    .card:hover #add {
        opacity: 1;
        transition: .5s;
    }
    #productDetails img:hover{
        transform: scale(1.09);
        transition: .5s;
    }
    @media(max-width: 992px)
    {
        *{
            font-size: x-small;
        }   
    }
</style>

<div class="container">
    <div class="row">
        <div class=" col-lg-3">
            <h5 class="mt-3 text-center">SORT BY</h5>

            <div class="row m-1">
                <div class="mb-3 p-3 border border-dark">
                    <div class="h5 pt-2">Price</div>
                    <div class="text-align-center">
                        <form action="product_search.php" method="POST">
                            <input class="mb-2" type="text" placeholder="Min" name="min"/> 
                            <input  class="mb-2" type="text" placeholder="Max" name="max"/><br>
                            <button class="btn btn-success" name="minmax">GO</button>
                        </form>
                    </div>
                </div>
                <form class="border border-dark p-3" method="POST" action="product_search.php">
                    <div class="h5 pt-2">Shops</div>

                    <?php
                        include "connect.php";
                        $qr2 ="SELECT * FROM SHOP WHERE SHOP_VERIFICATION='1'";
                        $re2 = oci_parse($conn, $qr2);
                        oci_execute($re2);

                        $cn = 0;

                        while($ro2 = oci_fetch_assoc($re2))
                        {
                            $shop_id = $ro2['SHOP_ID'];
                            $shop_name = $ro2['SHOP_NAME'];
                            $cn = $cn+1;
                            echo"
                                <div class='form-check'>
                                    <input type='radio' class='form-check-input' name='shops' id='shop$cn' value='$shop_name'/>
                                    <label for='shop$cn' class='form-check-label'>$shop_name</label>
                                </div>
                            ";
                        }
                    ?>
                    <button class="btn btn-success mt-2" type="submit" name="shopSubmit">GO</button>
                </form>
            </div>
        </div>

        <div class=" col-lg-9">
            <div class="container border border-dark mt-5 mb-2">
                <div class="row p-3">
                    <h6><b>
                    <?php
                        echo $count;
                    ?></b>
                    result found for <b><?php  if(isset($_GET['searchtxt']))
                                             {
                                                 echo "'".$_GET['searchtxt']."'";
                                             } 
                                             if(isset($_POST['shopSubmit']))
                                             {
                                                echo "'". $shopname ."'";
                                             }
                                             if(isset($_POST['minmax']))
                                             {
                                                echo "$". $min ." - $". $max ." price range";
                                             }
                                             if(isset($_GET['category']))
                                             {
                                                echo "'".$_GET['category']."'";
                                             }
                                             ?></b>
                    </h6>
                </div>
            </div>

            <div class="container border border-dark mb-3">
                <div class="row p-3">
                    <div class='row d-flex justify-content-around my-4'>
                            <?php 
                            if(empty($_GET['searchtxt']) && empty($_POST['shops']) && empty($_POST['min']) && empty($_POST['max']) && empty($_GET['category']))
                                {
                                    echo "No results";
                                }
                            ?>
                    <?php
                      
                        for($counter = 0; $counter < $count; $counter++)
                        {
                            echo
                            "
                                    <div class='card border-0' style='width: 10rem; border border-dark'>
                                        <a id='productDetails' href='productDetail.php?product_id=$product_id[$counter]'>
                                            <img style='width: 8rem; height: 8rem;' class='card-img-top border shadow p-3' src='$product_image[$counter]' alt='Card image cap'>

                                            <div class='card-body text-center'>
                                                <h5 class='card-title'><strong>$product_name[$counter]</strong></h5>
                                                <h5 class='card-title'>$$product_price[$counter]</h5>
                                            </div>
                                        </a>
                                    </div>
                            ";
                        }
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    include "end.php";
    include "main-footer.php";
?>