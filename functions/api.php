<?php


session_start();

include('../connectors/db-connector.php');
require_once('../configs/config.php');
require_once('../controller/product_controller.php');
require_once('./email-functions.php');
require_once('../controller/file_controller.php');
require_once('../controller/user_controller.php');
require_once('../controller/order_controller.php');
require_once('../controller/shop_controller.php');
require_once('../controller/other_controller.php');
require_once('../controller/chat_controller.php');

header('Content-Type: application/json');


function userLogin($email, $password)
{
    $sendOnj = [
        'status' => "ERROR",
        'msg' => "Authentication Failed. Try again."
    ];

    $conn = getConnection();


    if (isset($email) && isset($password)) {

        $stmt = $conn->prepare("SELECT * FROM " . TABLE_USER . " WHERE is_active = 1 AND acc_status <> 'BLACK' AND email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $hashed_password = $row["password"];

            if($row["acc_status"] == 'BANNED'){
                $sendOnj = [
                    'status' => "BANNED ACCOUNT",
                    'msg' => "You are temporarily banned from Mr.PC. contact our administration."
                ];
            }else if (password_verify($password, $hashed_password)) {
                $sendOnj = [
                    'status' => "SUCCESS",
                    'msg' => "Login OK"
                ];
                $_SESSION['user'] = $row;
            }
        }
        $stmt->close();
        $conn->close();
    }

    return $sendOnj;
}

function addSessionCart($productID, $qty)
{

    if (isset($productID)) {
        $product = getProductByID($productID);
        if ($product != null) {

            $productData = getProductByID($productID);

            if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                if (isProductExistsInSessionCart($productID)) {
                    foreach ($_SESSION['cart'] as &$item) {
                        if ($item['product']['product_id'] == $productID) {
                            $item['quantity'] += $qty;
                            break;
                        }
                    }
                } else {
                    $_SESSION['cart'][] = array(
                        'product' => $product,
                        'quantity' => (int)$qty,
                        'max_qty' => $productData["quntity"]
                    );
                }
            } else {
                $_SESSION['cart'][] = array(
                    'product' => $product,
                    'quantity' => (int)$qty,
                    'max_qty' => $productData["quntity"]
                );
            }
            $sendOnj = [
                'status' => "SUCCESS",
                'msg' => "Login OK"
            ];

            return $sendOnj;
        }
    }
}

function verifyEmailSend($email)
{

    $sendOnj = [
        'status' => "ERROR",
        'msg' => "Entered Email address is wrong. Check it and Try again."
    ];

    if (!isEmailExists($email)) {
        if (emailVerificationSend($email)) {
            $sendOnj = [
                'status' => "SUCCESS",
                'msg' => "Email Sent"
            ];
        }
    } else {
        $sendOnj = [
            'status' => "ERROR",
            'msg' => "Email Already Exists Please use another Email Address"
        ];
    }

    return $sendOnj;
}

function verifyEmailCode($code)
{

    $sendOnj = [
        'status' => "ERROR",
        'msg' => "Entered Verification code is wrong. Try again."
    ];

    if ($_SESSION['verifyingCode'] = $code) {

        $_SESSION["verifyingCode"] = null;

        $sendOnj = [
            'status' => "SUCCESS",
            'msg' => "Email Verified Successfully"
        ];
    }

    return $sendOnj;
}

function insertProduct($name, $price, $categoryID, $desc, $qty, $productImage, $status)
{

    $sendOnj = [
        'status' => "ERROR",
        'msg' => "Product Not Created"
    ];

    $savedFileName = "";
    if (isset($productImage)) {
        $extension = pathinfo($productImage['name'], PATHINFO_EXTENSION);
        $savedFileName = uniqid() . '.' . $extension;
        $isSaved = uploadFile($productImage, $savedFileName, IMAGE_TYPE_PRODUCT);

        if ($isSaved) {
            $productOK = createProductDB($name, $price, $categoryID, $desc, $qty, $savedFileName, $status, $_SESSION["selectedShopID"]);
            if ($productOK) {
                $sendOnj = [
                    'status' => "SUCCESS",
                    'msg' => "Product Created Successfully"
                ];

            }
        }
    }

    return $sendOnj;
}

function isProductExistsInSessionCart($productID)
{
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['product']['product_id'] == $productID) {
            return true;
        }
    }

    return false;
}

