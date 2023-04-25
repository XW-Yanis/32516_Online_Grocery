<?php
require_once 'sendgrid-php/sendgrid-php.php';

$API = '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';

$email = new \SendGrid\Mail\Mail();
$email->setFrom("test@example.com", "Example User");
$email->setSubject("Sending with Twilio SendGrid is Fun");
$email->addTo("test@example.com", "Example User");
$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
$email->addContent(
  "text/html",
  "<strong>and easy to do anywhere, even with PHP</strong>"
);
$sendgrid = new \SendGrid($API);
try {
  $response = $sendgrid->send($email);
  print $response->statusCode() . "\n";
  print_r($response->headers());
  print $response->body() . "\n";
} catch (Exception $e) {
  echo 'Caught exception: ' . $e->getMessage() . "\n";
}
?>