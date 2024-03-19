<?php 
    define('Access', TRUE);

    //START SESSION
    include "./AdditionalPHP/startSession.php";

    //CONNECTION TO DATABASE : cakeshop
    include_once 'connection.php';

    
?>


  

<?php

if(!isset($_SESSION['id'])){

    if($_GET['id'] == "") {
        echo "NO $-GET['id'] value ";
    }
    else {
        $_SESSION['id']= $_GET['id'];
    }
}
else {
    //if session is defined and get is undefined
    if($_GET['id'] == "") {
        //carry on with program.. session value does not change
    }
    else { //if session is defined and get is not empty
        $_SESSION['id'] = $_GET['id'];
    }
}

// BASIC MYSQL QUERIES
if(isset($_SESSION['name'])){

    //set session for id
    $Q_fetch_id = 'SELECT id FROM signup WHERE name = "'. $_SESSION['name'].'"';
    $run_fetch_id = mysqli_query($conn, $Q_fetch_id);
    $result = mysqli_fetch_array($run_fetch_id);
    $_SESSION['id'] = $result[0];

    //give cartID to user
    $Q_select_user_in_cart = 'SELECT * FROM cart WHERE id = '.$_SESSION['id'];
    $run_select_user_in_cart = mysqli_query($conn, $Q_select_user_in_cart);
    $count_user_in_cart = mysqli_num_rows($run_select_user_in_cart);
    
    //create cartID for user only once
    if( $count_user_in_cart==0){
        $Q_insert_into_cart = 'INSERT INTO cart (id) VALUES ('.$_SESSION['id'].')';
        $run_insert_into_cart = mysqli_query($conn, $Q_insert_into_cart);   
    }

    //set session for cartID
    $Q_fetch_cartID = 'SELECT cartID FROM cart WHERE id ='.$_SESSION['id'];
    $run_fetch_cartID = mysqli_query($conn, $Q_fetch_cartID);
    $result2 = mysqli_fetch_array($run_fetch_cartID);
    $_SESSION['cartID'] = $result2[0];
   

}





//check if Add to Cart button has been submitted
if(filter_input(INPUT_POST, 'add-to-cart')){
    if(isset($_SESSION['shopping_cart'])){

        //keep track of how many product are in shopping cart
        $count = count($_SESSION['shopping_cart']);

        //create sequential array for matching array keys to product ids
        $ids = array_column($_SESSION['shopping_cart'], 'id');

            if(!in_array($_GET['id'], $ids)){//** */
                $_SESSION['shopping_cart'][$count] = array

                (
                    'id' => $_GET['id'], //GET used since id is provided in URL -filter_input(INPUT_GET, 'id')
                    'name' => filter_input(INPUT_POST, 'name'),
                    'price' => filter_input(INPUT_POST, 'price'),
                    'quantity' => filter_input(INPUT_POST, 'input_quantity')
                ); 

                //INSERT CART ITEM DETAILS TO TABLE cartitem
                $Q_insert_into_cartitem = 'INSERT INTO cartitem (id, cartID, price, quantity) 
                VALUES ('.$_SESSION['id'].','.$_SESSION['cartID'].','.filter_input(INPUT_POST, 'price').','.filter_input(INPUT_POST, 'input_quantity').' )';
                $run_insert_into_cartitem = mysqli_query($conn, $Q_insert_into_cartitem);
            }
            else {//product already exist, increase quantity

                //match array key to id of product being added to the cart
                for($i=0; $i<count($ids); $i++){
                    if($ids[$i] ==  $_GET['id']){
                    //filter_input(INPUT_GET, 'id')){
                        //add item quantity from form to the existing product in the array
                        // $_SESSION['shopping_cart'][$i]['quantity'] += filter_input(INPUT_POST, 'input-quantity');
                        $_SESSION['shopping_cart'][$i]['quantity'] += $_POST['input_quantity'];

                        //UPDATE QUERY IN TABLE cartitem
                        $Q_update_cartitem = 'UPDATE cartitem SET quantity = '.$_SESSION['shopping_cart'][$i]['quantity'].' 
                        WHERE id = '.$_GET['id'];
                        $run_update_cartitem = mysqli_query($conn, $Q_update_cartitem);
                    }
                }
            }
    }
    else { //if shopping cart does not exist, create first product with array key 0
        //create array using submitted form data, start from key 0 and fill it with values
        $_SESSION['shopping_cart'][0] = array

        (
            'id' => $_GET['id'], //GET used since id is provided in URL - filter_input(INPUT_GET, 'id')
            'name' => filter_input(INPUT_POST, 'name'),
            'price' => filter_input(INPUT_POST, 'price'),
            'quantity' => filter_input(INPUT_POST, 'input_quantity')
        );


        //INSERT CART ITEM DETAILS TO TABLE cartitem
        $Q_insert_into_cartitem = 'INSERT INTO cartitem (id, cartID, price, quantity) 
        VALUES ('.$_GET['id'].','.$_SESSION['cartID'].','.filter_input(INPUT_POST, 'price').','.filter_input(INPUT_POST, 'input_quantity').' )';
        $run_insert_into_cartitem = mysqli_query($conn, $Q_insert_into_cartitem);
    }

}