function createUser($email, $password, $fname, $lname, $fullname, $bday, $gender, $nic, $mobile, $address, $city, $zip, $type)
{

    $sendOnj = [
        'status' => "ERROR",
        'msg' => "User Not Created"
    ];

    $isSaved = insertUser($email, $password, $fname, $lname, $fullname, $bday, $gender, $nic, $mobile, $address, $city, $zip, $type);

    if ($isSaved) {
        $sendOnj = [
            'status' => "SUCCESS",
            'msg' => "User Saved",
            'data' => getUserByEmail($email)
        ];
    }

    return $sendOnj;
}

function addUserDP($image, $userID)
{

    $sendOnj = [
        'status' => "ERROR",
        'msg' => "Image Not Added"
    ];

    $savedFileName = "";
    if (isset($image)) {
        $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
        $savedFileName = uniqid() . '.' . $extension;
        $isSaved = uploadFile($image, $savedFileName, IMAGE_TYPE_USER);

        if ($isSaved) {
            $isUpdated = updateProfileImage($savedFileName, $userID);
            if ($isUpdated) {
                $sendOnj = [
                    'status' => "SUCCESS",
                    'msg' => "Image Updated"
                ];
            }
        }
    }

    return $sendOnj;
}

function setShopSession($shopID)
{

    $_SESSION["selectedShopID"] = $shopID;
    $sendOnj = [
        'status' => "SUCCESS",
        'msg' => "Session Updated"
    ];

    return $sendOnj;
}

function logoutUser()
{

    session_destroy();
    $sendOnj = [
        'status' => "SUCCESS",
        'msg' => "User Logged Out"
    ];

    return $sendOnj;
}

function checkoutOrder($address, $city, $msg)
{

    $sendOnj = [
        'status' => "ERROR",
        'msg' => "Order Not Placed."
    ];

    if (isset($_SESSION['user']) && isset($_SESSION["cart"])) {
        $orderNumber = insertOrder($address, $city, $msg, $_SESSION['user']['user_id'], $_SESSION["cart"], $_SESSION['user']['tel']);
        if ($orderNumber != null) {
            $sendOnj = [
                'status' => "SUCCESS",
                'msg' => "Order Placed Successfully",
                'data' => $orderNumber
            ];

            $_SESSION['cart'] = null;
        }
    }

    return $sendOnj;
}

function editProduct($productId, $productName, $categoryID, $desc, $quantity, $perPrice, $status, $imageURL)
{


    $sendOnj = [
        'status' => "ERROR",
        'msg' => "Product Not Updated"
    ];

    if ($imageURL === "") {
        if (updateProduct($productId, $productName, $categoryID, $desc, $quantity, $perPrice, $status, $imageURL)) {
            $sendOnj = [
                'status' => "SUCCESS",
                'msg' => "Product Updated"
            ];
            
        }
    } else {

        $savedFileName = "";
        if (isset($imageURL)) {
            $extension = pathinfo($imageURL['name'], PATHINFO_EXTENSION);
            $savedFileName = uniqid() . '.' . $extension;
            $isSaved = uploadFile($imageURL, $savedFileName, IMAGE_TYPE_PRODUCT);

            if ($isSaved) {
                if (updateProduct($productId, $productName, $categoryID, $desc, $quantity, $perPrice, $status, $savedFileName)) {
                    $sendOnj = [
                        'status' => "SUCCESS",
                        'msg' => "Product Updated"
                    ];
                }
            }
        }
    }

    return $sendOnj;
}

function deleteProduct($productID)
{

    $sendOnj = [
        'status' => "ERROR",
        'msg' => "Product Not Updated"
    ];

    if (setDeleteProduct($productID)) {

        $sendOnj = [
            'status' => "SUCCESS",
            'msg' => "Product Updated."
        ];
    }

    return $sendOnj;
}

function updateStatus($status, $orderID)
{
    $sendOnj = [
        'status' => "ERROR",
        'msg' => "Order Updated."
    ];
    if (isset($orderID) && isset($status)) {
        if (updateOrderStatusByID($status, $orderID)) {
            $sendOnj = [
                'status' => "SUCCESS",
                'msg' => "Order Updated."
            ];
        }
    }

    return $sendOnj;
}

