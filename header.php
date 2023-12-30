<?php
include 'connection.php';

$sql = "select * from `carts`";
$result = mysqli_query($con, $sql);

// Count the number of items in the cart
$numItemsInCart = mysqli_num_rows($result);

?>


<header>
    <div class="navbar">
        <div class="nav-title">
            <a href="index.php">Shopping Cart</a>
        </div>
        <nav>
            <ul>
                <li><a href="product.php">add</a></li>
                <li><a href="index.php">view</a> </li>
                <li><a href="shop_product.php">shop</a></li>
                <li><a href="cart.php"><i class="fa-solid  fa-cart-shopping"></i><span><sup><?php echo $numItemsInCart ?></sup></span></a>
                </li>

            </ul>
        </nav>
    </div>
</header>