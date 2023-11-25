<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="./css/admin-main.css">
    <title>Shops | Sanakin.lk</title>
</head>

<body>
    <?php

    require_once "../connectors/db-connector.php";
    require_once "../configs/config.php";

    include "../controller/product_controller.php";
    include "../controller/user_controller.php";
    include "../controller/shop_controller.php";

    include './includes/dashboard-navigation.php';

    // $categoryList = getAllCategories();
    // $productList = getProductsWithCategoryByShopId($_SESSION["selectedShopID"]);
    $ShopList = getShopsOrderByDate();


    ?>

    <main class="section main-wrapper ">
        <section id="loader" style="position:fixed; width:-webkit-fill-available; height:100%; z-index:10000; display:flex; flex-direction:column; justify-content:center; align-items:center; background:#ffffff;">
            <div class="spinner-grow text-warning" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </section>
        <div class="header">
            <h4>All Shops</h4>
            <span class="current_timestamp" id="datetime"></span>
        </div>
        <div class="sec-container">
            <div class="tool-bar">
                <input type="text" class="t-feild form_data" name="searchByProduct" id="searchByProduct" placeholder="Search Product">
            </div>
            <div class="table-responsive">
                <table class="table ">
                    <thead>
                        <tr>

                            <th class="min-width">
                                <h6 class="text-sm text-medium">
                                    Shop ID
                                </h6>
                            </th>
                            <th class="min-width">
                                <h6 class="text-sm text-medium">
                                    Shop Name
                                </h6>
                            </th>
                            <th class="min-width">
                                <h6 class="text-sm text-medium">
                                    Shop Owner ID
                                </h6>
                            </th>
                            <th class="min-width">
                                <h6 class="text-sm text-medium">
                                    Registered Date
                                </h6>
                            </th>
                            <th class="min-width">
                                <h6 class="text-sm text-medium">
                                    Status
                                </h6>
                            </th>
                            <th class="min-width">
                                <h6 class="text-sm text-medium">

                                </h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        if (isset($ShopList)) {
                            if (count($ShopList) > 0) {
                                for ($i = 0; $i < count($ShopList); $i++) {
                        ?>
                                    <tr>
                                        <td>
                                            <p class="text-sm">#<?php echo $ShopList[$i]["shop_id"] ?></p>
                                        </td>
                                        <td>
                                            <p class="text-sm"><?php echo $ShopList[$i]["shop_name"] ?></p>
                                        </td>
                                        <td>
                                            <p class="text-sm">#<?php echo $ShopList[$i]["user_id"] ?></p>
                                        </td>
                                        <td>
                                            <p class="text-sm" style="<?php
                                                                        if ($ShopList[$i]["is_active"] == 0) {
                                                                        ?>
                                                color:#DD3A3A
                                                <?php
                                                                        }
                                                ?>
                                                "><?php echo $ShopList[$i]["create_time"] ?></p>
                                        </td>
                                        <td>
                                            <span class="status-tag text-sm" style="<?php
                                                                                    if ($ShopList[$i]["shop_status"] == "BANNED") {
                                                                                        echo 'border:#DD3A3A; color:#DD3A3A';
                                                                                    } else if ($ShopList[$i]["shop_status"] == "ACTIVE") {
                                                                                        echo 'border:#28D764; color:#28D764';
                                                                                    } ?>"><?php echo $ShopList[$i]["shop_status"] ?></span>

                                        </td>
                                        <td class="color2-btn">
                                            <i style="cursor: pointer;" class="bi bi-box-arrow-up-right"
                                               onclick="openShopModal(
                                                       '<?php

                                               echo str_ireplace('"','|',json_encode(getCustomInfoShopByShopID($ShopList[$i]["shop_id"])))?>')">
                                            </i>
                                        </td>
                                    </tr>
                        <?php
                                }
                            }
                        } ?>
                    </tbody>

                </table>

            </div>
        </div>



    </main>

    <?php include './modals/view-shop.php'; ?>
    <?php include './modals/logout-confiremation.php'; ?>
    <script src="https://code.jquery.com/jquery-3.6.3.slim.min.js" integrity="sha256-ZwqZIVdD3iXNyGHbSYdsmWP//UBokj2FHAxKuSBKDSo=" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="./js/tools.js?v=785465"></script>
    <script>
        document.getElementById('shops').classList.add('selected');
    </script>

</body>

</html>