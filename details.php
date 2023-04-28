<html>

<head>
  <meta charset="utf-8">
  <title>Daily Fresh - Product Details</title>
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
  <link rel="stylesheet" href="css/details.css">
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
  <!-- JQuery -->
  <script src="js/jquery.js"></script>
  <script src="js/jquery.nice-select.js"></script>
  <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/e6c249af2f.js" crossorigin="anonymous"></script>
  <script src="js/details.js"></script>
</head>

<body>
  <?php include 'header.php'; ?>
  <div class="all-title-box">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h2>Product Details</h2>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Shop</a></li>
            <li class="breadcrumb-item active">Details</li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <div class="shop-detail-box-main">
    <div class="container">
      <div class="row" id='insertPosition'>
      </div>
    </div>
  </div>
  <script>window.onload = initialize();</script>
  <?php include 'footer.php'; ?>
</body>

</html>