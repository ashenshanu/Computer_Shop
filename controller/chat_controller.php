<?php


function getMessagesForShop($shopID){

    $conn = getConnection();

    $stmt = $conn->prepare("SELECT * FROM ".TABLE_SHOP_CHAT." WHERE incoming_type = 'SHOP' AND incoming_id = ".$shopID);
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

function getMessagesForCustomer($customerID,$shopID){

    $conn = getConnection();

    $stmt = $conn->prepare("SELECT * FROM ".TABLE_SHOP_CHAT." WHERE 
    (incoming_id = ".$customerID." AND outgoing_id = ".$shopID.") 
     OR (outgoing_id = ".$customerID." AND incoming_id = ".$shopID.")");

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

function sendMessage($senderType,$recipientType,$sender,$recipient,$message){

    $conn = getConnection();

    $sql = "INSERT INTO ".TABLE_SHOP_CHAT." 
    (incoming_id,incoming_type,outgoing_id,outgong_type,message,is_active)
    VALUES ('".$recipient."','".$recipientType."','".$sender."','".$senderType."','".$message."',1)";

    if ($conn->query($sql) === TRUE) {
        $conn->close();
        return true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        $conn->close();
        return false;
    }
}

