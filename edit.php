<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM `users` WHERE id=$id";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $email = $row['email'];
}

if (isset($_POST['submit'])) {
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';


    if (empty($name) || empty($email)) {
        echo "Name and Email are required fields";
    } else {
        $sql = "UPDATE  `users` set name='$name', email='$email' WHERE id=$id ";
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
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <section id="main">
            <form method="post">
                <h1>Update User</h1>
                <div class="mb-3">
                    <label for="name" class="form-label">Name :</label>
                    <input type="text" class="form-control" name="name" value="<?php echo $name ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="<?php echo $email ?>" required>
                </div>

                <button class="btn btn-primary" name="submit">Update</button>
            </form>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>