<?php

include 'connection.php';

$sql = "select * from `users`";
$result = mysqli_query($con, $sql);

$users = array();
while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
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
    <div class="container my-5">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="btn btn-primary" href="user.php">Add</a>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>

                </ul>

                <div id="navbarSupportedContent">
                    <form class="d-flex" action="search.php" method="get">
                        <input class="form-control me-2" type="search" placeholder="Search" name="search" required>
                        <button type="submit" class="btn btn-outline-success">Search</button>
                    </form>
                </div>

            </div>
        </nav>

        <h6 class="text-center mt-3">all data</h6>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">name</th>
                    <th scope="col">email</th>
                    <th scope="col">actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($users as $user) {
                    echo '<tr>';
                    echo '<th scope="row">' . $user['id'] . '</th>';
                    echo '<td>' . $user['name'] . '</td>';
                    echo '<td>' . $user['email'] . '</td>';
                    echo '<td><a href="edit.php?id=' . $user['id'] . '" class="btn btn-primary">Edit</a>
                    <a href="delete.php?id=' . $user['id'] . '" class="btn btn-danger">Delete</a>
                    </td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>