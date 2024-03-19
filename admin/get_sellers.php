<?php
require_once('connection.php');
$id = $_GET['id'];
$select = "SELECT * FROM seller where sellerID = $id";
$query = mysqli_query($conn, $select);
$res = mysqli_fetch_assoc($query);
echo json_encode($res);
?>