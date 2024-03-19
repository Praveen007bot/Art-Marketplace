<?php
session_start();
include "includes/config.php";

if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if user is not logged in
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newName = $_POST['name'];
    $newEmail = $_POST['email'];

    // Update user details in the database
    $sql = "UPDATE signup SET name='$newName', email='$newEmail' WHERE id = $user_id";

    if ($conn->query($sql) === TRUE) {
        echo "<script type='text/javascript'>alert('Profile updated successfully');window.location.href='profile.php';</script>";
    } else {
        echo "Error updating profile: " . $conn->error;
    }
}

$conn->close();
?>
