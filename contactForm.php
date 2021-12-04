<?php

/*
// include required phpmailer files
    require 'phpmailer/include/PHPMailer.php';
    require 'phpmailer/include/SMTP.php';
    require 'phpmailer/include/Exception.php';
 *//*

// Define name spaces
    use PHPMailer\PHPMailer\PHPMailer;
 *//*
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
 *//*
$msg = '';
if (array_key_exists('customer_email', $_POST){
     date_default_timezone_set('Etc/UTC');

     require 'vendor/autoload.php';
// Create instanceof phpmailer
    $mail = new PHPMailer();

// Set mailer to use smtp
    mail->isSMTP();

    $mail->SMTPDebug = 2;
    $mail->Debugoutpu = 'html';
// define smtp host
    $mail->Host = "smtp.hostinger.com";
// enable smtp authentication
    $mail->AMTPAuth = "true";
// set type of encryption (ssl/tls)
    $mail->SMTPSecure = "tls";
// set prt to connect smtp
    $mail->Port = "587";
// set email username
    $mail->Username = 'services@centicon.com.au';
// set email password
    $mail->Password = '';
// set email subject
   // $mail->Subject = "Test email using PHPMailer";
//Set sender email
    $mail->setFrom('services@centicon.com.au', 'Centicon');
// Email body
    //$mail->Body = "This is plain text email body";
// Add recipient
    $mail->addAddress('roah.egl@gmail.com', 'Roah');

    if ($mail->addReplyTo($_POST['customer_email'], $_POST['customer_name'])) {
            $mail->Subject = 'Contact form submission';
            $mail->isHTML(false);
            $mail->Body = <<<EOT
    Email: {$_POST['customer_email']}
    Name: {$_POST['customer_name']}
    Company: {$_POST['customer_company']}
    Phone: {$_POST['customer_phone']}
    Message: {$_POST['customer_message']}
    EOT;
            if (!$mail->send()) {
                $msg = 'Sorry, something went wrong. Please try again later.';
            } else {
                $msg = 'Message sent! Thanks for contacting us.';
            }
        } else {
            $msg = 'Share it with us!';
        }

    *//*  // Finally send email

    // Closing smtp connection
    $mail->smtpClose(); *//*
}
header("Location: index.html"); */

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/autoload.php';
    require 'src/Exception.php';
    require 'src/PHPMailer.php';
    require 'src/SMTP.php';
    require 'index.html';

    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = 0;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.hostinger.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'services@centicon.com.au';                 // SMTP username
            $mail->Password = 'Cen&ticon@Services21';                           // SMTP password
            $mail->SMTPSecure = 'tsl';                           // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('services@centicon.com.au');
            $mail->addAddress($_POST['customer_email']);     // Add a recipient



            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $_POST['customer_company'];
            $mail->Body    = $_POST['customer_message'];

            $mail->send();
            echo 'Message has been sent';
            header('Location: index.html');
            exit();
        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
?>





























