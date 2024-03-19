<?php
$users_id = $_GET['id'];
require_once('connection.php');
$delete = "DELETE FROM seller where sellerID = $users_id";
mysqli_query($conn, $delete);
header("Location: sellers.php");
?>