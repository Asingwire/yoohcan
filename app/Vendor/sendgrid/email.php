<?php
require 'vendor/autoload.php';
$sendgrid = new SendGrid("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");
$email    = new SendGrid\Email();
die("hiiii");
$email->addTo("khemit.verma25@gmail.com")
      ->setFrom("business@yoohcan.com")
      ->setSubject("Sending with SendGrid is Fun")
      ->setHtml("and easy to do anywhere, even with PHP");

echo $sendgrid->send($email)."hiiii";
die("hiiii");


?>