<?php
use PHPMailer\PHPMailer\PHPMailer;
        require_once "PHPMailer/PHPMailer.php";
        require_once "PHPMailer/SMTP.php";
        require_once "PHPMailer/Exception.php";

        $mail = new PHPMailer();

        //SMTP Settings
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "demoemailforproject@gmail.com"; //enter you email address
        $mail->Password = 'Demo@0012'; //enter you email password
        $mail->Port = 465;
        $mail->SMTPSecure = "ssl";

        //Email Settings
        $mail->isHTML(true);
        $mail->setFrom("demoemailforproject@gmail.com");
        $mail->addAddress("creativesiddharth.pbh@gmail.com"); //enter you email address
        $mail->Subject = ("verify");
        $mail->Body = "hello";

        if ($mail->send()) {
           echo "send";
        } else {
            echo "failed";
        }

        // exit(json_encode(array("status" => $status, "response" => $response)));
?>