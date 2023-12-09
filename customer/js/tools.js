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

function openCustomerOrderModal(jsonData) {

    if(jsonData) {

        let custName = "";
        let address = "";
        let mobile = "";
        let totalBill = "";
        let custHtml = "";

        let fixData = jsonData.replaceAll('|', '"');
        fixData = fixData.replaceAll('\r\n','<br>');
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
                        custHtml += "<div class=\"order-card white-bd-card\">\n" +
                            "                                <p id=\"order-id\">"+customerRow.order_number+"</p>\n" +
                            "                                <p id=\"order-date\">"+customerRow.create_time+"</p>\n" +
                            "                                <p id=\"order-price\">Rs."+customerRow.cust_total+"</p>\n" +
                            "                                <p id=\"order-status\">"+customerRow.de_status+"</p>\n" +
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

function openComplaintFormModal(orderId,orderDate,userId){

    let btn = "<input type=\"button\" class=\"btn primary\" id=\"send-btn\" value=\"Submit\" onclick=\"sendCustomerComplaint('Order',"+orderId+","+userId+")\" disabled>";
    document.getElementById('complaint-order-id').innerHTML = orderId;
    document.getElementById('complaint-order-date').innerHTML = orderDate;
    document.getElementById('sentComplaintBtn').innerHTML = btn;

    $('#send-complaint-modal').modal('show');
}

function openOrderItemModal(jsonData,status,deCode,orderNumber,total,msg,orderId,orderrDate,userId) {

    if(jsonData){

        let totalBill = "";
        let itemListHtml = "";
        let statusActionHtml = "";
        let shopName = "";

        let fixData = jsonData.replaceAll('|','"');
        fixData = fixData.replaceAll('\r\n','<br>');
        let productList = JSON.parse(fixData);
        // console.log(productList);
        if(productList){
         if(productList.length > 0){
            shopName = productList[0].full_name;
            totalBill = 0.00;


            if(status === "PROCESSING"){
                statusActionHtml = "<button type=\"button\" class=\"btn primary\" onclick=\"updateStatus("+orderId+",'CANCEL')\">Cancel Order</button>";
            }else{
                statusActionHtml = "<p>You can report him about that order after 7 days <span class=\"orange-text\" onclick=\"openComplaintFormModal('"+orderId+"','"+orderrDate+"','"+userId+"')\">Click here to report</span></p>";
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
                        "                                        <label for=\"\">Unit - Rs. <span>"+productRow.per_price+"</span></label>\n" +
                        "                                        <label for=\"\">Shop <span>"+productRow.shop_name+"</span></label>\n" +
                        "                                    </div>\n" +
                        "                                </div>\n" +
                        "                                <div class=\"pro-count\">\n" +
                        "                                    <div class=\"qyt-count\">\n" +
                        "                                        <label for=\"quantity\">Quantity</label>\n" +
                        "                                        <h5 id=\"quantity\">"+productRow.quntity+"</h5>\n" +
                        "\n" +
                        "                                    </div>\n" +
                        "                                    <div class=\"price\">\n" +
                        "                                        <label for=\"total-price\">Rs. </label>\n" +
                        "                                        <h5 id=\"total-price\">"+productRow.sub_total.toFixed(2)+"</h5>\n" +
                        "\n" +
                        "                                    </div>\n" +
                        "\n" +
                        "                                </div>\n" +
                        "                            </div>"
                }
            }


totalBill = totalBill.toFixed(2);
             document.getElementById("shop-order-id").innerHTML = orderNumber;
             document.getElementById("order-status").innerHTML = status;
             document.getElementById("customer-msg").innerHTML = msg;
             document.getElementById("delivary-code").innerHTML = deCode;
             document.getElementById("bill").innerHTML = totalBill;
            document.getElementById('status_change_btn').innerHTML = statusActionHtml;
            document.getElementById("item-list-container").innerHTML = itemListHtml;
         }
        }
    }
    //console.log(document.getElementById('view-order-modal'));
    $('#view-cus-order-modal').modal('show');
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
function openComplaintModal(jsonData) {

    if(jsonData){

        let related_id = "";

        let fixData = jsonData.replaceAll('|','"');
        fixData = fixData.replaceAll('\r\n','<br>');
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
        document.getElementById("com-subject").innerHTML = complainInfo[0].subject;
        document.getElementById("com-msg").innerHTML = complainInfo[0].description;
        document.getElementById("kind-of").innerHTML = complainInfo[0].kind_of;
        document.getElementById("related_id").innerHTML = related_id;
        document.getElementById("sent-date").innerHTML = complainInfo[0].create_time;

    }
    //console.log(document.getElementById('view-order-modal'));
    $('#view-complaint-modal').modal('show');
}

function sendCustomerComplaint(kindof,relativeId,userId) {
    let subject = document.getElementById("com_subject").value;
    let msg = document.getElementById("com_msg").value;

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