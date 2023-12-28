<?php

function getComplaintsOrderByDate(){

    $conn = getConnection();

    $stmt = $conn->prepare("SELECT * FROM ".TABLE_COMPLAINT." ORDER BY create_time");
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
function getComplaintByComID($comID){

    $conn = getConnection();

    $stmt = $conn->prepare("SELECT * FROM ".TABLE_COMPLAINT." WHERE com_id = '".$comID."';");
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