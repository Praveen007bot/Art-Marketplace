<?php
session_start();
require_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $art_name = $_POST['art_name'];
    $artist_name = $_POST['artist_name'];
    $art_price = $_POST['art_price'];

    // Update product information in the database
    // Assuming you have a table named 'products'
    // Update query might look something like this
    $sql = "UPDATE products SET artist_name='$artist_name', art_price='$art_price' WHERE art_name='$art_name'";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        echo "Product information updated successfully.";
    } else {
        echo "Error updating product information: " . mysqli_error($conn);
    }

    // Handle file uploads if any
    if (!empty($_FILES['product_image']['name'][0])) {
        // Handle file uploads here
        // For example, move uploaded files to a directory on the server
    }
}


?>

