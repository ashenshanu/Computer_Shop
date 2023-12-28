<?php

require_once '../functions/code-generate.php';

function insertOrder($address,$city,$msg,$userID,$cart,$tel){


    $orderNumber = "SAI".str_pad(rand(0, 999999), 6, "0", STR_PAD_LEFT);

    $totBill = 0.00;
    for ($i = 0; $i < count($cart); $i++) {

        $subTotal = $cart[$i]["product"]["per_price"] * $cart[$i]["quantity"];
        $totBill += $subTotal;
    }

    $conn = getConnection();

    $deCode = generateCode();

    $sql = "INSERT INTO ".TABLE_ORDER." (order_number,de_address,de_tel,de_note,de_status,total_bill,user_user_id,de_city,de_code)
    VALUES ('".$orderNumber."','".$address."','".$tel."','".$msg."','PROCESSING','".$totBill."','".$userID."','".$city."','".$deCode."')" ;

    if ($conn->query($sql) === TRUE) {

        $savedID = $conn->insert_id;
        if($savedID > 0){

            $conn->close();
            $conn = getConnection();
            $connstock = getConnection();
            $successCount = 0;
            for ($i = 0; $i < count($cart); $i++) {

                $subTotal = $cart[$i]["product"]["per_price"] * $cart[$i]["quantity"];

                $query = "INSERT INTO ".TABLE_ORDER_ITEMS." 
                (product_name,quntity,per_price,sub_total,product_product_id,order_order_id)
                VALUES ('".$cart[$i]["product"]["product_name"]."',
                '".$cart[$i]["quantity"]."',
                '".$cart[$i]["product"]["per_price"]."',
                '".$subTotal."',
                '".$cart[$i]["product"]["product_id"]."',
                '".$savedID."')" ;

                if($conn->query($query) === TRUE){

                    /**
                     *Update Product Stock
                     */
                    $stmt = $connstock->prepare("SELECT * FROM " . TABLE_PRODUCT . " WHERE is_active = 1 AND status = 'ACTIVE' AND product_id = ?");
                    $stmt->bind_param("s", $cart[$i]["product"]["product_id"]);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $connstock->close();
                        if($row["quntity"] > 0){
                            $setQty = $row["quntity"] - $cart[$i]["quantity"];
                            $stockQuery = "UPDATE ".TABLE_PRODUCT." SET quntity = ".$setQty." WHERE product_id = ".$cart[$i]["product"]["product_id"];

                            $connstock = getConnection();
                            if ($connstock->query($stockQuery) === TRUE) {
                                $successCount++;
                            }
                        }
                    }

                }else{
                    echo "Order Item Row Error: " . $sql . "<br>" . $conn->error;
                }

            }
            $conn->close();
            if($successCount == count($cart)){
                return $orderNumber;
            }else{
                return null;
            }

        }
    }else{
        echo "Order Main Error: " . $sql . "<br>" . $conn->error;
    }

}

function updateOrderStatusByID($status,$orderID){

    $conn = getConnection();

    $sql = "UPDATE ".TABLE_ORDER." SET de_status = '".$status."' WHERE order_id = ".$orderID;

    if ($conn->query($sql) === TRUE) {
        $conn->close();
        return true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        return false;
    }
}

function getOrderItemByOrderID($orderID){

    $conn = getConnection();

    $stmt = $conn->prepare("SELECT order_item.`product_name`, shop.`email`,shop.`tel`,
    product.`image_url`,`order_item`.`quntity`,`order_item`.`sub_total`,shop.shop_name,order_item.per_price FROM `order_item` 
    JOIN product ON `order_item`.`product_product_id` = `product`.`product_id`
    JOIN shop ON product.`shop_shop_id` = shop.`shop_id`
    WHERE `order_order_id` = ".$orderID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return null;
    }

    $stmt->close();
    $conn->close();

}

function getCustomerFromOrderID($orderID){

    $conn = getConnection();

    $stmt = $conn->prepare("SELECT cus.first_name,cus.last_name,ord.de_tel,ord.de_address,ord.de_note,ord.create_time,ord.de_city,ord.de_status,ord.order_number 
    FROM ".TABLE_ORDER." AS ord
    JOIN ".TABLE_USER." AS cus ON ord.user_user_id = cus.user_id
    WHERE ord.order_id = '".$orderID."'");
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $stmt->close();
        $conn->close();
        return $data;
    } else {
        $stmt->close();
        $conn->close();
        return null;
    }
}

function getOrderItemByShopID($orderID,$shopID){

    $conn = getConnection();

    $stmt = $conn->prepare("SELECT order_item.`product_name`, shop.`email`,shop.`tel`,
    product.`image_url`,`order_item`.`quntity`,`order_item`.`sub_total`,shop.shop_name,order_item.per_price 
    FROM `order_item` 
    JOIN product ON `order_item`.`product_product_id` = `product`.`product_id`
    JOIN shop ON product.`shop_shop_id` = shop.`shop_id`
    WHERE `order_order_id` = ".$orderID." AND shop.shop_id = ".$shopID );
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        $conn->close();
        return $data;
    } else {
        $stmt->close();
        $conn->close();
        return null;
    }

}