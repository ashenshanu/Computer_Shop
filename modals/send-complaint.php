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
                    
                    <?php  if ($isUserLogged) {?>
                    <div class="com-info">
                        <div class="info ">
                            <label for="shop-name">Shop Name</label>
                            <p id="shop-name"><?php echo $shopData["shop_name"];?></p>
                        </div>
                        <div class="info ">
                            <label for="shop-id">Shop ID</label>
                            <p id="shop-id">#<?php echo $shopID;?></p>
                        </div>

                    </div>
                    <div class="com-sec">
                        <input type="text" class="t-feild" name="com_subject" id="com_subject" placeholder="Complaint Subject" onkeyup="dataCheck()" required>
                        <textarea class="t-feild" style="height: 100px;padding-top:5px;" name="com_msg" id="com_msg" placeholder="Describe your complaint " onkeyup="dataCheck()" required></textarea>
                    </div>
                    <div class="btn-sec">
                        <input type="button" class="btn primary" id="send-btn" value="Submit"  onclick="sendComplain('Shop',<?php echo $shopID;?>,<?php echo  $_SESSION["user"]['user_id']?>)" disabled>
                    </div>
                    <?php } else{?>
                        <h6>Please, sign in first.</h6>
                        <span data-bs-dismiss="modal" aria-label="Close" style="width: 100%;">
                            <input type="button" class="primary btn" style="width: 100%;" value="Sign in" data-bs-toggle="offcanvas" data-bs-target="#sign-in-offcanvasRight" aria-controls="sign-in-offcanvasRight" >
                        </span>

                    <?php }?>
                </div>




            </div>

        </div>
    </div>
</div>
