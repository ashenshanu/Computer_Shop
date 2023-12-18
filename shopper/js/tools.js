// const myModal = document.getElementById('add-product-modal');
// const myInput = document.getElementById('add-product');
//
// myModal.addEventListener('shown.bs.modal', () => {
//     myInput.focus()
// });

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



document.getElementById('e-product-img').addEventListener('change' ,function (ev) {
    console.log("AWAAAAAAAAAAAAAAAAAAA");
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


    statusActive.checked = false;
    statusDarft.checked = false;

    productIDInput.value = productId;
    name.value = productName;
    qty.value = quantity;
    price.value = perPrice;
    productCat.value = categoryID;

    let fixedDesc = desc.replaceAll("^","\"");
    fixedDesc = fixedDesc.replaceAll("=",",");
    fixedDesc = fixedDesc.replaceAll("|","'");
    fixedDesc = fixedDesc.replaceAll("<br>","\r\n");

    description.value = fixedDesc;

    if(status === "ACTIVE"){
        statusActive.checked = true;
    }else{
        statusDarft.checked = true;
    }

    productImage.setAttribute('src','../uploads/product_images/'+imageURL);


    $('#edit-product-modal').modal('show');
}



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

    let fixedDesc = description.value.replaceAll(/(?:\r\n|\r|\n)/g,"<br>");
    fixedDesc = fixedDesc.replaceAll(",","=");
    fixedDesc = fixedDesc.replaceAll("'","|");
    fixedDesc = fixedDesc.replaceAll("\"","^");


    sendData.append('productID',productID.value);
    sendData.append('name',name.value);
    sendData.append('qty',qty.value);
    sendData.append('price',price.value);
    sendData.append('categoryID',productCat.value);
    sendData.append('desc',fixedDesc);
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

function openDeleteConfirmation(productID,productName) {

    console.log("-------------------"+productID);

    document.getElementById('del-productID').value = productID;
    document.getElementById('del-pro-name').innerHTML = productName;
    $('#delete-confirmation-modal').modal('show');
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

function openCustomerOrderModal(jsonData,shid) {

    if(jsonData) {

        let custName = "";
        let address = "";
        let mobile = "";
        let totalBill = "";
        let custHtml = "";

        let fixData = jsonData.replaceAll('|', '"');
        // fixData = fixData.replaceAll('\r\n','<br>');
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
                            statusActionHtml = "<p id=\"order-status\" class=\"status-tag \" style=\" width: 20%; text-align: center; color:#006CCF; border:#006CCF;\">PROCESSING</button>";
                        }else if(customerRow.de_status === "READY"){
                            statusActionHtml = "<p id=\"order-status\" class=\"status-tag \" style=\" width: 20%; text-align: center; color:#FF9C00; border:#FF9C00;\">READY</button>";
                        }else if(customerRow.de_status === "ON DELIVERY"){
                            statusActionHtml = "<p id=\"order-status\" class=\"status-tag \" style=\" width: 20%; text-align: center; color:#882FFA; border:#882FFA;\">ON DELIVERY</p>";
                        }else if(customerRow.de_status === "DELIVERED"){
                            statusActionHtml = "<p id=\"order-status\" class=\"status-tag \" style=\" width: 20%; text-align: center; color:#28D764; border:#28D764;\">DELIVERED</h4>";
                        }else if(customerRow.de_status === "NOT DELIVERED"){
                            statusActionHtml = "<p id=\"order-status\" class=\"status-tag \" style=\" width: 20%; text-align: center; color:#DD3A3A; border:#DD3A3A;\">Delivery Failed</h4>";
                        }
        
                        custHtml += "<div class=\"order-card white-bd-card\">\n" +
                            "                                <p style='width: 20%; text-align: center' id=\"order-id\">"+customerRow.order_number+"</p>\n" +
                            "                                <p style='width: 20%; text-align: center' id=\"order-date\">"+customerRow.create_time+"</p>\n" +
                            "                                <p style='width: 20%; text-align: center' id=\"order-price\">Rs."+customerRow.cust_total+"</p>\n" +
                            "                                "+statusActionHtml+"\n" +
                            "                                <p style='width: 20%; text-align: center' class='color2-btn' id=\"order-view\"></a><i class=\"bi bi-printer\" onclick=\"window.open('../templates/invoice.php?oid="+customerRow.order_id+"&shid="+shid+"')\"></i></p>\n" +
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
        let deNote = "";
        let itemListHtml = "";
        let statusActionHtml = "";


        let fixData = jsonData.replaceAll('|','"');
        fixData = fixData.replaceAll('\r\n','<br>');
        let productList = JSON.parse(fixData);
        console.log(productList);
        if(productList){
         if(productList.length > 0){
            custName = productList[0].full_name;
            address = productList[0].de_address+" "+productList[0].de_city;
            mobile = productList[0].de_tel;
            deNote = productList[0].de_note;
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
                        "                                    <img src=\"./../assets/product.jpg\" alt=\"\">\n" +
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
            document.getElementById("customer-msg").innerHTML = deNote;
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
                    }else{
                        alert(responseObj.msg);
                    }
                }
            }
        }
    };
    xhr.send(formData);
}
function updateShop(shopId) {


    let dp_image = document.getElementById('update-shop-dp');
    let banner_image = document.getElementById('update-banner-dp');
    let shopName = document.getElementById('update-shop_name');
    let description = document.getElementById('update-description');
    let roc = document.getElementById('update-roc');
    let contact = document.getElementById('update-shop-contact');
    let address = document.getElementById('update-address');
    let city = document.getElementById('update-city');
    let zip = document.getElementById('update-zipCode');

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../functions/api.php', true);
    xhr.setRequestHeader("application-auth", "computershop-auth");

    const formData = new FormData();
    formData.append('dp_image', dp_image.files[0]);
    formData.append('banner_image', banner_image.files[0]);
    formData.append('shopName', shopName.value);
    formData.append('description', description.value);
    formData.append('roc', roc.value);
    formData.append('contact', contact.value);
    formData.append('address', address.value);
    formData.append('city', city.value);
    formData.append('zip', zip.value);
    formData.append('shopId', shopId);
    formData.append('action', "update_shop");

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

function deleteShop(shopId) {

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../functions/api.php', true);
    xhr.setRequestHeader("application-auth", "computershop-auth");

    const formData = new FormData();
    formData.append('shopId', shopId);
    formData.append('action', "delete_shop");

    xhr.onload = function () {
        if (xhr.readyState === xhr.DONE && xhr.status === 200) {
            if (xhr.responseText) {
                var responseObj = JSON.parse(xhr.responseText);
                if (responseObj) {
                    if (responseObj.status === "SUCCESS") {
                        alert(responseObj.msg);
                        location.href='./admin-shopper.php';
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