<?php
$shopID =$_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="icon" type="image/x-icon" href="./assets/favicon.png">
    <title>Sanakin.LK | Trusted Shops</title>
</head>
<?php

require_once "./connectors/db-connector.php";
require_once "./configs/config.php";

include "./includes/home-navigation.php";
include "./includes/home-header.php";

include "./controller/product_controller.php";
include "./controller/shop_controller.php";


$shopData = getShopById($shopID);
$productByShopId = getProductByShopId($shopID);
//var_dump($shopData);
?>

<body>
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="shop-header col-md-12">
                    <img id="shop-banner" onerror="this.src='./assets/products.png'" src="./uploads/shop_images/shop_banner/<?php echo $shopData['dp_banner'];?>" alt="">

                </div>
                <div class="shop-info">
                    <div class="col-md-4">
                        <img id="shop-dp" onerror="this.src='./assets/products.png'" src="./uploads/shop_images/shop_dp/<?php echo $shopData['dp_logo'];?>" alt="">
                    </div>
                    <div class="right col-md-8">
                        <div class="shop-details">
                            <div class="shopper">
                            <h1><?php echo $shopData["shop_name"];?></h1>
                            <div class="dr-tag"><span id="dr">9.6</span> DR</div>
                        </div>
                        <div class="star-rate">
                            <img src="./assets/icons/star1.svg" alt="">
                            <img src="./assets/icons/star1.svg" alt="">
                            <img src="./assets/icons/star1.svg" alt="">
                            <img src="./assets/icons/star1.svg" alt="">
                            <img src="./assets/icons/star1.svg" alt="">
                            <p id="shop-id">#<?php echo"$shopID"; ?></p>
                        </div>

                        </div>
                        <button id="report-opt" onclick="$('#send-complaint-modal').modal('show');">Report This</button>
                    </div>


                </div>
<div class="shop-description">
    <h3>Nature of Business</h3>
    <p id="description"><?php echo $shopData["nb_description"];?></p>
</div>
            </div>
        </div>
    </div>
    <div class="section products">
        <div class="container">
            <h2 class="section-header">Products</h2>
            <div class="row">

                <div class="col-md-12">
                <ul id="paginated-list" class="row" data-current-page="1" aria-live="polite"  style="padding-left: 0px !important;">
                    <?php
                    $productByShopId = getProductsByShopId($shopID);
                    if($productByShopId != null) {
                        for ($besD = 0; $besD < count($productByShopId); $besD++) {

                            ?>
                            <li class='card col-md-3'>
                                <div class='product-tile'>
                                    <img class='card-img-top' onerror="this.src='./assets/products.png'" src='uploads/product_images/<?php echo $productByShopId[$besD][10]?>' alt='Card image cap' onclick=location.href='./single-product.php?id=<?php echo $productByShopId[$besD][0]?>'>
                                    <div class='card-body'>
                                        <h5 class='card-title'><?php echo $productByShopId[$besD][1]?></h5>
                                        <h6>Rs. <span class='card-price'><?php echo number_format((float)$productByShopId[$besD][3], 2, '.', ',');?></span></h6>
                                        <input type='button' class='btn primary' value='Add to Cart' onclick="addtoCart('<?php echo $productByShopId[$besD][0]?>',1)" <?php echo $addCart?>>
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














    <?php include "./includes/home-modals-mapping.php"; ?>
    <?php include "./includes/home-footer.php"; ?>
    <?php include "./modals/send-complaint.php"; ?>
    <script src="https://code.jquery.com/jquery-3.6.3.slim.min.js" integrity="sha256-ZwqZIVdD3iXNyGHbSYdsmWP//UBokj2FHAxKuSBKDSo=" crossorigin="anonymous"></script>
    <script src="./js/bootstrap.js"></script>
    <script src="./js/bootstrap.bundle.min.js"></script>    
    <script src="./js/product-pagination.js"></script>
    <script src="./js/cart.js"></script>
    <script src="./js/tools.js?v=44432"></script>
</body>

</html>