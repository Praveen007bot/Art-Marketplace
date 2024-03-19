<?php
    include "includes/header.php";
?>
<?php
    // Check if the user ID is provided in the query parameter
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Query to fetch user details by ID
        $sql = "SELECT * FROM product WHERE productID = $id";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $productID = $id;
            $productname = $row['art_name'];
            $productartist = $row['artist_name'];
            $productprice = $row['art_price'];
            $image = $row['art_image'];

            if (isset($_GET['id'])) {
                $id = $_GET['id'];

                //******* start get product details *******
                //query
                $Q_get_product = "SELECT * FROM product WHERE productID = '$id'";
                //run query
                $run_get_product = mysqli_query($conn, $Q_get_product);
                //store details in array
                $row_product = mysqli_fetch_array($run_get_product);
                //******* end get product details *******

                //******* start get product type *******

                //declare variables for all column headers
                $productID = $id;
                $art_name = $row_product['art_name'];
                $artist_name = $row_product['artist_name'];
                $art_image = $row_product['art_image'];
                $art_price = $row_product['art_price'];
            }
            else {
                // Handle the case when ID is not set
            }
            ?>
            
                <section class="bg-light">
                    <form action="shop-single.php" method="POST" enctype="multipart/form-data">
                        <div class="container pb-5">
                            <div class="row">
                                <div class="col-lg-5 mt-5">
                                    <div class="card mb-3">
                                        <img class="card-img img-fluid" src="<?php echo $row["art_image"]; ?>" alt="Card image cap" id="product-detail">
                                    </div>
                                </div>
                                <div class="col-lg-7 mt-5">
                                    <div class="card">
                                        <div class="card-body">
                                            <h1 class="h2"><?php echo $row["art_name"]; ?></h1>
                                            <p class="h3 py-2">Rs&nbsp;&nbsp;<?php echo number_format($row["art_price"],2); ?></p>
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <h6>Artist name:</h6>
                                                </li>
                                                <li class="list-inline-item">
                                                    <p class="text-muted"><strong><?php echo $row["art_name"]; ?></strong></p>
                                                </li>
                                            </ul>
                                            <div class="row pb-3"> 
                                                <div class="col d-grid">
                                                    <input type="hidden" name="product_id" value="<?php echo $row['productID']; ?>">
                                                    <button type="button" class="btn btn-success btn-lg" name="add-to-cart-btn" value="Add to Cart">Add To Cart</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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
                    productID:productID,
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
                </section>
            </body>
            </html>
            <?php
        } else {
            echo 'User not found.';
        }
    } else {
        echo 'User ID not provided.';
    }

    $conn->close();
?>
