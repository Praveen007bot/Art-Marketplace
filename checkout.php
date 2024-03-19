<?php 
    session_start();
    include "includes/header.php";
    
    
    $userID = $_SESSION['id'];


    $sql = "SELECT *, SUM(art_price) AS total_art_price
    FROM cartitem
    WHERE userID = '$userID'
    GROUP BY userID";

    $result = $conn->query($sql);
    
    // Check if the query was successful
    if ($result) {
        // Fetch the result
        $row = $result->fetch_assoc();
    
        // Access the total_art_price value
        $total_art_price = $row['total_art_price'];

         
        $gst = ($total_art_price*18)/100; 
        $Amount = $gst+$total_art_price;    
    }
     
        
    if(isset($_POST['order'])){
        $f_name = $_POST['f_name'];
        $l_name = $_POST['l_name'];        
        $email = $_POST['email'];
        $address = $_POST['address'];
        $country = $_POST['country'];
        $state = $_POST['state'];
        $zipcode = $_POST['zipcode'];
 
        
        $sql = "INSERT INTO checkout(userID, f_name, l_name, email, address, country, state, zipcode, total_amount) VALUES('$userID','$f_name','$l_name','$email','$address','$country','$state','$zipcode','$Amount')";
        $result = $conn->query($sql);

        if ($result) {
            echo "Order inserted successfully";
            $deleteCartItems = "DELETE FROM cartitem WHERE userID = '$userID'";
            $deleteResult = $conn->query($deleteCartItems);
    
            if ($deleteResult) {
                echo "Order inserted successfully, and cart items removed.";
            } else {
                echo "Error removing cart items: " . $conn->error;
            }
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        
    }
?>








<style>
 .lh-condensed { line-height: 1.25; }
</style>

<div class="container" style="max-width: 1200px; padding-top: 3rem!important; padding-bottom: 3rem!important;">
    
    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span >Your cart</span>
                <span class="badge badge-secondary badge-pill">3</span>
            </h4>

            
            <?php 
                $sql = "SELECT *, SUM(art_price) AS total_art_price
                FROM cartitem
                WHERE userID = '$userID'
                GROUP BY userID";
        
                $result = $conn->query($sql);
                
                // Check if the query was successful
                if ($result) {
                    // Fetch the result
                    $row = $result->fetch_assoc();
                
                    // Access the total_art_price value
                    $total_art_price = $row['total_art_price'];

                     
                    $gst = ($total_art_price*18)/100; 
                    $Amount = $gst+$total_art_price;
                                            
                
                    
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            ?>


            <ul class="list-group mb-3 sticky-top">
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                    <span class="text-muted">Total </span>
                        
                    </div>
                    <span class="text-muted">Rs<?php echo number_format($total_art_price,2); ?></span>
                </li>
                
               
                <li class="list-group-item d-flex justify-content-between">
                    <span>Total (Including GST)</span>
                    <strong>Rs<?php echo number_format($Amount,2); ?></strong>
                </li>
            </ul>
            
        </div>
        <div class="col-md-8 order-md-1">
            <h1 class="mb-3">Billing address</h1>
            <form id="paymentForm" action="checkout.php"  method="POST" class="needs-validation" novalidate="">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName">First name</label>
                        <input type="text" class="form-control" id="f_Name" name="f_name" placeholder="" value="" required="">
                        <div class="invalid-feedback"> Valid first name is required. </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">Last name</label>
                        <input type="text" class="form-control" id="l_Name" name="l_name" placeholder="" value="" required="">
                        <div class="invalid-feedback"> Valid last name is required. </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="email">Email </label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com">
                    <div class="invalid-feedback"> Please enter a valid email address for shipping updates. </div>
                </div>
                <div class="mb-3">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St" required="">
                    <div class="invalid-feedback"> Please enter your shipping address. </div>
                </div>
                
                <div class="row">
                    <div class="col-md-5 mb-3">
                        <label for="country">Country</label>
                        <input type="text" class="form-control" id="country" name="country" placeholder="" required="">
                        <div class="invalid-feedback"> Please select a valid country. </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="state">State</label>
                        <input type="text" class="form-control" id="state" name="state" placeholder="" required="">
                        <div class="invalid-feedback"> Please provide a valid state. </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="zip">Zip</label>
                        <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="" required="">
                        <div class="invalid-feedback"> Zip code required. </div>
                    </div>
                </div>    
                <hr class="mb-4">
                <a href="javascript:void(0)" class="btn btn-sm btn-primary float-right buy_now" onclick="pay_now()" data-img="//www.tutsmake.com/wp-content/uploads/2019/03/c05917807.png" data-amount=" <?php echo $Amount; ?>" data-id="1">Pay Now</a> 
                
            </form>
        </div>
    </div>
    
</div>










    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script type="text/javascript">

        function pay_now()
        {
            var name          = ""; // Add Name
            var amount        = "<?php echo $Amount; ?>"; // Get total amount
            var actual_amount = parseInt(amount) * 100;
            var description   = "Art"; // Add description

            var options = {
                "key": "rzp_test_MGWGsjkJ3Kthbl", // Add API Key
                "amount": actual_amount, 
                "currency": "INR",
                "name": name,
                "description": description,
                "image": "", // Add Image
                "handler": function (response){
                    console.log(response);
                    $.ajax({
                        url: 'api/common.php',
                        'type': 'POST',
                        'data': {
                            'action': 'payment',  // Add API Callback
                            'name':name,
                            'user': "<?php echo  $_SESSION['id']; ?>", 
                            'payment_id':response.razorpay_payment_id,
                            'amount':actual_amount,
                            'total':amount,
                            'f_name': $("#f_name").val(),
                            'l_name':$("#l_name").val(),
                            'email':$("#email").val(),
                            'address':$("#address").val(),
                            'country':$("#country").val(),
                            'state':$("#state").val(),
                            'zipcode':$("#zipcode").val(),
                        },
                        success:function(data){
                            console.log(data);
                            window.location.href = 'orders.php'; // Add redirect page
                        }

                    });
                },
            };

            var rzp1 = new Razorpay(options);
            rzp1.on('payment.failed', function (response){
                    alert(response.error.code);
                    alert(response.error.description);
                    alert(response.error.source);
                    alert(response.error.step);
                    alert(response.error.reason);
                    alert(response.error.metadata.order_id);
                    alert(response.error.metadata.payment_id);
            });

            rzp1.open();
        }
    </script>




<?php
include "includes/footer.php";
?>




