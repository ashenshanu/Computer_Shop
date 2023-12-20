<?php


function getShops(){

    $conn = getConnection();

    $stmt = $conn->prepare("SELECT * FROM ".TABLE_SHOP." WHERE is_active = 1");
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 1){
        return $result->fetch_all();
    }else{
        return null;
    }

    $stmt->close();
    $conn->close();
}


function getShopById($shop_id){
    $conn = getConnection();

    $stmt = $conn->prepare("SELECT * FROM " . TABLE_SHOP . " WHERE shop_id= $shop_id");
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row;
    } else {
        return null;
    }

    $stmt->close();
    $conn->close();
}
function getShopByOrderId($order_id){
    $conn = getConnection();

    $stmt = $conn->prepare("SELECT * FROM " . TABLE_SHOP . " WHERE shop_id= $shop_id");
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row;
    } else {
        return null;
    }

    $stmt->close();
    $conn->close();
}

function getShopListByUserID($userID){

    $conn = getConnection();

    $stmt = $conn->prepare("SELECT * FROM " . TABLE_SHOP . " WHERE user_user_id= ".$userID." AND is_active=1 ");
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_all();
    } else {
        return null;
    }

    $stmt->close();
    $conn->close();
}

function getOrdersByShopID($shopID){

    $conn = getConnection();

    $stmt = $conn->prepare("SELECT site_order.order_id,site_order.order_number,user.full_name,site_order.create_time,site_order.de_status FROM ".TABLE_ORDER."
    JOIN order_item AS or_it ON site_order.`order_id` = or_it.`order_order_id`
    JOIN  product ON or_it.`product_product_id` = `product`.`product_id`
    JOIN  user ON site_order.`user_user_id` = user.`user_id`
    WHERE product.shop_shop_id = ".$shopID." GROUP BY site_order.order_id");
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

function getCustomInfoShopByShopID($shopID){

    $conn = getConnection();

    $stmt = $conn->prepare("SELECT * FROM ".TABLE_SHOP." JOIN USER AS us ON shop.`user_user_id`= us.`user_id` WHERE shop_id = ".$shopID.";");
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
function getShopStats($shopId){

    $conn = getConnection();

    $stmt = $conn->prepare("SELECT SUM(or_it.`sub_total`) AS total_earn,
COUNT(DISTINCT(`site_order`.`order_number`)) AS total_orders,
COUNT(DISTINCT(`site_order`.`user_user_id`)) AS total_customers
FROM site_order
    JOIN order_item AS or_it ON site_order.`order_id` = or_it.`order_order_id`
    JOIN  product ON or_it.`product_product_id` = `product`.`product_id`
    JOIN shop AS sh ON product.`shop_shop_id` = sh.`shop_id`
    JOIN USER ON sh.`user_user_id` = user.`user_id`
    WHERE sh.`shop_id` = '".$shopId."'");
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $conn->close();
        return $row;
    }else{
        return null;
    }
}
function updateShopStatus($action,$shopId){
    $conn = getConnection();

    $sql = "UPDATE ".TABLE_SHOP." SET shop_status = '".$action."' WHERE shop_id=".$shopId;

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        return false;
    }
}

function getComplaintListByUserID($customerID){

    $conn = getConnection();

    $stmt = $conn->prepare("SELECT * FROM ".TABLE_COMPLAINT." WHERE user_id = ".$customerID." ORDER BY create_time");
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

function getOrderProductsByShopIDAndOrderID($shopID,$orderID){

    $conn = getConnection();

    $stmt = $conn->prepare("SELECT site_order.order_id,user.first_name,user.last_name ,user.full_name,
    site_order.de_address,site_order.de_city,site_order.de_note,site_order.de_tel,site_order.total_bill,site_order.de_status,
    or_it.product_name,or_it.per_price,or_it.quntity,or_it.sub_total
    FROM ".TABLE_ORDER."
    JOIN order_item AS or_it ON site_order.`order_id` = or_it.`order_order_id`
    JOIN  product ON or_it.`product_product_id` = `product`.`product_id`
    JOIN `product_category` AS pro_cat ON pro_cat.`cat_id` = `product`.`product_category_cat_id`
    JOIN  user ON site_order.`user_user_id` = user.`user_id`
    WHERE product.shop_shop_id = ".$shopID." AND site_order.order_id = ".$orderID);
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
function getOrderProductsByShopIDAndOrderIDForInvoice($shopID,$orderID){

    $conn = getConnection();

    if(!$conn) {

//Handle connection error
}

    $query ="SELECT site_order.order_id,user.first_name,user.last_name ,user.full_name,
    site_order.de_address,site_order.de_city,site_order.de_tel,site_order.total_bill,site_order.de_status,
    or_it.product_name,or_it.per_price,or_it.quntity,or_it.sub_total
    FROM ".TABLE_ORDER."
    JOIN order_item AS or_it ON site_order.`order_id` = or_it.`order_order_id`
    JOIN  product ON or_it.`product_product_id` = `product`.`product_id`
    JOIN `product_category` AS pro_cat ON pro_cat.`cat_id` = `product`.`product_category_cat_id`
    JOIN  user ON site_order.`user_user_id` = user.`user_id`
    WHERE product.shop_shop_id = ".$shopID." AND site_order.order_id = ".$orderID;

    $stmt = $conn->prepare($query);
    $stmt->execute();
    $data = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    $stmt->close();
    $conn->close();



    return $data;
}
function getCustomerListByShopID($shopID){

    $conn = getConnection();

    $stmt = $conn->prepare("SELECT user.first_name,user.user_id,user.last_name,user.email,COUNT(DISTINCT(site_order.order_id)) AS orderCount,
    COUNT(DISTINCT CASE WHEN site_order.`de_status` = 'DELIVERED' THEN site_order.order_id END) AS successful_orders,
    SUM(or_it.`sub_total`) AS total
    FROM ".TABLE_ORDER."
    JOIN order_item AS or_it ON site_order.`order_id` = or_it.`order_order_id`
    JOIN  product ON or_it.`product_product_id` = `product`.`product_id`
    JOIN  USER ON site_order.`user_user_id` = user.`user_id`
    WHERE product.shop_shop_id = ".$shopID."
    GROUP BY user.user_id");
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
function updateShopInfo($savedFileName1,$savedFileName2, $shopName, $description, $roc, $contact, $address, $city, $zip, $shopId){

    $conn = getConnection();

    if(!isset($savedFileName1) && !isset($savedFileName2)){
        $sql = "UPDATE ".TABLE_SHOP." SET shop_name = '".$shopName."',
    nb_description = '".$description."',
    roc_number = '".$roc."',
    tel = '".$contact."',
    address = '".$address."',
    city = '".$city."',
    zip_code = '".$zip."' 
    WHERE shop_id = '".$shopId."'";
    } else if(!isset($savedFileName1)){
        $sql = "UPDATE ".TABLE_SHOP." SET shop_name = '".$shopName."',
    nb_description = '".$description."',
    roc_number = '".$roc."',
    tel = '".$contact."',
    address = '".$address."',
    city = '".$city."',
    zip_code = '".$zip."',
    dp_banner = '".$savedFileName2."' 
    WHERE shop_id = '".$shopId."'";
    } else if(!isset($savedFileName2)){
        $sql = "UPDATE ".TABLE_SHOP." SET shop_name = '".$shopName."',
    nb_description = '".$description."',
    roc_number = '".$roc."',
    tel = '".$contact."',
    address = '".$address."',
    city = '".$city."',
    zip_code = '".$zip."',
    dp_logo = '".$savedFileName1."'
    WHERE shop_id = '".$shopId."'";
    } else {
        $sql = "UPDATE ".TABLE_SHOP." SET shop_name = '".$shopName."',
    nb_description = '".$description."',
    roc_number = '".$roc."',
    tel = '".$contact."',
    address = '".$address."',
    city = '".$city."',
    zip_code = '".$zip."',
    dp_logo = '".$savedFileName1."',
    dp_banner = '".$savedFileName2."' 
    WHERE shop_id = '".$shopId."'";
    }

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        return false;
    }
}
//
//function getUpdatedShopInfo($shopId)
//{
//    $sendOnj = [
//        'status' => "ERROR",
//        'msg' => "Authentication Failed. Try again."
//    ];
//
//    $conn = getConnection();
//
//
//    if (isset($userId)) {
//
//        $stmt = $conn->prepare("SELECT * FROM " . TABLE_SHOP . " WHERE shop_id = ?");
//        $stmt->bind_param("s", $shopId);
//        $stmt->execute();
//        $result = $stmt->get_result();
//
//        if ($result->num_rows == 1) {
//            $row = $result->fetch_assoc();
//
////            $shopData = $row;
//
//        }
//        $stmt->close();
//        $conn->close();
//    }
//
//    return $sendOnj;
//}



function getDashboardData($shopID){

    $conn = getConnection();

    $stmt = $conn->prepare("SELECT 
    COUNT(CASE WHEN site_order.`de_status` = 'DELIVERED' THEN site_order.order_id END) AS successful_orders,
    SUM(or_it.sub_total) AS total_sales,
    COUNT(CASE WHEN site_order.`de_status` = 'PROCESSING' THEN site_order.order_id END) AS inprocess_orders,
    SUM(or_it.quntity) AS total_sold
    FROM ".TABLE_ORDER." 
    JOIN ".TABLE_ORDER_ITEMS." AS or_it ON site_order.`order_id` = or_it.`order_order_id`
    JOIN  ".TABLE_PRODUCT." ON or_it.`product_product_id` = `product`.`product_id`
    JOIN  ".TABLE_USER." ON site_order.`user_user_id` = user.`user_id`
    WHERE product.shop_shop_id = ".$shopID);
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

function getInStockTotalByShop($shopID){

    $conn = getConnection();

    $stmt = $conn->prepare("SELECT SUM(`quntity`) AS tot_in FROM ".TABLE_PRODUCT." 
    WHERE `shop_shop_id` = ".$shopID);
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

function getCustomerDataByShopAndCustomerID($shopID,$customerID){

    $conn = getConnection();

    $stmt = $conn->prepare("SELECT site_order.* ,user.*,product.product_id,or_it.*, SUM(or_it.sub_total) AS cust_total
    FROM ".TABLE_ORDER."
    JOIN order_item AS or_it ON site_order.`order_id` = or_it.`order_order_id`
    JOIN  product ON or_it.`product_product_id` = `product`.`product_id`
    JOIN  USER ON site_order.`user_user_id` = user.`user_id`
    WHERE product.shop_shop_id = ".$shopID." AND user.user_id = ".$customerID." GROUp BY site_order.order_id");
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


function createShopDB($shop_name, $email, $tel,$address,$city,$zip_code,$roc_number, $nb_description, $db_logo, $db_banner,$userID){

    $conn = getConnection();

    $sql = "INSERT INTO ".TABLE_SHOP." 
    (shop_name, email, tel,address,city,zip_code,roc_number,is_active, user_user_id, nb_description, dp_logo, dp_banner)
    VALUES ('".$shop_name."','".$email."','".$tel."','".$address."','".$city."','".$zip_code."','".$roc_number."',1,'".$userID."','".$nb_description."','".$db_logo."','".$db_banner."')";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        return false;
    }
}

function getShopsOrderByDate(){

    $conn = getConnection();

    $stmt = $conn->prepare("SELECT * FROM ".TABLE_SHOP." S INNER JOIN ".TABLE_USER." U ON S.`user_user_id` = U.`user_id` ORDER BY S.`create_time`");
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
function getTotalShop(){
    $conn = getConnection();

    $stmt = $conn->prepare("SELECT COUNT(*) FROM ".TABLE_SHOP." WHERE is_active = 1;");
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
function getTotalCustomer(){
    $conn = getConnection();

    $stmt = $conn->prepare("SELECT COUNT(*) FROM ".TABLE_USER." WHERE is_active = 1 AND acc_type = 'CUSTOMER';");
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

function getTodayOrderCount(){
    $conn = getConnection();

    $stmt = $conn->prepare("SELECT COUNT(*) FROM ".TABLE_ORDER." WHERE create_time >= CURDATE() GROUP BY DATE(create_time);");
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

function deleteShopById($shopId){
    $conn = getConnection();

    $sql = "UPDATE ".TABLE_SHOP." SET is_active = '0', shop_status = 'DELETED'  WHERE shop_id=".$shopId;

    if ($conn->query($sql) === TRUE) {

        $sql = "UPDATE ".TABLE_PRODUCT." SET is_active = '0'  WHERE shop_shop_id=".$shopId;
        if ($conn->query($sql) === TRUE) {
            return true;
        }
        return true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        return false;
    }
}