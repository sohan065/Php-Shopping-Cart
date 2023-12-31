<?php

$serverName = "localhost";
$username = "root";
$password = "root1234";
$database = "shopping_cart";

$con = new mysqli($serverName, $username, $password, $database);

if (!$con) {
    die(mysqli_error($con));
}
