<?php


function addNewInquiry($name,$email,$phone,$msg){

    $conn = getConnection();

    $sql = "INSERT INTO inquiry 
    (inq_name, inq_email, inq_contact,inq_msg)
    VALUES ('".$name."','".$email."','".$phone."','".$msg."')";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        return false;
    }
}

function shopperLogin($email, $password){


    $conn = getConnection();


    if (isset($email) && isset($password)) {

        $stmt = $conn->prepare("SELECT * FROM " . TABLE_USER . " WHERE is_active = 1 AND acc_status <> 'BLACK' AND acc_type = 'SHOPPER' AND email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $hashed_password = $row["password"];

            if($row["acc_status"] == 'BANNED'){
//                $sendOnj = [
//                    'status' => "BANNED ACCOUNT",
//                    'msg' => "You are temporarily banned from Mr.PC. contact our administration."
//                ];
                return false;
            }else if (password_verify($password, $hashed_password)) {
//                $sendOnj = [
//                    'status' => "SUCCESS",
//                    'msg' => "Login OK"
//                ];

                $_SESSION["shop"] = $row;
                return true;
            }
        }
        $stmt->close();
        $conn->close();
    }

//    return $sendOnj;
}

function getAllInquiries(){

    $conn = getConnection();

    $stmt = $conn->prepare("SELECT * FROM inquiry ORDER BY create_date DESC ");
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
function getAllSubscribe(){

    $conn = getConnection();

    $stmt = $conn->prepare("SELECT * FROM subscribe ORDER BY create_date DESC ");
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

function updateDeliveryStatus($orderId,$deCode,$shopId){
    $conn = getConnection();

//    $orderItemlist = getOrderProductsByShopIDAndOrderID($shopId,$orderId);


    $stmt = $conn->prepare("SELECT de_code,order_id FROM site_order  WHERE order_number  = ?");
    $stmt->bind_param("s", $orderId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $realDeCode = $row["de_code"];
        $realOrderId = $row["order_id"];
        var_dump($realOrderId);
    }

    if($deCode == $realDeCode){
        $sql = "UPDATE site_order SET de_status = 'DELIVERED' WHERE order_id = ".$realOrderId;

        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            return false;
        }

    }else{
        return false;
    }

}