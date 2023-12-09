<div class="modal fade modal-box" id="edit-user-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container step-1" id="step-1">
                <div class="header-bar">
                    <img src="../assets/icons/previous-arrow.svg" class="back-button" data-bs-dismiss="modal" aria-label="Close">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Your Information</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="feilds-sec">
                    <h6>Shop Informations</h6>
                    <input type="text" class="t-feild" name="shopName" id="shopName" placeholder="Shop Name">
                    <input type="text" class="t-feild" name="rocNumber" id="rocNumber" placeholder="Company Registration Number (Optional)">
                    <textarea class="t-feild form_data" name="busiNature" id="busiNature" placeholder="Nature of Business (Describe your shop.)"></textarea>
                </div>

                <div class="feilds-sec">
                    <h6>Contact Details</h6>
                    <span>
                        <input type="text" class="t-feild" name="shopEmail" id="shopEmail" value="<?php echo $loggedUser["email"] ?>" placeholder="Shop Email">
                        <input type="text" class="t-feild" name="shopTel" id="shopTel" value="<?php echo $loggedUser["tel"] ?>" placeholder="Shop Telephone">
                    </span>
                </div>

                <div class="feilds-sec">
                    <h6>Shop Address</h6>
                    <input type="text" class="t-feild" name="shopAddress" id="shopAddress" placeholder="Street Address">
                    <span>
                        <input type="text" class="t-feild" name="shopCity" id="shopCity" placeholder="City">
                        <input type="text" class="t-feild" name="shopZipCode" id="shopZipCode" placeholder="Zip Code">
                    </span>
                </div>
                <input type="button" class="btn primary" name="confirmInfo" id="confirmInfo" onclick="step1()" value="Continue">
            </div>

        </div>

    </div>
</div>
</div>

