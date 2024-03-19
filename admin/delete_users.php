<?php
$users_id = $_GET['id'];
require_once('connection.php');
$delete = "DELETE FROM signup where id = $users_id";
mysqli_query($conn, $delete);
header("Location: users.php");
?>