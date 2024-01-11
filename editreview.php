<?php
    include "start.php";
    include "main-header.php";

    if(isset($_POST['editReviewBtn']))
    {
        $pimage = $_POST['product_image'];
        $pname = $_POST['product_name'];
        $revdesc = $_POST['review_desc'];
        $revdate = $_POST['review_date'];
        $product_id = $_POST['product_id'];
        $c_id = $_POST['customer_id'];
        $rating = $_POST['rating'];
    }
?>
<div class="container mt-4 p-3">
    <div class="row">
        <table class="table">
            <div class="h5"><strong>Edit Reviews</strong></div>
            <thead>
                <tr class="text-center">
                    <th colspan="1" scope="col">Product Details</th>
                    <th colspan="1" scope="col">Reviewed Date</th>
                    <th colspan="1"scope="col">Rating</th>
                    <th colspan="1" scope="col">Comments</th>
                    <th colspan="1" scope="col">Update</th>
                </tr>
            </thead>
            <tbody class='border'>
            <tr>
                <form action='updatereview.php' method='POST'>
                    <td class='text-center border border-groove'><img src='<?php echo $pimage ?>' style='width: 6vw' ><br><?php echo $pname ?></td>
                    <td class='text-center text-align-center'><?php echo $revdate ?></td>
                    <td class='text-center border border-groove'>
                        <?php include "rating_conditional.php"; ?><br><br>
                        Enter new rating here:
                        <br>   
                        <input class='w-50 text-center' type="number" min='1' max='5' placeholder="1 to 5" name="rating" required>
                    </td>
                    <td class='border border-groove'><textarea name="desc" style="width: 100%; padding: 5px; height: 7vw;"><?php echo $revdesc ?></textarea></td>
                    <td class='text-center'>
                        <input type='hidden' name='product_id' value='<?php echo $product_id ?>'>
                        <input type='hidden' name='customer_id' value='<?php echo $c_id ?>'>
                        <button class='btn btn-success' name='updateReviewBtn'>
                            Update
                        </button>
                    </td>
                </form>
            </tr>
            </tbody>
        </table>
    </div>
</div>
        
<?php
include "start.php";
include "main-footer.php";
?>