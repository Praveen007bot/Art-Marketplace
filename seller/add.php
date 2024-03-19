<?php

    require_once 'connection.php';

    if(isset($_POST["submit"])){
    
    $artname = $_POST["artname"];
    $artistname = $_POST["artistname"];
    $artprice = $_POST["artprice"];
    

    //For uploads photos
    $upload_dir = "uploads/"; //this is where the uploaded photo stored
    $artimage = $upload_dir.$_FILES["artimage"]["name"];
    $upload_dir.$_FILES["artimage"]["name"];
    $upload_file = $upload_dir.basename($_FILES["artimage"]["name"]);
    $imageType = strtolower(pathinfo($upload_file,PATHINFO_EXTENSION)); //used to detected the image format
    $check = $_FILES["artimage"]["size"]; // to detect the size of the image
    $upload_ok = 0;

    if(file_exists($upload_file)){
        echo "<script>alert('The file already exist')</script>";
        $upload_ok = 0;
    }else{
        $upload_ok = 1;
        if($check !== false){
            $upload_ok = 1;
            if($imageType == 'jpg' || $imageType == 'png' || $imageType == 'jpeg' || $imageType == 'gif'){
                $upload_ok = 1;
            }else{
                echo '<script>alert("please change the image format")</script>';
            }
        }else{
            echo '<script>alert("The photo size is 0 please change the photo ")</script>';
            $upload_ok = 0;
        }
    }

    if($upload_ok == 0){
        echo '<script>alert("sorry your file is doesn\'t uploaded. Please try again")</script>';
    }else{
        if($artname != "" && $artprice !=""){
            move_uploaded_file($_FILES["artimage"]["tmp_name"],$upload_file);

            $sql = "INSERT INTO product(art_name,artist_name,art_price,art_image)
            VALUES('$artname','$artistname','$artprice','$artimage')";

            if($conn->query($sql) == TRUE){
                echo "<script>alert('your product uploaded successfully')</script>";
            }
        }
    }


    
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

    <title>Product Upload</title>
    <link rel="stylesheet" href="css/seller.css">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
            
            include "includes/sidebar.php";
        ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php
            
                    include "includes/topbar.php";
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Add your Art</h1>
                        
                    </div>

                    <div class="col-md-6">
        <div class="container">
            <h1>Upload Your Artwork</h1>
            <form action="seller.php" method="POST" enctype="multipart/form-data">
                <label for="artname">Art Name:</label>
                <input type="text" id="artname" name="artname" required>

                <label for="artistname">Artist Name:</label>
                <input type="text" id="artistname" name="artistname" required>

                <label for="artdescription">Art Description:</label>
                <input type="text" id="artdescription" name="artdescription" required>

                
                
                <div class="form-group">
                        <label for="addBookCategory">Art Category</label>
                        <select class="form-control" id="addBookCategory" name="addBookCategory">
                        
                        <option value="1" >Art</option>
                        <option value="2">Handmade carfts</option>
                        
                        </select>
                </div>

                <label for="artprice">Art Price:</label>
                <input type="text" id="artprice" name="artprice" required>

                <label for="artimage">Upload Image:</label>
                <input type="file" id="artimage" name="artimage"  required hidden>

                <button id="choose" onclick="upload();">Choose Image</button>

                <button type="submit" value ="Upload" name="submit">Upload Product</button>0
            </form>
            <script>
                var artname = document.getElementById("artname");
                var artistname = document.getElementById("artistname");
                var artprice = document.getElementById("artprice");
                var choose = document.getElementById("choose");
                var uploadImage = document.getElementById("artimage");


                function upload(){
                    uploadImage.click();
                }

                uploadImage.addEventListener("change",function(){
                    var file = this.files[0];
                    if(artname.value == ""){
                        artname.value = file.name;
                    }
                    choose.innerHTML = "You can change("+file.name+") picture";
                })

                
            </script>
        </div>
                    </div>
                

                    

                    

                    

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.php">Logout</a>
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

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>