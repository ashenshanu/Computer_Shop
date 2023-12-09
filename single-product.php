<?php
$productID =$_GET['id'];
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
    <title>Mr.PC | Trusted Shops</title>

</head>

<?php

require_once "./connectors/db-connector.php";
require_once "./configs/config.php";

include "./includes/home-navigation.php";
// include "./includes/home-header.php";

include "./controller/product_controller.php";
include "./controller/shop_controller.php";

$productData = getProductData($productID);
$shopData = getShopById($productData[0][9]);
$productCat = getCategoryById($productData[0][8]);
//var_dump($productData);

?>
<body>
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="product-img">
                    <img onerror="this.src='./assets/products.png'" src='uploads/product_images/<?php echo $productData[0][10]?>' alt="">
                </div>
            </div>
            <div class="info-side col-md-7">
                <div class="info-sec" >
                <div class="shopper" onclick=location.href='./shop-profile.php?id=<?php echo $productData[0][9] ?>'>
                    <h4><?php echo $shopData["shop_name"];?></h4>
                    <div class="dr-tag"><span id="dr">9.6</span> DR</div>
                </div>
                <h2 class="product-name"><?php echo $productData[0][1];?></h2>
                    <button id="report-opt" onclick="$('#send-complaint-modal').modal('show');">Report This</button>
                <p class="product-category">#<span><?php echo $productID;?></span> - <?php echo $productCat[0][1];?></p>
                <div class="product-price"><h2>Rs. <span id="product-price"><?php echo number_format((float)$productData[0][3], 2, '.', ',');?> </span></h2>Per Piece</div>
                <div class="pr-rate">
                    <h6><span><?php echo $productData[0][2];?></span> Available </h6>
                    
                </div>
                <div class="product-description" style="max-height: 200px;margin-bottom: 10px;">
                        <textarea class="description" style="background: transparent; border: transparent; width: 100%; max-height: 200px; height: 200px;" disabled><?php echo $productData[0][4];?></textarea>
                    </div>
                </div>
                    <div class="btn-sec">
                        <button class="add-cart" onclick="addtoCart('<?php echo $productData[0][0]?>',1)" <?php if ($productData[0][2] == '0'){
                            echo 'disabled';
                        }?>>Add to Cart <img src="./assets/icons/shopping-cart.svg" alt="" <?php echo $addCart?> ></button>
                    </div>
            </div>
        </div>
    </div>
</div>
<div class="section products">
    <div class="container">
    <h2 class="section-header">Related Products</h2>
        <div class="row">
            <?php
            $categorizedList = getCategorizedProducts($productCat[0][0]);
            //                            var_dump($categorizedList);
            if($categorizedList != null) {
                if (count($categorizedList)<=4){
                    $maxProduct = count($categorizedList);
                }else{
                    $maxProduct = 4;
                }
                for ($pro = 0; $pro < $maxProduct; $pro++) {
                    ?>
                    <div class='card col-md-4'>
                        <div class='product-tile'>
                        <div class="f-card-boader">
                            <img class='card-img-top' onerror="this.src='./assets/products.png'" src='uploads/product_images/<?php echo $categorizedList[$pro][10]?>' alt='Card image cap' onclick=location.href='./single-product.php?id=<?php echo $categorizedList[$pro][0] ?>'>
                            <div class='card-body'>
                                <h5 class='card-title'><?php echo $categorizedList[$pro][1] ?></h5>
                                <h6>Rs. <span class='card-price'><?php echo number_format((float)$categorizedList[$pro][3], 2, '.', ',');?></span></h6>
                                <input <?php echo $addCart?> type='button' class='btn primary' value='Add to Cart' onclick="addtoCart('<?php echo $categorizedList[$pro][0]?>',1)">
                            </div>
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












    <?php include "./includes/home-footer.php"; ?>
    <?php include "./modals/send-product_complaint.php"; ?>
    <?php include "./includes/home-modals-mapping.php"; ?>
    <script src="./js/bootstrap.js"></script>
    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.slim.min.js" integrity="sha256-ZwqZIVdD3iXNyGHbSYdsmWP//UBokj2FHAxKuSBKDSo=" crossorigin="anonymous"></script>
    <script src="./js/tools.js?v=444323"></script>
    <script src="./js/cart.js?v=7484"></script>
</body>
</html>