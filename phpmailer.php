<?php

    session_start();
    include('./db_conn.php'); 
    $user_id=$_SESSION['user_id'];

    $owner_id =$_GET['owner_id'];
    $q1 = "SELECT email FROM `users` WHERE id = '$user_id' ";
    

use PHPMailer\PHPMailer\PHPMailer;

// if(isset($_POST['name']) && isset($_POST['email'])){
    // $name = $_POST['name'];
    // $email = $_POST['email'];
    // $subject = $_POST['subject'];
    // $body = $_POST['body'];

    require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/SMTP.php";
    require_once "PHPMailer/Exception.php";

    $mail = new PHPMailer();

    //smtp settings
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = "coinagecrewgmail.com";
    $mail->Password = 'coinagecrew12345';
    $mail->Port = 465;
    $mail->SMTPSecure = "ssl";

    //email settings
    $mail->isHTML(true);
    $mail->setFrom("rohith2019@iiitkottayam.ac.in");
    $mail->addAddress("bhanukrishna2019@iiitkottayam.ac.in");
    $mail->Subject = ("testing");
    $mail->Body = "test mail";

    if($mail->send()){
        $status = "success";
        $response = "Email is sent!";
    }
    else
    {
        $status = "failed";
        $response = "Something is wrong: <br>" . $mail->ErrorInfo;
    }

    exit(json_encode(array("status" => $status, "response" => $response)));


?>