//pre_r($_SESSION);

function pre_r($array){
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <title>MALAKO | Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!--========== CSS FILES ==========-->
    <link rel="stylesheet" type="text/css" href="Common.css">
    <link rel="stylesheet" type="text/css" href="Sanjana.css">
    <link href="jquery.nice-number.css" rel="stylesheet">
    <!--========== JQUERY CDN ==========-->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="jquery.nice-number.js"> </script>
    <script type="text/javascript"> 
    <link rel="apple-touch-icon" href="assets/img/apple-icon.png">
    
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/templatemo.css">
    <link rel="stylesheet" href="assets/css/custom.css">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">

    $(function(){
        $('input[type="number"]').niceNumber();
    });
    </script>


    <!--========== BOOTSTRAP ==========-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    
    <?php
    //CART QUANTITY VALUE
    include_once 'numOfItemsInCart.php';
    ?>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/0e16635bd7.js" crossorigin="anonymous"></script>
    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!--========== BOXICONS ==========-->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    </head>

    <body>
          <!--========== PHP QUERIES ==========-->
        <?php 
                
            $Q_fetch_featured = "SELECT * FROM product INNER JOIN product_type ON product.id = product_type.id WHERE product_type.typeID = 2"; //selects featured product
            $Q_fetch_new = "SELECT * FROM product INNER JOIN product_type ON product.id = product_type.id WHERE product_type.typeID = 1"; //selects new product
            $Q_fetch_product_details = "SELECT * FROM product INNER JOIN product_type ON product.id = product_type.id WHERE product_type.typeID = 2"; //selects product with id =1

        ?>


        <!--========== HEADER ==========-->
        <?php $page = 'product'?>
        <!--Start Navigation Bar-->
        


       


        <!--========== PHP FETCH PRODUCT DETAILS ==========-->

        <?php
             if(isset($_GET['id'])){ //if(isset($_GET['id'])){
                $id = $_GET['id'];
                
                //******* start get product details *******
                //query
                $Q_get_product = "SELECT * FROM product WHERE id = '$id'";
                //run query
                $run_get_product = mysqli_query($conn, $Q_get_product);
                //store details in array
                $row_product = mysqli_fetch_array($run_get_product);
                //******* end get product details *******

                //******* start get product type *******
                

                //declare variables for all column headers
                $art_name = $row_product['art_name'];
                $artist_name = $row_product['artist_name'];
                $art_image = $row_product['art_image'];
                $art_price = $row_product['art_price'];
                            
            }
            
            else{

            }
        ?>

        <!--PRODUCT DETAILS GRID-->
        
        <div class="container mx-auto mt-0 pt-0 ">
            <!-- <form method="POST" action="index.php?action=add&id=<?php //echo $id; ?>"> -->
                <div class="row continue-shop-div text-center">
                    <a href="product.php" class="button continue" id="cat-but" >Continue</a>
                    <!-- <button class="dropbtn button" id="cat-but"></button> -->
                </div>
                <div class="row">
                    <div class="col-md mt-4 mx-auto ">
                        <img src="<?php echo $art_image;?>" class="product-image" />
                    </div>
                    <div class="col mt-4">
                        <h1><?php echo $art_name;?></h1>
                        <h2>Rs <?php echo $art_price;?></h2>
                        <!-- INPUT QUANTITY -->
                        <form id="form-pd" method="POST" action="product.php?action=add&id=<?php echo $id; ?>">
                            <div class="box my-4">
                                <label class="subtitle" style="margin-left: 2.7rem; 
                                margin-bottom: .8rem; font-weight: 700; color: grey; ">Quantity</label><br>
                                <input type="number" value="1" min="1" max="100" name= "input_quantity" id= "input_quantity" class="input-quantity mx-2 p-3 px-4">
                                <input type="hidden" name="name" value="<?php echo $art_name;?>" />
                                <input type="hidden" class="show_id" name="id_id" value="<?php echo $id;?>" />
                                <input type="hidden" name="price" value="<?php echo $art_price;?>" /> <br>
                                <input type="submit" name="add-to-cart" id="add-to-cart-btn" value="Add to Cart" class="btn btn-primary btn-lg my-4 button" />

                            </div>
                        </form>
                        <!-- <div>
                            <a href="product.php" class="continue-shop">Continue shopping</a>
                        </div> -->
                        <!-- <button type="button" class="btn btn-primary btn-lg my-4 button">Add to cart</button> -->
                    </div>
                </div>
                <div class="row">
                    <div class="product-description my-3">
                        <div class="description">
                            <h2>description</h2>
                        </div>
                        <div class="para_details py-2 px-4 my-3 ">
                            <p>
                                <?php echo $artist_name;?>
                            </p>
                        </div>
                    </div>
                </div>

            <!-- </form> -->

        </div>

        <!-- <script src="Javascript\main.js?<?php //echo filemtime('Javascript\main.js'); ?>" ></script> -->
    </body>
    <!-- Start Script -->
    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/templatemo.js"></script>
    <script src="assets/js/custom.js"></script>
    <!-- End Script -->
</html>