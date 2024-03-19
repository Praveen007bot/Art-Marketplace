<?php
session_start();
// Include your database connection code here
include "includes/connection.php";
$id = $_SESSION["id"];
// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the product details from the AJAX request
    $art_name = $_POST['art_name'];
    $artist_name = $_POST['artist_name'];
    $art_price = $_POST['art_price'];
    $art_image = $_POST['art_image']; // Remove the dollar sign here

    // Insert the product details into the cartitem database (replace with your actual database table and columns)
    $sql = "INSERT INTO cartitem (userID, art_name, artist_name, art_price, art_image) VALUES ('$id', '$art_name', '$artist_name', '$art_price', '$art_image')";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['status' => 'success']);
    } else {
        // Log or print the SQL error for debugging
        echo json_encode(['status' => 'error', 'message' => 'Error adding product to cart.', 'error' => $conn->error]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}

// Close the database connection
$conn->close();
?>
