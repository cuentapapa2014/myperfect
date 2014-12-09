<?php

/**
 * Description of Correo
 *
 * @author MARTIN
 */
class Correo {

//put your code here
    static function correoMail($to = null, $subject = null, $message = null, $headers = null) {
        return mail($to, $subject, $message, $headers);
    }

    static function correoGmail($to, $from, $key, $subject, $message) {
        require'PHPMailerAutoload.php';
        $mail = new PHPMailer();
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";
        $mail->Username = $from;
        $mail->Password = $$key;
        $mail->Subject = $subject;
        $mail->MsgHTML($message);
        $mail->IsHTML(true);
        $mail->AddAddress($to);
        if (!$mail->Send()) {
            return $mail->ErrorInfo;
        } else {
            return true;
        }
    }

    static function correoHotmail($to, $from, $key, $subject, $message) {
        require'PHPMailerAutoload.php';
        $mail = new PHPMailer();
        $mail->Host = "smtp.live.com";
        $mail->Port = 25;
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Mailer = "smtp";
        $mail->Username = $from;
        $mail->Password = $key;
        $mail->Subject = $subject;
        $mail->MsgHTML($message);
        $mail->IsHTML(true);
        $mail->AddAddress($to);
        if (!$mail->Send()) {
            return $mail->ErrorInfo;
        } else {
            return true;
        }
    }

}
