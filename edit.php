<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'connection.php';

// get editable data
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM `products` WHERE id=$id";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $price = $row['price'];
    $quantity = $row['quantity'];
    $description = $row['description'];
}

// update logic

if (isset($_POST['submit'])) {
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $price = isset($_POST['price']) ? trim($_POST['price']) : '';
    $quantity = isset($_POST['quantity']) ? trim($_POST['quantity']) : '';
    $description = isset($_POST['description']) ? trim($_POST['description']) : '';


    if (empty($name) || empty($price) || empty($quantity) || empty($description)) {
        echo "Name,price,quantity and description are required fields";
    } else {
        $sql = "UPDATE  `products` set name='$name', price='$price',quantity='$quantity',description='$description'  WHERE id=$id ";
        $result = mysqli_query($con, $sql);

        if ($result) {
            header("Location: index.php");
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
    <title>crud</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <?php include 'header.php' ?>

    <div class="container">
        <section id="main">
            <form method="post">
                <h1>Update Product</h1>
                <div class="mb-3">
                    <label for="name" class="form-label">Name :</label>
                    <input type="text" class="form-control" name="name" value="<?php echo $name ?>" required>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control" name="price" value="<?php echo $price ?>" required>
                </div>
                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" class="form-control" name="quantity" value="<?php echo $quantity ?>" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" name="description" value="<?php echo $description ?>" required>
                </div>

                <button class="btn btn-primary" name="submit">Update</button>
            </form>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>