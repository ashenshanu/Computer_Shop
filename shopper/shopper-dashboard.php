<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="./css/shopper-main.css">
    <title>Dashboard | Sanakin.lk</title>
</head>

<body>

    <?php

    require_once "../connectors/db-connector.php";
    require_once "../configs/config.php";

    include "../controller/product_controller.php";
    include "../controller/shop_controller.php";

    include './includes/dashboard-navigation.php';
    $orderProList = getOrdersByShopID($_SESSION["selectedShopID"]);
    $dashboardData = getDashboardData($_SESSION["selectedShopID"]);
    $shopProductList = getProductByShopId($_SESSION["selectedShopID"]);
    $totalProduct = 0;
    if(isset($shopProductList)) {
        $totalProduct = count($shopProductList);
    }
    $totalInStock = getInStockTotalByShop($_SESSION["selectedShopID"]);
    // ------------------------------------------------------------------------------

    // $dataPoints = array( 
    //     array("label"=>"Instock", "symbol" => "Instock","y"=>46.6),
    //     array("label"=>"Sold Stock", "symbol" => "Sold Stock","y"=>27.7),
        
     
    // )
    $categoryList = getAllCategories();
//    var_dump($shopData);
    ?>
    <main class="section main-wrapper ">
        <div class="header">
            <h4>Dashboard</h4>
            <span class="current_timestamp" id="datetime"></span>
        </div>
        <div class="section">
            <div class="row">
                <div class="col-7">
                    <div class="row orange-text">
                        <div class="col-6">
                            <div class="stat-card white-bd-card">
                                <div class="info">
                                    <span class="count"><?php echo $totalProduct?></span>
                                    <span class="title">Total Product</span>
                                </div>
                                <div class="icon">
                                    <i class="bi bi-boxes"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-card white-bd-card">
                                <div class="info">
                                    <span class="count"><?php echo isset($dashboardData[0]["total_sales"]) ? $dashboardData[0]["total_sales"] : "0"?></span>
                                    <span class="title">Total Sales</span>
                                </div>
                                <div class="icon">
                                    <i class="bi bi-graph-up-arrow"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-card white-bd-card">
                                <div class="info">
                                    <span class="count"><?php echo isset($dashboardData[0]["successful_orders"]) ? $dashboardData[0]["successful_orders"] : "0"?></span>
                                    <span class="title">Success Orders</span>
                                </div>
                                <div class="icon">
                                    <i class="bi bi-box2-heart"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-card white-bd-card">
                                <div class="info">
                                    <span class="count"><?php echo isset($dashboardData[0]["inprocess_orders"]) ? $dashboardData[0]["inprocess_orders"] : "0"?></span>
                                    <span class="title">On Proccess to Delivary</span>
                                </div>
                                <div class="icon">
                                    <i class="bi bi-truck"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row btn-section">
                        <div class="col-6">
                            <div class="btn-card  white-bd-card" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#add-product-modal">
                                <div class="info">
                                    <span class="title">Add New Product</span>
                                    <span class="description">On Proccess to Delivary</span>
                                </div>
                                <div class="icon">
                                    <i class="bi bi-plus-square"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-5">
                <div class="chart-card white-bd-card">
                <canvas id="myChart" style="height: 200px !important; width: 200px !important;"></canvas>

                </div>
                </div>
                
            </div>
            <div class="row">
            <div class="table-responsive">
                <table class="table top-selling-table">
                    <thead>
                        <tr>
                            <th>
                                <h6 class="text-sm text-medium">Order ID</h6>
                            </th>
                            <th class="min-width">
                                <h6 class="text-sm text-medium">
                                    Customer Name
                                </h6>
                            </th>
                            <th class="min-width">
                                <h6 class="text-sm text-medium">
                                    Order Date
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
                                        <p class="text-sm"><?php echo $orderProList[$i]["full_name"]?></p>
                                    </td>
                                    <td>
                                        <p class="text-sm"><?php echo $orderProList[$i]["create_time"]?></p>
                                    </td>
                                    <td>
                                        <span class="status-tag text-sm"
                                              style="<?php
                                              if($orderProList[$i]["de_status"] == "PROCESSING"){echo 'border:#006CCF; color:#006CCF';}
                                              else if($orderProList[$i]["de_status"] == "READY"){echo 'border:#FF9C00; color:#FF9C00';}
                                              else if($orderProList[$i]["de_status"] == "ON DELIVERY"){echo 'border:#882FFA; color:#882FFA';}
                                              else if($orderProList[$i]["de_status"] == "DELIVERED"){echo 'border:#28D764; color:#28D764';}?>"

                                        ><?php echo $orderProList[$i]["de_status"]?></span>
                                    </td>
                                    <td class="color2-btn">
                                        <i style="cursor: pointer;" class="bi bi-box-arrow-up-right"
                                            onclick="openOrderItemModal('<?php echo str_ireplace('"','|',json_encode(getOrderProductsByShopIDAndOrderID($_SESSION["selectedShopID"],$orderProList[$i]["order_id"])))?>')"></i>
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
        </div>





    </main>

    <?php include './modals/logout-confiremation.php'; ?>
    <?php include './modals/view-orders.php'; ?>
    <?php include './modals/add-product.php'; ?>
    <script src="https://code.jquery.com/jquery-3.6.3.slim.min.js" integrity="sha256-ZwqZIVdD3iXNyGHbSYdsmWP//UBokj2FHAxKuSBKDSo=" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="./js/tools.js?v=741"></script>
    
    <script>document.getElementById('dashboard').classList.add('selected');</script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>

</html>

<script>
  var ctx = document.getElementById('myChart').getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ['Instock', 'Sold'],
      datasets: [{
        data: [<?php echo $totalInStock[0]["tot_in"]?>, <?php echo $dashboardData[0]["total_sold"]?>],
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