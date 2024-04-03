<?php
require_once('connection.php');

$art_name = $_POST['art_name'];
$artist_name = $_POST['artist_name'];
$art_price = $_POST['art_price'];
$hidden_id = $_POST['hidden_product'];

if ($_FILES['product_image']['name'][0] != "") {
    $upload_file_name = ""; // Initialize variable to store uploaded file names
    for ($i = 0; $i < count($_FILES['product_image']['name']); $i++) {
        $file_name = $_FILES['product_image']['name'][$i];
        $f_name = date('ymdhis') . $i;
        $file_array = explode('.', $file_name);
        $ext = $file_array[count($file_array) - 1];
        $new_file_name = $f_name . '.' . $ext;
        $source = $_FILES['product_image']['tmp_name'][$i];
        $destination = "../" . $new_file_name;
        move_uploaded_file($source, $destination);
        if ($i == count($_FILES['product_image']['name']) - 1) {
            $upload_file_name .= $new_file_name;
        } else {
            $upload_file_name .= $new_file_name . ", ";
        }
    }
    $update = "UPDATE product SET art_name = '$art_name', artist_name = '$artist_name', art_price = '$art_price', art_image = '$upload_file_name' WHERE productID = $hidden_id";
    mysqli_query($conn, $update);
    header("Location: view_product.php?edit_msg=2");
} elseif ($_FILES['product_image']['name'][0] == "") {
    $update = "UPDATE product SET art_name = '$art_name', artist_name = '$artist_name', art_price = '$art_price' WHERE productID = $hidden_id";
    mysqli_query($conn, $update);
    header("Location: view_product.php?edit_msg=2");
}
?>
