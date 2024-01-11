<?php
     include "../start.php";
     include "t_header.php";
    //  error_reporting(0);

    if(isset($_GET['id']))
    {
        $tid = $_GET['id'];
    }
?>
<div class="container">
    <div class="h4 text-center">REVIEWS</div>
    <div class="d-flex justify-content-center">
        <div class="col-12 border border-dark-light bg-light p-5 mt-4">
            <table class="table mt-3">
                <thead>
                    <tr class='text-center'>
                        <th>Product Details</th>
                        <th>Customer Details</th>
                    </tr>
                </thead>
                <div class='d-flex justify-content-between align-items-center'>
                    <div style='font-size: 1.3vw;'>
                        <b>All Reviews</b>
                    </div>
                </div>
                <tbody class="border">
                    <?php
                        if(isset($_GET['id']))
                        {
                            $tid = $_GET['id'];

                            include "connect.php";
                            $sql = "SELECT * FROM SHOP WHERE TRADER_ID='$tid'";
                            $res = oci_parse($conn, $sql);
                            oci_execute($res);

                            while($r = oci_fetch_assoc($res))
                            {
                                $shop_id = $r['SHOP_ID'];

                                include "connect.php";
                                $sql2 = "SELECT * FROM PRODUCT WHERE SHOP_ID=$shop_id";
                                $res2 = oci_parse($conn, $sql2);
                                oci_execute($res2);

                                while($r2 = oci_fetch_assoc($res2))
                                {
                                    $product_id = $r2['PRODUCT_ID'];
                                    $p_name = $r2['PRODUCT_NAME'];
                                    $p_image = $r2['PRODUCT_IMAGE'];
                                    
                                    $imgPath ='../';

                                    $f_img= $imgPath.$p_image;

                                    // echo $p_name;
                                    include "connect.php";
                                    $sql3 = "SELECT * FROM REVIEW WHERE PRODUCT_ID=$product_id";
                                    $res3 = oci_parse($conn, $sql3);
                                    oci_execute($res3);

                                    while($r3 = oci_fetch_assoc($res3))
                                    {
                                        $r_id = $r3['REVIEW_ID'];
                                        $rating = $r3['RATING'];
                                        $r_desc = $r3['REVIEW_DESCRIPTION'];
                                        $r_date = $r3['REVIEW_DATE'];
                                        $c_id = $r3['CUSTOMER_ID'];

                                        include "connect.php";
                                        $sql4 = "SELECT * FROM CUSTOMER WHERE CUSTOMER_ID=$c_id";
                                        $res4 = oci_parse($conn, $sql4);
                                        oci_execute($res4);

                                        $r4 = oci_fetch_assoc($res4);
                                        $c_pp = $r4['PROFILE_PICTURE'];
                                        $c_fname = $r4['FIRST_NAME'];
                                        $c_lname = $r4['LAST_NAME'];

                                        $c_ppPath = '../';
                                        $f_cpp = $c_ppPath.$c_pp;


                                        $c_fullname = $c_fname.' '.$c_lname;

                                        echo
                                        "
                                        <tr>
                                            <td class='col-4 h4 text-center border border-groove p-3'>
                                                <img src='$f_img' style='width:7vw'><br>$p_name
                                            </td>
                                            <td class='col-8 text-center border border-groove align-middle p-3'>
                                                <div class='h3 mt-1 d-flex align-items-center'>
                                                    <img style='width: 4rem; height: 4rem;' class='img-fluid border rounded-circle shadow' src='$f_cpp'>&nbsp;&nbsp;$c_fname $c_lname
                                                </div>
                                                <div class='h5 mt-3 d-flex align-items-center'>
                                                ";
                                                            include "../rating_conditional.php";
                                        echo"
                                                    &nbsp;&nbsp;<b> $r_date</b>
                                                </div>
                                                <div class='h5 mt-4 d-flex align-items-center'>
                                                        $r_desc
                                                </div>
                                            </td>
                                        </tr>
                                        ";
                                    }
                                }
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
    include "../main-footer.php";
    include "../end.php";
?>