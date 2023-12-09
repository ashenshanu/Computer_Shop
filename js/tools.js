window.addEventListener("load", function() {
if(document.getElementById("loader")) {
    document.getElementById("loader").style.display = "none";
}

}, false);


let rangeInput = document.getElementById('priceRangeInput');
if(rangeInput){
    rangeInput.addEventListener('input', function(e){
        document.getElementById('rangeValue').innerHTML = e.target.value;

        let queryString = window.location.search;
        let urlParams = new URLSearchParams(queryString);
        let category = urlParams.get('cat_id');
        if(category){
            location.href="./online-shop.php?cat_id="+category+"&maxPrice="+e.target.value;
        }else {
            location.href='./online-shop.php?maxPrice='+e.target.value;
        }
    });
}

function categoryClick(categoryID) {

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const maxPrice = urlParams.get('maxPrice');
    if(maxPrice){
        location.href="./online-shop.php?cat_id="+categoryID+"&maxPrice="+maxPrice;
    }else {
        location.href='./online-shop.php?cat_id='+categoryID;
    }
}


function handleSearchButton(search_txt) {
    if(search_txt.length > 3) {
        location.href = "./search_results.php?search_txt=" + search_txt;
    }else {
        alert("Please type more than 3 characters for better search results");
    }
}

function handleSearchFiled(event) {
    if (event.key === "Enter") {
        handleSearchButton(event.target.value);
    }
}




let view1 = document.getElementById('view1');
let view2 = document.getElementById('view2');
let view1btn = document.getElementById('check-out');
let sCartModal = document.getElementById('s-cart-offcanvasRight');
let modalBackdrop = document.getElementById('offcanvas-backdrop');

view1btn.addEventListener('click', () => {
    view1.classList.add('hidden');
    view2.classList.remove('hidden');
});

function freshStep(){
    view2.classList.add('hidden');
    view1.classList.remove('hidden');
}

function placeOrder() {

    let address = document.getElementById("cart-address");
    let city = document.getElementById("cart-city");
    let msg = document.getElementById("cart-msg");

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'functions/api.php', true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.setRequestHeader("application-auth", "computershop-auth");

    xhr.onload = function () {
        if (xhr.readyState === xhr.DONE && xhr.status === 200) {
            if (xhr.responseText) {
                var responseObj = JSON.parse(xhr.responseText);
                if (responseObj) {
                    if (responseObj.status === "SUCCESS") {
                        document.getElementById('new-order-number').innerText = responseObj.data;
                        view2.classList.add('hidden');
                        document.getElementById('cart-sucess').classList.remove('hidden');
                    }
                }
            }
        }
    };
    xhr.send("action=checkout&address="+address.value+"&city="+city.value+"&msg="+msg.value);
}


function sendComplain(kindof,relativeId,userId) {
    let subject = document.getElementById("com_subject").value;
    let msg = document.getElementById("com_msg").value;

    const xhr = new XMLHttpRequest();
    xhr.open('POST', './functions/api.php', true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.setRequestHeader("application-auth", "computershop-auth");

    xhr.onload = function () {
        if (xhr.readyState === xhr.DONE && xhr.status === 200) {
            if (xhr.responseText) {
                var responseObj = JSON.parse(xhr.responseText);
                if (responseObj) {
                    if (responseObj.status === "SUCCESS") {
                        location.reload();
                    }
                }
            }
        }
    };
    xhr.send("action=send_complaint&kindof="+kindof+"&relativeId="+relativeId+"&subject="+subject+"&msg="+msg+"&userId="+userId);
}

function dataCheck(){
    if (document.getElementById('com_subject').value == "" || document.getElementById('com_msg').value == null){
        document.getElementById('send-btn').disabled = true;
    }else if (document.getElementById('com_msg').value == "" || document.getElementById('com_msg').value == null){
        document.getElementById('send-btn').disabled = true;
    }else {
        document.getElementById('send-btn').disabled = false;
    }
}

function openSecondOffcanvas() {
    var offcanvas2 = document.getElementById('sign-up-offcanvasRight');
    var offcanvas2Obj = new bootstrap.Offcanvas(offcanvas2);
    offcanvas2Obj.show();
}
function openSecondOffcanvas2() {
    var offcanvas2 = document.getElementById('sign-in-offcanvasRight');
    var offcanvas2Obj = new bootstrap.Offcanvas(offcanvas2);
    offcanvas2Obj.show();
}

function logoutUser() {

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../functions/api.php', true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.setRequestHeader("application-auth", "computershop-auth");

    xhr.onload = function () {
        if (xhr.readyState === xhr.DONE && xhr.status === 200) {
            if (xhr.responseText) {
                var responseObj = JSON.parse(xhr.responseText);
                if (responseObj) {
                    if (responseObj.status === "SUCCESS") {
                        location.reload();
                    }
                }
            }
        }
    };
    xhr.send("action=logout_user");
}

function uploadInquiry() {

    let name = document.getElementById('name');
    let email = document.getElementById('email');
    let phone = document.getElementById('phone');
    let msg = document.getElementById('msg');

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'functions/api.php', true);
    xhr.setRequestHeader("application-auth", "computershop-auth");

    const formData = new FormData();
    formData.append('name', name.value);
    formData.append('email', email.value);
    formData.append('phone', phone.value);
    formData.append('msg', msg.value);
    formData.append('action', "contact_inquiry");
    xhr.onload = function () {
        if (xhr.readyState === xhr.DONE && xhr.status === 200) {
            if (xhr.responseText) {
                var responseObj = JSON.parse(xhr.responseText);
                if (responseObj) {
                    if (responseObj.status === "SUCCESS") {
                        location.reload();
                    }
                }
            }
        }
    };
    xhr.send(formData);
}
function addNewSubscriber() {

    let email = document.getElementById('newsletter_email');

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'functions/api.php', true);
    xhr.setRequestHeader("application-auth", "computershop-auth");

    const formData = new FormData();
    formData.append('email', email.value);
    formData.append('action', "add_subscriber");

    xhr.onload = function () {
        if (xhr.readyState === xhr.DONE && xhr.status === 200) {
            if (xhr.responseText) {
                var responseObj = JSON.parse(xhr.responseText);
                if (responseObj) {
                    if (responseObj.status === "SUCCESS") {
                        location.reload();
                    }
                }
            }
        }
    };
    xhr.send(formData);
}
