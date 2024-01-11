<?php
session_start();
$rand1 = 11111;
$rand2 = 99999;
$random_number =  rand($rand1, $rand2);

if(isset($_POST['signup'])){
    
    if (!empty($_POST['c_username']) && !empty($_POST['c_firstName']) && !empty($_POST['c_lastName']) && !empty($_POST['c_email']) && !empty($_POST['gender']) && !empty($_POST['c_address']) && !empty($_POST['c_phoneNumber']) && !empty($_POST['c_password'])) {

        if (empty($_POST['acceptPT'])) {
            $_SESSION['cuerror'] = "Please Agree our Privacy Policy and Terms & Conditions.</br>";
            header('Location:../signup_customer.php?c_username='.$_POST['c_username'].'&c_firstName='.$_POST['c_firstName'].'&c_lastName='.$_POST['c_lastName'].'&c_email='.$_POST['c_email'].'&gender='.$_POST['gender'].'&c_address='.$_POST['c_address'].'&c_phoneNumber='.$_POST['c_phoneNumber']);
        }else {

            $password = $_POST['c_password'];
            $c_password = $_POST['c_confirmPassword'];

            if($password == $c_password){
                
                $pattern = "/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,20}$/";
                $password = $_POST['c_password'];

                if (preg_match($pattern, $password)) {
                    $fpassword = $password;
                    $username = $_POST['c_username'];
                    $fname= $_POST['c_firstName'];
                    $lname = $_POST['c_lastName'];
                    $email = $_POST['c_email'];
                    $gender = $_POST['gender'];
                    $address = $_POST['c_address'];
                    $phone = $_POST['c_phoneNumber'];

                    include ('../connect.php');

                    $sql = "INSERT INTO CUSTOMER(USERNAME, FIRST_NAME, LAST_NAME, EMAIL, GENDER, ADDRESS, PHONE_NUMBER, PASSWORD, PROFILE_PICTURE, EMAIL_VERIFY) VALUES ('$username', '$fname', '$lname', '$email', '$gender', '$address', '$phone', '$fpassword', ' ', $random_number)";
    
                    $qry = oci_parse($conn, $sql);
                    oci_execute($qry);
    
                    if($qry){
                        // echo "REGISTERED";
                        $to = $email;
                        $subject = 'Verify your email address!';
                        $message = 'Your 5-Digit OTP Verification Code is : ' . $random_number . '';
                        $headers = "From: sandeshjoshi2211@gmail.com\r\nReply-To: sandeshjoshi2211@gmail.com";
                        $mail_sent = mail($to, $subject, $message, $headers);

                        if ($mail_sent == true)
                        {
                            echo "<script>
                                alert('Check your Email for 5-Digit OTP Code');
                            </script>";
                        } 
                        else
                        {
                            echo "<script>
                                alert('Mail Failed');
                            </script>";
                        }
                        header('Location: ../customer_email_verify.php?Mail Sent');
                    }
                    else{
                        echo "There is an error try again!";
                    }
                }
                else{
                    $_SESSION['cuerror'] = "Password must include at least one capital letter, a number, a symbol and greater than 8 digit <br/>";
                    header('Location:../signup_customer.php?c_username='.$_POST['c_username'].'&c_firstName='.$_POST['c_firstName'].'&c_lastName='.$_POST['c_lastName'].'&c_email='.$_POST['c_email'].'&gender='.$_POST['gender'].'&c_address='.$_POST['c_address'].'&c_phoneNumber='.$_POST['c_phoneNumber']);
                }
            }
            else{
                $_SESSION['cuerror'] = "Passwords do not match <br/>";
                header('Location:../signup_customer.php?c_username='.$_POST['c_username'].'&c_firstName='.$_POST['c_firstName'].'&c_lastName='.$_POST['c_lastName'].'&c_email='.$_POST['c_email'].'&gender='.$_POST['gender'].'&c_address='.$_POST['c_address'].'&c_phoneNumber='.$_POST['c_phoneNumber']);
            }
        }
    }
    else{
        $_SESSION['cuerror'] = "Please fill up all the fields<br/>";
        header('Location:../signup_customer.php?c_username='.$_POST['c_username'].'&c_firstName='.$_POST['c_firstName'].'&c_lastName='.$_POST['c_lastName'].'&c_email='.$_POST['c_email'].'&gender='.$_POST['gender'].'&c_address='.$_POST['c_address'].'&c_phoneNumber='.$_POST['c_phoneNumber']);
    }
}
?>