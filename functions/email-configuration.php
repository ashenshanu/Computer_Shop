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
        $mail->Username   = '22ug3-0083@sltc.ac.lk';              // SMTP username
        $mail->Password   = 'zxee wwfy vpwd wddf';                        // SMTP password   
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465;                                    // TCP port to connect to

        // Recipients
        $mail->setFrom('hello.mrpc@gmail.com', 'Mr.PC');
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