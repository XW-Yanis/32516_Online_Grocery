<?php
// This file aims to extract products from the database, for now it is a local database.
// Once I set up the Amazon database I will change the parameters.

$server_name = 'localhost';
$username = 'uts';
$password = 'internet';
$db_name = 'internet_programming';

$con = mysqli_connect($server_name, $username, $password, $db_name);


if (!$con) {
  die("Could not connect to DB.");
}

$mode = 0;
$productNames;
$price;

if (isset($_POST['param'])) {
  $param = json_decode($_POST['param'], true);
  foreach ($param as $item) {
    if (array_key_exists('productNames', $item)) {
      $mode = 1;
      $temp = preg_split('/\s+/', $item['productNames']);
      if (count($temp) == 1) {
        $productNames = "'" . $temp[0] . "'";
      } else {
        $productNames = "'" . implode("', '", $temp) . "'";
      }
    } else if (array_key_exists('price', $item)) {
      $mode = -1;
      $price = preg_split('/\-{1}/', $item['price']);
    }
  }
}

$query = "";

if ($mode > 0) {
  $query = "SELECT * FROM products WHERE product_name IN ($productNames)";
} else if ($mode < 0) {
  $lower_bound = $price[0];
  $upper_bound = $price[1];
  $query = "SELECT * FROM products WHERE unit_price BETWEEN $lower_bound AND $upper_bound";
} else {
  echo "Nothing to do here...Mode is neither positive or negative. Check if something is wrong in $param.";
}

$result = mysqli_query($con, $query);

$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_close($con);

echo json_encode($products);
?>