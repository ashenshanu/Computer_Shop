<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

function send_email($to, $subject, $body) {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->SMTPDebug = 0;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'shashishajanith0@gmail.com';              // SMTP username  hello.sanakin@gmail.com shashishajanith0@gmail.com
        $mail->Password   = 'izmq yzhn kyin bprx';                        // SMTP password   izmq yzhn kyin bprx     uoic buun jzxp vufe
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465;                                    // TCP port to connect to

        // Recipients
        $mail->setFrom('hello.sanakin@gmail.com', 'Sanakin.lk');
        $mail->addAddress($to, 'User');     // Add a recipient

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $body;

        return $mail->send();
    
    } catch (Exception $e) {
        return false;
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    } finally{
        
    // echo "consol.log'".$to."' '".$subject."' '".$body."'";
    }
}

?>