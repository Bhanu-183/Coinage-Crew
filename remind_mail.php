<?php

    session_start();
    include('./db_conn.php'); 
    $user_id=$_SESSION['user_id'];

    $id =$_GET['id'];
    $q1 = "SELECT email FROM `users` WHERE user_id = '$user_id' ";
    $res1=$conn->query($q1);
    $row1=$res1->fetch_assoc();
    $from_email=$row1['email'];

    $q2 = "SELECT email FROM `users` WHERE user_id = '$id' ";
    $res2=$conn->query($q2);
    $row2=$res2->fetch_assoc();
    $to_email=$row2['email'];
    $msg="You have recieved a payment remainder from ".$from_email;
    use PHPMailer\PHPMailer\PHPMailer;

    require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/SMTP.php";
    require_once "PHPMailer/Exception.php";

    $mail = new PHPMailer();

    //smtp settings
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = "coinagecrew@gmail.com";
    $mail->Password = 'coinagecrew12345';
    $mail->Port = 465;
    $mail->SMTPSecure = "ssl";

    //email settings
    $mail->isHTML(true);
    $mail->setFrom("coinagecrew@gmail.com");
    $mail->addAddress($to_email);
    $mail->Subject = ("Payement Remainder");
    $mail->Body =$msg;

    if($mail->send()){
        ?>
            <script>
                alert('Request Sent');
                location.replace('./dashboard.php');
            </script>
            <?php
    }
    else
    {
        $status = "failed";
        $response = "Something is wrong: <br>" . $mail->ErrorInfo;
    }

    exit(json_encode(array("status" => $status, "response" => $response)));
?>