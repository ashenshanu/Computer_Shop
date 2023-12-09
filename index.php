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
<section id="loader" style="position:fixed; width:100vw; height:100vh; z-index:10000; display:flex; flex-direction:column; justify-content:center; align-items:center; background:#ffffff;">
    <img src="./assets/sanakin-logo.png"  style="margin-bottom: 20px; width:40vW;" alt="">
    <div class="spinner-grow text-warning" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</section>
<?php
require_once "./configs/config.php";
include "./includes/home-navigation.php"; 
include "./includes/home-header.php";

require_once "./connectors/db-connector.php";

include "./controller/product_controller.php";
include "./controller/shop_controller.php";

//$_SESSION['cart'] = array();
//var_dump($_SESSION["cart"])

?>
<body>
    <div class="section hero-sec">
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
                        <h1 class="main-title">Find the Best Products<br>with <span class="primarycolor-text">Reliability</h1>
<!--                        <div class="search-bar">-->
<!--                            <input type="search" class="search" name="search_txt" placeholder="Search Here Shop or Product" id="Search" onkeyup="handleSearchFiled(event)">-->
<!--                            <input type="button" id="search-btn" class="search-btn btn primary" value="Search" onclick="handleSearchButton(document.getElementById('search_head').value)">-->
<!--                        </div>-->

                    </div>

                </div>
                <!-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button> -->
            </div>
        </div>
    </div>

    <div class="section cat-sec">
        <div class="container">
            <h2 class="section-header">Shop Our Top Categories</h2>












            <div id="category-carousel" class="carousel slide" data-interval="pause" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php
                    $categoryList = getAllCategories();

                    if($categoryList != null) {
                        ?>
                        <div class="carousel-item active">
                            <div class="row">
                            <?php
                            $catCount = count($categoryList);
                            if ($catCount <= 6) {
                                $maxCount = $catCount;
                            } else {
                                $maxCount = 6;
                            }
                            for ($cou = 0; $cou < $maxCount; $cou++) {
                                ?>
                                <div class='card col-2'
                                     onclick="location.href='./online-shop.php?cat_id=<?php echo $categoryList[$cou][0] ?>'"
                                     style="border: transparent;">
                                    <div class='card-content'
                                         style="background-image: url('./uploads/category/<?php echo $categoryList[$cou][2] ?>');">
                                        <div class='cat-name'>
                                            <h5><?php echo $categoryList[$cou][1] ?></h5>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }

                            ?>
                        </div>
                        </div>
                        <?php
                        if ($catCount > 6) {
                            ?>
                            <div class="carousel-item">
                                <div class="row">
                                <?php
                                if ($catCount <= 12) {
                                    $maxCount = $catCount;
                                } else {
                                    $maxCount = 12;
                                }
                                for ($cou = 6; $cou < $maxCount; $cou++) {
                                    ?>
                                    <div class='card col-2'
                                         onclick="location.href='./online-shop.php?cat_id=<?php echo $categoryList[$cou][0] ?>'"
                                         style="border: transparent;">
                                        <div class='card-content'
                                             style="background-image: url('./uploads/category/<?php echo $categoryList[$cou][2] ?>');">
                                            <div class='cat-name'>
                                                <h5><?php echo $categoryList[$cou][1] ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                                </div>
                            </div>

                            <?php
                        }
                    }
                ?>
            </div>
            
                <button class="carousel-control-prev" type="button" data-bs-target="#category-carousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#category-carousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>

            </div>
        </div>
    </div>

    <div class="section best-deals products">
        <div class="container">
            <h2 class="section-header">Best Deals For You!</h2>
            <div class="row">
                <?php
                $bestDealList = getBestDealsProducts();
                if($bestDealList != null) {
                    if (count($bestDealList)<=8){
                        $maxCount = count($bestDealList);
                    }else{
                        $maxCount = 8;
                    }
                    for ($besD = 0; $besD < $maxCount; $besD++) {

                        ?>
                        <div class='card col-md-3'>
                            <div class='product-tile'>
                                <img class='card-img-top' onerror="this.src='./assets/products.png'" src='uploads/product_images/<?php echo $bestDealList[$besD][10]?>' alt='Card image cap'
                                     onclick=location.href='./single-product.php?id=<?php echo $bestDealList[$besD][0]?>'>
                                <div class='card-body'>
                                    <h5 class='card-title'><?php echo $bestDealList[$besD][1]?></h5>
                                    <h6>Rs. <span class='card-price'><?php echo number_format((float)$bestDealList[$besD][3], 2, '.', ',');?></span></h6>
                                    <input <?php echo $addCart?> type='button' class='btn primary' value='Add to Cart' onclick="addtoCart('<?php echo $bestDealList[$besD][0]?>',1)">
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
    
    <div class="section shops">
        <div class="container baoth-sides-margin-14">
            <h2 class="section-header">Choose by Shops</h2>
            <div id="shopsIndicators" class="carousel slide" data-interval="pause" data-bs-ride="carousel">

                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row">
                            <?php
                            $shops = getShops();
                            // var_dump(count($shops));
                            if($shops != null) {
                                if (count($shops)<=8){
                                    $maxCount = count($shops);
                                }else{
                                    $maxCount = 8;
                                }
                                for ($shp = 0; $shp < $maxCount; $shp++) {

                                    ?>
                                    <div class='col-md-3'>
                                        <div class='card' onclick=location.href='./shop-profile.php?id=<?php echo $shops[$shp][0]?>'>
                                            <img class='shop-profile' onerror="this.src='./assets/products.png'" src='./uploads/shop_images/shop_dp/<?php echo $shops[$shp][8]?>' alt=''>
                                            <div class='text'>
                                                <h5 class='shop-name'><?php echo $shops[$shp][1]?></h5>
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
                    <?php
                    if (count($shops)>=12){
                        if (count($shops)<=16){
                            $maxCount = count($shops);
                        }else{
                            $maxCount = 16;
                        }
                        ?>

                        <div class="carousel-item">
                            <div class="row">
                                <?php
                                // if (count($shops)>=16){
                                    for ($shp = 8; $shp < $maxCount; $shp++) {

                                        ?>
                                        <div class='col-md-3'>
                                            <div class='card' onclick=location.href='./shop-profile.php?id=<?php echo $shops[$shp][0]?>'>
                                                <img class='shop-profile' onerror="this.src='./assets/products.png'" src='./uploads/shop_images/shop_dp/<?php echo $shops[$shp][8]?>' alt=''>
                                                <div class='text'>
                                                    <h5 class='shop-name'><?php echo $shops[$shp][1]?></h5>
                                                    <h6><span id='product-count'></span> Products</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                // }
                                ?>
                            </div>
                        </div>

                        <?php
                    }
                    ?>
                </div>
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#shopsIndicators" data-bs-slide-to="0" class="indicate-line active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#shopsIndicators" data-bs-slide-to="1" class="indicate-line" aria-label="Slide 2"></button>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#shopsIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#shopsIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>

    <div class="section most-popular products">
        <div class="container">
            <h2 class="section-header">Most Popular Products</h2>
            <div class="row">
                <?php
                $mostPopularList = getMostPopularProducts();
                if($mostPopularList != null) {
                    if (count($mostPopularList)<=8){
                        $maxCount = count($mostPopularList);
                    }else{
                        $maxCount = 8;
                    }
                    for ($besD = 0; $besD < $maxCount; $besD++) {

                        ?>
                        <div class='card col-md-3'>
                            <div class='product-tile' >
                                <img class='card-img-top' onerror="this.src='./assets/products.png'" src='uploads/product_images/<?php echo $mostPopularList[$besD][10]?>' alt='Card image cap' onclick=location.href='./single-product.php?id=<?php echo $mostPopularList[$besD][0]?>'>
                                <div class='card-body'>
                                    <h5 class='card-title'><?php echo $mostPopularList[$besD][1]?></h5>
                                    <h6>Rs. <span class='card-price'><?php echo number_format((float)$mostPopularList[$besD][3], 2, '.', ',');?></span></h6>
                                    <input <?php echo $addCart?> type='button' class='btn primary' value='Add to Cart' onclick="addtoCart('<?php echo $mostPopularList[$besD][0]?>',1)">
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


    <div class="section ad-banner-1">
        <div id="ad-banner-carousel1" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators" style="display: none;">
                <button type="button" data-bs-target="#ad-banner-carousel1" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#ad-banner-carousel1" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#ad-banner-carousel1" data-bs-slide-to="2" aria-label="Slide 3"></button>
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
        </div>
    </div>

    <div class="section deals">
        <div class="container">
            <h2 class="section-header">Today Best Deals For You</h2>

            <div class="row products">

                <ul class="nav nav-pills mb-3 deal-tags" id="pills-tab" role="tablist">
                    <?php
                    $categoryList = getAvailableCategories();
//                    var_dump($categoryList);
                    if($categoryList != null) {
                        if (count($categoryList)<=8){
                            $maxCount = count($categoryList);
                        }else{
                            $maxCount = 8;
                        }
                        for ($cou = 0; $cou < $maxCount; $cou++) {
                            if ($cou != 0){
                                $select = "false";
                                $active = "";
                            }else{
                                $select = "true";
                                $active = "active";
                            }

                            ?>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link <?php echo $active?>" id="pill-<?php echo $categoryList[$cou][0]?>-tab" data-bs-toggle="pill" data-bs-target="#pill-<?php echo $categoryList[$cou][0]?>" type="button" role="tab" aria-controls="pill-<?php echo $categoryList[$cou][0]?>" aria-selected="<?php echo $select ?>"><?php echo $categoryList[$cou][1]?></button>
                            </li>
                            <?php
                        }
                    }
                    ?>

<!--                    <li class="nav-item" role="presentation">-->
<!--                        <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Search Tag</button>-->
<!--                    </li>-->
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <?php
                    $categoryList = getAvailableCategories();
                    if($categoryList != null) {
                        if (count($categoryList)<=8){
                            $maxCat = count($categoryList);
                        }else{
                            $maxCat = 8;
                        }
                    for ($cou = 0; $cou < $maxCat; $cou++) {
                        if ($cou == 0){
                            $select = "active";
                        }else{
                            $select = "";
                        }
                    ?>

                    <div class="tab-pane fade show <?php echo $select ?>" id="pill-<?php echo $categoryList[$cou][0] ?>" role="tabpanel" aria-labelledby="pill-<?php echo $categoryList[$cou][0] ?>-tab">
                        <div class="row">
                            <?php
                            $categorizedList = getCategorizedProducts($categoryList[$cou][0]);
//                            var_dump($categorizedList);
                            if($categorizedList != null) {
                                if (count($categorizedList)<=8){
                                    $maxProduct = count($categorizedList);
                                }else{
                                    $maxProduct = 8;
                                }
                            for ($pro = 0; $pro < $maxProduct; $pro++) {
                                ?>
                                <div class='card col-md-3'>
                                    <div class='product-tile'>
                                        <img class='card-img-top' onerror="this.src='./assets/products.png'" src='uploads/product_images/<?php echo $categorizedList[$pro][10]?>' alt='Card image cap' onclick=location.href='./single-product.php?id=<?php echo $categorizedList[$pro][0] ?>'>
                                        <div class='card-body'>
                                            <h5 class='card-title'><?php echo $categorizedList[$pro][1] ?></h5>
                                            <h6>Rs. <span class='card-price'><?php echo number_format((float)$categorizedList[$pro][3], 2, '.', ',');?></span></h6>
                                            <input <?php echo $addCart?> type='button' class='btn primary' value='Add to Cart' onclick="addtoCart('<?php echo $categorizedList[$pro][0]?>',1)">
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                    }
                    ?>
                    <div class="center-btn">
                        <a class="explore-btn" href="./online-shop.php?cat_id=<?php echo $categoryList[$cou][0] ?>">
                            Explore More <img src="./assets/icons/more-arrow.svg" alt="" sizes="w-16" srcset="">
                        </a>
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

    <div class="section ad-banner-2">
        <div class="container">
            <div id="ad-banner-carousel2" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#ad-banner-carousel2" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#ad-banner-carousel2" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#ad-banner-carousel2" data-bs-slide-to="2" aria-label="Slide 3"></button>
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
                <button class="carousel-control-prev" type="button" data-bs-target="#ad-banner-carousel2" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#ad-banner-carousel2" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>

    <div class="section cat-sec">
        <div class="container">
            <h2 class="section-header">Today Best Deals For You</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="cat-tile">
                        <div class="cat-img">
                            <img src="./assets/hero-slides/slide 1.png" alt="" srcset="">
                        </div>
                        <div class="cat-text">
                            <h4 id="cat-name1">Fashion & Apparel</h4>
                            <input type="button" class="btn primary" onclick="location.href='./online-shop.php?cat_id=2'" value="Shop Now">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="cat-tile">
                        <div class="cat-img">
                            <img src="./assets/hero-slides/slide 1.png" alt="" srcset="">
                        </div>
                        <div class="cat-text">
                            <h4 id="cat-name2">Electronic & Tech Gadgets</h4>
                            <input type="button" class="btn primary" onclick="location.href='./online-shop.php?cat_id=1'" value="Shop Now">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="./js/bootstrap.js"></script>
    <script src="./js/bootstrap.bundle.min.js"></script>

    <?php include "./includes/home-footer.php"; ?>
    <?php include "./includes/home-modals-mapping.php"; ?>

    <script src="./js/tools.js?v=7416514"></script>
    <script src="./js/cart.js?v=368333"></script>
    <script>
       document.getElementById('home-page').classList.add('selected');
    </script>
</body>

</html>