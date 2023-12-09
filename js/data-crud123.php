<?php
include "../connectors/db-connector.php";

include "../functions/email-functions.php";

try {
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  //echo "Connected successfully";
} catch(Exception $error) {
  echo "Connection failed: " . $error->getMessage();
}


  $newEmail = $_POST['newEmail'];
  $newPassword = $_POST['newPassword'];
  $newTypeBool = $_POST['newType'];
  $newStatus = "Pending Verification";
  //echo "The input data is: " . $newEmail;
  
  // if($newTypeBool == 1){
  //   $newType = "customer";
  // }elseif($newTypeBool == 0){
  //   $newType = "shopper";
  // }else{
  //   $newType = "unknown";
  // }
  
  
  // $_SESSION['newEmail'] = $inputData;
  $sql = "INSERT INTO user (email, password, acc_type, acc_status) 
  VALUES ('".$newEmail."', '". $newPassword . "', '".$newTypeBool."', '".$newStatus."');";

  if (mysqli_query($conn, $sql)) {

    $sendOnj = [
      'status' => "ERROE",
      'msg' => "Record not updated successfully"
    ];

    $isSent = emailVerificationSend($newEmail);
    if($isSent){
    $sendOnj = [
      'status' => "SUCCESS",
      'msg' => "Record updated successfully"
    ];
  }
    
    echo json_encode($sendOnj);

  } else {
      echo "Error updating record: " . $conn->error;
  }
?>
