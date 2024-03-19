<?php
if (isset($_GET['register_msg']) && $_GET['register_msg'] == 1) {
    echo "<script>alert('Username already assigned!!!')</script>";
    echo "<script>window.location.assign('register.php')</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Register</title>
    <link rel="stylesheet" href="css/signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    

</head>

<body class="bg-gradient-primary">

    <div class="container" >

        <div class="card o-hidden border-0 shadow-lg my-5" style="margin:auto;width:800px;">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="wrapper">
                   
                    <div class="col-lg-12">
                        <div class="p-5">   
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form action="registerbk.php" method = "post">
        
        <div class="form-group row">
            <!-- <i class="fas fa-user"></i> -->
            <input type="text" class="form-control form-control-user"  name = "name" placeholder="Username" required>
          </div>
          <div class="form-group row">
            <!-- <i class="fas fa-user"></i> -->
            <input type="text" class="form-control form-control-user" name = "email" placeholder="Email Id" required>
          </div>
          <div class="form-group row">
            <!-- <i class="fas fa-lock"></i> -->
            <input type="password" class="form-control form-control-user" name ="password" placeholder="Password" required>
          </div>
          
          <div class="row button">
            <input type="submit" class="form-control form-control-user" value="Create Account">
          </div>
          <div class="signup-link">Already a member? <a href="login.php">Login now</a></div>
        </form>
                            <hr>
                         
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>