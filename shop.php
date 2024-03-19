<?php

  include "includes/header.php";

  $sql = "SELECT * FROM product";
  $all_product = $conn->query($sql);
  $row = $all_product->fetch_assoc();
  $productname = $row['art_name'];
  $productartist = $row['artist_name'];
  $productprice = $row['art_price'];
  $image = $row['art_image'];


?>









    <!-- Start Content -->
    <div class="container py-5">
        <div class="row">

            <div class="col-lg-3">
                <h1 class="h2 pb-4">Categories</h1>
                <ul class="list-unstyled templatemo-accordion">
                    <li class="pb-3">
                        <a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="#">
                            Art
                            <i class="fa fa-fw fa-chevron-circle-down mt-1"></i>
                        </a>
                        
                    </li>
                    
                    <li class="pb-3">
                        <a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="#">
                            Crafts
                            <i class="pull-right fa fa-fw fa-chevron-circle-down mt-1"></i>
                        </a>
                        
                    </li>
                </ul>
            </div>

            <div class="col-lg-9">
                
                <div class="row">

                    <?php
                    while($row = mysqli_fetch_assoc($all_product))
                    {
                    ?>
                    
                    <div class="col-md-4">
                        <div class="card mb-4 product-wap rounded-0">
                            <div class="card rounded-0">
                                <img class="card-img rounded-0 img-fluid" src="<?php echo $row["art_image"];  ?>">
                                <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                    <ul class="list-unstyled">
                                        <li><a class="btn btn-success text-white" href="#" ><i class="far fa-heart"></i></a></li>
                                        <li><a class="btn btn-success text-white mt-2" href="shop-single.php?id=<?php echo $row["id"];  ?>"><i class="far fa-eye"></i></a></li>
                                        <li>
                                            <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                                            <button type="button" class="btn btn-success text-white mt-2 add-to-cart-btn"
                                                    data-id="<?php echo $row['id']; ?>"
                                                    data-art-name="<?php echo $row['art_name']; ?>"
                                                    data-artist-name="<?php echo $row['artist_name']; ?>"
                                                    data-art-price="<?php echo $row['art_price']; ?>"
                                                    data-art-image="<?php echo $row['art_image']; ?>">
                                                <i class="fas fa-cart-plus"></i>
                                            </button>
                                            
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <h3> <a href="shop-single.php" class="h3 text-decoration-none"><?php echo $row["art_name"];  ?></a> </h3>
                                <ul class="w-100 list-unstyled d-flex justify-content-between mb-0">
                                    <li><?php echo $row["artist_name"];  ?></li>
                                    <li class="pt-2">
                                        <span class="product-color-dot color-dot-red float-left rounded-circle ml-1"></span>
                                        <span class="product-color-dot color-dot-blue float-left rounded-circle ml-1"></span>
                                        <span class="product-color-dot color-dot-black float-left rounded-circle ml-1"></span>
                                        <span class="product-color-dot color-dot-light float-left rounded-circle ml-1"></span>
                                        <span class="product-color-dot color-dot-green float-left rounded-circle ml-1"></span>
                                    </li>
                                </ul>
                                
                                <h5 class="text-center mb-0">Rs&nbsp;&nbsp;<?php echo number_format($row["art_price"],2); ?></h5>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                    
                </div>
                <div div="row">
                    <ul class="pagination pagination-lg justify-content-end">
                        <li class="page-item disabled">
                            <a class="page-link active rounded-0 mr-3 shadow-sm border-top-0 border-left-0" href="#" tabindex="-1">1</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link rounded-0 mr-3 shadow-sm border-top-0 border-left-0 text-dark" href="#">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link rounded-0 shadow-sm border-top-0 border-left-0 text-dark" href="#">3</a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
    <!-- End Content -->

    

<!-- At the end of your HTML file, after the jQuery script inclusion -->
<script>
    $(document).ready(function () {
        $('.add-to-cart-btn').on('click', function () {
            // Get the product details from the clicked button's data attributes
            var productId = $(this).data('id');
            var art_name = $(this).data('art-name');
            var artist_name = $(this).data('artist-name');
            var art_price = $(this).data('art-price');
            var art_image = $(this).data('art-image');

            // Send an Ajax request to add the product to the cart
            $.ajax({
                url: 'add_to_cart.php',
                type: 'POST',
                data: {
                    productId: productId,
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




<?php
include "includes/footer.php";
?>