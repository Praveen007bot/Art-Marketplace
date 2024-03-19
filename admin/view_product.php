<?php

session_start();
require_once 'connection.php';

$admin_id = $_SESSION["id"];

if (isset($_GET['edit_msg']) && $_GET['edit_msg'] == 2) {
    echo "<script>
    alert('Product edited!');
    window.location.assign('view_product.php');
    </script>";
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

    <title>Admin Dashboard</title>

    <link rel="stylesheet" href="..assets/css/bootstrap.min.css">
    <link href="../fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="..assets/css/style.css">
    <link rel="stylesheet" href="../fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="..assets/css/dataTables.bootstrap4.css">

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

        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content">
                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">Product</h2>
                            
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="dashboard.php" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Product</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">View product</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header">Product Table</h5>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first">
                                        <thead>
                                            <tr>
                                                <th>S. No.</th>
                                                <th>Name</th>
                                                <th>Artist</th>
                                                <th>Price</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                                
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            require_once('connection.php');
                                            $select = "SELECT * FROM product WHERE admin_id = $admin_id;";
                                            $query = mysqli_query($conn, $select);
                                            $i = 1;
                                            while ($res = mysqli_fetch_assoc($query)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $res['art_name'];?></td>
                                                <td><?php echo $res['artist_name'];?></td>
                                                <td>Rs. <?php echo $res['art_price'];?></td>
                                                <td>
                                                	<?php
                                                	$file_array = explode(', ', $res['art_image']);
                                                	?>
                                                    <div class="owl-carousel owl-theme" style="width: 100px;">
                                                	<?php
                                                	for ($j=0; $j < count($file_array); $j++) {
                                                	?>
                                                    <div class="item"> 
                                                	<img src="../<?php echo $file_array[$j];?>" height="100px" width="100px">
                                                    </div>
                                                	<?php
                                                	}
                                                	?>
                                                    </div>
                                                </td>
                                                <td>
                                                    <button data-toggle="modal" data-target="#exampleModal" class="btn btn-space btn-primary" onclick="edit_prod(<?php echo $res['id'];?>)">Edit</button>
                                                    <button onclick="delete_prod(<?php echo $res['id'];?>)" class="btn btn-space btn-danger">DELETE</button></td>

                                                <td>
                                                    
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                        
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <div class="footer">
                <div class="container-fluid">
                    <div class="row">
                        
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="text-md-right footer-links d-none d-sm-block">
                                <a href="javascript: void(0);">About</a>
                                <a href="javascript: void(0);">Support</a>
                                <a href="javascript: void(0);">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- end main wrapper -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->
    <div class="modal fade" id="exampleModal" data-backdrop="static" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="edit_product.php" id="form" method="post" enctype="multipart/form-data">
      <div class="modal-body">
            <div class="card">
                                <h5 class="card-header">Edit product</h5>
                                <div class="card-body">
                                        <div class="form-group">
                                            <label for="inputProductName">Product Name</label>
                                            <input id="inputProductName" type="text" name="art_name" required="" placeholder="Enter product name" autocomplete="off" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputProductCategory">Artist name</label>
                                            <input class="form-control" type="text" id="inputProductCategory" name="artist_name" required="" placeholder="Enter artist name" autocomplete="off" class="form-control">
                                                
                                                </input>
                                            
                                        </div>
                                        <div class="form-group">
                                            <label for="inputProductPrice">Price</label>
                                            <input id="inputProductPrice" type="text" name="art_price" required="" placeholder="Enter product price" autocomplete="off" class="form-control currency-inputmask">
                                        </div>
                                        <div class="custom-file mb-3">
                                            <input type="file" class="custom-file-input" id="customFile" name="product_image[]" multiple="">
                                            <label class="custom-file-label" for="customFile">Choose Image</label>
                                        </div>
                                        <div class="form-group">
                                            
                                            <input type="hidden" name="hidden_product">
                                        </div>
                                </div>
                            </div>
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-space btn-secondary">Clear</button>
        <button type="submit" class="btn btn-space btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
    <!-- Optional JavaScript -->
    <!-- <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/popper.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script> -->
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/bootstrap.bundle.js"></script>
    <script src="../js/jquery.slimscroll.js"></script>
    <script src="../js/main-js.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script src="../js/dataTables.bootstrap4.min.js"></script>
    <script src="../js/data-table.js"></script>
    <script type="text/javascript" src="../js/owl.carousel.min.js"></script>
    <script src="../js/jquery.inputmask.bundle.js"></script>
    <script>
        $(function(e){
            "use strict";
            $(".currency-inputmask").inputmask('999');
        });
        function edit_prod(id) {
            $.ajax({
                url:'get_product.php',
                data:'id='+id,
                method:'get',
                dataType:'json',
                success:function(res){
                    console.log(res);
                    $('input[name="art_name"]').val(res.art_name); // Change 'product_name' to 'art_name'
                    $('input[name="artist_name"]').val(res.artist_name); // Change 'product_category' to 'artist_name'
                    $('input[name="art_price"]').val(res.art_price); // Change 'product_price' to 'art_price'
                    $('input[name="hidden_product"]').val(res.id);
                }
            })
        }
        function delete_prod(prod_id) {
            var flag = confirm("Do you want to delete?");
            if (flag) {
                window.location.href = "delete_product.php?prod_id="+prod_id;
            }
        }
        $(document).ready(function(){
            $('.owl-carousel').owlCarousel({
                loop: true, margin: 10, dots: 0, autoplay: 4000, autoplayHoverPause: true, responsive:{
                    0:{items:1}, 600:{items:1}, 1000:{items:1}
                }
            })
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
<?php

