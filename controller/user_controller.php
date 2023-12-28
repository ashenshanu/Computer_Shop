<?php

function insertUser($email,$password,$fname,$lname,$fullname,$bday,$gender,$nic,$mobile,$address,$city,$zip,$type){

    $conn = getConnection();

    $hasedPassword = password_hash($password,PASSWORD_DEFAULT);

    $sql = "INSERT INTO ".TABLE_USER." 
    (email, password, acc_type,acc_status,first_name,last_name,full_name,birthday,nic,tel,gender,home_address,home_city,zip_code,is_active)
    VALUES ('".$email."','".$hasedPassword."','".$type."','ACTIVE','".$fname."','".$lname."','".$fullname."','".$bday."','".$nic."','".$mobile."','".$gender."','".$address."','".$city."','".$zip."',1)";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        return false;
    }
}

function updateUserInfo($dpImg,$fName,$lName,$fullName,$birthday,$gender,$nic,$tel,$address,$city,$zipcode,$userID){

    $conn = getConnection();

    if($dpImg == null){
        $sql = "UPDATE ".TABLE_USER." SET first_name = '".$fName."',
    last_name = '".$lName."',
    full_name = '".$fullName."',
    birthday = '".$birthday."',
    nic = '".$nic."',
    tel = '".$tel."',
    gender = '".$gender."',
    home_address = '".$address."',
    home_city = '".$city."',
    zip_code = '".$zipcode."'
    WHERE user_id = '".$userID."'";
    } else{
        $sql = "UPDATE ".TABLE_USER." SET first_name = '".$fName."',
    last_name = '".$lName."',
    full_name = '".$fullName."',
    birthday = '".$birthday."',
    nic = '".$nic."',
    tel = '".$tel."',
    gender = '".$gender."',
    home_address = '".$address."',
    home_city = '".$city."',
    zip_code = '".$zipcode."',
    dp_img = '".$dpImg."'
    WHERE user_id = '".$userID."'";
    }

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        return false;
    }
}
function getUpdatedInfo($userId)
{
    $sendOnj = [
        'status' => "ERROR",
        'msg' => "Authentication Failed. Try again."
    ];

    $conn = getConnection();


    if (isset($userId)) {

        $stmt = $conn->prepare("SELECT * FROM " . TABLE_USER . " WHERE user_id = ?");
        $stmt->bind_param("s", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            $_SESSION['user'] = $row;

        }
        $stmt->close();
        $conn->close();
    }

    return $sendOnj;
}

function updateProfileImage($imageName,$userID){

    $conn = getConnection();

    $sql = "UPDATE ".TABLE_USER." SET dp_img = '".$imageName."' WHERE user_id=".$userID;

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        return false;
    }
}

