<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="./css/shopper-main.css">
    <title>Shop Profile | Mr.PC</title>
</head>

<body>

    <?php

    require_once "../connectors/db-connector.php";
    require_once "../configs/config.php";

    include "../controller/product_controller.php";
    include "../controller/shop_controller.php";
    include "../controller/user_controller.php";

    include './includes/dashboard-navigation.php';
    $shopList = getShopListByUserID($loggedUser["user_id"]);
    $user = getUserByUserID($loggedUser['user_id']);
    $shop = getshopByID($shopData['shop_id']);
    // var_dump($_SESSION['user']);
    // var_dump($shopList);
    // var_dump($user);
    
    ?>


    <main class="section main-wrapper shopper-profile">
        <div class="header">
            <h4>Shop Profile</h4>
            <span class="current_timestamp" id="datetime"></span>
        </div>
        <div class="section proinfo-sec">
            
                <div class="sub-sec firstcol">
                    <img class="dp-img" onerror="this.src='../assets/product.jpg'" src="../uploads/shop_images/shop_dp/<?php echo $shop['dp_logo'];?>" alt="">
                    <input type="button" onclick="$('#shop-settings-modal').modal('show');" class="btn primary" style="width: 300px;" value="Settings">
                </div>
                <div class="sub-sec secondcol">
                    <div class="info">
                        <label for="s-name">Shop Name</label>
                        <p id="s-name"><?php echo $shop['shop_name'];?></p>
                    </div>
                    <div class="info">
                        <label for="s-fullname">Nature of Business</label>
                        <p id="s-fullname"><?php echo $shop['nb_description'];?></p>
                    </div>
                    <div class="info">
                        <label for="s-nic">ROC Number</label>
                        <p id="s-nic"><?php echo $shop['roc_number'];?></p>
                    </div>
                    <div class="info">
                        <label for="s-email">E-mail Address</label>
                        <p id="s-email"><?php echo $shop['email'];?></p>
                    </div>
                    <div class="info">
                        <label for="s-tel">Contact Number</label>
                        <p id="s-tel"><?php echo $shop['tel'];?></p>
                    </div>
                    <div class="info">
                        <label for="s-address">Address</label>
                        <p id="s-address"><?php echo $shop['address'];?></p>
                    </div>
                    <div class="info">
                        <label for="s-city">City</label>
                        <p id="s-city"><?php echo $shop['city'];?></p>
                    </div>
                    <div class="info">
                        <label for="s-zip">Zip Code</label>
                        <p id="s-zip"><?php echo $shop['zip_code'];?></p>
                    </div>
                    
                </div>
                <div class="shops sub-sec">                   
                </div>
            
        </div>
    </main>







    <?php include './modals/logout-confiremation.php'; ?>
    <?php include './modals/view-orders.php'; ?>
    <?php include './modals/delete-user.php'; ?>
    <?php include './modals/delete-shop.php'; ?>
    <?php include './modals/user-settings.php'; ?>
    <?php include './modals/shop-settings.php'; ?>
    <?php include './modals/update-user.php'; ?>
    <?php include './modals/update-shop.php'; ?>
    <?php include './modals/add-product.php'; ?>

    <script src="https://code.jquery.com/jquery-3.6.3.slim.min.js" integrity="sha256-ZwqZIVdD3iXNyGHbSYdsmWP//UBokj2FHAxKuSBKDSo=" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="./js/tools.js?d=1234"></script>
    <script>
        document.getElementById('shop-profile').classList.add('card-thumb-selected');
    </script>
</body>

</html>