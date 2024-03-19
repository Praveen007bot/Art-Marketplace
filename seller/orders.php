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

    $sql = "SELECT * FROM orders";
    $all_product = $conn->query($sql);  

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
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>



                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header">ORDERS</h5>
                            <div class="card-body">
                                <div class="table-responsive">
        
                                    <table class="table table-hover table-bordered first">
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Total Price</th>
                                                <th>Placed on</th>
                                                <th>View products</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Sample order data -->
                                            <?php
                                                while($row = mysqli_fetch_assoc($all_product))
                                                {
                                                ?>
                                            <tr>
                                                <td><?php echo $row["orderID"];  ?></td>
                                                <td><?php echo $row["f_name"];  ?></td>
                                                <td><?php echo $row["email"];  ?></td>                    
                                                <td><?php echo $row["total_amount"];  ?></td>
                                                <td><?php echo $row["placed_on"];  ?></td>
                                                <td>
                                                
                                                    <button data-toggle="modal" data-target="#myModal" class="btn btn-space btn-dark" onclick="view_orderitems(<?php echo $row['orderID'];?>)">View Products</button>
                                                </td>
                                            </tr>
                                            <?php
                                                }
                                                ?>
                                            
                                            <!-- Add more rows as needed -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

    <script>
function view_orderitems(orderID) {
    $.ajax({
        url: 'view_orderitems.php',
        data: 'orderID=' + orderID,
        method: 'get',
        dataType: 'json',
        success: function (res) {
            if (res.length > 0) {
                var tableBodyHtml = '';

                for (var i = 0; i < res.length; i++) {
                    tableBodyHtml += '<tr>';
                    tableBodyHtml += '<td>' + res[i]['orderitemID'] + '</td>';
                    tableBodyHtml += '<td>' + res[i]['art_name'] + '</td>';
                    tableBodyHtml += '<td>' + res[i]['artist_name'] + '</td>';
                    tableBodyHtml += '<td>' + res[i]['art_price'] + '</td>';
                    tableBodyHtml += '<td><img src="../'+ res[i]['art_image'] + '" alt="Art Image" style="max-width: 50px; max-height: 50px;"></td>';
                    tableBodyHtml += '</tr>';
                }

                // Display the dynamically generated table rows
                $('#orderItemsTableBody').html(tableBodyHtml);
                $('#myModal').modal('show');
            } else {
                console.log('No items found for the order.');
            }
        }
    });
}
</script>


    <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Order Items</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="myModalBody">

            
                <!-- Display the table here -->

                <div class="card">
                    <h5 class="card-header">Order Items</h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Orderitem ID</th>
                                <th>Art Name</th>
                                <th>Artist Name</th>
                                <th>Art price</th>
                                <th>Art image</th>
                                
                            </tr>
                        </thead>
                        <tbody  id="orderItemsTableBody">
                            
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</body>







<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>







<!-- Include Bootstrap CSS -->

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Include Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>




