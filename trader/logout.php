<?php
    session_start();
    if(isset($_SESSION['tfullname']))
    {
        unset($_SESSION['tfullname']);
        session_destroy();
    }
    header("Location: trader_signin.php?msg=Successfully logged out");
?>