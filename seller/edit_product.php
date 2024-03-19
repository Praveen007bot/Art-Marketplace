<?php
require_once('connection.php');
$art_name = $_POST['art_name'];
$artist_name = $_POST['artist_name'];
$art_price = $_POST['art_price'];

$hidden_id = $_POST['hidden_product'];
if ($_FILES['art_image']['name'][0] != "") {
for ($i=0; $i < count($_FILES['art_image']['name']); $i++) { 
	$file_name = $_FILES['art_image']['name'][$i];
	$f_name = Date('ymdhis').$i;
	$file_array = explode('.', $file_name);
	$ext = $file_array[count($file_array) - 1];
	$new_file_name = $f_name.'.'.$ext;
	$source = $_FILES['art_image']['tmp_name'][$i];
	$destination = "../".$new_file_name;
	move_uploaded_file($source, $destination);
	if ($i == count($_FILES['art_image']['name']) - 1) {
		$upload_file_name .= $f_name.'.'.$ext;
	} else {	
		$upload_file_name .= $f_name.'.'.$ext.", ";
	}	
}
$update = "UPDATE product set art_name = '$art_name', artist_name = '$artist_name', art_price = '$art_price', art_image = '$upload_file_name' where id = $hidden_id";
mysqli_query($conn, $update);
header("Location: view_product.php?edit_msg=2");
} 
elseif ($_FILES['art_image']['name'][0] == "") {
	$update = "UPDATE product set art_name = '$art_name', artist_name = '$artist_name', art_price = '$art_price', where id = $hidden_id";
    mysqli_query($conn, $update);
    header("Location: view_product.php?edit_msg=2");
}
?>