function insertShopImages($shop_name, $email, $tel, $address, $city, $zip_code, $roc_number, $nb_description, $db_logo, $db_banner)
{

    $sendOnj = [
        'status' => "ERROR",
        'msg' => "Shop Not Created"
    ];

    $bannerImage = "";
    $shopProfileImage = "";
    $isDPSaved = false;
    $isBannerSaved = false;


    /**
     *Save Shop Profile Image
     */
    if (isset($db_logo)) {
        $extension = pathinfo($db_logo['name'], PATHINFO_EXTENSION);
        $shopProfileImage = uniqid() . '.' . $extension;
        $isDPSaved = uploadFile($db_logo, $shopProfileImage, IMAGE_TYPE_SHOP);
    } else {
        $isDPSaved = true;
    }


    /**
     *Save Shop Profile Banner
     */
    if (isset($db_banner)) {
        $banner_extension = pathinfo($db_banner['name'], PATHINFO_EXTENSION);
        $bannerImage = uniqid() . '.' . $banner_extension;
        $isBannerSaved = uploadFile($db_banner, $bannerImage, IMAGE_TYPE_SHOP_BANNER);
    } else {
        $isBannerSaved = true;
    }

    /**
     * Insert Shop Data to DB
     */
    if ($isDPSaved && $isBannerSaved) {
        $isShopOK = createShopDB($shop_name, $email, $tel, $address, $city, $zip_code, $roc_number, $nb_description, $shopProfileImage, $bannerImage, $_SESSION['user']['user_id']);
        if ($isShopOK) {
            $sendOnj = [
                'status' => "SUCCESS",
                'msg' => "Shop Created Successfully"
            ];
        }
    }


    return $sendOnj;
}

function updateUser($dpImg, $fName, $lName, $fullName, $birthday, $gender, $nic, $tel, $address, $city, $zipcode, $userID)
{

    $sendOnj = [
        'status' => "ERROR",
        'msg' => "User Not Updated"
    ];

    if (!isset($dpImg)) {
        $savedFileName = null;
        if (updateUserInfo($savedFileName, $fName, $lName, $fullName, $birthday, $gender, $nic, $tel, $address, $city, $zipcode, $userID)) {

            $sendOnj = [
                'status' => "SUCCESS",
                'msg' => "User Updated."
            ];
        }
    } else {
        $savedFileName = "";
        if (isset($dpImg)) {
            $extension = pathinfo($dpImg['name'], PATHINFO_EXTENSION);
            $savedFileName = uniqid() . '.' . $extension;
            $isSaved = uploadFile($dpImg, $savedFileName, IMAGE_TYPE_USER);
            if ($isSaved) {
                if (updateUserInfo($savedFileName, $fName, $lName, $fullName, $birthday, $gender, $nic, $tel, $address, $city, $zipcode, $userID)) {

                    $sendOnj = [
                        'status' => "SUCCESS",
                        'msg' => "User Updated."
                    ];
                }
            }
        }
    }
    getUpdatedInfo($userID);
    return $sendOnj;
}

function updatePassword($currentPass, $newPass, $userID){

    $sendOnj = [
        'status' => "ERROR",
        'msg' => "User Not Updated"
    ];
    if (currentPasswordCheck($currentPass, $userID)) {
        if(updateUserPassword($newPass, $userID)){
            $sendOnj = [
                'status' => "SUCCESS",
                'msg' => "Password Updated."
            ];
        }
        
    }

    return $sendOnj;
}

function deleteUser($userID){

    $sendOnj = [
        'status' => "ERROR",
        'msg' => "User Not Updated"
    ];
    if(deleteUserOnDB($userID)){
        $sendOnj = [
            'status' => "SUCCESS",
            'msg' => "Password Updated."
        ];

        session_destroy();
    }

    return $sendOnj;
}

function resetPassword($newPass, $userID)
{

    $sendOnj = [
        'status' => "ERROR",
        'msg' => "User Not Updated"
    ];
    
        if(updateUserPassword($newPass, $userID)){
            $sendOnj = [
                'status' => "SUCCESS",
                'msg' => "Password Updated."
            ];
        }

    return $sendOnj;
}

