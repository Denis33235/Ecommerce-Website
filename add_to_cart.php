<?php
include "inc/functions.php";

if (isset($_POST["productid"])) {
    $productid = $_POST["productid"];



    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM produkte WHERE productid = $productid";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $emri = $row["emri"];
        $pershkrimi = $row["pershkrimi"];
        $cmimi = $row["cmimi"];
        $sasia_ne_stock = $row["sasia_ne_stock"];
        $categoryid = $row["categoryid"];

        $insert_sql = "INSERT INTO produkte (emri, pershkrimi, cmimi, sasia_ne_stock, categoryid)
                       VALUES ($emri, $pershkrimi,$cmimi, $sasia_ne_stock, $categoryid)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("ssdii", $emri, $pershkrimi, $cmimi, $sasia_ne_stock, $categoryid);

        if ($insert_stmt->execute()) {
            echo "Product added to the produkte table!";
        } else {
            echo "Error adding the product to the produkte table: " . $insert_stmt->error;
        }

        $conn->close();
    } else {
        echo "Product not found in the database.";
    }
}
