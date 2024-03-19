<?php
    session_start();
    unset($_SESSION['productItems']);
    include "includes/header.php";
?>

<?php
    // Check if the user ID is provided in the query parameter
    

        // Query to fetch user details by ID
        $id = $_SESSION["id"];
        $sql = "SELECT * FROM cartitem WHERE userID = $id";
        $result = $conn->query($sql);
        
        $productDetailsArray = array();

        if (!isset($_SESSION['productItems'])) {
            
            $_SESSION['productItems'] = array();
        }
        if ($result->num_rows > 0) {
            $total = 0;
            
            ?>

                
         <section class="h-100 gradient-custom">
            <form action="cart.php" method="POST" enctype="multipart/form-data">
                <div class="container py-5">
                    <div class="row d-flex justify-content-center my-4">
                        <div class="col-md-8">
                            <div class="card mb-4">
                                <div class="card-header py-3">
                                    <h5 class="mb-0">My Cart</h5>
                                </div>
                                <div class="card-body">
                                    <!-- Single item -->
                                    <?php
                                    while ($row = $result->fetch_assoc()) {
                                        $productData = [
                                            'productID' => $row['productID'],
                                            'art_name' => $row['art_name'],
                                            'artist_name' => $row['artist_name'],
                                            'art_price' => $row['art_price'],
                                            'art_image' => $row['art_image'],
                                           ];
                            
                                           array_push($_SESSION['productItems'],$productData);
                                    ?>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                                                <!-- Image -->
                                                <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
                                                    <img src="<?php echo $row["art_image"]; ?>" class="w-100" />
                                                    <a href="#!">
                                                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                                                    </a>
                                                </div>
                                                <!-- Image -->
                                            </div>

                                            <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                                                <!-- Data -->
                                                <p><strong><?php echo $row["art_name"]; ?></strong></p>
                                                <p>Artist Name:<?php echo $row["artist_name"]; ?> </p>

                                                <button type="button" class="btn btn-danger btn-sm me-1 mb-2 remove-item-btn" data-mdb-toggle="tooltip" title="Remove item" data-product-id="<?php echo $row['cartitemID']; ?>">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                
                                                <!-- Data -->
                                            </div>

                                            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                                                <!-- Price -->
                                                <p class="text-start text-md-center">
                                                    <strong>Rs&nbsp;&nbsp;<?php echo number_format($row["art_price"],2); ?></strong>
                                                </p>
                                                <!-- Price -->
                                            </div>
                                        </div>
                                        <hr class="my-4" />
                                        <?php
                                            $total += $row["art_price"]; 
                                            
                                        ?> 
                                    <?php
                                    }
                                    ?>
                                    <!-- Single item -->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-4">
                                <div class="card-header py-3">
                                    <h5 class="mb-0">Summary</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                            Products
                                            <span> Rs&nbsp;&nbsp;<?php echo number_format($total,2); ?></span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                            Shipping
                                            <span>Gratis</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                            <div>
                                                <strong>Total amount</strong>
                                                <strong>
                                                    <p class="mb-0">(including GST)</p>
                                                </strong>
                                                
                                            </div>
                                            <?php 
                                                $gst = ($total*18)/100; 
                                                $Amount = $gst+$total;
                                            ?>
                                            <span><strong>Rs&nbsp;&nbsp;<?php echo number_format($Amount,2); ?></strong></span>
                                        </li>
                                    </ul>

                                    <a class="btn btn-sm btn-primary" href="checkout.php"> <button type="button" class="btn btn-primary btn-lg btn-block">
                                        checkout
                                    </button></a>
                                    <input type="hidden" id="totalAmount" name="amount" value="<?php echo number_format($Amount, 2); ?>">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>

                   



<?php
        }
    
        else {
            ?>
            
            <div class="container-fluid  mt-50">
            <div class="row">
            
               <div class="col-md-12">
               
                       <div class="card">
                   <div class="card-header">
                   
                   </div>
                   <div class="card-body cart">
                           <div class="col-sm-12 empty-cart-cls text-center">
                               <img src="https://i.imgur.com/dCdflKN.png" width="130" height="130" class="img-fluid mb-4 mr-3">
                               <h3><strong>Your Cart is Empty</strong></h3>
                               <h4>Add something to make me happy :)</h4>
                               <a href="shop.php" class="btn btn-primary cart-btn-transform m-3" data-abc="true">continue shopping</a>
                               
                           
                           </div>
                   </div>
           </div>
                   
               
               </div>
            
            </div>
           
           </div>
           <?php

        }
    
    

    $conn->close();
?>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Add click event listener to all "Remove item" buttons
        var removeButtons = document.querySelectorAll('.remove-item-btn');
        
        removeButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                // Extract product ID from the data attribute
                var productId = button.getAttribute('data-product-id');
                
                // Send asynchronous request to the server to remove the item
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'remove_item.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                
                // Send the product ID to the server
                xhr.send('cartitemID=' + productId);
                
                // Handle the response from the server (you can update the cart display if needed)
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        // Handle the response (if needed)
                        // For example, you can reload the page to reflect the changes
                        location.reload();
                    }
                };
            });
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('button[name="add-to-cart-btn"]').on('click', function () {
            var productID = "<?php echo $productID; ?>";
            var art_name = "<?php echo $art_name; ?>";
            var artist_name = "<?php echo $artist_name; ?>";
            var art_price = "<?php echo $art_price; ?>";
            var art_image = "<?php echo $art_image; ?>";

            $.ajax({
                url: 'add_to_cart.php',
                type: 'POST',
                data: {
                    productID : productID,
                    art_name: art_name,
                    artist_name: artist_name,
                    art_price: art_price,
                    art_image: art_image
                },
                success: function (response) {
                    alert('Product added to cart!');
                },
                error: function (error) {
                    alert('Error adding product to cart.');
                }
            });
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
    "key": "rzp_test_v2uRVdVdpyEH96",
    "amount": (totalAmount*100), // 2000 paise = INR 20
    "name": "Tutsmake",
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
    "key": "rzp_test_v2uRVdVdpyEH96", // secret key id
    "amount": (totalAmount*100), // 2000 paise = INR 20
    "name": "Tutsmake",
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


<style>
    @import url(http://fonts.googleapis.com/css?family=Calibri:400,300,700);

body {
    background-color: #eee;
    font-family: 'Calibri', sans-serif !important;
}

.mt-100{
   margin-top:100px;

}


.card {
    margin-bottom: 30px;
    border: 0;
    -webkit-transition: all .3s ease;
    transition: all .3s ease;
    letter-spacing: .5px;
    border-radius: 8px;
    -webkit-box-shadow: 1px 5px 24px 0 rgba(68,102,242,.05);
    box-shadow: 1px 5px 24px 0 rgba(68,102,242,.05);
}

.card .card-header {
    background-color: #fff;
    border-bottom: none;
    padding: 24px;
    border-bottom: 1px solid #f6f7fb;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
}

.card-header:first-child {
    border-radius: calc(.25rem - 1px) calc(.25rem - 1px) 0 0;
}



.card .card-body {
    padding: 30px;
    background-color: transparent;
}

.btn-primary, .btn-primary.disabled, .btn-primary:disabled {
    background-color: #4466f2!important;
    border-color: #4466f2!important;
}

</style>

<?php
include "includes/footer.php";
?>