<?php
require_once "../configs/config.php";

require_once "../connectors/db-connector.php";

include "../controller/product_controller.php";
include "../controller/shop_controller.php";
//var_dump($_SESSION["shop"]);
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css">
        <title>Mr.PC</title>
    </head>
<body>
    <header id="top_header">
        <div class="wrapper">
          <a href="index.html"><img id="logo_top" draggable="false" src="../assets/Mr.PC.png"></a>
        </div>
    </header>

    <div class="box">
        <h2>Log in</h2>
        <p>Log  in with your shopper account</p>
        <form>
          <div class="inputBox">
            <input type="email" name="email" class="t-feild" id="email" onkeyup="dataCheck()" required>
            <label>Email Address</label>
          </div>
          <div class="inputBox">
                <input type="password" class="t-feild" name="text" id="password" onkeyup="dataCheck()" required>
                <label>Password</label>
              </div>
          <input type="button" class="btn primary" id="signin-btn" onclick="shopSignIn()" value="Login" disabled>
        </form>
      </div>

</body>
    <script
            src="https://code.jquery.com/jquery-3.6.3.slim.min.js"
            integrity="sha256-ZwqZIVdD3iXNyGHbSYdsmWP//UBokj2FHAxKuSBKDSo="
            crossorigin="anonymous"></script>
    <script>
        function dataCheck(){
            if (document.getElementById('email').value == "" || document.getElementById('email').value == null){
                document.getElementById('signin-btn').disabled = true;
            }else if (document.getElementById('password').value == "" || document.getElementById('password').value == null){
                document.getElementById('signin-btn').disabled = true;
            }else {
                document.getElementById('signin-btn').disabled = false;
            }
        }
        function shopSignIn() {


            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;

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
                                location.href='./admin-shopper.php';
                            } else {
                                alert(responseObj.msg);
                            }
                        }
                    }

                }
            }
            xhttp.send("action=logindepot&email=" + email + "&password=" + password);


        }
    </script>
</html>