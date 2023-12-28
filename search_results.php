<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="icon" type="image/x-icon" href="./assets/favicon.png">
    <title>Mr.PC | Trusted Shops</title>
</head>
<?php

require_once "./connectors/db-connector.php";
require_once "./configs/config.php";

include "./includes/home-navigation.php";
// include "./includes/home-header.php";

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
        </div>
    </div>

    <div class="section products">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section shops">
                        <div class="container baoth-sides-margin-14">
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
                                                            <img class='shop-profile' onerror="this.src='./assets/product.jpg'" src='./uploads/shop_images/shop_dp/<?php echo $shopResult[$shp][8]?>' alt=''>
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
                                <div class="f-card-boader">
                                    <img class='card-img-top' onerror="this.src='./assets/product.jpg'" src='uploads/product_images/<?php echo $productResult[$p][10]?>' alt='Card image cap' onclick=location.href='./single-product.php?id=<?php echo $productResult[$p][0]?>'>
                                    <div class='card-body'>
                                        <h5 class='card-title'><?php echo $productResult[$p][1] ?></h5>
                                        <h6>Rs. <span class='card-price'><?php echo $productResult[$p][3] ?></span>
                                        </h6>
                                        <input <?php echo $addCart?> type='button' class='btn primary' value='Add to Cart' onclick="addtoCart('<?php echo $productResult[$p][0]?>',1)">
                                    </div>
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
    <?php include "./includes/home-footer.php"; ?>
    <?php include "./includes/home-modals-mapping.php"; ?>
    <script src="./js/bootstrap.js"></script>
    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="./js/tools.js?v=44553"></script>
    <script src="./js/cart.js?v=382333"></script>
    <script src="./js/product-pagination.js"></script>

</body>

</html>