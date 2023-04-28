<html>

<head>
  <script src="js/header.js"></script>
  <link rel="stylesheet" href="css/header.css">
  <script src="js/header.js"></script>
</head>
<!-- Start main top -->

<body>
  <header class="main-header">
    <!-- Nav bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light ">
      <div class="container d-flex justify-content-evenly">
        <!-- Hearder Navigation Start -->
        <!-- Logo part -->
        <div class="mavbar-header">
          <a class="navbar-brand" href="index.php"><img src="images/logo.png" class="logo" alt="Daily Fresh Logo"
              width="60" height="48" class="d-inline-block align-text-top"><i style="color:#7bb385;"
              class="fa-solid fa-font-case">Daily
              Fresh</i>
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
        <!-- Dropdown DIV -->
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" id="frozen-food"
                data-bs-auto-close="true">
                Frozen Food
              </a>
              <ul class="dropdown-menu" id="frozen-ul">
                <li><a class="dropdown-item" id="meat" href="#">Meats</a></li>
                <li><a class="dropdown-item" id="ice-cream" href="#">Ice Cream</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"
                id="fresh-food" data-bs-auto-close="true">
                Fresh Food
              </a>
              <ul class="dropdown-menu" id="fresh-ul">
                <li><a class="dropdown-item" id="meat" href="#">Meats</a></li>
                <li><a class="dropdown-item" id="cheese" href="#">Cheese</a></li>
                <li><a class="dropdown-item" id="fruit" href="#">Fruits</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"
                id="beverage" data-bs-auto-close="true">
                Beverage
              </a>
              <ul class="dropdown-menu" id="beverage-ul">
                <li><a class="dropdown-item" id="tea" href="#">Tea</a></li>
                <li><a class="dropdown-item" id="coffee" href="#">Coffee</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"
                id="home-health" data-bs-auto-close="true">
                Home & Health
              </a>
              <ul class="dropdown-menu" id="home-ul">
                <li><a class="dropdown-item" id="medicine" href="#">Medicine</a></li>
                <li><a class="dropdown-item" id="personal-care" href="#">Personal Care</a></li>
                <li><a class="dropdown-item" id="cleaning" href="#">Cleaning</a></li>
                <li><a class="dropdown-item" id="snack" href="#">Snacks</a></li>
              </ul>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"
                id="pet-food" data-bs-auto-close="true">
                Pet Food
              </a>
              <ul class="dropdown-menu" id="pet-ul">
                <li><a class="dropdown-item" id="dog-food" href="#">Dog Food</a></li>
                <li><a class="dropdown-item" id="cat-food" href="#">Cat Food</a></li>
                <li><a class="dropdown-item" id="bird-food" href="#">Bird Food</a></li>
                <li><a class="dropdown-item" id="fish-food" href="#">Fish Food</a></li>
              </ul>
            </li>
          </ul>


          <!-- Search Related, includs the search Box, the price range and the btn -->
          <div class="container-fuild">
            <form id="search-form" class="d-flex" role="search" action="getSearchProducts.php" method="get">
              <input class="form-control me-2" type="search" placeholder="Search Products..." aria-label="Search"
                style="width:auto" id="product-name">
              <div class="form-floating" style="margin-right: .5rem!important;">
                <select id="floatingSelect">
                  <option data-display="Filter By Price">Cancel</option>
                  <option value="0-10">0$ - 10$</option>
                  <option value="10-20">10$ - 20$</option>
                  <option value="20-30">20$ - 30$</option>
                </select>
              </div>
              <div class="d-grid gap-2 col-2 ms-auto">
                <button id="search" class="hvr-hover" type="submit" onclick="searchBtnOnClick()">Search</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </nav>
  </header>
</body>

</html>