<?php

include 'connection.php';

$sql = "select * from `carts`";
$result = mysqli_query($con, $sql);

$carts = array();
while ($row = mysqli_fetch_assoc($result)) {
    $carts[] = $row;
}

// update quantity logic

if (isset($_POST['update_quantity'])) {
    $id = isset($_POST['quantity_updatable_id']) ? trim($_POST['quantity_updatable_id']) : '';
    $quantity = isset($_POST['quantity']) ? trim($_POST['quantity']) : '';

    if (empty($id) || empty($quantity)) {
        echo "id,quantity  are required fields";
    } else {
        $sql = "UPDATE  `carts` set quantity='$quantity'  WHERE id=$id ";
        $result = mysqli_query($con, $sql);

        if ($result) {
            header("Location: cart.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($con);
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <h1 class="text-center">My Cart</h1>
    </div>

    <?php
    if ($carts) {
        echo '<div class="container my-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">SL</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total Price</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>';
        $sl = 1;
        $grandTotal = 0;
        foreach ($carts as $cart) {
            echo '<tr>';
            echo '<th scope="row">' . $sl . '</th>';
            echo '<td>' . $cart['product_name'] . '</td>';
            echo '<td>$' . number_format($cart['price']) . '</td>';
            echo '<td>
                            <div class="updateQuantity">
                                <form action="" method="post">
                                    <input type="text" name="quantity_updatable_id" value="' . $cart['id'] . '" hidden>
                                    <input type="number" name="quantity" value="' . $cart['quantity'] . '" min=1>
                                    <input type="submit" name="update_quantity" class="btn btn-primary" value="update">
                                </form>
                            </div>
                 </td>';

            echo '<td>' . number_format($cart['price'] * $cart['quantity']) . '</td>';
            echo '<td>
            <a href="remove.php?id=' . $cart['id'] . '" class="btn btn-danger" onClick="return confirm(\'Are you sure?\');" >Remove</a>
                    </td>';
            echo '</tr>';
            $sl++;
            $grandTotal += $cart['price'] * $cart['quantity'];
        }

        echo '</tbody>
            </table>
        </div>';
    } else {
        // Handle the case when there are no users
        echo '    <div class="container">
                        <div style="width: 500px;" class="m-auto bg-color-red">
                            <h1>NO PRODUCTS IN CARTS</h1>
                        </div>
                  </div>
              ';
    }
    ?>
    <?php
    if ($grandTotal > 0) {
        echo '<section id="payment">
        <div class="container">
            <div class="d-flex justify-content-between">
                <a href="shop_product.php" class="btn btn-primary">Continue Shopping</a>
                <button class="btn btn-primary">Grand Total : $' . number_format($grandTotal, 2) . '</button>
                <button class="btn btn-primary">Proceed To Check Out</button>
            </div>
        </div>
        </section>';
    }
    ?>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>