<?php

include 'connection.php';

$sql = "select * from `products`";
$result = mysqli_query($con, $sql);

$products = array();
while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
}
// add to cart logic
if (isset($_POST['submit'])) {
    $product_name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $price = isset($_POST['price']) ? trim($_POST['price']) : '';
    $quantity = isset($_POST['quantity']) ? trim($_POST['quantity']) : '';

    // Basic validation: Check if name, price, and quantity are not empty
    if (empty($product_name) || empty($price) || empty($quantity)) {
        echo "Name, price, and quantity are required fields";
    } else {
        // Check if the product name already exists in the cart
        $checkQuery = "SELECT * FROM `carts` WHERE product_name = '$product_name'";
        $checkResult = mysqli_query($con, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            $display_message = "Product Already  Added";
        } else {
            // Product does not exist in the cart, proceed with insertion
            $sql = "INSERT INTO `carts` (product_name, price, quantity) VALUES ('$product_name', '$price', '$quantity')";
            $result = mysqli_query($con, $sql);

            if ($result) {
                $display_message = "Product  Added Successfully";
                // header("Location: shop_product.php?message=" . urlencode($display_message));
                // exit();
            } else {
                echo "Error: " . mysqli_error($con);
            }
        }
        header("Location: shop_product.php?message=" . urlencode($display_message));
        exit();
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <?php include 'header.php'; ?>
    <?php
    if (isset($_GET['message'])) {
        $display_message = urldecode($_GET['message']);
        echo '<div class="container">
        <span>' . $display_message . '</span>
        <i class="fas fa-times" onclick="this.parentElement.style.display=\'none\'"></i>
    </div>';
    }
    ?>


    <?php
    if ($products) {
        echo '<div class="container">
        <div class="row">';
        $sl = 1;
        foreach ($products as $product) {

            echo ' 
            <div class="col-md-4 mt-2">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="card" style="width: 18rem;">
                    <!-- <img src="" class="card-img-top" alt=""> -->
                    <div class="card-body">
                        <h6 class="card-title">Product Name : ' . $product['name'] . '</h3>
                        <p class="card-text">Details : ' . $product['description'] . '
                        </p>
                        <p>Price : ' . $product['price'] . '</p>
                       <button class="btn btn-primary" name="submit">Add To Cart</button>
                    </div>
                </div>
                    <input type="text" name="name" value="' . $product['name'] . '" hidden>
                    <input type="number" name="price" value="' . $product['price'] . '" hidden>
                    <input type="number" name="quantity" value="' . $product['quantity'] . '" hidden>
    </form>
    </div>';
        }
        echo '</div>
    </div>';
    } else {
        // Handle the case when there are no users
        echo ' <div class="container">
        <div style="width: 500px;" class="m-auto bg-color-red">
            <h1>NO PRODUCTS</h1>
        </div>
    </div>
    ';
    }
    ?>






    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>