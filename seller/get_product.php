<?php
// get_product.php
require_once('connection.php');

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $select = "SELECT * FROM product WHERE productID = $id";
    $query = mysqli_query($conn, $select);
    $res = mysqli_fetch_assoc($query);
    echo json_encode($res);
}
?>
