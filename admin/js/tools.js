// const myModal = document.getElementById('add-product-modal');
// const myInput = document.getElementById('add-product');
//
// myModal.addEventListener('shown.bs.modal', () => {
//     myInput.focus()
// });


setInterval(function() {
    var datetimeElement = document.getElementById('datetime');
    var options = {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: 'numeric',
        minute: 'numeric',
        second: 'numeric',
        hour12: false
    };
    var currentDateTime = new Date().toLocaleString('en-US', options);
    datetimeElement.innerHTML = currentDateTime;
}, 1000);

window.addEventListener("load", function() {
    setTimeout(loaderClose, 3000);
    
document.getElementById("loader").style.display = "none";

}, false);

function loaderClose(){
    
document.getElementById("loader").style.display = "none";
}
document.getElementById('product-img').addEventListener('change', function (ev) {

    if (ev.target.files && ev.target.files[0]) {
        let reader = new FileReader();
        reader.onload = function (e) {
            console.log(e.target.result);
            document.getElementById('img-preview').setAttribute('src',e.target.result);
        };

        reader.readAsDataURL(ev.target.files[0]);
    }
});
function addProduct() {


    let productName = document.getElementById('product-name');
    let quantity = document.getElementById('quantity');
    let perPrice = document.getElementById('per-price');
    let productCat = document.getElementById('product-cat');
    let description = document.getElementById('description');
    let isActive;
    let productImage = document.getElementById('product-img');

    var getSelectedValue = document.querySelector(
        'input[name="is-active"]:checked');

    if(getSelectedValue != null) {
        isActive = getSelectedValue.value;
    }else{
        isActive = 'ACTIVE';
    }

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../functions/api.php', true);
    xhr.setRequestHeader("application-auth", "computershop-auth");

    const formData = new FormData();
    formData.append('image', productImage.files[0]);
    formData.append('name', productName.value);
    formData.append('qty', quantity.value);
    formData.append('price', perPrice.value);
    formData.append('category', productCat.value);
    formData.append('desc', description.value);
    formData.append('status', isActive);
    formData.append('action', "create_product");

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


function setShopSession(shopID) {

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
                      window.location.href = "./shopper-dashboard.php";
                    }
                }
            }
        }
    };
    xhr.send("action=set_shop_session&shopID="+shopID);

}


function openEditModal(productId, productName, categoryID, desc, quantity, perPrice, status, imageURL) {


    let productIDInput = document.getElementById('e-product_id');
    let name = document.getElementById('e-product-name');
    let qty = document.getElementById('e-quantity');
    let price = document.getElementById('e-per-price');
    let productCat = document.getElementById('e-product-cat');
    let description = document.getElementById('e-description');
    let statusActive =  document.getElementById('e-active');
    let statusDarft =  document.getElementById('e-draft');
    let productImage = document.getElementById('e-image-preview');

    let oldImg = document.getElementById('e-product-img');
    let newInput = document.createElement("input");

    newInput.type = "file";
    newInput.id = oldImg.id;
    newInput.name = oldImg.name;
    newInput.className = oldImg.className;
    newInput.style.cssText = oldImg.style.cssText;

    oldImg.parentNode.replaceChild(newInput, oldImg);


    statusActive.checked = false;
    statusDarft.checked = false;

    productIDInput.value = productId;
    name.value = productName;
    qty.value = quantity;
    price.value = perPrice;
    productCat.value = categoryID;
    description.value = desc;

    if(status === "ACTIVE"){
        statusActive.checked = true;
    }else{
        statusDarft.checked = true;
    }

    productImage.setAttribute('src','../uploads/product_images/'+imageURL);


    $('#edit-product-modal').modal('show');
}

document.getElementById('e-product-img').addEventListener('change' ,function (ev) {
    if (ev.target.files && ev.target.files[0]) {
        document.getElementById('isImageChanged').value = 1;
        if (ev.target.files && ev.target.files[0]) {
            let reader = new FileReader();
            reader.onload = function (e) {
                console.log(e.target.result);
                document.getElementById('e-image-preview').setAttribute('src',e.target.result);
            };

            reader.readAsDataURL(ev.target.files[0]);
        }
    }
});


