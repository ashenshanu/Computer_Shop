<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="./css/customer-main.css">
    <title>Document</title>
</head>

<body>
    <?php

    require_once "../connectors/db-connector.php";
    require_once "../configs/config.php";

    include "../controller/product_controller.php";
    include "../controller/shop_controller.php";
    
    include "../controller/user_controller.php";
    include "../controller/order_controller.php";

    include './includes/dashboard-navigation.php';

   $orderProList = getOrdersByCustomerID($_SESSION['user']["user_id"]);


    ?>

    <main class="section main-wrapper ">
        <div class="header">
            <h4>Orders</h4>
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
                                <h6 class="text-sm text-medium">Order ID</h6>
                            </th>
                            <th class="min-width">
                                <h6 class="text-sm text-medium">
                                    Order Date
                                </h6>
                            </th>
                            <th class="min-width">
                                <h6 class="text-sm text-medium">
                                    Total Amount
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

                    if(isset($orderProList)) {
                        if (count($orderProList) > 0) {
                            for ($i = 0; $i < count($orderProList); $i++) {

                                ?>
                                
                                <tr>
                                    <td>
                                        <div class="product">
                                            <p class="text-sm"><?php echo $orderProList[$i]["order_number"]?></p>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm"><?php echo $orderProList[$i]["create_time"]?></p>
                                    </td>
                                    <td>
                                        <p class="text-sm">Rs. <?php echo number_format((float)$orderProList[$i]["total_bill"], 2, '.', ',');?></p>
                                    </td>
                                    <td>
                                        <span class="status-tag text-sm"
                                              style="<?php
                                              if($orderProList[$i]["de_status"] == "PROCESSING"){echo 'border:#006CCF; color:#006CCF';}
                                              else if($orderProList[$i]["de_status"] == "READY"){echo 'border:#FF9C00; color:#FF9C00';}
                                              else if($orderProList[$i]["de_status"] == "ON DELIVERIY"){echo 'border:#882FFA; color:#882FFA';}
                                              else if($orderProList[$i]["de_status"] == "DELIVERED"){echo 'border:#28D764; color:#28D764';}?>"

                                        ><?php echo $orderProList[$i]["de_status"]?></span>
                                    </td>
                                    <td class="color2-btn">
                                        <i style="cursor: pointer;" class="bi bi-box-arrow-up-right"
                                            onclick="openOrderItemModal(
                                                '<?php echo str_ireplace('"','|',json_encode(getOrderItemByOrderID($orderProList[$i]["order_id"])))?>',
                                                    '<?php echo $orderProList[$i]["de_status"]?>',
                                                    '<?php echo $orderProList[$i]["de_code"]?>',
                                                    '<?php echo $orderProList[$i]["order_number"]?>',
                                                    '<?php echo $orderProList[$i]["total_bill"]?>',
                                                    '<?php echo $orderProList[$i]["de_note"]?>',
                                                    '<?php echo $orderProList[$i]["order_id"]?>',
                                                    '<?php echo $orderProList[$i]["create_time"]?>',
                                                    '<?php echo $loggedUser['user_id']?>')">

                                        </i>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                    }?>
                    </tbody>
                </table>

            </div>
        </div>



    </main>


    <?php include './modals/logout-confiremation.php'; ?>
    <?php include './modals/view-orders.php'; ?>
    <?php include './modals/view-complaint.php'; ?>
    <?php include './modals/send-order_complaint.php'; ?>
    <script src="https://code.jquery.com/jquery-3.6.3.slim.min.js" integrity="sha256-ZwqZIVdD3iXNyGHbSYdsmWP//UBokj2FHAxKuSBKDSo=" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="./js/tools.js?v=7441744"></script>
    <script>
    document.getElementById('orders').classList.add('selected');
    setInterval(function() {
    var datetimeElement = document.getElementById('datetime');
    var options = {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: 'numeric',
        minute: 'numeric',
        second: 'numeric',
        hour12: false
    };
    var currentDateTime = new Date().toLocaleString('en-US', options);
    datetimeElement.innerHTML = currentDateTime;
}, 1000);

</script>

</body>

</html>