<?php
session_start(); // Start the session
require_once 'connection.php';

// Check if user is logged in
if (!isset($_SESSION['id'])) {
    // Redirect to login page or handle unauthorized access
    header("Location: login.php");
    exit(); // Stop script execution
}

// Check if prod_id is set and numeric
if (isset($_GET['prod_id']) && is_numeric($_GET['prod_id'])) {
    $prod_id = $_GET['prod_id'];

    // Prepare delete query
    $delete = "DELETE FROM product WHERE productID = ?";

    // Prepare statement
    $stmt = mysqli_prepare($conn, $delete);

    if ($stmt) {
        // Bind parameter
        mysqli_stmt_bind_param($stmt, "i", $prod_id);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // Deletion successful, redirect to view_product.php
            header("Location: view_product.php?delete_msg=2");
            exit(); // Ensure script stops executing after redirection
        } else {
            // Deletion failed, handle the error
            echo "Error deleting record: " . mysqli_error($conn);
        }

        // Close statement
        mysqli_stmt_close($stmt);
    } else {
        // Handle prepared statement error
        echo "Error in prepared statement: " . mysqli_error($conn);
    }

    // Close connection
    mysqli_close($conn);
} else {
    // Handle invalid or missing prod_id parameter
    echo "Invalid or missing product ID.";
}
?>
