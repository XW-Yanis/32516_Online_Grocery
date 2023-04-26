<?php
$email = $_POST['email'];
$body = $_POST['body'];


function sendEmail($mail_to, $mail_subject, $body)
{
  $cURL_key = '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';
  $mail_from = 'wxwhyain@gmail.com';

  $data = array(
    "personalizations" => array(
      array(
        "to" => array(
          array(
            "email" => $mail_to
          )
        )
      )
    ),
    "from" => array(
      "email" => $mail_from
    ),
    "subject" => $mail_subject,
    "content" => array(
      array(
        "type" => "text/html",
        "value" => $body
      )
    )
  );

  $curl = curl_init();

  curl_setopt_array(
    $curl,
    array(
      CURLOPT_URL => 'https://api.sendgrid.com/v3/mail/send',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => json_encode($data),
      CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer ' . $cURL_key,
        'Content-Type: application/json',
        'cache-control: no-cache'
      ),
    )
  );
  $response = curl_exec($curl);
  $err = curl_error($curl);
  curl_close($curl);
  if ($err) {
    echo "cURL Error: " . $err . "\n";
  } else {
    echo 0;
  }
}
sendEmail($email, "Order Confirmation", $body);
?>