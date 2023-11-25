<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="./css/admin-main.css">
    <title>Admin Dashboard | Sanakin.lk</title>
</head>

<body>

    <?php

    require_once "../connectors/db-connector.php";
    require_once "../configs/config.php";

    include "../controller/product_controller.php";
    include "../controller/shop_controller.php";
    include "../controller/user_controller.php";

    include './includes/dashboard-navigation.php';

    $accountList = getAccountsOrderByDate();
    $totalShops = getTotalShop();
    $totalCustomers = getTotalCustomer();
    $todayOrderCount = getTodayOrderCount();


    ?>
    <main class="section main-wrapper ">
        <section id="loader" style="position:fixed; width:-webkit-fill-available; height:100%; z-index:10000; display:flex; flex-direction:column; justify-content:center; align-items:center; background:#ffffff;">
            <div class="spinner-grow text-warning" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </section>
        <div class="header">
            <h4>Dashboard</h4>
            <span class="current_timestamp" id="datetime"></span>
        </div>
        <div class="section">
            <div class="row ">
                <div class="col-4 gray-text">
                    <div class="stat-card white-bd-card">
                        <div class="info">
                            <span class="count orange-text"><?php echo $totalShops[0]['COUNT(*)']; ?></span>
                            <span class="title">Total Shops</span>
                        </div>
                        <div class="icon">
                            <img src="../assets/icons/shopper.svg" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-4 gray-text">
                    <div class="stat-card white-bd-card">
                        <div class="info">
                            <span class="count orange-text"><?php echo $totalCustomers[0]['COUNT(*)']; ?></span>
                            <span class="title">Total Customers</span>
                        </div>
                        <div class="icon">
                            <img src="../assets/icons/adminsales.svg" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-4 gray-text">
                    <div class="stat-card white-bd-card">
                        <div class="info">
                            <span class="count orange-text"><?php
                                if (!isset($todayOrderCount[0]['COUNT(*)'])){
                                    echo "0";
                                }else{
                                    echo $todayOrderCount[0]['COUNT(*)'];
                                }
                                 ?></span>
                            <span class="title">Today Total Orders</span>
                        </div>
                        <div class="icon">
                            <img src="../assets/icons/customerd.svg" alt="">
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="table-responsive">
                    <table class="table top-selling-table">
                        <thead>
                            <tr>
                                <th class="min-width">
                                    <h4 class="text-sm text-medium">
                                        New Accounts
                                    </h4>
                                </th>
                                <th class="min-width">
                                    <h6 class="text-sm text-medium">
                                        Account Name
                                    </h6>
                                </th>
                                <th class="min-width">
                                    <h6 class="text-sm text-medium">
                                        Registered Date
                                    </h6>
                                </th>
                                <th class="min-width">
                                    <h6 class="text-sm text-medium">
                                        AC. Verification
                                    </h6>
                                </th>
                                <th class="min-width">
                                    <h6 class="text-sm text-medium">
                                        Type
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

                            if (isset($accountList)) {
                                if (count($accountList) > 0) {
                                    for ($i = 0; $i < count($accountList); $i++) {
                            ?>
                                        <tr>
                                            <td>
                                                <div class="product">
                                                    <p class="text-sm">#<?php echo $accountList[$i]["user_id"] ?></p>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-sm">
                                                <p class="text-sm"><?php echo $accountList[$i]["first_name"] ?> <?php echo $accountList[$i]["last_name"] ?></p>
                                            </td>
                                            <td>
                                                <p class="text-sm"><?php echo $accountList[$i]["date_created"] ?></p>
                                            </td>
                                            <td>
                                                <span class="status-tag text-sm" style="<?php
                                                                                        if ($accountList[$i]["acc_status"] == "ACTIVE") {
                                                                                            echo 'border:#006CCF; color:#006CCF';
                                                                                        } else if ($accountList[$i]["acc_status"] == "BANNED") {
                                                                                            echo 'border:#882FFA; color:#882FFA';
                                                                                        } else if ($accountList[$i]["acc_status"] == "VERIFIED") {
                                                                                            echo 'border:#28D764; color:#28D764';
                                                                                        } ?>"><?php echo $accountList[$i]["acc_status"] ?></span>
                                                <p class="text-sm"></p>
                                            </td>
                                            <td>
                                                <p class="text-sm"><?php echo $accountList[$i]["acc_type"] ?></p>
                                            </td>

                                            <td class="color2-btn">
                                                <i style="cursor: pointer;" class="bi bi-box-arrow-up-right"
                                                   onclick="openUserAccountModal(
                                                           '<?php

                                                   echo str_ireplace('"','|',json_encode(getUserByUserID($accountList[$i]["user_id"])))?>')">
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
        </div>





    </main>

    <?php include './modals/logout-confiremation.php'; ?>
    <?php include './modals/view-account.php'; ?>
    <script src="https://code.jquery.com/jquery-3.6.3.slim.min.js" integrity="sha256-ZwqZIVdD3iXNyGHbSYdsmWP//UBokj2FHAxKuSBKDSo=" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="./js/tools.js?v=7874"></script>

    <script>
        document.getElementById('dashboard').classList.add('selected');
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Instock', 'Sold'],
                datasets: [{
                    data: [<?php echo $totalInStock[0]["tot_in"] ?>, <?php echo $dashboardData[0]["total_sold"] ?>],
                    backgroundColor: ['#FFEAC9', '#FF9C00'],
                    borderWidth: 1,
                    pointRadius: 1
                }]
            },
            options: {
                animation: {
                    animateRotate: true,
                    animateScale: true
                },
                layout: {
                    padding: {
                        top: 0,
                        bottom: 0,
                        boxHeight: 4
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            lineHeight: 0.5,
                        },
                        boxHeight: 1 // Change this value to adjust the color scheme height
                    }
                }
            }
        });
    </script>
</body>

</html>
