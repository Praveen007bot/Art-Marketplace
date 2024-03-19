<?php
    session_start();
    include "includes/header.php";
    
    $id = $_SESSION["id"];

    $sql = "SELECT * FROM orders WHERE userID = $id";
    $all_product = $conn->query($sql);  

?>
</head>
<body>
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
                    tableBodyHtml += '<td><img src="' + res[i]['art_image'] + '" alt="Art Image" style="max-width: 50px; max-height: 50px;"></td>';
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




