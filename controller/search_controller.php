<?php
/**
 * Created by PhpStorm.
 * User: Shasheesha
 * Date: 3/6/2023
 * Time: 8:02 AM
 */

function search($searchText){

    if(isset($searchText)){

        $conn = getConnection();

        $productList = null;
        $shopList = null;

        /**
        * Search From Products
         */
        $sanatizedText = mysqli_real_escape_string($conn,$searchText);
        $sanatizedText = "%".$sanatizedText."%";


        $stmt = $conn->prepare("SELECT * FROM " . TABLE_PRODUCT . " WHERE is_active = 1 AND status = 'ACTIVE' AND (product_name LIKE ? OR description LIKE ?)");
        $stmt->bind_param("ss", $sanatizedText,$sanatizedText);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
           $productList =  $result->fetch_all();
        }

        $stmt->close();
        $conn->close();


        $conn = getConnection();
        /**
         * Search From Shops
         */

        $stmt = $conn->prepare("SELECT * FROM " . TABLE_SHOP . " WHERE is_active = 1 AND (shop_name LIKE ? OR nb_description LIKE ?)");
        $stmt->bind_param("ss", $sanatizedText,$sanatizedText);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $shopList =  $result->fetch_all();
        }

        $stmt->close();
        $conn->close();


        $sendOnj = [
            'productList' => $productList,
            'shopList' => $shopList
        ];

        return $sendOnj;
    }
}