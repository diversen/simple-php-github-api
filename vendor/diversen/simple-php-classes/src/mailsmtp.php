<?php

namespace diversen;
/**
 * simple wrapper of PHPMailer. 
 * just loads most basic settings from config.php 
 * and returns a PHPMailer object
 * 
<code>

$mail = mailsmtp::getPHPMailer();
$mail->addAddress('dennis.iversen@gmail.com');
$mail->addAttachment('composer.json');
$mail->Subject = 'ÆØÅ test Here is a subject';
$mail->Body    = 'And now with danish signs! This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}

</code>
 * 
 */
class mailsmtp {

    
    /**
     * returns a PHPHMailer object with settings from config.php
     * @return \PHPMailer
     */
    public static function getPHPMailer () {
        $config = config::get('smtp');

        $mail = new \PHPMailer;
        $mail->SMTPDebug = $config['SMTPDebug'];
        $mail->isSMTP();
        $mail->Host = $config['Host'];
        $mail->SMTPAuth = $config['SMTPAuth'];
        $mail->Username = $config['Username'];
        $mail->Password = $config['Password'];
        $mail->SMTPSecure = $config['SMTPSecure'];
        $mail->Port = $config['Port'];
        $mail->CharSet = $config['CharSet'];
        $mail->From = $config['From'];
        $mail->FromName = $config['FromName'];
        $mail->isHTML(true);    
        return $mail;
    }
    
    /**
     * mail using smtp 
     * @param string $to
     * @param string $subject
     * @param string $html
     * @param string $text
     * @param array $attachments filenames
     * @return boolean
     */
    public static function mail ($to, $subject, $html, $text, $attachments = array()) {
        $mail = self::getPHPMailer();
        
        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->Body    = $html;
        $mail->AltBody = $text;
        
        foreach ($attachments as $val) {
            $mail->addAttachment($val);
        }
        
        if(!$mail->send()) {
            log::error($mail->ErrorInfo);
            return false;
        } else {
            return true;
        }
    }
}
