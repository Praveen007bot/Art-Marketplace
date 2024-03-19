<?php
session_start();
require_once("connection.php");
include "includes/header.php";

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$id = $_SESSION['id'];

$query = "SELECT name, email FROM signup WHERE id = $id";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($result);
$name = $row['name'];
$email = $row['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    
    <style>
        body {
            padding: 20px;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h1 class="text-center">Welcome, <?php echo $name; ?></h1>
        </div>
        <div class="card-body">
            <p class="card-text"><strong>Email:</strong> <?php echo $email; ?></p>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
