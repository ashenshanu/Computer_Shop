<?php



function getAllCategories()
{

    $conn = getConnection();

    $stmt = $conn->prepare("SELECT * FROM " . TABLE_CATEGORY);
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

function getAvailableCategories(){
    $conn = getConnection();
    $stmt = $conn->prepare("SELECT DISTINCT(product_category.`cat_id`), product_category.`cat_name` FROM product_category
JOIN product AS pr ON product_category.`cat_id` = pr.`product_category_cat_id`;");
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0){
        return $result->fetch_all();
    } else{
        return null;
    }
}
function updateProductStatus($action,$proId){
    $conn = getConnection();

    $sql = "UPDATE ".TABLE_PRODUCT." SET status = '".$action."' WHERE product_id=".$proId;

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        return false;
    }
}
function getProductStats($proId){
    $conn = getConnection();

    $stmt = $conn->prepare("SELECT SUM(order_item.`quntity`) AS sold,
    product.`quntity` AS available FROM order_item
    RIGHT JOIN product ON product.`product_id`= order_item.`product_product_id`
    WHERE product.`product_id` = '".$proId."'");
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

function getProductByProID($proID){

    $conn = getConnection();

    $stmt = $conn->prepare("SELECT * FROM ".TABLE_PRODUCT." JOIN shop AS sh ON product.`shop_shop_id`= sh.`shop_id` WHERE product_id =".$proID.";");
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

function getAllProducts()
{

    $conn = getConnection();

    $stmt = $conn->prepare("SELECT * FROM " . TABLE_PRODUCT . " WHERE is_active = 1 AND status = 'ACTIVE'");
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


function getBestDealsProducts()
{

    $conn = getConnection();

    $stmt = $conn->prepare("SELECT * FROM " . TABLE_PRODUCT . " WHERE is_active = 1 AND status = 'ACTIVE' ORDER BY per_price ASC");
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
function getProductsByShopId($shopId)
{

    $conn = getConnection();

    $stmt = $conn->prepare("SELECT * FROM " . TABLE_PRODUCT . " WHERE is_active = 1 AND status = 'ACTIVE' AND shop_shop_id = ".$shopId." ORDER BY per_price ASC");
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

function getMostPopularProducts()
{

    $conn = getConnection();

    $stmt = $conn->prepare("SELECT * FROM " . TABLE_PRODUCT . " WHERE is_active = 1 AND status = 'ACTIVE'");
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

function getCategorizedProducts($category)
{

    $conn = getConnection();

    $stmt = $conn->prepare("SELECT * FROM " . TABLE_PRODUCT . " WHERE is_active = 1 AND status = 'ACTIVE' AND product_category_cat_id = ?");
    $stmt->bind_param("s", $category);
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

function getProductByID($productID)
{

    if (isset($productID)) {
        $conn = getConnection();

        $stmt = $conn->prepare("SELECT * FROM " . TABLE_PRODUCT . " WHERE is_active = 1 AND status = 'ACTIVE' AND product_id = ?");
        $stmt->bind_param("s", $productID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        }
    }

    return null;
}

function getNewProducts()
{

    $conn = getConnection();

    $stmt = $conn->prepare("SELECT * FROM " . TABLE_PRODUCT . " WHERE is_active = 1 AND status = 'ACTIVE' ORDER BY create_time DESC");
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

function getPriceRange(){
    $conn = getConnection();

    $stmt = $conn->prepare("SELECT MIN(per_price),MAX(per_price) FROM ".TABLE_PRODUCT." WHERE is_active = 1 AND status = 'ACTIVE'");
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

function getProductsByMaxPrice($maxPrice){

    $conn = getConnection();

    $stmt = $conn->prepare("SELECT * FROM ".TABLE_PRODUCT." WHERE per_price < ".$maxPrice." AND is_active = 1 AND status = 'ACTIVE'");
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

function getProductByCategoryAndMaxPrice($categoryID,$maxPrice){

    $conn = getConnection();

    $stmt = $conn->prepare("SELECT * FROM " . TABLE_PRODUCT . " WHERE is_active = 1 AND status = 'ACTIVE' AND product_category_cat_id = ? AND per_price < ?");
    $stmt->bind_param("ii", $categoryID,$maxPrice);
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

function getProductData($product_id)
{

    $conn = getConnection();

    $stmt = $conn->prepare("SELECT * FROM " . TABLE_PRODUCT . " WHERE product_id= $product_id");
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

function getCategoryById($cat_id)
{

    $conn = getConnection();

    $stmt = $conn->prepare("SELECT * FROM " . TABLE_CATEGORY. " WHERE cat_id= $cat_id");
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

function getProductByShopId($shop_id)
{

    $conn = getConnection();

    $stmt = $conn->prepare("SELECT * FROM " . TABLE_PRODUCT. " WHERE is_active = 1 AND shop_shop_id= $shop_id");
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

function createProductDB($name,$price,$categoryID,$desc,$qty,$productImage,$status,$shopID){

    $conn = getConnection();

    $sql = "INSERT INTO ".TABLE_PRODUCT." 
    (product_name, quntity, per_price,description,status,is_active,product_category_cat_id,shop_shop_id,image_url)
    VALUES ('".$name."','".$qty."','".$price."','".$desc."','".$status."',1,'".$categoryID."','".$shopID."','".$productImage."')";

    if ($conn->query($sql) === TRUE) {
       return true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        return false;
    }
}

function getProductsWithCategoryByShopId($shop_id)
{

    $conn = getConnection();

    $stmt = $conn->prepare("SELECT * FROM " . TABLE_PRODUCT. " 
    JOIN product_category AS pro_cat ON product.product_category_cat_id = pro_cat.cat_id 
    WHERE product.is_active = 1 AND shop_shop_id = ".$shop_id);
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

function updateProduct($productId, $productName, $categoryID, $desc, $quantity, $perPrice, $status, $imageURL){

    $sql = "";

    if($imageURL === ""){

        $sql = "UPDATE ".TABLE_PRODUCT." SET 
        product_name = '".$productName."',
        quntity = '".$quantity."',
        per_price = '".$perPrice."',
        description = '".$desc."',
        status = '".$status."',
        product_category_cat_id = '".$categoryID."'
        WHERE product_id = ".$productId;

    }else{

        $sql = "UPDATE ".TABLE_PRODUCT." SET 
        product_name = '".$productName."',
        quntity = '".$quantity."',
        per_price = '".$perPrice."',
        description = '".$desc."',
        status = '".$status."',
        product_category_cat_id = '".$categoryID."',
        image_url = '".$imageURL."'
        WHERE product_id = ".$productId;

    }

    $conn = getConnection();

    if ($conn->query($sql) === TRUE) {
        $conn->close();
        return true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        $conn->close();
        return false;
    }

}

function setDeleteProduct($productID){

    $conn = getConnection();

    $sql = "UPDATE ".TABLE_PRODUCT." SET is_active = 0 WHERE product_id = ".$productID;

    if ($conn->query($sql) === TRUE) {
        $conn->close();
        return true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        $conn->close();
        return false;
    }
}
function getProductsOrderByDate(){

    $conn = getConnection();

    $stmt = $conn->prepare("SELECT * FROM ".TABLE_PRODUCT." P INNER JOIN ".TABLE_CATEGORY." PC ON P.product_category_cat_id = PC.cat_id ORDER BY P.create_time");
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