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
    include "../controller/complaint_controller.php";

    include './includes/dashboard-navigation.php';

    $complaintList = getComplaintListByUserID($_SESSION['user']["user_id"]);

    ?>

    <main class="section main-wrapper ">
        <div class="header">
            <h4>Complaints & Reports</h4>
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
                            <h6 class="text-sm text-medium">Complaint ID</h6>
                        </th>
                        <th class="min-width">
                            <h6 class="text-sm text-medium">
                                Subject
                            </h6>
                        </th>
                        <th class="min-width">
                            <h6 class="text-sm text-medium">
                                Sent Date
                            </h6>
                        </th>
                        <th class="min-width">
                            <h6 class="text-sm text-medium">
                                Kind of
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

                    if (isset($complaintList)) {
                        if (count($complaintList) > 0) {
                            for ($i = 0; $i < count($complaintList); $i++) {
                                ?>
                                <tr>
                                    <td>
                                        <p class="text-sm">#<?php echo $complaintList[$i]["com_id"] ?></p>
                                    </td>
                                    <td>
                                        <p class="text-sm"><?php echo $complaintList[$i]["subject"] ?></p>
                                    </td>
                                    <td>
                                        <p class="text-sm"><?php echo $complaintList[$i]["create_time"] ?></p>
                                    </td>
                                    <td>
                                        <p class="text-sm"><?php echo $complaintList[$i]["kind_of"] ?></p>
                                    </td>
                                    <td class="color2-btn">
                                        <i style="cursor: pointer;" class="bi bi-box-arrow-up-right"
                                           onclick="openComplaintModal(
                                                   '<?php




                                           echo str_ireplace('"','|',json_encode(getComplaintByComID($complaintList[$i]["com_id"])))?>')">
                                            <!--                                            onclick="$('#view-complaint-modal').modal('show');"-->
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

    <?php include './modals/logout-confiremation.php'; ?>
    <?php include './modals/view-complaint.php'; ?>
    <script src="https://code.jquery.com/jquery-3.6.3.slim.min.js" integrity="sha256-ZwqZIVdD3iXNyGHbSYdsmWP//UBokj2FHAxKuSBKDSo=" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="./js/tools.js?as=12323"></script>
    <script>
        document.getElementById('customers').classList.add('selected');
    </script>

</body>

</html>