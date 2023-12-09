<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="./css/shopper-main.css">
    <title>Your Shops | Mr.PC</title>
</head>

<body>
    <?php

    session_start();

    require_once "../connectors/db-connector.php";
    require_once "../configs/config.php";

    include "../controller/product_controller.php";
    include "../controller/shop_controller.php";

    $loggedUser = null;
    if (!isset($_SESSION["user"])) {
        header('Location: ' . "../index.php");
    } else {
        $loggedUser = $_SESSION['user'];
    }

    $shopList = getShopListByUserID($loggedUser["user_id"]);

//    var_dump($_SESSION['user']);
    ?>


    <main class="shop-section main-wrapper ">
        <div class="header">
        <span class="current_timestamp" id="datetime"></span>
        </div>
        <div class="sec-container">
            <div class="tile-board shops">
                <h3>Your Shops</h3>
                <div class="shop-tile-table">
                    <?php
                    if (isset($shopList)) {
                        if (count($shopList) > 0) {
                            for ($s = 0; $s < count($shopList); $s++) {
                    ?>
                                <div class="tile" onclick="setShopSession('<?php echo $shopList[$s][0] ?>')">
                                    <img onerror="this.src='../assets/products.png'" src="../uploads/shop_images/shop_dp/<?php echo $shopList[$s][8];?>"  alt="">
                                    <h4><?php echo $shopList[$s][1] ?></h4>
                                </div>

                    <?php
                            }
                        }
                    }
                    ?>
                    <div class="tile" id="addShop" id="add-product" data-bs-toggle="modal" data-bs-target="#add-shop-modal">
                        <h4>Create Shop</h4>
                        <img src="../assets/icons/plus (1).svg" alt="">
                    </div>
                </div>

                <div class="logout-btn" id="logout-confirmation" data-bs-toggle="modal" data-bs-target="#logout-confirmation-modal">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Log Out</span>
                </div>
            </div>
        </div>
    </main>


    <?php include './modals/add-product.php'; ?>
    <?php include './modals/add-shop.php'; ?>
    <?php include './modals/logout-confiremation.php'; ?>
    <script src="https://code.jquery.com/jquery-3.6.3.slim.min.js" integrity="sha256-ZwqZIVdD3iXNyGHbSYdsmWP//UBokj2FHAxKuSBKDSo=" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="./js/tools.js?v=741"></script>


</body>

</html>