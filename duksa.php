<?php include "inc/header.php"; ?>
<html>
<style>
    .clothes-container {
        display: inline-block;
        margin: 10px;
        vertical-align: top;
    }

    .clothes-container img {
        max-width: 400px;
        height: auto;
    }
</style>

<div class="navbar1">
    <div class="nav1-items">
        <ul>
            <li><a href="jakne.php">Jakne</a></li>
            <li><a href="jelek.php">Jelek</a></li>
            <li><a href="duksa.php">Duksa</a></li>

        </ul>

    </div>
</div>
<?php
if (isset($_POST['productId'])) {
    $productId = $_POST['productId'];

    $product = merrProduktId($productId);

    if ($product) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        $_SESSION['cart'][] = array(
            'productId' => $productId,
            'productName' => $product['emri'],
            'productPrice' => $product['cmimi'],
        );
    }
}

$clothingProducts = getDuksa();
foreach ($clothingProducts as $product) {
    $productId = $product['productid'];
    $productName = $product['emri'];
    $productPrice = $product['cmimi'];

    $productImageURL = getProductImageURL($productId);
    echo '<div class="clothes-container">';
    echo '<ul class="image-list">';
    echo '<li>';
    echo '<a href=""><img src="' . $productImageURL . '"></a>';
    echo '<p>' . $productName . '</p>';
    echo '<span>' . $productPrice . '$</span>';
    echo '<form action="" method="POST">';
    echo '<input type="hidden" name="productId" value="' . $productId . '">';
    echo '<input type="submit" name="blej" value="Buy"class="buy">';
    echo '</form>';
    echo '</li>';
    echo '</ul>';
    echo '</div>';
}
?>











</html>