<?php
/*
    if (isset($_POST['submit'])){
        $email_centicon = 'services@centicon.com.au';

        $customer_name = $_POST['customer_name'];
        $customer_email = $_POST['customer_email'];
        $customer_company = $_POST['customer_company'];
        $customer_phone = $_POST['customer_phone'];
        $customer_message = $_POST['customer_message'];

        $email_subject = "New Customer Message";
        $subject = "Confirmation: Your enquiries have been submitted successfully."

        $email_body = "Customer name: " . $customer_name . "\n"
         ."Customer email: ". $customer_email . "\n"
         ."Company: " . $customer_company . "\n"
         ."Customer phone: " . $customer_phone . "\n\n"
         ."Message: " . $customer_message . "\n";

        $message = "Dear" .$customer_name. "\n"
        . "Thank you for contacting us. We will get back to you shortly!" . "\n\n"
        . "Your enquiry: " . "\n" .$_POST['customer_message'] . "\n\n"
        . "Regards," . "\n" . "Centicon building and construction services";

        $headers = "From: " . $customer_email;
        $to = "To: " . $email_centicon;

        $resEmail1 = mail($to, $email_subject, $email_body, $headers);
        $resEmail2 = mail($customer_email, $subject, $message, $to); // confirmation email to client

        header("Location: index.html"); exit;

        if ($resEmail1){
            echo '<script type="text/javascript">Your Message was sent successfully!</script>';
            header("Location: index.html"); exit;
        } else {
            echo '<script type="text/javascript"> Alert! Message was not sent, Please try again. </script>';
            header("Location: index.html"); exit;
        }
        header("Location: index.html"); exit;
    }
    header("Location: index.html"); exit; */

/**
 * This example shows how to handle a simple contact form safely.
 */

//Import PHPMailer class into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$msg = '';
//Don't run this unless we're handling a form submission
if (array_key_exists('customer_email', $_POST)) {
    date_default_timezone_set('Etc/UTC');

    require 'vendor/autoload.php';
    require 'index.html';


    //Create a new PHPMailer instance
    $mail = new PHPMailer();
    //Send using SMTP to localhost (faster and safer than using mail()) – requires a local mail server
    //See other examples for how to use a remote server such as gmail
    $mail->isSMTP();
    $mail->Host = 'smtp.hostinger.com';
    $mail->Port = 587;-

    $mail->SMTPAuth = true;
    $mail->Username = 'services@centicon.com.au';
    $mail->Password = '';

    $mail->setFrom('services@centicon.com.au', 'Centicon');
    //Choose who the message should be sent to
    //You don't have to use a <select> like in this example, you can simply use a fixed address
    //the important thing is *not* to trust an email address submitted from the form directly,
    //as an attacker can substitute their own and try to use your form to send spam
    // Add recipient
    $mail->addAddress('info@centicon.com.au', 'Centicon');
    $mail->addAddress($_POST['customer_email'], $_POST['customer_name']);
    //Put the submitter's address in a reply-to header
    //This will fail if the address provided is invalid,
    //in which case we should ignore the whole request
    if ($mail->addReplyTo('services@centicon.com.au', 'Centicon')) {
        $mail->Subject = 'Website contact form';
        //Keep it simple - don't use HTML
        $mail->isHTML(false);
        //Build a simple message body
        $mail->Body = <<<EOT
Dear {$_POST['customer_name']}
Thank you for contacting us, we will get back to you shortly!

Submitted details:
Email: {$_POST['customer_email']}
Company: {$_POST['customer_company']}
Phone: {$_POST['customer_phone']}
Message: {$_POST['customer_message']}
EOT;
        //Send the message, check for errors
        if (!$mail->send()) {
            //The reason for failing to send will be in $mail->ErrorInfo
            //but it's unsafe to display errors directly to users - process the error, log it on your server.
            $msg = 'Sorry, something went wrong. Please try again later.';
            echo $msg;
            header('Location: index.html');
        } else {
            $msg = 'Message sent! Thanks for contacting us.';
            echo $msg;
            header('Location: https://centicon.com.au');
            exit();
        }
    } else {
        $msg = 'Invalid email address, message ignored.';
        echo $msg;
        header('Location: https://centicon.com.au');
        exit();
    }
    header('Location: https://centicon.com.au'); echo "<a href='index.html'>Message sent! Thank you for contacting us!</a>";
    exit();
}
header('Location: https://centicon.com.au');
exit();
?>






















