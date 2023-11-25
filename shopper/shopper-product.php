<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="./css/shopper-main.css">
    <title>Products | Sanakin.lk</title>
</head>

<body>
    <?php

    require_once "../connectors/db-connector.php";
    require_once "../configs/config.php";

    include "../controller/product_controller.php";
    include "../controller/shop_controller.php";

    include './includes/dashboard-navigation.php';

    $categoryList = getAllCategories();
    $productList = getProductsWithCategoryByShopId($_SESSION["selectedShopID"]);



    ?>

    <main class="section main-wrapper ">
        <div class="header">
            <h4>Products</h4>
            <span class="current_timestamp" id="datetime"></span>
        </div>
        <div class="sec-container">
            <div class="tool-bar">
                <input type="text" class="t-feild form_data" name="searchByProduct" id="searchByProduct" placeholder="Search Product">
                <button type="button" class="primary btn" id="add-product" data-bs-toggle="modal" data-bs-target="#add-product-modal">Add New Product <img src="../assets/icons/plus (1).svg" alt="" srcset=""></button>
            </div>
            <div class="table-responsive">
                <table class="table ">
                    <thead>
                        <tr>
                            <th class="min-width">
                                <h6 class="text-sm text-medium">
                                    Product Name
                                </h6>
                            </th>
                            <th class="min-width">
                                <h6 class="text-sm text-medium">
                                    Category
                                </h6>
                            </th>
                            <th class="min-width">
                                <h6 class="text-sm text-medium">
                                    Quantity
                                </h6>
                            </th>
                            <th class="min-width">
                                <h6 class="text-sm text-medium">
                                    Per.Price
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
                    <div class="divi">
                        <tbody>
                            <?php
                            if (isset($productList)) {
                                if (count($productList) > 0) {
                                    for ($i = 0; $i < count($productList); $i++) {

                            ?>
                                        <tr>
                                            <td>
                                                <p class="text-sm"><?php echo $productList[$i]["product_name"] ?></p>
                                            </td>
                                            <td>
                                                <p class="text-sm"><?php echo $productList[$i]["cat_name"] ?></p>
                                            </td>
                                            <td>
                                                <p class="text-sm"><?php echo $productList[$i]["quntity"] ?></p>
                                            </td>
                                            <td>
                                                <p class="text-sm">Rs.<?php echo number_format((float)$productList[$i]["per_price"], 2, '.', ',') ?></p>
                                            </td>
                                            <td>
                                                <span class="status-tag status-btn "
                                                style="<?php
                                              if($productList[$i]["status"] == "ACTIVE"){echo 'border:#28D764; color:#28D764';}
                                              else if($productList[$i]["status"] == "DRAFT"){echo 'border:#FF9C00; color:#FF9C00';}
                                              else if($productList[$i]["status"] == "NO STOCK"){echo 'border:#DD3A3A; color:#DD3A3A';}?>"
                                                
                                                ><?php echo $productList[$i]["status"] ?></span>
                                            </td>
                                            <td>
                                                <button class="more-btn ml-10 dropdown-toggle" id="moreAction1" data-bs-toggle="dropdown" aria-expanded="false">

                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="moreAction1">
                                                    <li class="dropdown-item" id="delete-confirmation" onclick="openDeleteConfirmation('<?php echo $productList[$i]["product_id"] ?>','<?php echo $productList[$i]["product_name"]?>')">
                                                        <a href="#0" class="delete">Delete</a>
                                                    </li>
                                                    <li class="dropdown-item" id="edit-product" onclick="openEditModal(
                                    '<?php echo $productList[$i]["product_id"] ?>',
                                        '<?php echo $productList[$i]["product_name"] ?>',
                                        '<?php echo $productList[$i]["product_category_cat_id"] ?>',
                                        '<?php
                                                    $desc = str_replace("\"","^",$productList[$i]["description"]);
                                                    $desc = str_replace(",","=",$desc);
                                                    $desc = str_replace("'","|",$desc);
                                                    $desc = str_replace(array("\r", "\n"),"<br>",$desc);

                                                    echo $desc;
                                                         ?>',
                                        '<?php echo $productList[$i]["quntity"] ?>',
                                        '<?php echo $productList[$i]["per_price"] ?>',
                                        '<?php echo $productList[$i]["status"] ?>',
                                        '<?php echo $productList[$i]["image_url"] ?>')">
                                                        <a href="#0" class="">Edit</a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>

                            <?php
                                    }
                                }
                            }
                            ?>

                        </tbody>
                    </div>
                </table>

            </div>
        </div>



    </main>

    <?php include './modals/add-product.php'; ?>
    <?php include './modals/delete-confiremation.php'; ?>
    <?php include './modals/edit-product.php'; ?>
    <?php include './modals/logout-confiremation.php'; ?>
    <script src="https://code.jquery.com/jquery-3.6.3.slim.min.js" integrity="sha256-ZwqZIVdD3iXNyGHbSYdsmWP//UBokj2FHAxKuSBKDSo=" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="./js/tools.js?v=7487441"></script>
    <script>
        document.getElementById('products').classList.add('selected');
    </script>

</body>

</html>