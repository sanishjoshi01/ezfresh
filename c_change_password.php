<?php
    session_start();

    if(isset($_GET['id']))
    {
        $id = $_GET['id'];

        if(isset($_POST['changePassword']))
        {
            if(!empty($_POST['currentPassword']) && !empty($_POST['newPassword']) && !empty($_POST['renewPassword']))
            {
                $oldpass = $_POST['currentPassword'];
                $newpass = $_POST['newPassword'];
                $repass = $_POST['renewPassword'];

                include "connect.php";

                $sql1 = "SELECT * FROM CUSTOMER WHERE CUSTOMER_ID=$id";

                $qry = oci_parse($conn, $sql1);
                oci_execute($qry);

                while($r = oci_fetch_assoc($qry))
                {
                    $pass = $r['PASSWORD'];

                    if($oldpass == $pass)
                    {
                        if($oldpass != $newpass)
                        {
                            if($newpass == $repass)
                            {
                                $pattern = "/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,20}$/";
                                $newpass = $_POST['newPassword'];
        
                                if (preg_match($pattern, $newpass)) {
                                    $f_password = $newpass;
                                    // $username = $_POST['c_username'];
                                    // $fname= $_POST['c_firstName'];
                                    // $lname = $_POST['c_lastName'];
                                    // $email = $_POST['c_email'];
                                    // $gender = $_POST['gender'];
                                    // $address = $_POST['c_address'];
                                    // $phone = $_POST['c_phoneNumber'];
                
                                    include ('connect.php');
                
                                    $sql = "UPDATE CUSTOMER SET PASSWORD = '$f_password' WHERE CUSTOMER_ID=$id";
                    
                                    $qry = oci_parse($conn, $sql);
                                    oci_execute($qry);
                                    if($qry)
                                    {
                                        echo"
                                            <script>
                                                alert('Password Changed Succesfully');
                                                window.location.href = 'logout.php';
                                            </script>
                                        ";
                                    }   
                                }
                                else
                                {
                                    $_SESSION['errorchangePassword'] = "Password must include at least one capital letter, a number, a symbol and greater than 8 digit!<br/>";
                                    header('Location:../signup_customer.php');
                                }
                            }
                            else
                            {
                                $_SESSION['errorchangePassword'] = "New password and Confirm New password doesn't match!<br/>";
                                header('location: customer_change_password.php');
                            }
                        }
                        elseif($oldpass == $newpass || $oldpass == $repass)
                        {
                            $_SESSION['errorchangePassword'] = "Old password and new password cannot be same!<br/>";
                            header('location: customer_change_password.php');
                        }
                    }
                    else
                    {
                        $_SESSION['errorchangePassword'] = "Wrong Old Password!<br/>";
                        header('location: customer_change_password.php');
                    }
                }
            }
            else{
                $_SESSION['errorchangePassword'] = "Please fill all the fields!<br/>";
                header('location: customer_change_password.php');
            }
        }
    }
?>