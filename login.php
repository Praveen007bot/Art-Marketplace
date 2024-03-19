<?php

session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];

	  $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    //change DB name 
    $dbname = "art"; 
	
	
// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

	  
	 $sql = "SELECT * from signup where email = '$email' AND password = '$password'";  
	 


// Execute the query
$result = $conn->query($sql);
$message = 'Login Successfully';
// Check if a user with the given credentials exists
if ($result->num_rows == 1) {

    // User is authenticated, set session variable to indicate login
    $_SESSION["logged_in"] = true;
    $userInfo = $result->fetch_assoc();
    $_SESSION["id"] = $userInfo["id"];
    $_SESSION["Name"] = $userInfo["name"];
    $_SESSION["email"] = $userInfo["email"];
    // Redirect to a protected page (e.g., home.php)`
    ?>
    <script type='text/javascript'>
      alert('$message');
      window.location.href='index.php';
    </script>

    <?php

    exit();
} else {
    // Invalid credentials, show an error message
    echo "Invalid username or password.";
}

// Close the database connection
$conn->close();
}
?>



<!DOCTYPE html>
<!-- Created By CodingLab - www.codinglabweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Login Form</title> 
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
  </head>
  <body>
    <div class="container">
      <div class="wrapper">
      
        <div class="title"><span>Welcome Back!</span></div>
        <form action="login.php" method = "post">
          <div class="row">
            <!-- <i class="fas fa-user"></i> -->
            <input type="text" name = "email" placeholder="Enter Your Email" required>
          </div>
          <div class="row">
            <!-- <i class="fas fa-lock"></i> -->
            <input type="password" name = "password" placeholder="Password" required>
          </div><br>
          
          <div class="row button">
            <input type="submit" value="Login">
          </div>
          <div class="signup-link">Not a member? <a href="signup.php">Signup now</a></div>
        </form>
      </div>
    </div>

 </body>
 


</html>