<?php 
    include "start.php"; 
    include "head.php";
?>
<!-- 
xl >= 1200
lg >= 992
md >= 768
sm >= 576 -->

<div class="container my-5">
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-xl-10 p-5">
            <form method="POST" action="Customer/customer_email_verify_process.php">
                <h4 class="text-center"><b>VERIFY EMAIL</b></h4>
				<div class="form-group py-3 px-5">
                    <label class="mb-2" for="email"><b>Email: </b></label>
                    <input type="text" class="form-control" placeholder="Enter your email here" name="email">
                </div>
                <div class="form-group py-3 px-5">
                    <label class="mb-2" for="code"><b>5-Digit Code: </b></label>
                    <input type="text" class="form-control" placeholder="Enter your code here" name="code">
                </div>
                <div class="form-group pb-3 text-center">
                    <button class="btn btn-success px-4" type="submit" name="emailVerify"><b>SUBMIT</b></button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include "main-footer.php";
include "end.php" ?>