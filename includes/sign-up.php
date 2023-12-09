<body>
    <div class="offcanvas offcanvas-end sign-up-canvas" tabindex="-1" id="sign-up-offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <button type="button" class="btn-close text-reset" onclick="location.reload()" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <nav class="top-nav">
            <img class="logo" src="./assets/sanakin-logo.png" alt="">
        </nav>
        <div class="offcanvas-body">

            <div class="container">
                <div class="sign-up-body">
                    <form class="step s1" id="signup-s1" method="POST" required>
                        <input type="hidden" id="account_type" value="CUSTOMER">
                        <input type="hidden" id="sanakin_uuu_sss" value="">
                        <h2>Create Account</h2>
                        <div class="account-type-selector">
                            <label class="switch btn-color-mode-switch">
                                <input type="checkbox" name="color_mode" id="color_mode" class="form_data" value="1">
                                <label for="color_mode" data-on="Shopper Account" data-off="Customer Account" class="btn-color-mode-switch-inner"></label>
                            </label>
                        </div>
                        <div class="feilds">
                            <input type="email" class="t-feild form_data" name="newEmail" id="newEmail" placeholder="Email Address" required>
                            <input type="password" class="t-feild form_data" name="newPassword" id="newPassword" placeholder="Create Password" onkeyup="checkPasswordMatch();">
                            <input type="password" class="t-feild form_data" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password" onkeyup="checkPasswordMatch();">
                        </div>
                        <div class="form-group" id="divCheckPasswordMatch"></div>
                        <div style="width: 100%;">
                            <input type="button" class="con-btn" name="continue" id="continueStepOne" value="Continue" onclick="emailVerifying()" disabled>

                            <button class="con-btn" id="continueStepOne2" style="display:none;" type="button" disabled>
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                Wait...
                            </button>
                            <p>If you have an account <a id="create-account" class="orange-text" data-bs-dismiss="offcanvas" aria-label="Close" onclick="openSecondOffcanvas2()">Sign in</a></p>
                        </div>



                    </form>


                    <form class="step s2" id="signup-s2" style="display: none;" action="" method="POST" required>

                        <h2>Email Verification</h2>
                        <img src="./assets/icons/email.svg" alt="">
                        <div class="feilds">
                            <p>Enter the 6 Digits code you received to<br>
                                <span class="orange-text" id="submitedEmail"></span>
                            </p>
                            <input type="numbers" class="t-feild" name="newVCode" id="newVCode" placeholder="6 Digits Code">
                        </div>
                        <input type="button" class="con-btn" name="codeVerifing" id="codeVerifing" onclick="codeCheck()" value="Submit">
                    </form>


                    <form class="step s3" id="signup-s3" style="display: none;" action="" method="POST" required>

                        <h2>Your Profile</h2>
                        <div class="feilds">
                            <div class="feilds-sec">
                                <h6>Your Informations</h6>
                                <span>
                                    <input type="text" class="t-feild" name="firstName" id="firstName" placeholder="First Name">
                                    <input type="text" class="t-feild" name="lastName" id="lastName" placeholder="Last Name">
                                </span>
                                <input type="text" class="t-feild" name="fullName" id="fullName" placeholder="Full Name">
                                <span>
                                    <input type="date" pattern="\d{2}-\d{2}-\d{4}" class="t-feild tf2" name="birthday" id="birthday" placeholder="Birthday(DD/MM/YYYY)">
                                    <select class="t-feild tf2" name="gender" id="gender">
                                        <option value="">Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">female</option>
                                    </select>
                                </span>
                                <span>
                                    <input type="text" class="t-feild" name="nicNumber" id="nicNumber" placeholder="NIC Number">
                                    <input type="number" class="t-feild" name="contactNumber" id="contactNumber" placeholder="Mobile Number">
                                </span>
                            </div>

                            <div class="feilds-sec">
                                <h6>Home Address</h6>
                                <input type="text" class="t-feild" name="address" id="address" placeholder="Street Address">
                                <span>
                                    <input type="text" class="t-feild" name="city" id="city" placeholder="City">
                                    <input type="text" class="t-feild" name="zipCode" id="zipCode" placeholder="Zip Code">
                                </span>
                            </div>
                        </div>
                        <input type="button" class="con-btn" name="confirmInfo" id="confirmInfo" onclick="registerUser()" value="Continue">
                    </form>


                    <form class="step s4" id="signup-s4" style="display: none;" action="" method="POST" required>

                        <h2>Profile Picture</h2>
                        <div class="feilds" style="width: 100%; display: flex; justify-content: center; align-items: center;">
                            <div class="img-upload dp-img" >
                                <img id="img-preview" >
                                <input type="file" name="" id="dpimg">
                            </div>

                        </div>
                        <input type="button" class="con-btn" name="dpSubmit" id="dpSubmit" onclick="addDPImage()" value="Submit">
                        <a href="" onclick="sendToLogin()">Skip</a>
                    </form>


                </div>

            </div>
        </div>
    </div>
