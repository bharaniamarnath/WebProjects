<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\OAuth;
    use League\OAuth2\Client\Provider\Google;
    
    
    require_once 'vendor/autoload.php';
    require_once 'class-db.php';

    class sendMail{
        public function __construct($sendEmail, $sendName, $sendSubject, $sendBody, $sendFile){
            //Create a new PHPMailer instance
            $mail = new PHPMailer();
            //Comment below line if PHPMailer doesn't send email in live server
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 465;
             
            //Set the encryption mechanism to use:
            // - SMTPS (implicit TLS on port 465) or
            // - STARTTLS (explicit TLS on port 587)
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
             
            $mail->SMTPAuth = true;
            $mail->AuthType = 'XOAUTH2';
             
            $email = 'YOUR_GOOGLE_EMAIL_ID'; // the email used to register google app
            $clientId = 'YOUR_GOOGLE_OAUTH_API_ID';
            $clientSecret = 'YOUR_GOOGLE_OAUTH_API_ID_SECRET_KEY';
             
            $db = new DB();
            $refreshToken = $db->get_refresh_token();
             
            //Create a new OAuth2 provider instance
            $provider = new Google(
                [
                    'clientId' => $clientId,
                    'clientSecret' => $clientSecret,
                ]
            );
             
            //Pass the OAuth provider instance to PHPMailer
            $mail->setOAuth(
                new OAuth(
                    [
                        'provider' => $provider,
                        'clientId' => $clientId,
                        'clientSecret' => $clientSecret,
                        'refreshToken' => $refreshToken,
                        'userName' => $email,
                    ]
                )
            );
             
            $mail->setFrom($sendEmail, $sendName);
            $mail->addAddress($sendEmail, $sendName);
            $mail->isHTML(true);
            $mail->Subject = $sendSubject;

            //$mail->AddEmbeddedImage('./assets/images/filename.png', 'some_unique_id');

            $mail->addAttachment($sendFile);

            //Replace the plain text body with one created manually
            $mail->Body = $sendBody;
             
            //send the message, check for errors
            if (!$mail->send()) {
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo 'Message sent!';
            }
        }
    }
?>