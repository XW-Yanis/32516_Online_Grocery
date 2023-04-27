<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Daily Fresh - Shopping Cart</title>
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
  <!-- renderCart -->
</head>

<body>
  <?php include 'header.php'; ?>

  <!-- Latest Product -->
  <div class="latest-products">
    <div class="container">
      <div class="row">
        <!-- Seciton Heading -->
        <div class="col-md-12" id="latest-products">
          <div class="section-heading">
            <h2 id="the-heading">Latest Products</h2>
            <a id="view-all" href="#">view all products<i class="fa fa-angle-right fa-2xl"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Shopping Cart -->
  <div class="container-fuild" style="position:fixed; right:50px; bottom:180px">
    <a href="cart.php">
      <i class="fa-solid fa-cart-shopping fa-2xl" style="color:#f2a154"></i>
    </a>
  </div>

  <!-- Footer -->
  <?php include 'footer.php'; ?>

  <script>
    window.onload = initialize;
  </script>
</body>

</html>