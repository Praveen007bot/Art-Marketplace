<?php
session_start();
include "connection.php"; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the product ID from the POST data
    $productId = $_POST['cartitemID'];

    // Perform the database operation to remove the item
    $sql = "DELETE FROM cartitem WHERE cartitemID = $productId AND userID = $_SESSION[id]";
    $result = $conn->query($sql);

    // You can send a response back to the client if needed
    if ($result) {
        echo "Item removed successfully";
    } else {
        echo "Error removing item from the cart";
    }
}

$conn->close();
?>
