











<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Signup Form</title> 
    <link rel="stylesheet" href="assets/css/signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
  </head>
  <body>
    <div class="container">
      <div class="wrapper">
     
        <h1 class="title"><span>Signup</span></h1>
        <form action="signupbk.php" method = "post">
        
        <div class="row">
            <!-- <i class="fas fa-user"></i> -->
            <input type="text" name = "name" placeholder="Username" required>
          </div>
          <div class="row">
            <!-- <i class="fas fa-user"></i> -->
            <input type="text" name = "email" placeholder="Email Id" required>
          </div>
          <div class="row">
            <!-- <i class="fas fa-lock"></i> -->
            <input type="password"  name ="password" placeholder="Password" required>
          </div>
          
          <div class="row button">
            <input type="submit" value="Create Account">
          </div>
          <div class="signup-link">Already a member? <a href="login.php">Login now</a></div>
        </form>
		
      </div>
    </div>
  </body>


