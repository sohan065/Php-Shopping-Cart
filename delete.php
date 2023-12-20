<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'connection.php';

if (isset($_GET['id'])) {
    $id = isset($_GET['id']) ? trim($_GET['id']) : '';

    if (empty($id)) {
        echo " id is  required";
    } else {
        $sql = "delete  from `users` where id=$id";

        $result = mysqli_query($con, $sql);

        if ($result) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($con);
        }
    }
}