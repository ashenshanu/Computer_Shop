$(document).ready(function() {
    $("#color_mode").on("change", function () {
        colorModePreview(this);
    })
});

function colorModePreview(ele) {
    if ($(ele).prop("checked")) {
        $('body').addClass('dark-preview');
        $('body').removeClass('white-preview');
        document.getElementById('account_type').value = "SHOPPER"
    }
    else if (!$(ele).prop("checked")) {
        $('body').addClass('white-preview');
        $('body').removeClass('dark-preview');
        document.getElementById('account_type').value = "CUSTOMER"
    }
}

function checkPasswordMatch() {
    var password = document.getElementById("newPassword").value;
    var confirmPassword = document.getElementById("confirmPassword").value;
    if (password != confirmPassword) {
        document.getElementById("divCheckPasswordMatch").innerHTML = "Passwords do not match!";
        document.getElementById("submit").disabled = true;
    } else {
        document.getElementById("divCheckPasswordMatch").innerHTML = "Passwords match.";
        document.getElementById("submit").disabled = false;
    }
}
function checkPasswordMatch2() {
    var password = document.getElementById("reset-password").value;
    var confirmPassword = document.getElementById("c-reset-password").value;
    if (password != confirmPassword) {
        document.getElementById("divCheckPasswordMatch2").innerHTML = "Passwords do not match!";
        document.getElementById("submit").disabled = true;
    } else {
        document.getElementById("divCheckPasswordMatch2").innerHTML = "Passwords match.";
        document.getElementById("submit").disabled = false;
    }
}


function hide1() {

    var xhttp = new XMLHttpRequest();

    xhttp.open("POST", "js/data-crud.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


    xhttp.onreadystatechange = function () {
        if (xhttp.readyState === XMLHttpRequest.DONE && xhttp.status === 200) {
            if (xhttp.responseText) {
                var responseObj = JSON.parse(xhttp.responseText);
                if (responseObj) {
                    if(responseObj.status === "SUCCESS"){
                        document.getElementById('submitedEmail').innerHTML = email;
                        document.getElementById("signup-s1").style.display = "none";
                        document.getElementById("signup-s2").style.display = "flex";

                    }
                }
            }

        } else {
            console.log(xhttp.status);
            console.log(xhttp.responseText);
        }
    }

    var email = document.getElementById("newEmail").value;
    var password = document.getElementById("newPassword").value;
    var type = document.getElementById("newEmail").value;
    xhttp.send("newEmail=" + email + "&newPassword=" + password + "&newType=" + type);
}

function hide2() {
    document.getElementById("sec2").style.display = "none";
    document.getElementById("sec3").style.display = "block";
}


  