function getActionToAccount($accAction,$userID)
{

    $sendOnj = [
        'status' => "ERROR",
        'msg' => "User Not Updated"
    ];

    if(updateAccountStatus($accAction,$userID)){
        $sendOnj = [
            'status' => "SUCCESS",
            'msg' => "status Updated."
        ];
    }

    return $sendOnj;
}
function getActionToShop($accAction,$userID)
{

    $sendOnj = [
        'status' => "ERROR",
        'msg' => "User Not Updated"
    ];

    if(updateShopStatus($accAction,$userID)){
        $sendOnj = [
            'status' => "SUCCESS",
            'msg' => "status Updated."
        ];
    }

    return $sendOnj;
}
function getActionToProduct($accAction,$userID)
{

    $sendOnj = [
        'status' => "ERROR",
        'msg' => "User Not Updated"
    ];

    if(updateProductStatus($accAction,$userID)){
        $sendOnj = [
            'status' => "SUCCESS",
            'msg' => "status Updated."
        ];
    }

    return $sendOnj;
}

function removeItemFromCart($productID)
{

    if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
        for($i = 0; $i < count($_SESSION['cart']); $i++){
            if($_SESSION['cart'][$i]['product']['product_id'] == $productID){
                array_splice($_SESSION['cart'],$i,1);
            }
        }
    }

    $sendOnj = [
        'status' => "SUCCESS",
        'msg' => "Item Removed"
    ];


    return $sendOnj;
}

function sendChatMessage($senderType,$recipientType,$sender,$recipient,$message){

    $sendOnj = [
        'status' => "ERROR",
        'msg' => "Message Not Sent."
    ];

    if(sendMessage($senderType,$recipientType,$sender,$recipient,$message)){
        $sendOnj = [
            'status' => "SUCCESS",
            'msg' => "Message Sent."
        ];
    }

    return $sendOnj;
}

function getAllMessages($receiverID,$outgoingID){

    $sendOnj = [
        'status' => "ERROR",
        'msg' => "No Messages",
        'data' => null
    ];

        $data = getMessagesForCustomer($receiverID,$outgoingID);
        if(count($data)) {
            $sendData = array();
            for ($cou = 0; $cou < count($data); $cou++) {
                $sendChat = array();
                if ($data[$cou]["outgong_type"] == "SHOP") {

                    $shop = getShopById($data[$cou]["outgoing_id"]);
                    $customer = getUserByUserID($data[$cou]["incoming_id"]);

                    $sendChat = [
                        'chat_id' => $data[$cou]["chat_id"],
                        'incoming_name' => $customer[0]["full_name"],
                        'incoming_type' => $data[$cou]["incoming_type"],
                        'outgoing_name' => $shop["shop_name"],
                        'outgong_type' => $data[$cou]["outgong_type"],
                        'message' => $data[$cou]["message"],
                        'date_created' => $data[$cou]["date_created"]
                    ];
                } else {

                    $shop = getShopById($data[$cou]["incoming_id"]);
                    $customer = getUserByUserID($data[$cou]["outgoing_id"]);

                    $sendChat = [
                        'chat_id' => $data[$cou]["chat_id"],
                        'incoming_name' => $shop["shop_name"],
                        'incoming_type' => $data[$cou]["incoming_type"],
                        'outgoing_name' => $customer[0]["full_name"],
                        'outgong_type' => $data[$cou]["outgong_type"],
                        'message' => $data[$cou]["message"],
                        'date_created' => $data[$cou]["date_created"]
                    ];
                }

                array_push($sendData, $sendChat);
            }

            $sendOnj = [
                'status' => "SUCCESS",
                'msg' => "No Messages",
                'data' => $sendData
            ];
        }


    return $sendOnj;
}

function sendComplaint($kindof,$relativeId,$subject,$msg,$userId){
    $conn = getConnection();


    $sql = "INSERT INTO ".TABLE_COMPLAINT." 
    (user_id, subject, description,kind_of,related_id)
    VALUES ('".$userId."','".$subject."','".$msg."','".$kindof."','".$relativeId."')";

    if ($conn->query($sql) === TRUE) {
        $sendOnj = [
            'status' => "SUCCESS",
            'msg' => "Login OK"
        ];
        return $sendOnj;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        return false;
    }
}

