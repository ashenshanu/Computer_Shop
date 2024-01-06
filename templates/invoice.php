<?php
require_once "../connectors/db-connector.php";
require_once "../configs/config.php";

include "../controller/product_controller.php";
include "../controller/shop_controller.php";
include "../controller/order_controller.php";

$orderID = $_GET['oid'];
$shopID = $_GET['shid'];

if($orderID != null && $shopID != null){

    $shopData = getShopById($shopID);
    $itemList = getOrderItemByShopID($orderID,$shopID);
    $customerData = getCustomerFromOrderID($orderID);

//    var_dump($itemList);

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <title>Invoice</title>
</head>
<button class="btn primary"  onclick="window.print()" style="position: fixed;width: 70px;height: 30px; margin: 30px; ">
    <i class="bi bi-printer"></i> Print
</button>
<body>
    <div class="my-5 page" size="A4">
        <div class="p-5">
            <section class="top-content bb d-flex justify-content-between">
                <div class="logo">
                    <img src="../assets/Mr.PC.png" alt="" class="img-fluid">
                </div>
                <div class="top-left">
                    <div class="graphic-path">
                        <p>Invoice</p>
                    </div>
                    <?php

                    if(isset($customerData)){
                    ?>
                    <div class="position-relative">
                        <p>Invoice No. <span><?php echo $customerData["order_number"]?></span></p>
                    </div>
                </div>
            </section>

            <section class="store-user mt-5">
                <div class="col-10">
                    <div class="row bb pb-3">
                        <div class="col-7">
                            <p>Shop,</p>
                            <?php if(isset($shopData)){?>
                            <h2 id="shop_name"><?php echo $shopData["shop_name"]?></h2>
                            <p class="address" id="shop_address"><?php echo $shopData["address"]?></p>
                            <p class="address" id="shop_city"><?php
                            if (isset($shopData["city"])) {
                                echo $shopData["city"];
                            }?></p>
                            <div class="txn mt-2">Contact No: <span id="shop_tel"><?php echo $shopData["tel"]?></span></div>
                            <?php  }?>
                        </div>

                        <div class="col-5">
                            <p>Customer,</p>

                            <h2 id="cus_name"><?php echo $customerData["first_name"]." ".$customerData["last_name"]?></h2>
                            <p class="address" id="cus_address"><?php echo $customerData["de_address"]?></p>
                            <p class="address" id="cus_city"><?php
                                if (isset($customerData["city"])){
                                    echo $customerData["city"];
}?></p>
                            <div class="txn mt-2" id="cus-tel">Contact No: <span id="cus_tel"><?php echo $customerData["de_tel"]?></span></div>
                        </div>
                    </div>
                    <div class="row extra-info pt-3">
                        <div class="col-7">
                            <p>Payment Method: <span>cash on delivery</span></p>
                            <p>Order Number: #<span id="order_id"><?php echo $customerData["order_number"]?></span></p>
                        </div>
                        <div class="col-5">
                            <p>Ordered Date: <span id="order_date"><?php echo $customerData["create_time"]?></span></p>
                        </div>
                    </div>
                    <?php }?>
                </div>
            </section>

            <section class="product-area mt-4">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <td>Item Description</td>
                            <td>Price</td>
                            <td>Quantity</td>
                            <td>Total</td>
                        </tr>
                    </thead>
                    <tbody id="item-list-container">
                    <?php
                    //var_dump($itemList);
                    $subTot = 0;
                    for ($product = 0; count($itemList) > $product; $product++) {



                        ?>
                        <tr>
                            <td>
                                <div class="media">
                                    <img class="mr-3 img-fluid" src="../uploads/product_images/<?php echo $itemList[0]["image_url"]?>" alt="Product 01">
                                    <div class="media-body">
                                        <p class="mt-0 title" style="margin-left: 5px"> <?php echo $itemList[0]["product_name"]?></p>
                                    </div>
                                </div>
                            </td>
                            <td><?php echo number_format((float)$itemList[0]["per_price"], 2, '.', ',')?></td>
                            <td><?php echo $itemList[0]["quntity"]?></td>
                            <td><?php echo number_format((float)$itemList[0]["sub_total"], 2, '.', ',')?></td>
                        </tr>
                        <?php
                        $subTot = $subTot+$itemList[0]["sub_total"];
                    }
                    ?>
                    </tbody>
                </table>
            </section>

            <section class="balance-info">
                <div class="row">
                    <div class="col-8">
                        <p class="m-0 font-weight-bold"> Note: </p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. In delectus, adipisci vero est dolore praesentium.</p>
                    </div>
                    <div class="col-4">
                        <table class="table border-0 table-hover">
                            <tr>
                                <td>Discount (0%):</td>
                                <td>LKR 0.00</td>
                            </tr>
                            <tfoot>
                                <tr>
                                    <td>Total:</td>
                                    <td>LKR <?php echo number_format((float)$subTot, 2, '.', ',')?></td>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
            </section>
            <h5>Terms & Conditions</h5>
            <p>A Terms and Conditions agreement is where you let the public know the terms, rules and guidelines for using your website or mobile app. They include topics such as acceptable use, restricted behavior and limitations of liability.
                    <br><br>
                This article will get you started with creating your own custom Terms and Conditions agreement. We've also put together a Sample Terms and Conditions Template that you can use to help you write your own.</p>
        </body>
        </html>
<?php }else{

    header('Location: '.BASE_URL);
}?>