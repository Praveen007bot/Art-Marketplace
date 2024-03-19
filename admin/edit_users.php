<?php
require_once('connection.php');
$users_username = $_POST['name'];
$users_email = $_POST['email'];
$users_password = $_POST['password'];

$hidden_id = $_POST['hidden_users'];
$update = "UPDATE signup SET name = '$users_username', email = '$users_email', password = '$users_password' where id = $hidden_id";
mysqli_query($conn, $update);
header('Location: users.php?edit_msg=1');
?>