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

$query = "select * from products";

$result = mysqli_query($con, $query);

$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_close($con);

echo json_encode($products);
?>