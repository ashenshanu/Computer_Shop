<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="./css/admin-main.css">
    <title>Subscribe | Sanakin.lk</title>
</head>

<body>
    <?php

    require_once "../connectors/db-connector.php";
    require_once "../configs/config.php";

    include "../controller/product_controller.php";
    include "../controller/user_controller.php";
    include "../controller/shop_controller.php";
    include "../controller/other_controller.php";

    include './includes/dashboard-navigation.php';

    // $categoryList = getAllCategories();
    // $productList = getProductsWithCategoryByShopId($_SESSION["selectedShopID"]);
    $subscribeList = getAllSubscribe();


    ?>

    <main class="section main-wrapper ">
        <section id="loader" style="position:fixed; width:-webkit-fill-available; height:100%; z-index:10000; display:flex; flex-direction:column; justify-content:center; align-items:center; background:#ffffff;">
            <div class="spinner-grow text-warning" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </section>
        <div class="header">
            <h4>All Newsletter Subscribe</h4>
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
                                    Inquiry ID
                                </h6>
                            </th>
                            <th class="min-width">
                                <h6 class="text-sm text-medium">
                                    Email
                                </h6>
                            </th>
                            <th class="min-width">
                                <h6 class="text-sm text-medium">
                                    Submit Date
                                </h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        if (isset($subscribeList)) {
                            if (count($subscribeList) > 0) {
                                for ($i = 0; $i < count($subscribeList); $i++) {
                        ?>
                                    <tr>
                                        <td>
                                            <p class="text-sm">#<?php echo $subscribeList[$i]["sub_id"] ?></p>
                                        </td>
                                        <td>
                                            <p class="text-sm"><?php echo $subscribeList[$i]["sub_email"] ?></p>
                                        </td>
                                        <td>
                                            <p class="text-sm"><?php echo $subscribeList[$i]["create_date"] ?></p>
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

    <?php include './modals/view-product.php'; ?>
    <?php include './modals/logout-confiremation.php'; ?>
    <script src="https://code.jquery.com/jquery-3.6.3.slim.min.js" integrity="sha256-ZwqZIVdD3iXNyGHbSYdsmWP//UBokj2FHAxKuSBKDSo=" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="./js/tools.js?v=74144"></script>
    <script>
        document.getElementById('subscribe').classList.add('selected');
    </script>

</body>

</html>