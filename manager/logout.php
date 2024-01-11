<?php
    session_start();
    if(isset($_SESSION['a_username']))
    {
        unset($_SESSION['a_username']);
        session_destroy();
    }
    header("Location: admin_login.php?msg=Successfully logged out");
?>