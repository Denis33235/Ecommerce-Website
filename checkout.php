<?php
include "inc/header.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Checkout</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    include "inc/aside.php";
    ?>

    <div class="checkout_container">
        <h2>Checkout</h2>

        <?php
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            echo '<table>';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Product Name</th>';
            echo '<th>Price</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            $totalPrice = 0;

            foreach ($_SESSION['cart'] as $item) {
                echo '<tr>';
                echo '<td>' . $item['productName'] . '</td>';
                echo '<td>$' . $item['productPrice'] . '</td>';
                echo '</tr>';
                $totalPrice += $item['productPrice'];
            }

            echo '<tr>';
            echo '<td><strong>Total:</strong></td>';
            echo '<td><strong>$' . $totalPrice . '</strong></td>';
            echo '</tr>';

            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<p>Your cart is empty.</p>';
        }
        ?>

        <form action="process_order.php" method="POST">
            <h3>Shipping Information</h3>
            <label for="name">Full Name:</label>
            <input type="text" name="name" required><br>

            <label for="address">Address:</label>
            <input type="text" name="address" required><br>

            <label for="city">City:</label>
            <input type="text" name="city" required><br>

            <label for="zip">ZIP Code:</label>
            <input type="text" name="zip" required><br>

            <h3>Payment Information</h3>
            <label for="card">Credit Card Number:</label>
            <input type="text" name="card" required><br>

            <label for="expiry">Expiration Date:</label>
            <input type="text" name="expiry" placeholder="MM/YY" required><br>

            <label for="cvv">CVV:</label>
            <input type="text" name="cvv" required><br>

            <input type="submit" name="checkout" value="Complete Purchase">
        </form>
    </div>
</body>

</html>

<?php
include "inc/footer.php";
?>