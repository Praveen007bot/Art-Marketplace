<?php
    include "includes/header.php";
  

    $sql = "SELECT * FROM new_release";
    $all_product = $conn->query($sql);


?>






    <!-- Start Banner Hero -->
    <div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="1"></li>
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                            <img class="img-fluid" src="./assets/img/banner_img_01.jpg" alt="">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left align-self-center">
                                <h1 class="h1 text-success">The Starry Night</h1>
                                <h3 class="h2">by Vincent Van Gogh</h3>
                                <p>
                                    Get a museum-quality reproduction of The Starry Night by Vincent Van Gogh, hand-painted in oil by a master artist. 
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                            <img class="img-fluid" src="./assets/img/banner_img_02.jpg" alt="">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left">
                                <h1 class="h1">The Girl With A Pearl Earring</h1>
                                <h3 class="h2">by Johannes Vermeer</h3>
                                <p>
                                    Get a museum-quality reproduction of The Girl With A Pearl Earring by Johannes Vermeer, hand-painted in oil by a master artist.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                            <img class="img-fluid" src="./assets/img/banner_img_03.jpg" alt="">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left">
                                <h1 class="h1">Tropical Forest Tassel Bracelet</h1>
                                <h3 class="h2">Premium threads, Metal coins</h3>
                                <p>
                                    This Handcrafted Bracelet spells oomph with a dash of quirk. It is accented with tassels in soothing multicolor hues and danglers inscribed with artisanal motifs. Enhance your fusion wear outfit with this bohemian pastel braided Bracelet perfect for summer parties and outdoor events.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="prev">
            <i class="fas fa-chevron-left"></i>
        </a>
        <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="next">
            <i class="fas fa-chevron-right"></i>
        </a>
    </div>
    <!-- End Banner Hero -->


    <!-- Start Categories of The Month -->
    <section class="container py-5">
        <div class="row text-center pt-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1">New Release</h1>
                <p>
                    New but vibrant.
                </p>
            </div>
        </div>
        <div class="row">
        <?php
            while($row = mysqli_fetch_assoc($all_product))
            {
        ?>
            <div class="col-md-3">
                <div class="card mb-4 product-wap rounded-0">
                    <div class="card rounded-0">
                        <img class="card-img rounded-0 img-fluid" src="<?php echo $row["product_image"];  ?>">
                        <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                            <ul class="list-unstyled">
                                <li><a class="btn btn-success text-white" href="#"><i class="far fa-heart"></i></a></li>
                                <li><a class="btn btn-success text-white mt-2" href="shop-single.php?id=<?php echo $row["id"];  ?>"><i class="far fa-eye"></i></a></li>
                                <li><a class="btn btn-success text-white mt-2" href="#"><i class="fas fa-cart-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <a href="shop-single.html" class="h3 text-decoration-none"><?php echo $row["product_name"];  ?></a>
                        <ul class="w-100 list-unstyled d-flex justify-content-between mb-0">
                            <li><?php echo $row["product_description"];  ?></li>
                            <li class="pt-2">
                                <span class="product-color-dot color-dot-red float-left rounded-circle ml-1"></span>
                                <span class="product-color-dot color-dot-blue float-left rounded-circle ml-1"></span>
                                <span class="product-color-dot color-dot-black float-left rounded-circle ml-1"></span>
                                <span class="product-color-dot color-dot-light float-left rounded-circle ml-1"></span>
                                <span class="product-color-dot color-dot-green float-left rounded-circle ml-1"></span>
                            </li>
                        </ul>
                        
                        <h5 class="text-center mb-0"><?php echo $row["product_price"];  ?></h5>
                    </div>
                </div>
            </div>
        <?php
            }
        ?>
        </div>
        <div class="row text-center pt-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1">Categories of The Month</h1>
                <p>
                    Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                    deserunt mollit anim id est laborum.
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-4 p-5 mt-3">
                <a href="#"><img src="./assets/img/category_img_01.jpg" class="rounded-circle img-fluid border"></a>
                <h5 class="text-center mt-3 mb-3">Art works</h5>
                <p class="text-center"><a class="btn btn-success">Go Shop</a></p>
            </div>
            <div class="col-12 col-md-4 p-5 mt-3">
                <a href="#"><img src="./assets/img/category_img_02.jpg" class="rounded-circle img-fluid border"></a>
                <h2 class="h5 text-center mt-3 mb-3">Paints</h2>
                <p class="text-center"><a class="btn btn-success">Go Shop</a></p>
            </div>
            <div class="col-12 col-md-4 p-5 mt-3">
                <a href="#"><img src="./assets/img/category_img_03.jpg" class="rounded-circle img-fluid border"></a>
                <h2 class="h5 text-center mt-3 mb-3">Handmade crafts</h2>
                <p class="text-center"><a class="btn btn-success">Go Shop</a></p>
            </div>
        </div>
    </section>
    <!-- End Categories of The Month -->


    <!-- Start Featured Product -->
    <section class="bg-light">
        <div class="container py-5">
            <div class="row text-center py-3">
                <div class="col-lg-6 m-auto">
                    <h1 class="h1">Featured Product</h1>
                    <p>
                        Reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                        Excepteur sint occaecat cupidatat non proident.
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-4 mb-4">
                    <div class="card h-100">
                        <a href="shop-single.php">
                            <img src="./assets/img/feature_prod_01.jpg" class="card-img-top" alt="...">
                        </a>
                        <div class="card-body">
                            <ul class="list-unstyled d-flex justify-content-between">
                                
                                <li class="text-muted text-right">2240.00</li>
                            </ul>
                            <a href="shop-single.php" class="h2 text-decoration-none text-dark">Meditative Buddha</a>
                            <p class="card-text">
                                By Maadhvan Goyal
                            </p>
                            <p class="text-muted">Reviews (24)</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-4">
                    <div class="card h-100">
                        <a href="shop-single.php">
                            <img src="./assets/img/feature_prod_02.jpg" class="card-img-top" alt="...">
                        </a>
                        <div class="card-body">
                            <ul class="list-unstyled d-flex justify-content-between">
                                
                                <li class="text-muted text-right">10000.00</li>
                            </ul>
                            <a href="shop-single.html" class="h2 text-decoration-none text-dark">A Street In Kerala.</a>
                            <p class="card-text">
                                This watercolour painting done in a street in Trivandrum, Kerala.
                            </p>
                            <p class="text-muted">Reviews (48)</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-4">
                    <div class="card h-100">
                        <a href="shop-single.html">
                            <img src="./assets/img/feature_prod_03.jpg" class="card-img-top" alt="...">
                        </a>
                        <div class="card-body">
                            <ul class="list-unstyled d-flex justify-content-between">
                                
                                <li class="text-muted text-right">3600.00</li>
                            </ul>
                            <a href="shop-single.html" class="h2 text-decoration-none text-dark">Banaras Ghat-12</a>
                            <p class="card-text">
                                Acrylic colors are used in this painting . Strokes have been given by knife
                            </p>
                            <p class="text-muted">Reviews (74)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Featured Product -->

<?php
include "includes/footer.php";
?>