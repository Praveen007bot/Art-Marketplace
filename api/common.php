<?php
session_start();
include "../includes/config.php";

$userID = $_SESSION['id'];

$ResponseArray = array();
$ErrorResponse = "";
$Action = stripslashes(trim($_REQUEST["action"]));
$HtmlContent = "";



if (isset($Action) && $Action == "login") {
    try {
        $email = addslashes((trim($_REQUEST['username'])));
        $password = addslashes((trim($_REQUEST['password'])));

        $CheckUserQuery = "SELECT * FROM signup WHERE email = '$email' AND password = '$password'";
        $CheckUserQueryResults = mysqli_query($conn, $CheckUserQuery);

        if (mysqli_num_rows($CheckUserQueryResults) > 0) {
            while ($record = mysqli_fetch_assoc($CheckUserQueryResults)) {
                // Store the user's ID in the session for future use
                $_SESSION['id'] = $record["id"];
            }

            $ResponseArray["status"] = "200";
            $ResponseArray["message"] = "Login Successful.";
        } else {
            $ResponseArray["status"] = "300";
            $ResponseArray["message"] = "Incorrect username or password.";
        }
    } catch (Exception $ex) {
        $ResponseArray["status"] = "500";
        $ResponseArray["message"] = $ex->getMessage();
    }
} elseif (isset($Action) && $Action == "register") {
    try {
        $username = addslashes((trim($_REQUEST['regname'])));
        $email = addslashes((trim($_REQUEST['regemail'])));
        $password = addslashes((trim($_REQUEST['regpassword'])));
    
        $LoginArray = array();
        $LoginArray["username"] = $username;
        $LoginArray["email"] = $email;
        $LoginArray["phone"] = $mobile;
        $LoginArray["password"] = $password;
    
        $columns = implode(", ", array_keys($LoginArray));
        $escaped_values = array_map(array($conn, 'real_escape_string'), array_values($LoginArray));
        $values = implode("', '", $escaped_values);
        $AddNewUserQuery = "INSERT INTO signup ($columns) VALUES ('$values')";
        $ExecuteAddNewUserQuery = mysqli_query($conn, $AddNewUserQuery) or die("Error in query: $AddNewUserQuery. " . mysqli_error($conn));
        
        $ResponseArray["status"] = "200";
        $ResponseArray["message"] = "Registration Successful.";
    } catch (Exception $ex) {
        $ResponseArray["status"] = "500";
        $ResponseArray["message"] = $ex->getMessage();
    }
}elseif (isset($Action) && $Action == "payment") {
    try {
        $f_name  = addslashes((trim($_REQUEST['f_name'])));
        $l_name  = addslashes((trim($_REQUEST['l_name'])));
        $email   = addslashes((trim($_REQUEST['email'])));
        $address = addslashes((trim($_REQUEST['address'])));
        $country = addslashes((trim($_REQUEST['country'])));
        $state   = addslashes((trim($_REQUEST['state'])));
        $zipcode = addslashes((trim($_REQUEST['zipcode'])));
        $total_amount = addslashes((trim($_REQUEST['total'])));
        $user = addslashes((trim($_REQUEST['user'])));

        $OrderArray = array();
        $OrderArray["userID"] = $user;
        $OrderArray["f_name"] = $f_name;
        $OrderArray["l_name"] = $l_name;
        $OrderArray["email"] = $email;

        $OrderArray["address"] = $address;
        $OrderArray["country"] = $country;
        $OrderArray["state"] = $state;
        $OrderArray["zipcode"] = $zipcode;
        $OrderArray["total_amount"] = $total_amount;
        $OrderArray["placed_on"] = date("Y-m-d H:i:s");

    

        $columns = implode(", ", array_keys($OrderArray));
        $escaped_values = array_map(array($conn, 'real_escape_string'), array_values($OrderArray));
        $values = implode("', '", $escaped_values);
        $AddNewUserQuery = "INSERT INTO orders ($columns) VALUES ('$values')";
        $ExecuteAddNewUserQuery = mysqli_query($conn, $AddNewUserQuery) or die("Error in query: $AddNewUserQuery. " . mysqli_error($conn));
        

        $lastOrderID = mysqli_insert_id($conn);
        $sessionProducts = $_SESSION['productItems'];


        function validate($inputData){
            global $conn;
            $validateData = mysqli_real_escape_string($conn, $inputData);
            return trim($validateData);
        }


        function insert($tablename, $data){
            global $conn;

            $table = validate($tablename);

            $columns = array_keys($data);
            $values = array_values($data);

            $finalColumn = implode(',', $columns);
            $finalValues = "'".implode("', '", $values)."'";

            $query = "INSERT INTO $table ($finalColumn) VALUES ($finalValues)";
            $result = mysqli_query($conn,$query);
            return $result;
        }





        if (isset($sessionProducts) && is_array($sessionProducts)) {
            foreach ($sessionProducts as $productItem) {
                $productID  = $productItem['productID'];
                $art_name  = $productItem['art_name'];
                $art_price  = $productItem['art_price'];
                $artist_name  = $productItem['artist_name'];
                $art_image  = $productItem['art_image'];
    
                $dataOrderItem = [
                    'orderID' => $lastOrderID,
                    'productID' => $productID,
                    'art_name' => $art_name,
                    'artist_name' => $artist_name,
                    'art_price' => $art_price,         
                    'art_image' => $art_image,
    
                ];
                
                $orderItemQuery = insert('orderitem', $dataOrderItem);
            }
        } else {
            // Handle the case where $sessionProducts is null or not an array
            echo "Error: Invalid or empty sessionProducts.";
        }

        unset($_SESSION['productItems']);
        

        



       
        
        if ($ExecuteAddNewUserQuery) {
            // Order inserted successfully, now remove items from the cart
            $deleteCartItems = "DELETE FROM cartitem WHERE userID = '$userID'";
            $deleteResult = $conn->query($deleteCartItems);
    
            if ($deleteResult) {
                echo "Order inserted successfully, and cart items removed.";
            } else {
                echo "Error removing cart items: " . $conn->error;
            }
        } else {
            echo "Error inserting order: " . $conn->error;
        }

        $ResponseArray["status"] = "200";
        $ResponseArray["message"] = "Ordered Successful.";
    } catch (Exception $ex) {
        $ResponseArray["status"] = "500";
        $ResponseArray["message"] = $ex->getMessage();
    }
} else {
    $ResponseArray["status"] = "404";
    $ResponseArray["message"] = "Invalid Action.";
}

$Response = json_encode($ResponseArray, true);

echo $Response;
exit;
?>


