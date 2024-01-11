<?php include('start.php'); ?>
<style>
    .info ul li a{
        text-decoration: none;
        color: white;
    }
    .fa-brands{
        color: white;
    }
    .fa-brands:hover{
        color: grey;
    }
    .info ul li a:hover{
        color: grey;
    }
    body{
        min-height:100vh;
    }
    #footer{
        position: sticky;
        top:100%;
        width: 100%;
        color: white;
        text-align: center;
        background-color: #394c55;
    }
</style>

<div id="footer" class="px-5 mt-4">
    <div class="follow d-flex justify-content-center py-2">
        <a href="#"><i class="fa-brands fa-facebook fa-lg m-4"></i></a>
        <a href="#"><i class="fa-brands fa-instagram fa-lg m-4"></i></a>
        <a href="#"><i class="fa-brands fa-twitter fa-lg m-4"></i></a>
    </div>

    <div class="info">
        <ul class="list-unstyled d-flex justify-content-around">
            <li><a href="about.php">About</a></li>
            <li>|</li>
            <li><a href="termsNcond.php">Terms & Conditions</a></li>
            <li>|</li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </div>
    <div class="content d-flex justify-content-center">
        <p>&copy; EZFRESH 2022. All Rights Reserved</p>
    </div>
</div>
<?php include('end.php'); ?>