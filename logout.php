<?php
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
if(session_destroy()) {
    // Redirect to the login page
    header("Location: login.php");
    exit();
} else {
    // Handle error (optional)
    echo "Logout failed. Please try again.";
}
?>
