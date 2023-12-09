<!DOCTYPE html>
<html lang="en">


<?php

date_default_timezone_set('Asia/Colombo');

require_once('connectors/db-connector.php');
require_once('configs/config.php');
require_once('controller/user_controller.php');



$isExpired = false;
$allOK = false;

if($_GET["san-rest-pa"] != null && strlen($_GET["san-rest-pa"]) > 3) {

    $resetData = getResetPasswordByCode($_GET["san-rest-pa"]);
    if($resetData != null && $resetData["user_user_id"] != null && !($resetData["is_active"] === 0)){
        if($resetData["is_used"] === 0 && $resetData["is_expired"] === 0){

            $createDate = new DateTime($resetData["date_created"]);
            $now = new DateTime();
            $diff = $createDate->diff($now);

            if($diff->h < 2){
                if(updatePasswordResetLink($resetData["reset_code"])){
                    $allOK = true;
                }
            }else{
                $isExpired = true;
            }

        }else{
            $isExpired = true;
        }
    }else{
        header('Location: '.BASE_URL);
    }
}else{
    header('Location: '.BASE_URL);
}



?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="icon" type="image/x-icon" href="./assets/favicon.png">
    <title>Reset Account Password</title>
</head>

<body class="sign-up-canvas reset-page">
    <nav class="top-nav">
        <img class="logo" src="./assets/sanakin-logo.png" alt="">
    </nav>
    <div class="container">
        <?php if($isExpired){?>
        <div class="sign-up-body">
        <div class="step s1" id="signup-s0" method="POST" required>
            <p>Link is expired</p>
            <p>Try again...!</p>
        </div>
            </div>
        <?php }?>
        <?php if($allOK){?>
        <div class="sign-up-body">
            <form class="step s1" id="signup-s1" method="POST" required>
                <input type="hidden" id="account_type" value="CUSTOMER">
                <input type="hidden" id="sanakin_uuu_sss" value="">
                <h2>Reset Password</h2>
                <div class="feilds">
                    <input type="hidden" id="user_id" value="<?php echo $resetData["user_user_id"]; ?>">
                    <input type="password" class="t-feild form_data" name="newPassword" id="newPassword" placeholder="New Password" onkeyup="checkPasswordMatch();">
                    <input type="password" class="t-feild form_data" name="confirmPassword" id="confirmPassword" placeholder="Confirm New Password" onkeyup="checkPasswordMatch();">
                </div>
                <div class="form-group" id="divCheckPasswordMatch"></div>
                <input type="button" class="con-btn" name="continue" id="continueStepOne" value="Continue" onclick="updatePassword()" disabled>

                <button class="con-btn" id="continueStepOne2" style="display:none;" type="button" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Wait...
                </button>

            </form>
        </div>
        <?php }?>
    </div>


    <div class="modal fade" id="success-reset" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="border: transparent;">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Your Password is Successfully Reset.</h1>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="con-btn btn-primary"onclick="window.location.href='./index.php';">Let's Sign In</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.3.slim.min.js" integrity="sha256-ZwqZIVdD3iXNyGHbSYdsmWP//UBokj2FHAxKuSBKDSo=" crossorigin="anonymous"></script>
    <script src="./js/bootstrap.js"></script>
    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="./js/tools.js?v=7414"></script>
    <script>
        function checkPasswordMatch() {
            var password = document.getElementById("newPassword").value;
            var confirmPassword = document.getElementById("confirmPassword").value;
            if (password != confirmPassword) {
                document.getElementById("divCheckPasswordMatch").innerHTML = "Passwords do not match!";
                document.getElementById("continueStepOne").disabled = true;
            } else {
                document.getElementById("divCheckPasswordMatch").innerHTML = "Passwords match.";
                document.getElementById("continueStepOne").disabled = false;
            }
        }

        function updatePassword() {
            document.getElementById("continueStepOne").style.display = "none";
            document.getElementById("continueStepOne2").style.display = "block";

            var password = document.getElementById("newPassword").value;
            var userId = document.getElementById("user_id").value;

            var xhttp = new XMLHttpRequest();
            xhttp.open("POST", "functions/api.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.setRequestHeader("application-auth", "computershop-auth");

            xhttp.onreadystatechange = function() {
                if (xhttp.readyState === XMLHttpRequest.DONE && xhttp.status === 200) {

                    if (xhttp.responseText) {
                        var responseObj = JSON.parse(xhttp.responseText);
                        if (responseObj) {
                            if (responseObj.status === "SUCCESS") {
                                $('#success-reset').modal('show');


                            } else {
                                alert(responseObj.msg);
                                document.getElementById("continueStepOne").style.display = "block";
                                document.getElementById("continueStepOne2").style.display = "none";
                            }
                        }
                    }

                }
            }
            xhttp.send("action=reset_password&newPassword=" + password + "&userId=" + userId);

        }
    </script>
</body>

</html>