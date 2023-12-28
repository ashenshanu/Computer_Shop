<?php
        $shopId = $_GET['shopid'];
        session_start();
if(!isset($_SESSION["shop"])){
    header("Location: ./index.php");
}

//var_dump($_SESSION["shop"]);

?><!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css">
        
        <link rel="stylesheet" href="dist/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="dist/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

        <title>Mr.PC</title>
    </head>
<body>
    <header id="top_header">
        <div class="wrapper">
          <a href="index.html"><img id="logo_top" draggable="false" src="../assets/Mr.PC.png"></a>
        </div>
    </header>

    <div class="box">
        <h2>Order Status</h2>
        <p>Add order id & delivery code here</p>
        <form>
          <div class="inputBox">
            <input type="text" name="text" class="t-feild" id="order_id" required onkeyup="this.setAttribute('value', this.value);"  value="">
            <label>Order ID</label>
          </div>
          <div class="inputBox">
                <input type="text" name="text" class="t-feild" id="de_code" required onkeyup="this.setAttribute('value', this.value);" value="">
                <label>DELIVERY CODE</label>
              </div>
              <a href="#myModal-suss" data-toggle="modal">
                  <input type="hidden" id="shop-id" value="<?php echo $shopId;?>">
          <input type="button" class="btn primary" name="update" onclick="updateOrder()" value="Submit"></a>
        </form>
      </div>

</body>
<script>
    function updateOrder(){
        var orderId = document.getElementById("order_id").value;
        var deCode = document.getElementById("de_code").value;
        var shopId = document.getElementById("shop-id").value;

        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "../functions/api.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.setRequestHeader("application-auth", "computershop-auth");

        xhttp.onreadystatechange = function() {
            if (xhttp.readyState === XMLHttpRequest.DONE && xhttp.status === 200) {
                if (xhttp.responseText) {
                    var responseObj = JSON.parse(xhttp.responseText);
                    if (responseObj) {
                        if (responseObj.status === "SUCCESS") {
                            alert(responseObj.msg);
                            location.reload()
                        } else {
                            alert(responseObj.msg);
                        }
                    }
                }

            }
        }
        xhttp.send("action=updateOrder&orderId=" + orderId + "&deCode=" + deCode + "&shopId=" + shopId);


    }
</script>
</html>