function updateProduct() {

    let productID = document.getElementById('e-product_id');
    let name = document.getElementById('e-product-name');
    let qty = document.getElementById('e-quantity');
    let price = document.getElementById('e-per-price');
    let productCat = document.getElementById('e-product-cat');
    let description = document.getElementById('e-description');
    let statusActive =  document.getElementById('e-active');
    let statusDarft =  document.getElementById('e-draft');
    let uploadImage = document.getElementById('e-product-img');


    let status = "ACTIVE";
    if(statusDarft.checked){
        status = "DRAFT";
    }else if(statusActive.checked){
        status = "ACTIVE";
    }

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../functions/api.php', true);
    xhr.setRequestHeader("application-auth", "computershop-auth");

    let sendData = new FormData();
    sendData.append('productID',productID.value);
    sendData.append('name',name.value);
    sendData.append('qty',qty.value);
    sendData.append('price',price.value);
    sendData.append('categoryID',productCat.value);
    sendData.append('desc',description.value);
    sendData.append('status',status);
    sendData.append('action',"update_product");
    if(document.getElementById('isImageChanged').value === "1") {
        sendData.append('image',uploadImage.files[0]);
    }


    xhr.onload = function () {
        if (xhr.readyState === xhr.DONE && xhr.status === 200) {
            if (xhr.responseText) {
                var responseObj = JSON.parse(xhr.responseText);
                if (responseObj) {
                    if (responseObj.status === "SUCCESS") {
                        //window.location.href = "./shopper-product.php";
                        location.reload();
                    }
                }
            }
        }
    };
    xhr.send(sendData);
}



function deleteProduct() {

    let productId = document.getElementById('del-productID').value;
    console.log("===================="+productId);

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

    xhr.send("action=delete_product&productID="+productId);
}

function openCustomerOrderModal(jsonData) {

    if(jsonData) {

        let custName = "";
        let address = "";
        let mobile = "";
        let totalBill = "";
        let custHtml = "";

        let fixData = jsonData.replaceAll('|', '"');
        let customerList = JSON.parse(fixData);
        console.log(customerList);
        if (customerList) {
            if (customerList.length > 0) {
                custName = customerList[0].first_name+" "+customerList[0].last_name;
                address = customerList[0].de_address + " " + customerList[0].de_city;
                mobile = customerList[0].de_tel;
                totalBill = 0.00;

                


                for (i = 0; i < customerList.length; i++) {
                    let customerRow = customerList[i];
                    if (customerRow) {
                        if(customerRow.de_status === "PROCESSING"){
                            statusActionHtml = "<p id=\"order-status\" class=\"status-tag \" style=\" color:#006CCF; border:#006CCF;\">PROCESSING</button>";
                        }else if(customerRow.de_status === "READY"){
                            statusActionHtml = "<p id=\"order-status\" class=\"status-tag \" style=\" color:#FF9C00; border:#FF9C00;\">READY</button>";
                        }else if(customerRow.de_status === "ON DELIVERY"){
                            statusActionHtml = "<p id=\"order-status\" class=\"status-tag \" style=\" color:#882FFA; border:#882FFA;\">ON DELIVERY</p>";
                        }else if(customerRow.de_status === "DELIVERED"){
                            statusActionHtml = "<p id=\"order-status\" class=\"status-tag \" style=\" color:#28D764; border:#28D764;\">DELIVERED</h4>";
                        }else if(customerRow.de_status === "NOT DELIVERED"){
                            statusActionHtml = "<p id=\"order-status\" class=\"status-tag \" style=\" color:#DD3A3A; border:#DD3A3A;\">Delivery Failed</h4>";
                        }
        
                        custHtml += "<div class=\"order-card white-bd-card\">\n" +
                            "                                <p id=\"order-id\">"+customerRow.order_number+"</p>\n" +
                            "                                <p id=\"order-date\">"+customerRow.create_time+"</p>\n" +
                            "                                <p id=\"order-price\">Rs."+customerRow.cust_total+"</p>\n" +
                            "                                "+statusActionHtml+"\n" +
                            "                                <p id=\"order-view\"><i class=\"bi bi-box-arrow-up-right\"></i></p>\n" +
                            "                            </div>"
                    }
                }

                document.getElementById('c-name').innerHTML = custName;
                document.getElementById('c-address').innerHTML = address;
                document.getElementById('c-tel').innerHTML = mobile;
                document.getElementById('item-list-container').innerHTML = custHtml;
            }
        }
    }

    $('#view-customer-modal').modal('show');
}

