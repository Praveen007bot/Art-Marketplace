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

<div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header">Users Table</h5>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered first">
                                        <thead>
                                            <tr>
                                                <th>S. No.</th>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Password</th>
                                                
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            require_once('connection.php');
                                            $select = "SELECT * FROM seller";
                                            $query = mysqli_query($conn, $select);
                                            $i = 1;
                                            while ($res = mysqli_fetch_assoc($query)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $res['name'];?></td>
                                                <td><?php echo $res['email'];?></td>
                                                <td><?php echo $res['password'];?></td>
                                                
                                                <td>
                                                    <button data-toggle="modal" data-target="#exampleModal" class="btn btn-space btn-primary" onclick="edit_sellers(<?php echo $res['sellerID'];?>)">Edit</button>
                                                    <button onclick="delete_sellers(<?php echo $res['sellerID'];?>)" class="btn btn-space btn-danger">DELETE</button>
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
                <div class="modal fade" id="exampleModal" data-backdrop="static" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit users</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="edit_sellers.php" id="form" method="post" enctype="multipart/form-data">
            <div class="modal-body">
                <div class="card">
                    <h5 class="card-header">Edit users</h5>
                    <div class="card-body">    
                        <div class="form-group">
                            <label for="inputUserName">Username</label>
                            <input id="inputUserName" type="text" name="name" required="" placeholder="Enter username" autocomplete="off" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="inputUserEmail">Email</label>
                            <input id="inputUserEmail" type="email" name="email" required="" placeholder="Enter email" autocomplete="off" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="inputUserPassword">Password</label>
                            <input id="inputUserPassword" type="password" name="password" required="" placeholder="Enter password" autocomplete="off" class="form-control">
                        </div>
                        
                        <input type="hidden" name="hidden_users">
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
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/bootstrap.bundle.js"></script>
    <script src="../js/jquery.slimscroll.js"></script>
    <script src="../js/main-js.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script src="../js/dataTables.bootstrap4.min.js"></script>
    <script src="../js/data-table.js"></script>
    <script>
        function edit_users(id) {
            $.ajax({
                url:'get_sellers.php',
                data:'id='+id,
                method:'get',
                dataType:'json',
                success:function(res){
                    console.log(res);
                    $('input[name="name"]').val(res.name);
                    $('input[name="email"]').val(res.email);
                    $('input[name="password"]').val(res.password);
                   
                    $('input[name="hidden_users"]').val(res.id);
                }
            })
        }
        function delete_sellers(id) {
            var flag = confirm("Do you want to delete?");
            if (flag) {
                window.location.href = "delete_sellers.php?id="+id;
            }
        }
    </script>
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



