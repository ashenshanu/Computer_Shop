<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="./css/shopper-main.css">
    <title>Profile | Mr.PC</title>
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
    // var_dump($_SESSION['user']);
    // var_dump($shopList);
    // var_dump($user);
    
    ?>


    <main class="section main-wrapper shopper-profile">
        <div class="header">
            <h4>Your Account</h4>
            <span class="current_timestamp" id="datetime"></span>
        </div>
        <div class="section proinfo-sec">
            
                <div class="sub-sec firstcol">
                    <img class="dp-img" onerror="this.src='../assets/product.jpg'" src="../uploads/user_images/<?php echo $user[0]['dp_img'];?>" alt="">
                    <input type="button" onclick="$('#user-settings-modal').modal('show');" class="btn primary" style="width: 300px;" value="Settings">
                </div>
                <div class="sub-sec secondcol">
                    <div class="info">
                        <label for="s-name">Name</label>
                        <p id="s-name"><?php echo $user[0]['first_name'];?> <?php echo $user[0]['last_name'];?></p>
                    </div>
                    <div class="info">
                        <label for="s-fullname">Full Name</label>
                        <p id="s-fullname"><?php echo $user[0]['full_name'];?></p>
                    </div>
                    <div class="info">
                        <label for="s-nic">NIC</label>
                        <p id="s-nic"><?php echo $user[0]['nic'];?></p>
                    </div>
                    <div class="info">
                        <label for="s-birthday">Birthday</label>
                        <p id="s-birthday"><?php echo $user[0]['birthday'];?></p>
                    </div>
                    <div class="info">
                        <label for="s-gender">Gender</label>
                        <p id="s-gender"><?php echo $user[0]['gender'];?></p>
                    </div>
                    <div class="info">
                        <label for="s-tel">Contact Number</label>
                        <p id="s-tel"><?php echo $user[0]['tel'];?></p>
                    </div>
                    <div class="info">
                        <label for="s-address">Address</label>
                        <p id="s-address"><?php echo $user[0]['home_address'];?></p>
                    </div>
                    <div class="info">
                        <label for="s-city">City</label>
                        <p id="s-city"><?php echo $user[0]['home_city'];?></p>
                    </div>
                    <div class="info">
                        <label for="s-zip">Zip Code</label>
                        <p id="s-zip"><?php echo $user[0]['zip_code'];?></p>
                    </div>
                    
                </div>
                <div class="shops sub-sec">
                <div class="shop-tile-table">
                    <h3>Your Shops</h3>
                    <?php
                    if (isset($shopList)) {
                        if (count($shopList) > 0) {
                            for ($s = 0; $s < count($shopList); $s++) {
                    ?>
                                <div class="tile" onclick="setShopSession('<?php echo $shopList[$s][0] ?>')">
                                    <img onerror="this.src='../assets/product.jpg'" src="../uploads/shop_images/shop_dp/<?php echo $shopList[$s][8];?>"  alt="">
                                    <h4><?php echo $shopList[$s][1] ?></h4>
                                </div>

                    <?php
                            }
                        }
                    }
                    ?>
                   
                </div>
                    
                </div>
            
        </div>
    </main>







    <?php include './modals/logout-confiremation.php'; ?>
    <?php include './modals/change-password.php'; ?>
    <?php include './modals/view-orders.php'; ?>
    <?php include './modals/delete-user.php'; ?>
    <?php include './modals/user-settings.php'; ?>
    <?php include './modals/update-user.php'; ?>
    <?php include './modals/add-product.php'; ?>
    <script src="https://code.jquery.com/jquery-3.6.3.slim.min.js" integrity="sha256-ZwqZIVdD3iXNyGHbSYdsmWP//UBokj2FHAxKuSBKDSo=" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="./js/tools.js"></script>
    <script>
        document.getElementById('shopper-profile').classList.add('card-thumb-selected');
    </script>
</body>

</html>