<div class="modal fade modal-box view-type-modal complaint-modal" id="send-complaint-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container">

                <div class="modal-header">
                            
                            <div class="modal-title">
                                <h2>Complaint</h2>
                            </div>
                        
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    
                    <?php
//                    var_dump($loggedUser);
                    if ($loggedUser) {?>
                    <div class="com-info">
                        <div class="info ">
                            <label for="shop-name">Order ID</label>
                            <p>#<span id="complaint-order-id" class="complaint-order-id">-</span></p>
                        </div>
                        <div class="info ">
                            <label for="shop-id">Order Date</label>
                            <p id="order-date"><span id="complaint-order-date">-</span></p>
                        </div>

                    </div>
                    <div class="com-sec">
                        <input type="text" class="t-feild" name="com_subject" id="com_subject" placeholder="Complaint Subject" onkeyup="dataCheck()" required>
                        <textarea class="t-feild" style="height: 100px;padding-top:5px;" name="com_msg" id="com_msg" placeholder="Describe your complaint " onkeyup="dataCheck()" required></textarea>
                    </div>
                    <div class="btn-sec" id="sentComplaintBtn">

                    </div>
                    <?php } ?>
                </div>




            </div>

        </div>
    </div>
</div>
<script>

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
</script>