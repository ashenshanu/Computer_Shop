<div class="modal fade modal-box update-info-modal" id="update-shop-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header " style="border: transparent;">
                <img src="../assets/icons/previous-arrow.svg" class="back-button" onclick="$('#shop-settings-modal').modal('show');" data-bs-dismiss="modal">

                <div class="title" style="width:100%; display:flex; flex-direction:row; justify-content:center;">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Account Details</h1>
                </div>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="images">
                    <div class="image-upload">

                        <img id="update-shop-img-preview" style="background-image: url('../uploads/shop_images/shop_dp/<?php echo $shop['dp_logo']; ?>');background-size: cover;background-repeat: no-repeat;">
                        <i class="bi bi-image"></i>
                        <input type="file" name="update-shop-dp" id="update-shop-dp">
                    </div>
                    <div class="banner-image-upload">

                        <img id="update-banner-img-preview" style="border-radius:0px;background-image: url('../uploads/shop_images/shop_banner/<?php echo $shop['dp_banner']; ?>');background-size: cover;background-repeat: no-repeat;">
                        <i class="bi bi-image"></i>
                        <input type="file" name="update-banner-dp" id="update-banner-dp">
                    </div>
                </div>
                <div class="feilds-sec">
                    <h6>Shop Informations</h6>
                    <input type="text" class="t-feild" name="update-shop_name" id="update-shop_name" placeholder="Shop Name" value="<?php echo $shop['shop_name'] ?>">
                    <textarea type="text" class="t-feild" name="update-description" id="update-description" placeholder="Nature of Business"><?php echo $shop['nb_description'] ?></textarea>
                    <input type="text" class="t-feild" name="update-email" id="update-email" placeholder="E-mail Address" value="<?php echo $shop['email'] ?>" disabled>

                    <span>
                        <input type="text" class="t-feild" name="update-roc" id="update-roc" placeholder="ROC Number" value="<?php echo $shop['roc_number'] ?>">
                        <input type="tel" class="t-feild" name="update-shop-contact" id="update-shop-contact" placeholder="Contact Number" value="<?php echo $shop['tel'] ?>">
                    </span>
                </div>

                <div class="feilds-sec">
                    <h6>Shop Address</h6>
                    <input type="text" class="t-feild" name="update-address" id="update-address" placeholder="Street Address" value="<?php echo $shop['address'] ?>">
                    <span>
                        <input type="text" class="t-feild" name="update-city" id="update-city" placeholder="City" value="<?php echo $shop['city'] ?>">
                        <input type="text" class="t-feild" name="update-zipCode" id="update-zipCode" placeholder="Zip Code" value="<?php echo $shop['zip_code'] ?>">
                    </span>
                </div>
                <input type="button" class="btn primary" name="confirmInfo" id="confirmInfo" onclick="updateShop(<?php echo $shop['shop_id'] ?>)" value="Update">
            </div>

        </div>
    </div>
</div>
<script>
    document.getElementById('update-shop-dp').addEventListener('change', function(ev) {

        if (ev.target.files && ev.target.files[0]) {
            let reader = new FileReader();
            reader.onload = function(e) {
                console.log(e.target.result);
                document.getElementById('update-shop-img-preview').setAttribute('src', e.target.result);
            };

            reader.readAsDataURL(ev.target.files[0]);
        }
    });
    document.getElementById('update-banner-dp').addEventListener('change', function(ev) {

if (ev.target.files && ev.target.files[0]) {
    let reader = new FileReader();
    reader.onload = function(e) {
        console.log(e.target.result);
        document.getElementById('update-banner-img-preview').setAttribute('src', e.target.result);
    };

    reader.readAsDataURL(ev.target.files[0]);
}
});
</script>