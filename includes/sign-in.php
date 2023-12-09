<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
<style>
    .back-btn {
        background: #ffd088;
        padding: 10px;
        border-radius: 100%;
        width: 40px;
        height: 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
        color: #ffffff;
        font-size: 20px;
    }

    .back-btn:hover {
        background: #ffffff;
        color: #ff9c00;
        transition: 0.3s;
    }
</style>

<body>
    <div class="offcanvas offcanvas-end sign-in-canvas" tabindex="-1" id="sign-in-offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-body">
            <div class="canvas-left">
                <img src="./assets/sanakin-logo.png" class="logo" alt="">
                <form class="sign-in-form sign-in1" id="sign-in1" action="" method="">
                    <div class="form-container">
                        <h3>Sign In</h3>
                        <p>Sign in with your email address and password.</p>
                        <div class="inputBox">
                            <input type="email" class="t-feild form_data" name="email" id="email" required="required">
                            <span>Email Address</span>
                        </div>
                        <div class="inputBox">
                            <input type="password" class="t-feild form_data" name="password" id="password" required="required">
                            <span>Password</span>
                        </div>
                        <p class="forget-pass" id="forget-password" onclick="clickForgetPassword()">Forget Password</p>
                        <input type="button" class="primary btn" value="Sign In" onclick="signIn()">
                        <p>If you don't have an account <a id="create-account" data-bs-dismiss="offcanvas" aria-label="Close" onclick="openSecondOffcanvas()">Create Account</a></p>
                    </div>
                </form>

                <form class="sign-in-form sign-in2" id="sign-in2" style="display: none;" action="" method="GET" required>
                    <div class="form-container">
                        <h3>Email Address</h3>
                        <img src="./assets/icons/exept-vector.svg" alt="">
                        <p>First, tell us what is your email address</p>
                        <input type="email" class="t-feild form_data" name="email" id="send-email" placeholder="Email Address">
                        <input type="button" class="primary btn" id="sendStepOne" value="Continue" onclick="fogetPasswordEmailSend()">
                        <button class="con-btn" id="sendStepOne2" style="display:none;" type="button" disabled>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Wait...
                        </button>
                        <div id="backBtn1" class="back-btn" onclick="backStep()">
                            <i class="bi bi-chevron-left"></i>
                        </div>
                    </div>
                </form>

                <form class="sign-in-form sign-in3" id="sign-in3" style="display: none;" action="" method="GET" required>
                    <div class="form-container">
                        <h3>Verifying</h3>
                        <p>Password reset link sent to your Email.<br>Chek your Email inbox.<br>That link is valid for next 30 minutes.</p>
                        
                        <p class="orange-text" style="cursor:pointer;" onclick="fogetPasswordEmailSend()">Resend Code</p>
                        <input type="button" class="primary btn" value="Exit" onclick="resetCanvas()">
                    </div>
                </form>

            </div>
            <div class="canvas-right">
                <div class="canvas-header">
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close" onclick="resetCanvas()"></button>
                </div>
                <h4>“Shop without limits – anytime, anywhere!”</h4>
                <img src="./assets/Gray.png" alt="" srcset="">
            </div>
        </div>
    </div>
</body>

<script>
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const destination = urlParams.get('destination');
    if (destination) {
        if (destination === "login") {
            document.getElementById('sign-in-offcanvasRight').classList.add('show');
            document.getElementById('sign-in-offcanvasRight').style.visibility = 'visible';
        }
    }

    function signIn() {

        var email = document.getElementById("email").value;
        var password = document.getElementById("password").value;

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
                            location.reload();
                        } else {
                            alert(responseObj.msg);
                        }
                    }
                }
            }
        }
        xhttp.send("action=login&email=" + email + "&password=" + password);
    }

    function fogetPasswordEmailSend() {

        document.getElementById("sendStepOne").style.display = "none";
        document.getElementById("sendStepOne2").style.display = "block";

        var email = document.getElementById("send-email").value;

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
                            document.getElementById("sign-in2").style.display = "none";
                            document.getElementById("sign-in3").style.display = "flex";
                        } else {
                            alert(responseObj.msg);
                            document.getElementById("sendStepOne").style.display = "block";
                            document.getElementById("sendStepOne2").style.display = "none";
                        }
                    }
                }

            }
        }
        xhttp.send("action=send_reset_link&email=" + email);


    }


    function clickForgetPassword() {
        document.getElementById("sign-in1").style.display = "none";
        document.getElementById("sign-in2").style.display = "flex";
    }

    function backStep() {
        document.getElementById("sign-in2").style.display = "none";
        document.getElementById("sign-in1").style.display = "flex";
        document.getElementById("sendStepOne").style.display = "block";
        document.getElementById("sendStepOne2").style.display = "none";
    }
    function resetCanvas() {
        document.getElementById("sign-in2").style.display = "none";
        document.getElementById("sign-in3").style.display = "none";
        document.getElementById("sign-in1").style.display = "flex";
        document.getElementById("sendStepOne").style.display = "block";
        document.getElementById("sendStepOne2").style.display = "none";
    }

</script>

</html>