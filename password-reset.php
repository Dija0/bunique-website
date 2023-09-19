<?php
session_start();
include('dbcon.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

function  send_password_reset($get_username, $get_email,$token)
{
    $mail = new PHPMailer(true);
    // $mail->SMTPDebug = 2;
    $mail->isSMTP();
    $mail->SMTPAuth = true;

    $mail->Host = "smtp.gmail.com";
    $email->Username = "digiwebnex@gmail.com";
    $mail->Password = "***";//here too

    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setForm("digiwebnex@gmail.com",$get_username);
    $mail->addAddress($get_email);

    $mail->isHTML(true);
    $mail->Subject = 'Reset Password Notification';

    $email_template = "
    <h2>Hello</h2>
    <h3>You are receiving this email because we received a password reset request for your account.</h3>
    <br>
    <a href='http://localhost/fundaofwebit/register-login-with-verification/password-change.php?token=$token&email=$email'>Click me</a>
    ";

    $mail->$email_template;
    $mail->send();
}

if(isset($_POST['password_reset_link']))
{
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $token = md5(rand());

    $check_email = "SELECT email FROM bunique_table WHERE email= '$email' LIMIT";
    $check_email_run = mysqli_query($con,$check_email);

    if(mysqli_num_rows() > 0)
    {
        $row = mysqli_fetch_array($check_email_run);
        $get_name = $row['username'];
        $get_email = $row['email'];

        $update_token = "UPDATE bunique_table SET verify_token='$token' WHERE email='get_email' LIMIT 1";
        $update_token_run = mysqli_query($con, $update_token);

        if($update_token_run)
        {
            send_password_reset($get_username, $get_email,$token);
            $_SESSION['status'] = 'We emailed you a password reset link';
            header("Location: passwordrest.html");
            exit(0);
        }
        else
        {
            $_SESSION['status'] = 'Opps...Something went wrong. #1';
            header("Location: passwordrest.html");
            exit(0);
        }

    }
    else
    {
        $_SESSION['status'] = 'No Email Found';
        header("Location: passwordrest.html");
        exit(0);
    }
}
?>