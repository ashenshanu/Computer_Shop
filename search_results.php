<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.css">
     <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="icon" type="image/x-icon" href="./assets/favicon.png">
    <title>Sanakin.LK | Trusted Shops</title>
</head>
<?php

require_once "./connectors/db-connector.php";
require_once "./configs/config.php";

 
include "./includes/home-header.php";

include "./controller/search_controller.php";

$searchText = "";
$searchResults = null;

$productResult = null;
$shopResult = null;

if(isset($_GET["search_txt"])){
    $searchText = $_GET["search_txt"];
    $searchResults = search($searchText);

    if(isset($searchResults["productList"])){
        $productResult = $searchResults["productList"];
    }
    if(isset($searchResults["shopList"])){
        $shopResult = $searchResults["shopList"];
    }
    //var_dump($searchResults);
}

include "./controller/product_controller.php";
include "./controller/shop_controller.php";

?>

<body>

    <div class="section hero2-sec">
        <div class="container">
            <div>
                <h2>Search Results for <b><?php echo $searchText?></b></h2>
            </div>
<!--            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">-->
<!--                <div class="carousel-indicators">-->
<!--                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>-->
<!--                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>-->
<!--                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>-->
<!--                </div>-->
<!--                <div class="carousel-inner">-->
<!--                    <div class="carousel-item active">-->
<!--                        <img src="./assets/hero-slides/slide 1.png" class="d-block w-100" alt="...">-->
<!--                    </div>-->
<!--                    <div class="carousel-item">-->
<!--                        <img src="./assets/hero-slides/slide 2.png" class="d-block w-100" alt="...">-->
<!--                    </div>-->
<!--                    <div class="carousel-item">-->
<!--                        <img src="./assets/hero-slides/slide 1.png" class="d-block w-100" alt="...">-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="carousel-caption d-none d-md-block hero-banner-content">-->
<!--                    <div class="row hero-content">-->
<!--                        <h1 class="main-title">Shop Online</h1>-->
<!--                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>-->
<!--                        <div class="search-bar">-->
<!--                            <input type="search" class="search" name="Search" placeholder="Search Here Shop or Product" id="">-->
<!--                            <input type="button" id="search-btn" class="search-btn btn primary" value="Search">-->
<!--                        </div>-->
<!---->
<!--                    </div>-->
<!---->
<!--                </div>-->
                <!-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button> -->
<!--            </div>-->
        </div>
    </div>

    <div class="section products">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section shops">
                        <div class="container baoth-sides-margin-14">
<!--                            <h4 class="section-header">Results by Shops</h4>-->
                            <div id="shopsIndicators" class="carousel slide" data-interval="pause"
                                 data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <div class="row">
                                            <?php
                                            if ($shopResult != null) {
                                                for ($shp = 0; $shp < count($shopResult); $shp++) {
                                                    ?>
                                                    <div class='col-md-3'>
                                                        <div class='card'
                                                             onclick=location.href='./shop-profile.php?id=<?php echo $shopResult[$shp][0] ?>'>
                                                            <img class='shop-profile' onerror="this.src='./assets/products.png'" src='./uploads/shop_images/shop_dp/<?php echo $shopResult[$shp][8]?>' alt=''>
                                                            <div class='text'>
                                                                <h5 class='shop-name'><?php echo $shopResult[$shp][1] ?></h5>
                                                                <h6><span id='product-count'></span> Products</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <br/>
                    <br/>
                <ul id="paginated-list" class="row" data-current-page="1" aria-live="polite">
                    <?php

                    if($productResult != null) {
                        for ($p = 0; $p < count($productResult); $p++) {

                            ?>
                            <li class='card col-md-3'>
                                <div class='product-tile'>
                                    <img class='card-img-top' onerror="this.src='./assets/products.png'" src='uploads/product_images/<?php echo $productResult[$p][10]?>' alt='Card image cap' onclick=location.href='./single-product.php?id=<?php echo $productResult[$p][0]?>'>
                                    <div class='card-body'>
                                        <h5 class='card-title'><?php echo $productResult[$p][1] ?></h5>
                                        <h6>Rs. <span class='card-price'><?php echo $productResult[$p][3] ?></span>
                                        </h6>
                                        <input <?php echo $addCart?> type='button' class='btn primary' value='Add to Cart' onclick="addtoCart('<?php echo $productResult[$p][0]?>',1)">
                                    </div>
                                </div>
                            </li>
                            <?php
                        }
                    }
                    ?>
                </ul>
                </div>

                <nav class="pagination-container justify-content-end">
                    <button class="pagination-button" id="prev-button" title="Previous page" aria-label="Previous page">
                        &lt;
                    </button>

                    <div id="pagination-numbers">
                    </div>

                    <button class="pagination-button" id="next-button" title="Next page" aria-label="Next page">
                        &gt;
                    </button>
                </nav>
            </div>




        </div>
    </div>
    <?php include "./includes/footer.php"; ?>
    <?php include "./includes/home-modals-mapping.php"; ?>
    <script src="./js/bootstrap.js"></script>
    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="./js/tools.js?v=44553"></script>
    <script src="./js/cart.js?v=382333"></script>
    <script src="./js/product-pagination.js"></script>

</body>

</html>