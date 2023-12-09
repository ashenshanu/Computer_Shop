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


include "./controller/product_controller.php";
include "./controller/shop_controller.php";
?>

<body>

    <div class="section hero2-sec">
        <div class="container">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="./assets/hero-slides/slide 1.png" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="./assets/hero-slides/slide 2.png" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="./assets/hero-slides/slide 1.png" class="d-block w-100" alt="...">
                    </div>
                </div>
                <div class="carousel-caption d-none d-md-block hero-banner-content">
                    <div class="row hero-content">
                        <h1 class="main-title page-title">What's New to Marcket</h1>
                        <p>Let us take care of all your shopping needs!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section products">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                <ul id="paginated-list" class="row" data-current-page="1" aria-live="polite"  style="padding-left: 0px !important;">
                    <?php
                    $newProductsList = getNewProducts();
                    if(count($newProductsList)<40){
                        $maxCount = count($newProductsList);
                    }else{
                        $maxCount = 40;
                    }

                    if($newProductsList != null) {
                        for ($besD = 0; $besD < $maxCount; $besD++) {

                            ?>
                            <div class='card col-md-4'>
                                <div class='product-tile'>
                                <div class="f-card-boader">
                                    <img class='card-img-top' onerror="this.src='./assets/products.png'" src='uploads/product_images/<?php
                                    echo $newProductsList[$besD][10]?>' alt='Card image cap' onclick=location.href='./single-product.php?id=<?php echo $newProductsList[$besD][0]?>'>
                                    <div class='card-body'>
                                        <h5 class='card-title'><?php echo $newProductsList[$besD][1]?></h5>
                                        <h6>Rs. <span class='card-price'><?php echo number_format((float)$newProductsList[$besD][3], 2, '.', ',');?></span></h6>
                                        <input type='button' class='btn primary' value='Add to Cart' onclick="addtoCart('<?php echo $newProductsList[$besD][0]?>',1)" <?php echo $addCart?>>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </ul>
                </div>

                <nav class="pagination-container justify-content-end">
                    <button class="pagination-button" id="prev-button" title="Previous page" aria-label="Previous page"> < </button>
                    <div id="pagination-numbers">
                    </div>
                    <button class="pagination-button" id="next-button" title="Next page" aria-label="Next page"> > </button>
                </nav>
            </div>
        </div>
    </div>
    <?php include "./includes/home-footer.php"; ?>
    <?php include "./includes/home-modals-mapping.php"; ?>
    <script src="./js/bootstrap.js"></script>
    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="./js/tools.js"></script>
    <script src="./js/product-pagination.js"></script>
    <script src="./js/cart.js"></script>
    <script>
       document.getElementById('whats-new-page').classList.add('selected');
    </script>
</body>

</html>