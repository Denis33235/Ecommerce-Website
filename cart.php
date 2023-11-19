<?php
include "inc/header.php";



if (isset($_POST['removeProduct'])) {
  $productIdToRemove = $_POST['productId'];

  removeFromCart($productIdToRemove);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Shopping Cart</title>
  <link rel="stylesheet" href="style.css">

</head>

<body>
  <?php
  include "inc/aside.php";
  ?>

  <div class="cart_container">
    <h2>Your Shopping Cart</h2>

    <?php
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
      echo '<table class="products">';
      echo '<thead>';
      echo '<tr>';
      echo '<th>Product Name</th>';
      echo '<th>Price</th>';
      echo '<th>Action</th>';
      echo '</tr>';
      echo '</thead>';
      echo '<tbody>';

      foreach ($_SESSION['cart'] as $item) {
        echo '<tr>';
        echo '<td>' . $item['productName'] . '</td>';
        echo '<td>$' . $item['productPrice'] . '</td>';
        echo '<td class="remove">';

        echo '<form method="post" action="">';
        echo '<input type="hidden" name="productId" value="' . $item["productId"] . '">';
        echo '<input type="submit" name="removeProduct" value="Remove">';
        echo '</form>';
        echo '</td>';
        echo '</tr>';
      }

      echo '</tbody>';
      echo '</table>';
    } else {
      echo '<p>Your cart is empty.</p>';
    }
    ?>

  </div>
</body>

</html>

<?php
include "inc/footer.php";
?>