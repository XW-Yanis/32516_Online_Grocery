<!DOCTYPE html>
<html lang="en" dir="ltr">

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
  <script src="js/checkout.js"></script>
  <script>window.onload = initialize;</script>
  <?php include 'header.php'; ?>
  <div class="all-title-box">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h2>Checkout</h2>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Shop</a></li>
            <li class="breadcrumb-item active">Checkout</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- End All Title Box -->

  <div class="cart-box-main">
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-lg-6 mb-3">
          <div class="checkout-address">
            <div class="title-left">
              <h3>Billing address</h3>
            </div>
            <form class="needs-validation" novalidate>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="firstName">First name *</label>
                  <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
                  <div class="invalid-feedback"> Valid first name is required. </div>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="lastName">Last name *</label>
                  <input type="text" class="form-control" id="lastName" placeholder="" value="" required>
                  <div class="invalid-feedback"> Valid last name is required. </div>
                </div>
              </div>

              <div class="mb-3">
                <label for="address">Address *</label>
                <input type="text" class="form-control" id="address" placeholder="" required>
                <div class="invalid-feedback"> Please enter your shipping address. </div>
              </div>
              <div class="mb-3">
                <label for="email">Email Address *</label>
                <input type="email" class="form-control" id="email" placeholder="example@emailhost.com">
                <div class="invalid-feedback"> Please enter a valid email address for shipping updates.
                </div>
              </div>

              <div class="row">
                <div class="col-md-5 mb-3">
                  <label for="country">Country *</label>
                  <input type="text" class="form-control" id="country" placeholder="" required>
                  <div class="invalid-feedback"> Please select a valid country. </div>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="state">State *</label>
                  <input type="text" class="form-control" id="state" placeholder="" required>
                  <div class="invalid-feedback"> Please provide a valid state. </div>
                </div>
                <div class="col-md-3 mb-3">
                  <label for="suburb">Suburb *</label>
                  <input type="text" class="form-control" id="suburb" placeholder="" required>
                  <div class="invalid-feedback"> Please provide a valid suburb. </div>
                </div>
              </div>
              <hr class="mb-4">
            </form>
          </div>
        </div>
        <div class="col-sm-6 col-lg-6 mb-3">
          <div class="col-md-12 col-lg-12">
            <div class="odr-box">
              <div id="insert-position" class="title-left">
                <h3>Shopping cart</h3>
              </div>
            </div>
          </div>
          <div class="col-md-12 col-lg-12">
            <div class="order-box">
              <div class="title-left">
                <h3>Your order</h3>
              </div>
              <div class="d-flex gr-total">
                <h5>Grand Total</h5>
                <div id="grand-total" class="ml-auto h5"></div>
              </div>
              <hr>
            </div>
          </div>
          <div class="col-12 d-flex shopping-box"> <a id="checkoutBtn" class="ml-auto btn hvr-hover"
              onclick="checkoutBtnAction()">Place
              Order</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include 'footer.php'; ?>
</body>

</html>