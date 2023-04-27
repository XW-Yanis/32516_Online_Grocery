<html>

<head>
  <meta charset="utf-8">
  <title>Daily Fresh - Checkout</title>
  <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
  <!-- Bootstrap css -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <!-- Nice Select css -->
  <link rel="stylesheet" href="css/nice-select.css">
  <!-- Font Awesome css -->
  <link rel="stylesheet" href="css/fontawesome.css">
  <!-- My css -->
  <link rel="stylesheet" href="css/mycss.css">
  <!-- checkout css -->
  <link rel="stylesheet" href="css/checkout.css">
  <link rel="stylesheet" href="css/sendEmail.css">
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
  <!-- JQuery -->
  <script src="js/jquery.js"></script>
  <script src="js/jquery.nice-select.js"></script>
  <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/e6c249af2f.js" crossorigin="anonymous"></script>
  <!-- myjs -->
  <script src="js/myjs.js"></script>
</head>

<body>
  <?php
  // Generate the array contains [mail_to, emailBody]
  function renderEmailContent()
  {
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $suburb = $_POST['suburb'];
    $orderTime = date('Y-m-d H:i:s');
    $itemsDetail = $_POST['items-detail'];
    $grandTotal = $_POST['grand-total'];

    $emailBody = "Hi $firstName $lastName,<br><br>Thank you for shopping at Daily Fresh! Below is your order details.<br><br>"
      . "Order Time: $orderTime<br><br>"
      . "Shipping Address: $address, $suburb, $state, $country<br><br>"
      . "Your Order Items:<br>$itemsDetail<br><br>"
      . "Grand total: $ " . number_format($grandTotal, 2) . "<br><br>";

    return ['emailAddress' => $email, 'body' => $emailBody];
  }

  $emailInfo = renderEmailContent();
  $email = $emailInfo['emailAddress'];
  $body = $emailInfo['body'];

  // Send email to customer
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
      echo $response;
    }
  }
  sendEmail($email, "Order Confirmation", $body);
  // Email has been sent, order has completed, coookie has expired.
  function emptyCookie()
  {
    setcookie(
      "cart",
      "",
      time() - 3600,
    );
  }
  emptyCookie();
  ?>

  <?php include 'header.php' ?>
  <div class="container">
    <div class="row">
      <h1 class="text-center">Thank you for shopping at Daily Fresh!<br><br><br>Your order details have been sent.
        <br>Check
        your
        mailbox after sometime.
      </h1>
    </div>
  </div>
  <?php include 'footer.php' ?>
</body>

</html>