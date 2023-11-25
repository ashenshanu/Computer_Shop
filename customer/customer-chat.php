<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="./css/customer-main.css">
    <title>Document</title>
</head>

<body>
<?php

require_once "../connectors/db-connector.php";
require_once "../configs/config.php";

include "../controller/product_controller.php";
include "../controller/shop_controller.php";

include './includes/dashboard-navigation.php';

$complaintList = getComplaintListByUserID($_SESSION['user']["user_id"]);

?>


<div>
    <h3>Chats</h3>
    <br/><br/>
    <div class="white-bd-card" id="chat_content" style="border: 1px solid #000000; width: 380px; height: 20vh; margin-left: 50px; overflow-y: scroll; display: flex; flex-direction: column;">
    </div>
</div>
<div class="col-md-12" style="position:relative; left:-350px; width: 10%; height: 100vh; display: flex; flex-direction: column; justify-content: center; align-items: center;">
    <br/>
    <br/>
    <div>
        <label>Customer ID</label>
    <input class="t-feild" type="text" id="userID" value="<?php echo $_SESSION['user']["user_id"] ?>">
    <br/>
        <label>Shop ID</label>
        <input class="t-feild" type="text" id="shopID" value="1">
    <br/>
        <label>Message</label>
        <input class="t-feild" type="text" id="msg">
    <br/>
    <br/>
    <br/>
    <button class="btn primary" id="msg_send_btn" onclick="sendMessage()">Send Message</button>
    </div>
</div>
<script>


function sendMessage() {

    let msg = document.getElementById('msg');
    let shopID = document.getElementById('shopID');
    let customerID = document.getElementById('userID');

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../functions/api.php', true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.setRequestHeader("application-auth", "sanakin-auth");

    xhr.onload = function () {
        if (xhr.readyState === xhr.DONE && xhr.status === 200) {
            if (xhr.responseText) {
                var responseObj = JSON.parse(xhr.responseText);
                if (responseObj) {
                    if (responseObj.status === "SUCCESS") {
                        alert("Message Sent");
                    }
                }
            }
        }
    };
    xhr.send("" +
        "action=send_chat_message&" +
        "senderType=CUSTOMER&" +
        "recipientType=SHOP&" +
        "senderID="+customerID.value+"&" +
        "receiverID="+shopID.value+"&" +
        "msg="+msg.value);
}

setInterval(() =>{getAllChats()}, 500);

function getAllChats() {

    let chatContent = "";
    let customerID = document.getElementById('userID');
    let shopID = document.getElementById('shopID');

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../functions/api.php', true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.setRequestHeader("application-auth", "sanakin-auth");

    xhr.onload = function () {
        if (xhr.readyState === xhr.DONE && xhr.status === 200) {
            if (xhr.responseText) {
                var responseObj = JSON.parse(xhr.responseText);
                if (responseObj) {
                    if (responseObj.status === "SUCCESS") {
                        for(i = 0; i < responseObj.data.length; i++) {
                            let chatRow = responseObj.data[i];

                            if(chatRow.outgong_type === "SHOP") {
                                chatContent += "<div class='row' style='width: 100%; text-align: left'>\n" +
                                    "            <label>" + chatRow.outgoing_name + "</label>\n" +
                                    "            <label>" + chatRow.date_created + "</label>\n" +
                                    "            <p>" + chatRow.message + "</p>\n" +
                                    "        </div>";
                            }else {

                                chatContent += "<div class='row' style='width: 100%; text-align: right'>\n" +
                                    "            <label>" + chatRow.outgoing_name+ "</label>\n" +
                                    "            <label>" + chatRow.date_created + "</label>\n" +
                                    "            <p>" + chatRow.message + "</p>\n" +
                                    "        </div>";
                            }
                        }

                        document.getElementById('chat_content').innerHTML = chatContent;
                    }
                }
            }
        }
    };
    xhr.send("action=get_all_messages&receiverID="+customerID.value+"&recipientType=CUSTOMER&senderID="+shopID.value);
}

</script>

</body>
</html>