function getStatistics($userId){

    $stats = getShopperStats($userId);

    $sendOnj = [
        'status' => "ERROR",
        'msg' => "Data Not Found",
        'totalEarn' => "0",
        'totalOrder' => "0",
        'totalCustomers' => "0"
    ];


    if($stats != null) {
        $sendOnj = [
            'status' => "SUCCESS",
            'msg' => "Data Found",
            'totalEarn' => number_format($stats["total_earn"],2,'.',','),
            'totalOrder' => $stats["totla_orders"],
            'totalCustomers' => $stats["total_customers"]
        ];

    }

    return $sendOnj;
}
function getProStatistics($proId){

    $stats = getProductStats($proId);

    $sendOnj = [
        'status' => "ERROR",
        'msg' => "Data Not Found",
        'sold' => "0",
        'available' => "0"
    ];


    if($stats != null) {
        $sendOnj = [
            'status' => "SUCCESS",
            'msg' => "Data Found",
            'sold' => $stats["sold"],
            'available' => $stats["available"]
        ];

    }

    return $sendOnj;
}
function getShopStatistics($shopId){

    $stats = getShopStats($shopId);

    $sendOnj = [
        'status' => "ERROR",
        'msg' => "Data Not Found",
        'totalEarn' => "0",
        'totalOrder' => "0",
        'totalCustomers' => "0"
    ];


    if($stats != null) {
        $sendOnj = [
            'status' => "SUCCESS",
            'msg' => "Data Found",
            'totalEarn' => number_format($stats["total_earn"],2,'.',','),
            'totalOrder' => $stats["total_orders"],
            'totalCustomers' => $stats["total_customers"]
        ];

    }

    return $sendOnj;
}
function sendResetLink($email){

    $dev = true;

    if(isEmailExists($email)){

        $bytes = random_bytes(20);
        $randomCode = bin2hex($bytes);
        $customer = getUserByEmail($email);

        if(createResetRecord($customer["user_id"],$randomCode)){

            $resetLink = "https://live-site-url/account_password_reset.php?san-rest-pa=".$randomCode;
            if($dev) {
                $resetLink = "http://localhost/computer_shop/account_password_reset.php?san-rest-pa=".$randomCode;
            }

            if(fogetPasswordVerificationSend($email,$resetLink)) {

                $sendOnj = [
                    'status' => "SUCCESS",
                    'msg' => "Email Sent"
                ];

                return $sendOnj;

            }else{
                $sendOnj = [
                    'status' => "ERROR",
                    'msg' => "Email Not Sent"
                ];

                return $sendOnj;
            }
        }

    }else{
        $sendOnj = [
            'status' => "ERROR",
            'msg' => "No User Account associated with the given email address."
        ];

        return $sendOnj;
    }
}

function deleteShop($shopId)
{

    $sendOnj = [
        'status' => "ERROR",
        'msg' => "Shop Not Deleted"
    ];

    if(deleteShopById($shopId)){
        $sendOnj = [
            'status' => "SUCCESS",
            'msg' => "Shop Deleted."
        ];
    }

    return $sendOnj;
}

function addSubscriber($email)
{

    $sendOnj = [
        'status' => "ERROR",
        'msg' => "Subscriber Not Added"
    ];

    if(addNewSubscriber($email)){
        $sendOnj = [
            'status' => "SUCCESS",
            'msg' => "Subscriber Added."
        ];
    }

    return $sendOnj;
}

function updateShop($fileDp,$fileBanner, $shopName, $description, $roc, $contact, $address, $city, $zip, $shopId)
{

    $sendOnj = [
        'status' => "ERROR",
        'msg' => "Shop Not Updated"
    ];
    if (!isset($fileDp)) {
        $savedFileName1 = null;

    }else{
        $extension = pathinfo($fileDp['name'], PATHINFO_EXTENSION);
        $savedFileName1 = uniqid() . '.' . $extension;
        $isSaved1 = uploadFile($fileDp, $savedFileName1, IMAGE_TYPE_SHOP);
    }
    if (!isset($fileBanner)) {
        $savedFileName2 = null;

    }else{
        $extension = pathinfo($fileBanner['name'], PATHINFO_EXTENSION);
        $savedFileName2 = uniqid() . '.' . $extension;
        $isSaved2 = uploadFile($fileBanner, $savedFileName2, IMAGE_TYPE_SHOP_BANNER);
    }

    if (isset($isSaved1)|| isset($isSaved2)){
        if (updateShopInfo($savedFileName1,$savedFileName2, $shopName, $description, $roc, $contact, $address, $city, $zip, $shopId)) {

            $sendOnj = [
                'status' => "SUCCESS",
                'msg' => "Shop Updated."
            ];
        }
    }else{
        if (updateShopInfo($savedFileName1,$savedFileName2, $shopName, $description, $roc, $contact, $address, $city, $zip, $shopId)) {

            $sendOnj = [
                'status' => "SUCCESS",
                'msg' => "Shop Updated."
            ];
        }
    }

//    getUpdatedShopInfo($shopId);
    return $sendOnj;
}
function addInquiry($name,$email,$phone,$msg)
{

    $sendOnj = [
        'status' => "ERROR",
        'msg' => "Inquiry Not Added"
    ];

    if(addNewInquiry($name,$email,$phone,$msg)){
        $sendOnj = [
            'status' => "SUCCESS",
            'msg' => "Inquiry Added."
        ];
    }

    return $sendOnj;
}
function depotLogin($email,$password)
{

    $sendOnj = [
        'status' => "ERROR",
        'msg' => "Authentication Failed. Try again."
    ];

    if(shopperLogin($email,$password)){
        $sendOnj = [
            'status' => "SUCCESS",
            'msg' => "Authentication Success."
        ];
    }

    return $sendOnj;
}

