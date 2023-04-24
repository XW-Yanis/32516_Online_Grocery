<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Shopping Cart</title>
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
  <!-- Cart css -->
  <link rel="stylesheet" href="css/cart.css">

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
  <script src="js/renderCart.js"></script>
</head>

<body>
  <?php include 'header.php';
  ?>
  <script>window.onload = initialize;</script>
  <div class="all-title-box">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h2>Cart</h2>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Shop</a></li>
            <li class="breadcrumb-item active">Cart</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- End All Title Box -->

  <!-- Start Cart  -->
  <div class="cart-box-main">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="table-main table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>Images</th>
                  <th>Product Name</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Total</th>
                  <th>Remove</th>
                </tr>
              </thead>
              <tbody id="insert-position">

              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- Empty Cart Btn -->
      <div id="empty-cart-container" class="row my-5">

        <div class="col-lg-6 col-sm-6">
          <div id="empty-cart">
            <input value="Empty Cart" type="submit" onclick="emptyCart()">
          </div>
        </div>
      </div>

      <!-- Order Summary -->
      <div class="row my-5">
        <div class="col-lg-8 col-sm-12"></div>
        <div class="col-lg-4 col-sm-12">
          <div class="order-box">
            <h3>Order Summary</h3>
            <hr>
            <div class="d-flex gr-total">
              <h5>Grand Total</h5>
              <div class="ml-auto h5" id="grand-total"> </div>
            </div>
            <hr>
          </div>
        </div>
        <div class="col-12 d-flex shopping-box"><a href="checkout.html" class="ml-auto  hvr-hover" id="checkout">check
            out</a>
        </div>
      </div>
    </div>
  </div>
  <!-- End Cart -->
  <?php include 'footer.php'; ?>
</body>


</html>