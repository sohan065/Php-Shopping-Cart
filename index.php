<?php

include 'connection.php';

$sql = "select * from `products`";
$result = mysqli_query($con, $sql);

$products = array();
while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <?php include 'header.php'; ?>
    <?php
    if ($products) {
        echo '<div class="container my-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">SL</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Description</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>';
        $sl = 1;
        foreach ($products as $product) {
            echo '<tr>';
            echo '<th scope="row">' . $sl . '</th>';
            echo '<td>' . $product['name'] . '</td>';
            echo '<td>' . $product['price'] . '</td>';
            echo '<td>' . $product['quantity'] . '</td>';
            echo '<td>' . $product['description'] . '</td>';
            echo '<td><a href="edit.php?id=' . $product['id'] . '" class="btn btn-primary">Edit</a>
                    <a href="delete.php?id=' . $product['id'] . '" class="btn btn-danger" onClick="return confirm(\'Are you sure?\');" >Delete</a>
                    </td>';
            echo '</tr>';
            $sl++;
        }
        echo '</tbody>
            </table>
        </div>';
    } else {
        // Handle the case when there are no users
        echo '    <div class="container">
                        <div style="width: 500px;" class="m-auto bg-color-red">
                            <h1>NO PRODUCTS</h1>
                        </div>
                  </div>
              ';
    }
    ?>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>