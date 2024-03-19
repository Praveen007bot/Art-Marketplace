<?php
session_start();
include "includes/config.php";

if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if user is not logged in
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch current user details from the database
$sql = "SELECT * FROM signup WHERE id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $email = $row['email'];
    // Add more fields as needed
} else {
    // Handle error if user not found
    echo "User not found.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
</head>
<body>
    <h1>Edit Profile</h1>
    <form action="update_profile.php" method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo $name; ?>" required>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $email; ?>" required>

        <!-- Add more fields as needed -->

        <button type="submit">Update Profile</button>
    </form>
    <br>
    <a href="profile.php">Back to Profile</a>
</body>
</html>