</body>
<script src="./js/sign-up.js?v=741"></script>
<script>
    document.getElementById('dpimg').addEventListener('change', function (ev) {

        if (ev.target.files && ev.target.files[0]) {
            let reader = new FileReader();
            reader.onload = function (e) {
                console.log(e.target.result);
                document.getElementById('img-preview').setAttribute('src',e.target.result);
            };

            reader.readAsDataURL(ev.target.files[0]);
        }
    });

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

    function emailVerifying() {
        document.getElementById("continueStepOne").style.display = "none";
        document.getElementById("continueStepOne2").style.display = "block";

        var email = document.getElementById("newEmail").value;
        var password = document.getElementById("newPassword").value;

        document.getElementById('submitedEmail').innerHTML = email;
        document.getElementById('newEmail').innerHTML = email;

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
                            document.getElementById("signup-s1").style.display = "none";
                            document.getElementById("signup-s2").style.display = "flex";
                        } else {
                            alert(responseObj.msg);
                            document.getElementById("continueStepOne").style.display = "block";
                            document.getElementById("continueStepOne2").style.display = "none";
                        }
                    }
                }

            }
        }
        xhttp.send("action=emailVerifying&email=" + email + "&password=" + password);

    }

    function codeCheck() {


        var newVCode = document.getElementById("newVCode").value;

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
                            //document.getElementById('submitedEmail').innerHTML = email;
                            document.getElementById("signup-s2").style.display = "none";
                            document.getElementById("signup-s3").style.display = "flex";
                        } else {
                            alert(responseObj.msg);
                        }
                    }
                }

            }
        }

        xhttp.send("action=codeCheck&code=" + newVCode);
    }


    function registerUser() {

        let fname = document.getElementById('firstName');
        let lname = document.getElementById('lastName');
        let fullName = document.getElementById('fullName');
        let bday = document.getElementById('birthday');
        let gender = document.getElementById('gender');
        let nic = document.getElementById('firstName');
        let mobileNumber = document.getElementById('contactNumber');
        let address = document.getElementById('address');
        let city = document.getElementById('city');
        let zip = document.getElementById('zipCode');
        let type = document.getElementById('account_type');
        let email = document.getElementById("newEmail");
        let password = document.getElementById("newPassword");

        let xhttp = new XMLHttpRequest();
        xhttp.open("POST", "functions/api.php", true);
        xhttp.setRequestHeader("application-auth", "computershop-auth");

        const formData = new FormData();
        formData.append('firstName', fname.value);
        formData.append('lastName', lname.value);
        formData.append('fullName', fullName.value);
        formData.append('birthday', bday.value);
        formData.append('gender', gender.value);
        formData.append('nic', nic.value);
        formData.append('mobileNumber', mobileNumber.value);
        formData.append('address', address.value);
        formData.append('city', city.value);
        formData.append('zip', zip.value);
        formData.append('email', email.value);
        formData.append('password', password.value);
        formData.append('type', type.value);
        formData.append('action', "register_user");

        xhttp.onreadystatechange = function() {
            if (xhttp.readyState === XMLHttpRequest.DONE && xhttp.status === 200) {

                if (xhttp.responseText) {
                    var responseObj = JSON.parse(xhttp.responseText);
                    if (responseObj) {
                        if (responseObj.status === "SUCCESS") {

                            if (responseObj.data) {
                                if (responseObj.data.user_id) {
                                    document.getElementById('sanakin_uuu_sss').value = responseObj.data.user_id;
                                }
                            }
                            //document.getElementById('submitedEmail').innerHTML = email;
                            document.getElementById("signup-s3").style.display = "none";
                            document.getElementById("signup-s4").style.display = "flex";
                        } else {
                            alert(responseObj.msg);
                        }
                    }
                }

            }
        }
        xhttp.send(formData);
    }

    function addDPImage() {

        let dpImage = document.getElementById('dpimg');
        if (dpImage.files.length > 0) {

            let xhttp = new XMLHttpRequest();
            xhttp.open("POST", "functions/api.php", true);
            xhttp.setRequestHeader("application-auth", "computershop-auth");

            const formData = new FormData();
            formData.append('image', dpImage.files[0]);
            formData.append('userID', document.getElementById('sanakin_uuu_sss').value);
            formData.append('action', "add_user_dp");

            xhttp.onreadystatechange = function() {
                if (xhttp.readyState === XMLHttpRequest.DONE && xhttp.status === 200) {
                    if (xhttp.responseText) {
                        var responseObj = JSON.parse(xhttp.responseText);
                        if (responseObj) {
                            if (responseObj.status === "SUCCESS") {
                                sendToLogin();
                            }
                        }
                    }
                }
            };
            xhttp.send(formData);

        } else {
            alert("Please add a Image to Upload");
        }
    }

    function sendToLogin() {
        alert("Please Login with new User Account");
        window.location.href = "./index.php?destination=login";
    }
</script>

</html>