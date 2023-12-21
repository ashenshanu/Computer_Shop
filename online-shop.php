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



    $isCategory = false;
    $isRange = false;
    $categoryID = 0;
    $maxRange = 0;
    if(isset($_GET["cat_id"])){
        $isCategory = true;
        $categoryID = $_GET["cat_id"];
    }

    if(isset($_GET["maxPrice"])){
        $isRange = true;
        $maxRange = $_GET["maxPrice"];
    }

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
                        <img src="./assets/hero-slides/pro6.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="./assets/hero-slides/pro14.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="./assets/hero-slides/pro15.jpg" class="d-block w-100" alt="...">
                    </div>
                </div>
                <div class="carousel-caption d-none d-md-block hero-banner-content">
                  <!-- <div class="row hero-content">-->
                       <!-- <h1 class="main-title page-title">Shop Online</h1>-->
                       <!--  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>-->
                            <!--<div class="search-bar">-->
                            <!--                            <input type="search" class="search" name="Search" placeholder="Search Here Shop or Product" id="search_head" onkeyup="handleSearchFiled(event)">-->
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

    <div class="section products">
        <div class="container">
            <div class="row">
                <form class="filter-tool col-md-3" id="tool-bar">
                    <div class="tool reset-btn-sec">
                        <h5>Filter</h5>
                        <input type="button" class="min-btn" value="Reset" onclick="restToolSettings()">
                    </div>
                    <div class="tool price-filter">
                        <h5>Price</h5>
                        <div class="range-selector">
                            <?php
                                $priceRange = getPriceRange();
                                $maxPrice = 0;
                                $minPrice = 0;
                                if(isset($priceRange)){
                                    $maxPrice = $priceRange["MAX(per_price)"];
                                    $minPrice = $priceRange["MIN(per_price)"];
                                }
                            ?>
                            <input type="range" name="" id="priceRangeInput" value="<?php echo !($isRange) ?$maxPrice : $maxRange?>" min="<?php echo $minPrice?>" max="<?php echo $maxPrice?>">
                            <p>max price Rs.<span id="rangeValue"><?php echo !($isRange) ?$maxPrice : $maxRange?></span></p>
                        </div>
<!--                        <select name="" id="priceVariant">-->
<!--                            <option value="l-h">Lower to Higher</option>-->
<!--                            <option value="h-l">Higher to Lower</option>-->
<!--                        </select>-->

                    </div>
                    <div class="tool cat-filter">
                        <h5>Category</h5>
                        <div class="cat-values">
                            <?php
                            $categoryList = getAllCategories();
                            if($categoryList != null) {
                                for ($cou = 0; $cou < count($categoryList); $cou++) {
                                    ?>
                                    <div class="cat-item">
                                        <input <?php echo ($isCategory && $categoryID == $categoryList[$cou][0]) ? 'checked' : '' ?> type="radio" name="category" id="<?php echo $categoryList[$cou][0]?>" onclick="categoryClick('<?php echo $categoryList[$cou][0]?>')" value="<?php echo $categoryList[$cou][0]?>">
                                        <label for="cat1"><?php echo $categoryList[$cou][1]?></label>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="tool city-filter">
                        <h5>City</h5>
                        <div class="city-values">
                            <div class="city-item">
                                <input type="checkbox" name="a" id="0" value="cat1">
                                <label for="city1">city 1</label>
                            </div>
                            <div class="cat-item">
                                <input type="checkbox" name="a" id="1" value="cat2">
                                <label for="city2">city 2</label>
                            </div>
                            <div class="cat-item">
                                <input type="checkbox" name="a" id="2" value="cat3">
                                <label for="city3">city 3</label>
                            </div>
                            <div class="cat-item">
                                <input type="checkbox" name="a" id="3" value="cat4">
                                <label for="city4">city 4</label>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="col-md-9">
                <ul id="paginated-list" class="row" data-current-page="1" aria-live="polite">
                    <?php
                    $categorizedList = getAllProducts();
                    if($isCategory && !($isRange)){
                        $categorizedList = getCategorizedProducts($categoryID);
                    }else if($isRange && !($isCategory)){
                        $categorizedList = getProductsByMaxPrice($maxRange);
                    }else if($isRange && $isCategory){
                        $categorizedList = getProductByCategoryAndMaxPrice($categoryID,$maxRange);
                    }

                    if($categorizedList != null) {
                        for ($p = 0; $p < count($categorizedList); $p++) {

                            ?>
                            <li class='card col-md-4'>
                                <div class='product-tile'>
                                <div class="f-card-boader">
                                    <img class='card-img-top' onerror="this.src='./assets/product.jpg'" src='uploads/product_images/<?php echo $categorizedList[$p][10]?>' alt='Card image cap'
                                         onclick=location.href='./single-product.php?id=<?php echo $categorizedList[$p][0] ?>'>
                                    <div class='card-body'>
                                        <h5 class='card-title'><?php echo $categorizedList[$p][1] ?></h5>
                                        <h6>Rs. <span class='card-price'><?php echo $categorizedList[$p][3] ?></span>
                                        </h6>
                                        <input type='button' class='btn primary' value='Add to Cart' onclick="addtoCart('<?php echo $categorizedList[$p][0]?>',1)" <?php echo $addCart?>>
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
    <script src="./js/tools.js"></script>
    <script src="./js/product-pagination.js"></script>
    <script src="./js/cart.js"></script>
    <script>
       document.getElementById('shop-online-page').classList.add('selected');

       function restToolSettings(){
           // document.getElementById("tool-bar").reset();
           location.href='./online-shop.php';
       }
    </script>
</body>

</html>