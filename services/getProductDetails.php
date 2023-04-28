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


$product_id = $_GET['product_id'];
$query = "SELECT * FROM products WHERE product_id = '$product_id'";
$result = mysqli_query($con, $query);
$product = mysqli_fetch_assoc($result);

mysqli_close($con);

echo json_encode($product);
?>