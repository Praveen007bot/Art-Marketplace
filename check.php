<?php
session_start();
include "includes/header.php";

// Check if the user is logged in
if (!isset($_SESSION["id"])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Fetch user details by ID
$id = $_SESSION["id"];
$sql = "SELECT * FROM cartitem WHERE userID = $id";
$result = $conn->query($sql);

// Initialize total amount variable
$totalAmount = 0;

if ($result->num_rows > 0) {
    ?>
    <div class="container mt-4">
        <h2>Order Details</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                <th>cartitemID</th>
                    <th>Art Name</th>
                    <th>Artist Name</th>
                    <th>Amount</th>
                       <th>Status</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop through cart items to display details and calculate total amount
                while ($row = $result->fetch_assoc()) {
                    // Calculate GST and Total Amount for each item
                    $itemPrice = $row["art_price"];
                    $itemGST = ($itemPrice * 18) / 100;
                    $itemTotal = $itemPrice + $itemGST;
                    $cartitemID = $row["cartitemID"];
                    echo "<tr>";
                    echo "<td>" . $row["cartitemID"] . "</td>";
                    echo "<td>" . $row["art_name"] . "</td>";
                    echo "<td>" . $row["artist_name"] . "</td>";
                    echo "<td>" . number_format($itemTotal, 2) . "</td>";
                    echo  "<td>" ;

            

                    if ($row['status'] == 'Accepted') {
                    //   echo '<a href="javascript:void(0)" class="btn btn-sm btn-primary float-right buy_now" data-img="//www.tutsmake.com/wp-content/uploads/2019/03/c05917807.png" data-amount="' . $itemTotal. '" data-id="1">Pay Now</a>';
                      echo '<a href="javascript:void(0)" class="btn btn-sm btn-primary buy_now" data-img="//www.tutsmake.com/wp-content/uploads/2019/03/jhgjhgjg.jpg" data-amount="'.$itemTotal.'" data-id="' . $cartitemID . '"><button class="button-10" role="button" onclick="listview()">Pay Now</button></a>';

                  
                    } elseif ($row['status'] == 'Rejected') {
                      echo '<button class="btn btn-sm btn-danger float-right">Rejected</button>';
                  } else {
                      echo '<button class="btn btn-sm btn-waiting float-right">Paid</button>';
                  }
            
                echo '</td>';

                    echo "</tr>";
                
                
                // else{
                //     echo '<tr><td colspan="7"> No Bookings Found. </td></tr>';
                // }

                    // Update total amount
                    $totalAmount += $itemTotal;
            }
                ?>
            </tbody>
        </table>

        <!-- Display total amount after the table -->
        <!-- <p>Total Amount: <?php echo number_format($totalAmount, 2); ?></p> -->
    </div>

    <!-- Additional checkout form goes here -->

    <?php
} else {
    // Display a message if the cart is empty
    ?>
    <div class="container mt-4">
        <p>Your cart is empty. <a href="shop.php">Continue shopping</a></p>
    </div>
    <?php
}

include "includes/footer.php";
?>
<script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script>
<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>

<script>
  $(document).ready(function() {
    var table = $('#example').DataTable({
        select: false,
        "columnDefs": [{
            "targets": [0],
            "visible": false,
            "searchable": false
        }]
    });

    $('#example tbody').on('click', 'tr', function() {
        alert(table.row(this).data()[0]);
    });
});

</script>
 <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>

  $('body').on('click', '.buy_now', function(e){
    var prodimg = $(this).attr("data-img");
    var totalAmount = $(this).attr("data-amount");
    var product_id =  $(this).attr("data-id");
    var options = {
    "key": "rzp_test_zogp4w4jLlCNCx",
    "amount": (totalAmount*100), // 2000 paise = INR 20
    "name": "Art",
    "description": "Payment",
 
    "handler": function (response){
          $.ajax({
            url: 'payment-proccess.php',
            type: 'post',
            dataType: 'json',
            data: {
                razorpay_payment_id: response.razorpay_payment_id , totalAmount : totalAmount ,product_id : product_id,
            }, 
            success: function (msg) {

               window.location.href = 'https://www.tutsmake.com/Demos/php/razorpay/success.php';
            }
        });
     
    },

    "theme": {
        "color": "#528FF0"
    }
  };
  var rzp1 = new Razorpay(options);
  rzp1.open();
  e.preventDefault();
  });

</script>

<script src=""></script>
<script>
 
  $('body').on('click', '.buy_now', function(e){
    var prodimg = $(this).attr("data-img");
    var totalAmount = $(this).attr("data-amount");
    var product_id =  $(this).attr("data-id");
    var options = {
    "key": "rzp_test_zogp4w4jLlCNCx", // secret key id
    "amount": (totalAmount*100), // 2000 paise = INR 20
    "name": "Art",
    "description": "Payment",
 
    "handler": function (response){
          $.ajax({
            url: 'payment-proccess.php',
            type: 'post',
            dataType: 'json',
            data: {
                razorpay_payment_id: response.razorpay_payment_id , totalAmount : totalAmount ,product_id : product_id,
            }, 
            success: function (msg) {
 
               window.location.href = 'payment-success.php';
            }
        });
      
    },
 
    "theme": {
        "color": "#528FF0"
    }
  };
  var rzp1 = new Razorpay(options);
  rzp1.open();
  e.preventDefault();
  });
 
</script>