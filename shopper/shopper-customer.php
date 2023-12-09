<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="./css/shopper-main.css">
    <title>Customers | Sanakin.lk</title>
</head>

<body>
    <?php

    require_once "../connectors/db-connector.php";
    require_once "../configs/config.php";

    include "../controller/product_controller.php";
    include "../controller/shop_controller.php";

    include './includes/dashboard-navigation.php';

    $customerList = getCustomerListByShopID($_SESSION["selectedShopID"]);

    ?>

    <main class="section main-wrapper ">
        <div class="header">
            <h4>Customers</h4>
            <span class="current_timestamp" id="datetime"></span>
        </div>
        <div class="sec-container">
            <div class="tool-bar">
                <input type="text" class="t-feild form_data" name="searchByCustomer" id="searchByCustomer" placeholder="Search Customer">

            </div>
            <div class="table-responsive">
                <table class="table top-selling-table">
                    <thead>
                        <tr>
                            <th>
                                <h6 class="text-sm text-medium">Customer Name</h6>
                            </th>
                            <th class="min-width">
                                <h6 class="text-sm text-medium">
                                    Customer Email
                                </h6>
                            </th>
                            <th class="min-width">
                                <h6 class="text-sm text-medium">
                                    Orders Count
                                </h6>
                            </th>
                            <th class="min-width">
                                <h6 class="text-sm text-medium">
                                    Successful Deliveries
                                </h6>
                            </th>
                            <th class="min-width">
                                <h6 class="text-sm text-medium">
                                    Total Income
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

                        if (isset($customerList)) {
                            if (count($customerList) > 0) {
                                for ($i = 0; $i < count($customerList); $i++) {
                        ?>
                                    <tr>
                                        <td>
                                            <div class="product">
                                                <p class="text-sm"><?php echo $customerList[$i]["first_name"] . " " . $customerList[$i]["last_name"] ?></p>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm"><?php echo $customerList[$i]["email"] ?></p>
                                        </td>
                                        <td>
                                            <p class="text-sm"><?php echo $customerList[$i]["orderCount"] ?></p>
                                        </td>
                                        <td>
                                            <p class="text-sm"><?php echo $customerList[$i]["successful_orders"] ?></p>
                                        </td>
                                        <td>
                                            <p class="text-sm">Rs. <?php echo number_format((float)$customerList[$i]["total"], 2, '.', ',');?></p>
                                        </td>
                                        <td class="color2-btn" onclick="openCustomerOrderModal('<?php echo str_replace('"','|',json_encode(getCustomerDataByShopAndCustomerID($_SESSION["selectedShopID"],$customerList[$i]["user_id"])))?>',<?php echo $_SESSION["selectedShopID"]?>)">
                                            <i class="bi bi-box-arrow-up-right"></i>
                                        </td>
                                    </tr>
                        <?php
                                }
                            }
                        }
                        ?>

                    </tbody>
                </table>

            </div>
        </div>
    </main>

    <?php include './modals/add-product.php'; ?>
    <?php include './modals/logout-confiremation.php'; ?>
    <?php include './modals/view-customer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.6.3.slim.min.js" integrity="sha256-ZwqZIVdD3iXNyGHbSYdsmWP//UBokj2FHAxKuSBKDSo=" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="./js/tools.js"></script>
    <script>
        document.getElementById('customers').classList.add('selected');
    </script>

</body>

</html>