function deleteUserOnDB($userID){

    $accountType = checkUserById($userID);
    $conn = getConnection();
    $productCount = 0;
    $shopCount = 0;
    $shopIds = array();
    $productList = array();

    $sql_user = "UPDATE ".TABLE_USER." SET is_active = '0' WHERE user_id=".$userID;
    if ($conn->query($sql_user) === TRUE) {
        if($accountType['acc_type'] == 'SHOPPER'){
            $shopIds = getShopIds($userID);
            for ($i=0; count($shopIds)>$i; $i++){
                $sql_shop = "UPDATE ".TABLE_SHOP." SET is_active = '0' WHERE shop_id=".$shopIds[$i]['shop_id'];
                if ($conn->query($sql_shop) === TRUE) {
                    $productList = getProductIds($shopIds[$i]['shop_id']);
                    if(isset($productList)) {
                        for ($n = 0; count($productList) > $n; $n++) {
                            $sql_product = "UPDATE " . TABLE_PRODUCT . " SET is_active = '0' WHERE product_id=" . $productList[$n]['product_id'];
                            if ($conn->query($sql_product) === TRUE) {
                                $productCount++;
                            }
                        }
                    }
                    $shopCount++;
                }
            }
        }
        var_dump(count($shopIds));
        var_dump($shopCount);
        var_dump(count($productList));
        var_dump($productCount);
        if(count($shopIds) == $shopCount && count($productList) == $productCount) {
            return true;
        }else{
            return false;
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        return false;
    }
}
function getProductIds($shopId){

    $conn = getConnection();

    $stmt = $conn->prepare("SELECT product.`product_id` FROM ".TABLE_PRODUCT." JOIN shop AS sh ON product.`shop_shop_id`= sh.`shop_id` WHERE sh.`shop_id` = ?");
    $stmt->bind_param("s", $shopId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    }else{
        return null;
    }
}
function getShopIds($userId){

    $conn = getConnection();

    $stmt = $conn->prepare("SELECT shop.shop_id FROM ".TABLE_SHOP." JOIN USER AS us ON shop.`user_user_id` = us.`user_id` WHERE us.user_id = ?");
    $stmt->bind_param("s", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    }else{
        return null;
    }
}

function checkUserById($userId){

    $conn = getConnection();

    $stmt = $conn->prepare("SELECT acc_type FROM ".TABLE_USER." WHERE user_id =  ?");
    $stmt->bind_param("s", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        return $result->fetch_assoc();
    }else{
        return null;
    }
}
function getUserByEmail($email){

    $conn = getConnection();

    $stmt = $conn->prepare("SELECT * FROM ".TABLE_USER." WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        return $result->fetch_assoc();
    }else{
        return null;
    }
}

function isEmailExists($email){

    $conn = getConnection();

    $stmt = $conn->prepare("SELECT * FROM ".TABLE_USER." WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        return true;
    }else{
        return false;
    }
}

function getOrdersByCustomerID($customerID){

    $conn = getConnection();

    $stmt = $conn->prepare("SELECT * FROM ".TABLE_ORDER." WHERE user_user_id = ".$customerID);
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

function getAccountsOrderByDate(){

    $conn = getConnection();

    $stmt = $conn->prepare("SELECT * FROM ".TABLE_USER." ORDER BY date_created");
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


function currentPasswordCheck($currentPass,$userID){

    $conn = getConnection();

    $stmt = $conn->prepare("SELECT password FROM ".TABLE_USER." WHERE user_id = ".$userID.";");
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();
        $conn->close();
        $hashed_password = $row["password"];
        if(password_verify($currentPass, $hashed_password)){
            return true;
        }
    }

    $conn->close();
    return false;
}


function updateUserPassword($newPass,$userID){

    $conn = getConnection();

    $hasedPassword = password_hash($newPass,PASSWORD_DEFAULT);

    $sql = "UPDATE ".TABLE_USER." SET password = '".$hasedPassword."' WHERE user_id = '".$userID."'";

    if ($conn->query($sql) === TRUE) {
        $conn->close();
        return true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        $conn->close();
        return false;
    }
}

function createResetRecord($userID,$resetCode){

    $conn = getConnection();

    $sql = "INSERT INTO ".TABLE_PASSWORD_RESET." (user_user_id,reset_code,is_used,is_expired,is_active)
    VALUES ('".$userID."','".$resetCode."',0,0,1)";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        return false;
    }

}

function getResetPasswordByCode($resetCode){

    $conn = getConnection();

    $stmt = $conn->prepare("SELECT * FROM ".TABLE_PASSWORD_RESET." WHERE reset_code = '".$resetCode."'");
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row;
    } else {
        return null;
    }

}

function updatePasswordResetLink($resetCode){

    $conn = getConnection();

    $sql = "UPDATE ".TABLE_PASSWORD_RESET." SET is_used = 1 WHERE reset_code = '".$resetCode."'";

    if ($conn->query($sql) === TRUE) {
        $conn->close();
        return true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        $conn->close();
        return false;
    }
}
function getUserByUserID($userID){

    $conn = getConnection();

    $stmt = $conn->prepare("SELECT * FROM " . TABLE_USER . " WHERE user_id= ".$userID.";");
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

function updateAccountStatus($action,$userId){
    $conn = getConnection();

    $sql = "UPDATE ".TABLE_USER." SET acc_status = '".$action."' WHERE user_id=".$userId;

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        return false;
    }
}

function getShopperStats($userID){

    $conn = getConnection();

    $stmt = $conn->prepare("SELECT SUM(or_it.`sub_total`) AS total_earn,
    COUNT(DISTINCT(`site_order`.`order_number`)) AS totla_orders,
    COUNT(DISTINCT(`site_order`.`user_user_id`)) AS total_customers
    FROM site_order
    JOIN order_item AS or_it ON site_order.`order_id` = or_it.`order_order_id`
    JOIN  product ON or_it.`product_product_id` = `product`.`product_id`
    JOIN shop AS sh ON product.`shop_shop_id` = sh.`shop_id`
    JOIN USER ON sh.`user_user_id` = user.`user_id`
    WHERE user.user_id = '".$userID."'");
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


function deleteUserById($shopId){
    $conn = getConnection();

    $sql = "UPDATE ".TABLE_USER." SET is_active = '0', shop_status = 'DELETED'  WHERE shop_id=".$shopId;

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