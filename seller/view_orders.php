<?php

session_start();
require_once 'connection.php';

$admin_id = $_SESSION["id"];

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

<div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content">
                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">Orders</h2>
                            <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="dashboard.php" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">View orders</li>
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
                            <h5 class="card-header">Orders Table</h5>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first">
                                        <thead>
                                            <tr>
                                                <th>S. No.</th>
                                                <th>Orders id</th>
                                                <th>Users id</th>
                                                <th>Delivery date</th>
                                                <th>Payment method</th>
                                                <th>Total amount</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            
                                            $select = "SELECT * FROM orders";
                                            $query = mysqli_query($conn, $select);
                                            $i = 1;
                                            while ($res = mysqli_fetch_assoc($query)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $res['orders_id'];?></td>
                                                <td><?php echo $res['users_id'];?></td>
                                                <td><?php echo $res['delivery_date'];?></td>
                                                <td><?php echo $res['payment_method'];?></td>
                                                <td>Rs. <?php echo $res['total_amount'];?></td>
                                                <td>
                                                    <button data-toggle="modal" data-target="#exampleModal" class="btn btn-space btn-primary" onclick="edit_orders(<?php echo $res['orders_id'];?>)">Edit</button>
                                                    <button onclick="delete_orders(<?php echo $res['orders_id'];?>)" class="btn btn-space btn-secondary">DELETE</button>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>S. No.</th>
                                                <th>Orders id</th>
                                                <th>Users id</th>
                                                <th>Delivery date</th>
                                                <th>Payment method</th>
                                                <th>Total amount</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header">Orders Detail Table</h5>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first">
                                        <thead>
                                            <tr>
                                                <th>S. No.</th>
                                                <th>Orders id</th>
                                                <th>Product name</th>
                                                <th>Quantity</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            
                                            $select = "SELECT * FROM orders";
                                            $query = mysqli_query($conn, $select);
                                            $i = 1;
                                            while ($res = mysqli_fetch_assoc($query)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $res['orders_id'];?></td>
                                                <td><?php echo $res['product_name'];?></td>
                                                <td><?php echo $res['quantity'];?></td>
                                                <td>
                                                    <button data-toggle="modal" data-target="#exampleModal1" class="btn btn-space btn-primary" onclick="edit_orders_detail(<?php echo $res['orders_detail_id'];?>)">Edit</button>
                                                    <button onclick="delete_orders_detail(<?php echo $res['orders_detail_id'];?>)" class="btn btn-space btn-secondary">DELETE</button>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>S. No.</th>
                                                <th>Orders id</th>
                                                <th>Product name</th>
                                                <th>Quantity</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
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
                            Copyright © 2018 Concept. All rights reserved. Dashboard by <a href="https://colorlib.com/wp/">Colorlib</a>.
                        </div>
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
            <h5 class="modal-title">Edit orders</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="edit_orders.php" id="form" method="post" enctype="multipart/form-data">
            <div class="modal-body">
                <div class="card">
                    <h5 class="card-header">Edit orders</h5>
                    <div class="card-body">    
                        <div class="form-group">
                            <label for="inputUsersId">Users id</label>
                            <input id="inputUsersId" type="number" min="1" name="users_id" required="" placeholder="Enter users id" autocomplete="off" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="inputDeliveryDate">Delivery date</label>
                            <input id="inputDeliveryDate" type="date" name="delivery_date" required="" placeholder="Enter delivery date" autocomplete="off" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="inputPaymentMethod">Payment method</label>
                            <select id="inputPaymentMethod" name="payment_method" class="form-control">
                                <option>Cash</option>
                                <option>Card</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputTotalAmount">Total amount</label>
                            <input id="inputTotalAmount" type="number" min="1" name="total_amount" required="" placeholder="Enter total amount" autocomplete="off" class="form-control">
                        </div>
                        <input type="hidden" name="hidden_orders">
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

    <div class="modal fade" id="exampleModal1" data-backdrop="static" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit orders detail</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="edit_orders_detail.php" id="form" method="post" enctype="multipart/form-data">
            <div class="modal-body">
                <div class="card">
                    <h5 class="card-header">Edit orders detail</h5>
                    <div class="card-body">    
                        <div class="form-group">
                            <label for="inputOrdersId">Orders id</label>
                            <input id="inputOrdersId" type="number" min="1" name="orders_id" required="" placeholder="Enter orders id" autocomplete="off" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="inputProductName">Product name</label>
                            <input id="inputProductName" type="text" name="product_name" required="" placeholder="Enter product name" autocomplete="off" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="inputQuantity">Quantity</label>
                            <input id="inputQuantity" type="number" min="1" max="9" name="quantity" required="" placeholder="Enter quantity" autocomplete="off" class="form-control">
                        </div>
                        <input type="hidden" name="hidden_orders_detail">
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
        function edit_orders(orders_id) {
            $.ajax({
                url:'get_orders.php',
                data:'id='+orders_id,
                method:'get',
                dataType:'json',
                success:function(res){
                    console.log(res);
                    $('input[name="users_id"]').val(res.users_id);
                    $('input[name="delivery_date"]').val(res.delivery_date);
                    $('select[name="payment_method"]').val(res.payment_method);
                    $('input[name="total_amount"]').val(res.total_amount);
                    $('input[name="hidden_orders"]').val(res.orders_id);
                }
            })
        }
        function delete_orders(orders_id) {
            var flag = confirm("Do you want to delete?");
            if (flag) {
                window.location.href = "delete_orders.php?orders_id="+orders_id;
            }
        }
        function edit_orders_detail(orders_detail_id) {
            $.ajax({
                url:'get_orders_detail.php',
                data:'id='+orders_detail_id,
                method:'get',
                dataType:'json',
                success:function(res){
                    console.log(res);
                    $('input[name="orders_id"]').val(res.orders_id);
                    $('input[name="product_name"]').val(res.product_name);
                    $('input[name="quantity"]').val(res.quantity);
                    $('input[name="hidden_orders_detail"]').val(res.orders_detail_id);
                }
            })
        }
        function delete_orders_detail(orders_detail_id) {
            var flag = confirm("Do you want to delete?");
            if (flag) {
                window.location.href = "delete_orders_detail.php?orders_detail_id="+orders_detail_id;
            }
        }
    </script>
</body>
 
</html>