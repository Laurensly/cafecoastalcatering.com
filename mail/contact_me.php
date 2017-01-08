<?php
if(empty($_POST['name'])      ||
   empty($_POST['email'])     ||
   empty($_POST['phone'])     ||
   empty($_POST['message'])   ||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
   echo "No arguments Provided!";
   return false;
   }
   

$name = strip_tags(htmlspecialchars($_POST['name']));
$email_address = strip_tags(htmlspecialchars($_POST['email']));
$phone = strip_tags(htmlspecialchars($_POST['phone']));
$message = strip_tags(htmlspecialchars($_POST['message']));

require_once '/home/ubuntu/cafecoastalcatering.github.io/vendor/swiftmailer/swiftmailer/lib/swift_required.php';

// Create the Transport
$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 587, "tls")
  ->setUsername(getenv('GMAIL_USER'))
  ->setPassword(getenv('GMAIL_PASS'))
  ;


// Create the Mailer using your created Transport
$mailer = Swift_Mailer::newInstance($transport);

// Create a message
$swift_message = Swift_Message::newInstance('Catering Inquiry')
  ->setFrom(array($email_address => $name))
  ->setTo(array('cafecoastal@gmail.com' => 'Cafe Coastal Catering'))
  ->setBody("Name: " . $name . "\nEmail: " . $email_address . "\nPhone number: " . $phone . "\n" . $message)
  ;

// Send the message
$result = $mailer->send($swift_message);
return true;         
?>