function openOrderItemModal(jsonData) {

    if(jsonData){

        let custName = "";
        let address = "";
        let mobile = "";
        let totalBill = "";
        let itemListHtml = "";
        let statusActionHtml = "";

        let fixData = jsonData.replaceAll('|','"');
        let productList = JSON.parse(fixData);
        console.log(productList);
        if(productList){
         if(productList.length > 0){
            custName = productList[0].full_name;
            address = productList[0].de_address+" "+productList[0].de_city;
            mobile = productList[0].de_tel;
            totalBill = 0.00;


            if(productList[0].de_status === "PROCESSING"){
                statusActionHtml = "<button type=\"button\" class=\"btn primary\" onclick=\"updateStatus("+productList[0].order_id+",'READY')\">Package Ready</button>";
            }else if(productList[0].de_status === "READY"){
                statusActionHtml = "<button type=\"button\" class=\"btn primary\" onclick=\"updateStatus("+productList[0].order_id+",'ON DELIVERY')\">Push to Delivery</button>";
            }else if(productList[0].de_status === "ON DELIVERY"){
                statusActionHtml = "<h4 class=\"orange-text\">On Delivery</h4>";
            }else if(productList[0].de_status === "DELIVERED"){
                statusActionHtml = "<h4 class=\"green-text\">Successfully Delivered</h4>";
            }else if(productList[0].de_status === "NOT DELIVERED"){
                statusActionHtml = "<h4 class=\"orange-text\">Delivery Failed</h4>";
            }


            for(i = 0; i < productList.length; i++){
                let productRow = productList[i];
                if(productRow){
                    totalBill += productRow.sub_total;
                    itemListHtml += "<div class=\"product-card\">\n" +
                        "\n" +
                        "                                <div class=\"product\">\n" +
                        "                                    <img src=\"./../assets/products.png\" alt=\"\">\n" +
                        "                                    <div class=\"name\">\n" +
                        "                                        <h5 id=\"name\">"+productRow.product_name+"</h5>\n" +
                        "                                        <label for=\"\">Per.price - Rs. <span>"+productRow.per_price+"</span></label>\n" +
                        "                                    </div>\n" +
                        "                                </div>\n" +
                        "                                <div class=\"pro-count\">\n" +
                        "                                    <div class=\"qyt-count\">\n" +
                        "                                        <label for=\"quantity\">Quantity</label>\n" +
                        "                                        <h5 id=\"quantity\">"+productRow.quntity+"</h5>\n" +
                        "\n" +
                        "                                    </div>\n" +
                        "                                    <div class=\"price\">\n" +
                        "                                        <label for=\"total-price\">Sub Price</label>\n" +
                        "                                        <h5 id=\"total-price\">"+productRow.sub_total+"</h5>\n" +
                        "\n" +
                        "                                    </div>\n" +
                        "\n" +
                        "                                </div>\n" +
                        "                            </div>"
                }
            }


            document.getElementById("customer-name").innerHTML = custName;
            document.getElementById("customer-address").innerHTML = address;
            document.getElementById("customer-tel").innerHTML = mobile;
            document.getElementById("bill").innerHTML = totalBill;
            document.getElementById('status_change_btn').innerHTML = statusActionHtml;
            document.getElementById("item-list-container").innerHTML = itemListHtml;
         }
        }
    }
    //console.log(document.getElementById('view-order-modal'));
    $('#view-order-modal').modal('show');
}
function openAccountViewModal(jsonData) {

    if(jsonData){

        let custName = "";
        let address = "";
        let mobile = "";
        let totalBill = "";
        let itemListHtml = "";
        let statusActionHtml = "";

        let fixData = jsonData.replaceAll('|','"');
        let productList = JSON.parse(fixData);
        console.log(productList);
        if(productList){
         if(productList.length > 0){
            custName = productList[0].full_name;
            address = productList[0].de_address+" "+productList[0].de_city;
            mobile = productList[0].de_tel;
            totalBill = 0.00;


            if(productList[0].de_status === "PROCESSING"){
                statusActionHtml = "<button type=\"button\" class=\"btn primary\" onclick=\"updateStatus("+productList[0].order_id+",'READY')\">Package Ready</button>";
            }else if(productList[0].de_status === "READY"){
                statusActionHtml = "<button type=\"button\" class=\"btn primary\" onclick=\"updateStatus("+productList[0].order_id+",'ON DELIVERY')\">Push to Delivery</button>";
            }else if(productList[0].de_status === "ON DELIVERY"){
                statusActionHtml = "<h4 class=\"orange-text\">On Delivery</h4>";
            }else if(productList[0].de_status === "DELIVERED"){
                statusActionHtml = "<h4 class=\"green-text\">Successfully Delivered</h4>";
            }else if(productList[0].de_status === "NOT DELIVERED"){
                statusActionHtml = "<h4 class=\"orange-text\">Delivery Failed</h4>";
            }


            for(i = 0; i < productList.length; i++){
                let productRow = productList[i];
                if(productRow){
                    totalBill += productRow.sub_total;
                    itemListHtml += "<div class=\"product-card\">\n" +
                        "\n" +
                        "                                <div class=\"product\">\n" +
                        "                                    <img src=\"./../assets/products.png\" alt=\"\">\n" +
                        "                                    <div class=\"name\">\n" +
                        "                                        <h5 id=\"name\">"+productRow.product_name+"</h5>\n" +
                        "                                        <label for=\"\">Per.price - Rs. <span>"+productRow.per_price+"</span></label>\n" +
                        "                                    </div>\n" +
                        "                                </div>\n" +
                        "                                <div class=\"pro-count\">\n" +
                        "                                    <div class=\"qyt-count\">\n" +
                        "                                        <label for=\"quantity\">Quantity</label>\n" +
                        "                                        <h5 id=\"quantity\">"+productRow.quntity+"</h5>\n" +
                        "\n" +
                        "                                    </div>\n" +
                        "                                    <div class=\"price\">\n" +
                        "                                        <label for=\"total-price\">Sub Price</label>\n" +
                        "                                        <h5 id=\"total-price\">"+productRow.sub_total+"</h5>\n" +
                        "\n" +
                        "                                    </div>\n" +
                        "\n" +
                        "                                </div>\n" +
                        "                            </div>"
                }
            }


            document.getElementById("customer-name").innerHTML = custName;
            document.getElementById("customer-address").innerHTML = address;
            document.getElementById("customer-tel").innerHTML = mobile;
            document.getElementById("bill").innerHTML = totalBill;
            document.getElementById('status_change_btn').innerHTML = statusActionHtml;
            document.getElementById("item-list-container").innerHTML = itemListHtml;
         }
        }
    }
    //console.log(document.getElementById('view-order-modal'));
    $('#view-order-modal').modal('show');
}
function updateStatus(orderID, status) {

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
    xhr.send("action=status_update&order_id="+orderID+"&status="+status);
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

function addShop() {

    let shopName = document.getElementById('shopName');
    let shopEmail = document.getElementById('shopEmail');
    let shopTel = document.getElementById('shopTel');
    let shopAddress = document.getElementById('shopAddress');
    let shopCity = document.getElementById('shopCity');
    let shopZipCode = document.getElementById('shopZipCode');
    let rocNumber = document.getElementById('rocNumber');
    let busiNature = document.getElementById('busiNature');
    let shopLogo = document.getElementById('up-shop-dp');
    let shopBanner = document.getElementById('up-shop-banner');


    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../functions/api.php', true);
    xhr.setRequestHeader("application-auth", "computershop-auth");

    const formData = new FormData();
    formData.append('shopName', shopName.value);
    formData.append('shopEmail', shopEmail.value);
    formData.append('shopTel', shopTel.value);
    formData.append('shopAddress', shopAddress.value);
    formData.append('shopCity', shopCity.value);
    formData.append('shopZipCode', shopZipCode.value);
    formData.append('rocNumber', rocNumber.value);
    formData.append('busiNature', busiNature.value);
    if(shopLogo.files[0]) {
        formData.append('up-shop-dp', shopLogo.files[0]);
    }
    if(shopBanner.files[0]) {
        formData.append('up-shop-banner', shopBanner.files[0]);
    }
    formData.append('action', "create_shop");
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

function updateUser(userId) {


    let dp_image = document.getElementById('update-dp');
    let firstName = document.getElementById('update-firstName');
    let lastName = document.getElementById('update-lastName');
    let fullName = document.getElementById('update-fullName');
    let birthday = document.getElementById('birthday');
    let gendder = document.getElementById('update-gender');
    let nic = document.getElementById('update-nicNumber');
    let tel = document.getElementById('update-contactNumber');
    let address = document.getElementById('update-address');
    let city = document.getElementById('update-city');
    let zipCode = document.getElementById('update-zipCode');
    
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../functions/api.php', true);
    xhr.setRequestHeader("application-auth", "computershop-auth");

    const formData = new FormData();
    formData.append('dp-img', dp_image.files[0]);
    formData.append('fName', firstName.value);
    formData.append('lName', lastName.value);
    formData.append('fullName', fullName.value);
    formData.append('birthday', birthday.value);
    formData.append('gender', gendder.value);
    formData.append('nic', nic.value);
    formData.append('tel', tel.value);
    formData.append('address', address.value);
    formData.append('city', city.value);
    formData.append('zipcode', zipCode.value);
    formData.append('userId', userId);
    formData.append('action', "update_user");

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

function updatePassword(userId) {


    let currentPass = document.getElementById('current-password');
    let newPass = document.getElementById('new-password');
    
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../functions/api.php', true);
    xhr.setRequestHeader("application-auth", "computershop-auth");

    const formData = new FormData();
    formData.append('currentPass', currentPass.value);
    formData.append('newPass', newPass.value);
    formData.append('userId', userId);
    formData.append('action', "update_password");

    xhr.onload = function () {
        if (xhr.readyState === xhr.DONE && xhr.status === 200) {
            if (xhr.responseText) {
                var responseObj = JSON.parse(xhr.responseText);
                if (responseObj) {
                    if (responseObj.status === "SUCCESS") {
                        location.reload();
                    }else{
                        alert(responseObj.msg);
                    }
                }
            }
        }
    };
    xhr.send(formData);
}

function deleteUser(userId) {

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../functions/api.php', true);
    xhr.setRequestHeader("application-auth", "computershop-auth");

    const formData = new FormData();
    formData.append('userId', userId);
    formData.append('action', "delete_user");

    xhr.onload = function () {
        if (xhr.readyState === xhr.DONE && xhr.status === 200) {
            if (xhr.responseText) {
                var responseObj = JSON.parse(xhr.responseText);
                if (responseObj) {
                    if (responseObj.status === "SUCCESS") {
                        location.reload();
                    }else{
                        alert(responseObj.msg);
                    }
                }
            }
        }
    };
    xhr.send(formData);
}
function openComplaintModal(jsonData) {

    if(jsonData){

        let related_id = "";

        let fixData = jsonData.replaceAll('|','"');
        let complainInfo = JSON.parse(fixData);
        console.log(complainInfo);
        let kind_of = complainInfo[0].kind_of;

        if(kind_of == 'shop' || kind_of == 'Shop'){
            related_id += "<label>Shop - <a class=\"orange-text\" href=\"../shop-profile.php?id="+complainInfo[0].related_id+"\">#"+complainInfo[0].related_id+"</a></label> "
        } else if(kind_of == 'product' || kind_of == 'Product'){
            related_id += "<label>Product - <a class=\"orange-text\" href=\"../single-product.php?id="+complainInfo[0].related_id+"\">#"+complainInfo[0].related_id+"</a></label> "
        }else if(kind_of == 'order' || kind_of == 'Order'){
            related_id += "<label>Order - <a class=\"orange-text\" href=\"../single-product.php?id="+complainInfo[0].related_id+"\">#"+complainInfo[0].related_id+"</a></label> "
        }



        document.getElementById("com-id").innerHTML = complainInfo[0].com_id;
        document.getElementById("com-name").innerHTML = complainInfo[0].user_id;
        document.getElementById("com-subject").innerHTML = complainInfo[0].subject;
        document.getElementById("com-msg").innerHTML = complainInfo[0].description;
        document.getElementById("kind-of").innerHTML = complainInfo[0].kind_of;
        document.getElementById("related_id").innerHTML = related_id;
        document.getElementById("sent-date").innerHTML = complainInfo[0].create_time;

    }
    //console.log(document.getElementById('view-order-modal'));
    $('#view-complaint-modal').modal('show');
}
function openUserAccountModal(jsonData) {

    if(jsonData){

        let acc_dp = "";
        let statistics ="";
        let shopperShops = "";

        let fixData = jsonData.replaceAll('|','"');
        let userInfo = JSON.parse(fixData);
        console.log(userInfo);
        if(userInfo[0].dp_img != null){
            acc_dp += "<img onerror=\"this.src='../assets/products.png'\" src=\"../uploads/user_images/"+userInfo[0].dp_img+"\" alt=\"\">";
        }else {
            acc_dp += "<img src=\"../assets/products.png\" alt=\"\">";
        }

        if (userInfo[0].acc_type === 'SHOPPER'){

            let tot_earn = "0";
            let tot_orders = "0";
            let tot_customers = "0";

            const xhr = new XMLHttpRequest();
            xhr.open('POST', '../functions/api.php', true);
            xhr.setRequestHeader("application-auth", "computershop-auth");

            const formData = new FormData();
            formData.append('userId', userInfo[0].user_id);
            formData.append('action', "get_shopper_statistics");

            xhr.onload = function () {
                if (xhr.readyState === xhr.DONE && xhr.status === 200) {
                    if (xhr.responseText) {
                        var responseObj = JSON.parse(xhr.responseText);
                        if (responseObj) {
                            if (responseObj.status === "SUCCESS") {
                                tot_earn = responseObj.totalEarn;
                                tot_orders = responseObj.totalOrder;
                                tot_customers = responseObj.totalCustomers;

                            }
                        }
                    }

                    statistics += "<div class=\"info-tab\">\n" +
                        "                                        <label for=\"acc_tot_lkr\">Totally Earned (without delivery charges)</label>\n" +
                        "                                        <p id=\"acc_tot\">Rs. "+tot_earn+"</p>\n" +
                        "                                    </div>\n" +
                        "                                    <div class=\"info-tab\">\n" +
                        "                                        <label for=\"acc_tot_order\">Totally Orders</label>\n" +
                        "                                        <p id=\"acc_tot_order\">"+tot_orders+"</p>\n" +
                        "                                    </div>\n" +
                        "                                    <div class=\"info-tab\">\n" +
                        "                                        <label for=\"acc_tot_cus\">Totally Customers</label>\n" +
                        "                                        <p id=\"acc_tot_cus\">"+tot_customers+"</p>\n" +
                        "                                    </div>\n" +
                        "                                    <div class=\"info-tab\">\n" +
                        "                                        <label for=\"acc_get_action\">Get Action</label>\n" +
                        "                                        <select class=\"t-feild\" name=\"acc_get_action\" id=\"acc_get_action\">\n" +
                        "                                            <option value=\"ACTIVE\">Active</option>\n" +
                        "                                            <option value=\"VERIFIED\">Verified</option>\n" +
                        "                                            <option value=\"BANNED\">Banned</option>\n" +
                        "                                            <option value=\"BLACK\">Black listed</option>\n" +
                        "                                        </select>\n" +
                        "                                <input type=\"hidden\" id=\"user_id\" value=\""+userInfo[0].user_id+"\">\n" +
                        "                                    </div>";

                    document.getElementById("statistics").innerHTML = statistics;
                    document.getElementById('acc_get_action').value = userInfo[0].acc_status;
                }
            };
            xhr.send(formData);

        }else {

            shopperShops = "";

            statistics += "<div class=\"info-tab\">\n" +
                "                                        <label for=\"acc_get_action\">Get Action</label>\n" +
                "                                        <select class=\"t-feild\" name=\"acc_get_action\" id=\"acc_get_action\">\n" +
                "                                            <option value=\"ACTIVE\" id=\"active-state\">Active</option>\n" +
                "                                            <option value=\"VERIFIED\" id=\"verified-state\">Verified</option>\n" +
                "                                            <option value=\"BANNED\" id=\"Banned-state\">Banned</option>\n" +
                "                                            <option value=\"BLACK\" id=\"black-state\">Black listed</option>\n" +
                "                                        </select>\n" +
                "                                        <input type=\"hidden\" id=\"user_id\" value=\""+userInfo[0].user_id+"\">\n" +
                "                                    </div>";

            document.getElementById("statistics").innerHTML = statistics;
            document.getElementById('acc_get_action').value= userInfo[0].acc_status;

        }





        document.getElementById("acc_id").innerHTML = userInfo[0].user_id;
        document.getElementById("acc_name").innerHTML = userInfo[0].first_name;
        document.getElementById("acc_fname").innerHTML = userInfo[0].full_name;
        document.getElementById("acc_email").innerHTML = userInfo[0].email;
        document.getElementById("acc_tel").innerHTML = userInfo[0].tel;
        document.getElementById("acc_nic").innerHTML = userInfo[0].nic;
        document.getElementById("acc_birthday").innerHTML = userInfo[0].birthday;
        document.getElementById("acc_gender").innerHTML = userInfo[0].gender;
        document.getElementById("acc_address").innerHTML = userInfo[0].home_address;
        document.getElementById("acc_regDate").innerHTML = userInfo[0].date_created;
        document.getElementById("acc_dp").innerHTML = acc_dp;
        // document.getElementById("shopper-shops").innerHTML = shopperShops;


    }
    //console.log(document.getElementById('view-order-modal'));
    $('#account-view-modal').modal('show');
}
function openProductModal(jsonData) {

    if(jsonData){

        let pro_dp = "";
        let inforTabs = "";
        let fixData = jsonData.replaceAll('|','"');
        fixData = fixData.replaceAll('\r\n','<br>');
        let proInfo = JSON.parse(fixData);
        console.log(proInfo);
        if(proInfo[0].image_url != null){
            pro_dp += "<img onerror=\"this.src='../assets/products.png'\" src=\"../uploads/product_images/"+proInfo[0].image_url+"\" alt=\"\">";
        }else {
            pro_dp += "<img src=\"../assets/products.png\" alt=\"\">";
        }

        let sold = "0";
        let available = "0";
        let added = "0";

        const xhr = new XMLHttpRequest();
        xhr.open('POST', '../functions/api.php', true);
        xhr.setRequestHeader("application-auth", "computershop-auth");

        const formData = new FormData();
        formData.append('proId', proInfo[0].product_id);
        formData.append('action', "get_product_statistics");

        xhr.onload = function () {
            if (xhr.readyState === xhr.DONE && xhr.status === 200) {
                if (xhr.responseText) {
                    var responseObj = JSON.parse(xhr.responseText);
                    if (responseObj) {
                        if (responseObj.status === "SUCCESS") {
                            sold = responseObj.sold;
                            available = responseObj.available;
                            if(sold != null) {
                                added = parseInt(sold) + parseInt(available);
                            }else{
                                sold = "0";
                                added = available
                            }
                        }
                    }
                }


                inforTabs += "<div class=\"info-tab\">\n" +
                    "                                    <label for=\"pro_added_stock\">Added Stock</label>\n" +
                    "                                    <p id=\"pro_added_stock\">"+added+"</p>\n" +
                    "                                </div>\n" +
                    "                                <div class=\"info-tab\">\n" +
                    "                                    <label for=\"pro_sold_stock\">Sold Stock</label>\n" +
                    "                                    <p id=\"pro_sold_stock\">"+sold+"</p>\n" +
                    "                                </div>\n" +
                    "                                <div class=\"info-tab\">\n" +
                    "                                    <label for=\"pro_status\">Available Stock</label>\n" +
                    "                                    <p id=\"pro_status\">"+available+"</p>\n" +
                    "                                </div>\n" +
                    "                                <div class=\"info-tab\">\n" +
                    "                                    <label for=\"pro_get_action\">Get Action</label>\n" +
                    "                                    <select class=\"t-feild\" name=\"pro_get_action\" id=\"pro_get_action\">\n" +
                    "                                        <option value=\"ACTIVE\">Active</option>\n" +
                    "                                        <option value=\"BANNED\">Banned</option>\n" +
                    "                                        <option value=\"BLACK\">Black listed</option>\n" +
                    "                                        <option value=\"DRAFT\">Draft</option>\n" +
                    "                                    </select>\n" +
                    "                                  <input type=\"hidden\" id=\"select_pro_id\" value=\"" + proInfo[0].product_id + "\">\n" +
                    "                                </div>";

                document.getElementById("dataTabs").innerHTML = inforTabs;
                document.getElementById('pro_get_action').value = proInfo[0].status;
            }
        };
        xhr.send(formData);

        document.getElementById("pro_id").innerHTML = proInfo[0].product_id;
        document.getElementById("pro_name").innerHTML = proInfo[0].product_name;
        document.getElementById("pro_description").innerHTML = proInfo[0].description;
        document.getElementById("pro_unit_price").innerHTML = proInfo[0].per_price;
        document.getElementById("pro_cat").innerHTML = proInfo[0].product_category_cat_id;
        document.getElementById("pro_added_date").innerHTML = proInfo[0].create_time;
        document.getElementById("pro_shop_id").innerHTML = proInfo[0].shop_shop_id;

        document.getElementById("pro_img").innerHTML = pro_dp;

    }
    $('#view-product-modal').modal('show');
}
function openShopModal(jsonData) {

    if(jsonData){

        let shop_dp = "";
        let inforTabs = "";
        let address = "";
        let shopName = "";

        let fixData = jsonData.replaceAll('|','"');
        fixData = fixData.replaceAll('\r\n','<br>');
        let shopInfo = JSON.parse(fixData);
        console.log(shopInfo);
        if(shopInfo[0].dp_logo != null){
            shop_dp += "<img onerror=\"this.src='../assets/products.png'\" src=\"../uploads/shop_images/"+shopInfo[0].dp_logo+"\" alt=\"\">";
        }else {
            shop_dp += "<img src=\"../assets/products.png\" alt=\"\">";
        }

        address +=""+shopInfo[0].address+"<br>"+shopInfo[0].city+"<br>"+shopInfo[0].zip_code+" ";

        let tot_earn = "0";
        let tot_orders = "0";
        let tot_customers = "0";

        const xhr = new XMLHttpRequest();
        xhr.open('POST', '../functions/api.php', true);
        xhr.setRequestHeader("application-auth", "computershop-auth");

        const formData = new FormData();
        formData.append('shopId', shopInfo[0].shop_id);
        formData.append('action', "get_shop_statistics");

        xhr.onload = function () {
            if (xhr.readyState === xhr.DONE && xhr.status === 200) {
                if (xhr.responseText) {
                    var responseObj = JSON.parse(xhr.responseText);
                    if (responseObj) {
                        if (responseObj.status === "SUCCESS") {
                            tot_earn = responseObj.totalEarn;
                            tot_orders = responseObj.totalOrder;
                            tot_customers = responseObj.totalCustomers;
console.log(responseObj);
                        }
                    }
                }
                inforTabs += "<div class=\"info-tab\">\n" +
                    "                                    <label for=\"shop_tot_earn\">Totally Earned (Without delivery charges)</label>\n" +
                    "                                    <p id=\"shop_tot_earn\">Rs. "+tot_earn+"</p>\n" +
                    "                                </div>\n" +
                    "                                <div class=\"info-tab\">\n" +
                    "                                    <label for=\"shop_tot_orders\">Total Orders</label>\n" +
                    "                                    <p id=\"shop_tot_orders\">"+tot_orders+"</p>\n" +
                    "                                </div>\n" +
                    "                                <div class=\"info-tab\">\n" +
                    "                                    <label for=\"shop_tot_cus\">Total Customers</label>\n" +
                    "                                    <p id=\"shop_tot_cus\">"+tot_customers+"</p>\n" +
                    "                                </div>\n" +
                    "                                <div class=\"info-tab\" id=\"shop_get_action_sec\">\n" +
                    "                                    <label for=\"shop_get_action\">Get Action</label>\n" +
                    "                                    <select class=\"t-feild\" name=\"shop_get_action\" id=\"shop_get_action\">\n" +
                    "                                        <option value=\"ACTIVE\">Active</option>\n" +
                    "                                        <option value=\"VERIFIED\">Verified</option>\n" +
                    "                                        <option value=\"BANNED\">Banned</option>\n" +
                    "                                        <option value=\"BLACK\">Black listed</option>\n" +
                    "                                        <option value=\"DELETE\">Delete</option>\n" +
                    "                                    </select>\n" +
                    "                                  <input type=\"hidden\" id=\"select_shop_id\" value=\"" + shopInfo[0].shop_id + "\">\n" +
                    "                                </div>";

                document.getElementById("dataTabs").innerHTML = inforTabs;
                document.getElementById('shop_get_action').value = shopInfo[0].shop_status;
            }
        };
        xhr.send(formData);


        shopName +="<label for=\"shop_shopper\">Shopper Account</label>\n" +
            "                                    <p id=\"shop_Shopper\">"+shopInfo[0].first_name+" "+shopInfo[0].last_name+"</p>";


        document.getElementById("shop_id").innerHTML = shopInfo[0].shop_id;
        document.getElementById("shop_name").innerHTML = shopInfo[0].shop_name;
        document.getElementById("shop_nob").innerHTML = shopInfo[0].nb_description;
        document.getElementById("shop_email").innerHTML = shopInfo[0].email;
        document.getElementById("shop_tel").innerHTML = shopInfo[0].tel;
        document.getElementById("shop_reg").innerHTML = shopInfo[0].create_time;
        document.getElementById("shop_roc").innerHTML = shopInfo[0].roc_number;
        document.getElementById("shop_Shopper").innerHTML = shopName;
        document.getElementById("shop_address").innerHTML = address;
        // document.getElementById("acc_regDate").innerHTML = proInfo[0].date_created;
        document.getElementById("shop_img").innerHTML = shop_dp;
        // document.getElementById("shopper-shops").innerHTML = shopperShops;


    }
    //console.log(document.getElementById('view-order-modal'));
    $('#view-shop-modal').modal('show');
}

function accountStatusUpdate() {
    let action = document.getElementById('acc_get_action');
    let userId = document.getElementById('user_id');

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../functions/api.php', true);
    xhr.setRequestHeader("application-auth", "computershop-auth");

    const formData = new FormData();
    formData.append('accAction', action.value);
    formData.append('userId', userId.value);
    formData.append('action', "account_status_update");

    xhr.onload = function () {
        if (xhr.readyState === xhr.DONE && xhr.status === 200) {
            if (xhr.responseText) {
                var responseObj = JSON.parse(xhr.responseText);
                if (responseObj) {
                    if (responseObj.status === "SUCCESS") {
                        location.reload();
                    }else{
                        alert(responseObj.msg);
                    }
                }
            }
        }
    };
    xhr.send(formData);

}

function shopStatusUpdate() {
    let action = document.getElementById('shop_get_action');
    let shopId = document.getElementById('select_shop_id');

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../functions/api.php', true);
    xhr.setRequestHeader("application-auth", "computershop-auth");

    const formData = new FormData();
    formData.append('accAction', action.value);
    formData.append('shopId', shopId.value);
    formData.append('action', "shop_status_update");

    xhr.onload = function () {
        if (xhr.readyState === xhr.DONE && xhr.status === 200) {
            if (xhr.responseText) {
                var responseObj = JSON.parse(xhr.responseText);
                if (responseObj) {
                    if (responseObj.status === "SUCCESS") {
                        location.reload();
                    }else{
                        alert(responseObj.msg);
                    }
                }
            }
        }
    };
    xhr.send(formData);

}

function productStatusUpdate() {
    let action = document.getElementById('pro_get_action');
    let productId = document.getElementById('select_pro_id');

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../functions/api.php', true);
    xhr.setRequestHeader("application-auth", "computershop-auth");

    const formData = new FormData();
    formData.append('accAction', action.value);
    formData.append('proId', productId.value);
    formData.append('action', "product_status_update");

    xhr.onload = function () {
        if (xhr.readyState === xhr.DONE && xhr.status === 200) {
            if (xhr.responseText) {
                var responseObj = JSON.parse(xhr.responseText);
                if (responseObj) {
                    if (responseObj.status === "SUCCESS") {
                        location.reload();
                    }else{
                        alert(responseObj.msg);
                    }
                }
            }
        }
    };
    xhr.send(formData);

}