function updateOrderFromDelivery($orderId,$deCode,$shopId)
{

    $sendOnj = [
        'status' => "ERROR",
        'msg' => "update Failed. Try again."
    ];

    if(updateDeliveryStatus($orderId,$deCode,$shopId)){
        $sendOnj = [
            'status' => "SUCCESS",
            'msg' => "Update Success."
        ];

    }

    return $sendOnj;
}



// Check if the request is an AJAX request
if (isset($_SERVER['HTTP_APPLICATION_AUTH']) && strtolower($_SERVER['HTTP_APPLICATION_AUTH']) === 'computershop-auth') {


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['action'])) {
            $action_param = $_POST['action'];
            if ($action_param === "login") {
                echo json_encode(userLogin($_POST["email"], $_POST["password"]));
            } else if ($action_param === "cart_add") {
                echo json_encode(addSessionCart($_POST["productID"], $_POST["qty"]));
            } else if ($action_param === "emailVerifying") {
                echo json_encode(verifyEmailSend($_POST["email"]));
            } else if ($action_param === "codeCheck") {
                echo json_encode(verifyEmailCode($_POST["code"]));
            } else if ($action_param === "create_product") {
                echo json_encode(insertProduct(
                    $_POST["name"],
                    $_POST["price"],
                    $_POST["category"],
                    $_POST["desc"],
                    $_POST["qty"],
                    $_FILES["image"],
                    $_POST["status"]
                ));
            } else if ($action_param === "register_user") {
                echo json_encode(createUser(
                    $_POST["email"],
                    $_POST["password"],
                    $_POST["firstName"],
                    $_POST["lastName"],
                    $_POST["fullName"],
                    $_POST["birthday"],
                    $_POST["gender"],
                    $_POST["nic"],
                    $_POST["mobileNumber"],
                    $_POST["address"],
                    $_POST["city"],
                    $_POST["zip"],
                    $_POST["type"]
                ));
            } else if ($action_param === "add_user_dp") {
                echo json_encode(addUserDP($_FILES["image"], $_POST["userID"]));
            } else if ($action_param === "set_shop_session") {
                echo json_encode(setShopSession($_POST["shopID"]));
            } else if ($action_param === "logout_user") {
                echo json_encode(logoutUser());
            } else if ($action_param === "checkout") {
                echo json_encode(checkoutOrder($_POST["address"], $_POST["city"], $_POST["msg"]));
            } else if ($action_param === "update_product") {
                $image = "";
                if (isset($_FILES["image"])) {
                    $image = $_FILES["image"];
                }

                echo json_encode(editProduct(
                    $_POST["productID"],
                    $_POST["name"],
                    $_POST["categoryID"],
                    $_POST["desc"],
                    $_POST["qty"],
                    $_POST["price"],
                    $_POST["status"],
                    $image
                ));
            } else if ($action_param === "delete_product") {
                echo json_encode(deleteProduct($_POST["productID"]));
            } else if ($action_param === "send_complaint") {
                echo json_encode(sendComplaint($_POST["kindof"],$_POST["relativeId"],$_POST["subject"],$_POST["msg"],$_POST["userId"]));
            } else if ($action_param === "status_update") {
                echo json_encode(updateStatus($_POST["status"], $_POST['order_id']));
            } else if ($action_param === "create_shop") {

                $dpFile = null;
                $bannerFile = null;
                if (isset($_FILES['up-shop-dp'])) {
                    $dpFile = $_FILES['up-shop-dp'];
                }
                if (isset($_FILES['up-shop-banner'])) {
                    $bannerFile = $_FILES['up-shop-banner'];
                }


                echo json_encode(insertShopImages(
                    $_POST["shopName"],
                    $_POST['shopEmail'],
                    $_POST['shopTel'],
                    $_POST['shopAddress'],
                    $_POST['shopCity'],
                    $_POST['shopZipCode'],
                    $_POST['rocNumber'],
                    $_POST['busiNature'],
                    $dpFile,
                    $bannerFile
                ));
            } else if ($action_param === "update_user") {
                $file = null;
                if(isset($_FILES["dp-img"])){
                    $file = $_FILES["dp-img"];
                }
                echo json_encode(updateUser($file,
                    $_POST["fName"], $_POST["lName"],
                    $_POST["fullName"],
                    $_POST["birthday"],
                    $_POST["gender"],
                    $_POST["nic"],
                    $_POST["tel"],
                    $_POST["address"],
                    $_POST["city"],
                    $_POST["zipcode"],
                    $_POST["userId"]));
            } else if ($action_param === "update_password") {
                echo json_encode(updatePassword($_POST["currentPass"], $_POST["newPass"], $_POST["userId"]));
            } else if ($action_param === "remove_item") {
                echo json_encode(removeItemFromCart($_POST["productID"]));
            }else if($action_param === "send_chat_message"){
                echo json_encode(sendMessage(
                    $_POST["senderType"],
                    $_POST["recipientType"],
                    $_POST["senderID"],
                    $_POST["receiverID"],
                    $_POST["msg"]));
            }else if($action_param === "get_all_messages"){
                echo json_encode(getAllMessages( $_POST["receiverID"],$_POST["senderID"]));
            }else if($action_param === "delete_user"){
                echo json_encode(deleteUser( $_POST["userId"]));
            }else if($action_param === "reset_password"){
                echo json_encode(resetPassword( $_POST["newPassword"],$_POST["userId"]));
            }else if($action_param === "send_reset_link"){
                echo json_encode(sendResetLink( $_POST["email"]));
            }else if($action_param === "get_shopper_statistics"){
                echo json_encode(getStatistics( $_POST["userId"]));
            }else if($action_param === "get_shop_statistics"){
                echo json_encode(getShopStatistics( $_POST["shopId"]));
            }else if($action_param === "get_product_statistics"){
                echo json_encode(getProStatistics($_POST["proId"]));
            }else if($action_param === "account_status_update"){
                echo json_encode(getActionToAccount( $_POST["accAction"],$_POST["userId"]));
            }else if($action_param === "shop_status_update"){
                echo json_encode(getActionToShop( $_POST["accAction"],$_POST["shopId"]));
            }else if($action_param === "product_status_update"){
                echo json_encode(getActionToProduct( $_POST["accAction"],$_POST["proId"]));
            }else if($action_param === "delete_shop"){
                echo json_encode(deleteShop( $_POST["shopId"]));
            }else if($action_param === "add_subscriber"){
                echo json_encode(addSubscriber( $_POST["email"]));
            }else if ($action_param === "update_shop") {
                $fileDp = null;
                $fileBanner = null;
                if(isset($_FILES["dp_image"])){
                    $fileDp = $_FILES["dp_image"];
                }
                if(isset($_FILES["banner_image"])){
                    $fileBanner = $_FILES["banner_image"];
                }
                echo json_encode(updateShop($fileDp,$fileBanner, $_POST["shopName"], $_POST["description"], $_POST["roc"], $_POST["contact"], $_POST["address"], $_POST["city"], $_POST["zip"], $_POST["shopId"]));
            }else if($action_param === "logindepot"){
                echo json_encode(depotLogin($_POST["email"], $_POST["password"]));
            }else if($action_param === "contact_inquiry"){
                echo json_encode(addInquiry( $_POST["name"],$_POST["email"],$_POST["phone"],$_POST["msg"]));
            }else if($action_param === "updateOrder"){
                echo json_encode(updateOrderFromDelivery( $_POST["orderId"],$_POST["deCode"],$_POST["shopId"]));
            }
        }
    }
}
?>