<?php
session_start();
$rand1 = 00000;
$rand2 = 99999;
$random_number =  rand($rand1, $rand2);

if(isset($_POST['t_signup'])){
    
    if (!empty($_POST['t_fullName']) && !empty($_POST['t_email']) && !empty($_POST['t_phoneNumber']) && !empty($_POST['t_sudesc']) && !empty($_POST['t_password']) && !empty($_POST['t_confirmPassword'])) {

        if (empty($_POST['acceptPT'])) {
            $_SESSION['tuerror'] = "Please Agree our Privacy Policy and Terms & Conditions.</br>";
            header('Location: trader_signup.php?t_fullName='.$_POST['t_fullName'].'&t_email='.$_POST['t_email'].'&t_phoneNumber='.$_POST['t_phoneNumber'].'&t_sudesc='.$_POST['t_sudesc'].'&t_password='.$_POST['t_password']);
        }else {

            $password = $_POST['t_password'];
            $c_password = $_POST['t_confirmPassword'];

            if($password == $c_password){
                
                $pattern = "/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,20}$/";
                $password = $_POST['t_password'];

                if (preg_match($pattern, $password)) {
                    $fpassword = $password;
                    $t_fullName = $_POST['t_fullName'];
                    $t_email= $_POST['t_email'];
                    $t_phoneNumber = $_POST['t_phoneNumber'];
                    $t_sudesc = $_POST['t_sudesc'];

                    include ('connect.php');

                    $sql = "INSERT INTO TRADER(FULL_NAME, EMAIL, PHONE_NUMBER, TRADER_DESC, PASSWORD, PROFILE_PICTURE, TRADER_VERIFICATION) VALUES ('$t_fullName', '$t_email', '$t_phoneNumber', '$t_sudesc', '$fpassword', '', $random_number)";
                    
                    $qry = oci_parse($conn, $sql);
                    oci_execute($qry);
    
                    if($qry){
                        // echo "REGISTERED";
                        $to = $t_email;
                        $subject = 'Trader Email Verification!';
                        $message = 'Your 5-Digit OTP Verification Code is : ' . $random_number . '';
                        $headers = "From: sandeshjoshi2211@gmail.com\r\nReply-To: sandeshjoshi2211@gmail.com";
                        $mail_sent = mail($to, $subject, $message, $headers);

                        if ($mail_sent == true)
                        {
                            echo "<script>
                                alert('Check your Email for 5-Digit OTP Code!');
                            </script>";
                        } 
                        else
                        {
                            echo "<script>
                                alert('Mail Failed!!! Try again.');
                            </script>";
                        }
                        header('Location: trader_email_verify.php?Mail Sent');
                    }
                    else{
                        echo "There is an error try again!";
                    }
                }
                else{
                    $_SESSION['tuerror'] = "Password must include at least one capital letter, a number, a symbol and greater than 8 digit <br/>";
                    header('Location: trader_signup.php?t_fullName='.$_POST['t_fullName'].'&t_email='.$_POST['t_email'].'&t_phoneNumber='.$_POST['t_phoneNumber'].'&t_sudesc='.$_POST['t_sudesc'].'&t_password='.$_POST['t_password']);
                }
            }
            else{
                $_SESSION['tuerror'] = "Passwords do not match <br/>";
                header('Location: trader_signup.php?t_fullName='.$_POST['t_fullName'].'&t_email='.$_POST['t_email'].'&t_phoneNumber='.$_POST['t_phoneNumber'].'&t_sudesc='.$_POST['t_sudesc'].'&t_password='.$_POST['t_password']);
            }
        }
    }
    else{
        $_SESSION['tuerror'] = "Please fill up all the fields<br/>";
        header('Location: trader_signup.php?t_fullName='.$_POST['t_fullName'].'&t_email='.$_POST['t_email'].'&t_phoneNumber='.$_POST['t_phoneNumber'].'&t_sudesc='.$_POST['t_sudesc'].'&t_password='.$_POST['t_password']);
    }
}
?>