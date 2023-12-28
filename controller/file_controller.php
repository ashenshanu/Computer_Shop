<?php

function uploadFile($file,$fileName,$imageType){

    $target_dir = "../uploads/product_images/";
    if($imageType === IMAGE_TYPE_USER){
        $target_dir = "../uploads/user_images/";
    }else if($imageType === IMAGE_TYPE_SHOP){
        $target_dir = "../uploads/shop_images/shop_dp/";
    }else if($imageType === IMAGE_TYPE_SHOP_BANNER){
        $target_dir = "../uploads/shop_images/shop_banner/";
    }

    $target_file = $target_dir . basename($fileName);
    $uploadOk = 1;


    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    if ($file["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }


    $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if (!in_array($file_type, $allowed_types)) {
        echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        return false;
    } else {
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            return true;
        } else {
            return false;
        }
    }
}

?>