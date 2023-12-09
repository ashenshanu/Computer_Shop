function addtoCart(productId,qty) {


    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "functions/api.php" , true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.setRequestHeader("application-auth", "sanakin-auth");

    xhttp.onreadystatechange = function () {
        if (xhttp.readyState === XMLHttpRequest.DONE && xhttp.status === 200) {
            if (xhttp.responseText) {
                var responseObj = JSON.parse(xhttp.responseText);
                if (responseObj) {
                    if(responseObj.status === "SUCCESS"){
                        location.reload();
                    }else{
                        alert(responseObj.msg);
                    }
                }
            }

        }
    }

    xhttp.send("action=cart_add&productID="+ productId + "&qty="+ qty );
}