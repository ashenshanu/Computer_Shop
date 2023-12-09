<div class="modal fade modal-box update-info-modal" id="update-user-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header " style="border: transparent;">
                <img src="../assets/icons/previous-arrow.svg" class="back-button" onclick="$('#user-settings-modal').modal('show');" data-bs-dismiss="modal">

                <div class="title" style="width:100%; display:flex; flex-direction:row; justify-content:center;">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Account Details</h1>
                </div>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="image-upload">

                <img id="update-img-preview" style="background-image: url('../uploads/user_images/<?php echo $user[0]['dp_img']?>');background-repeat: no-repeat;background-size: cover;">
                <i class="bi bi-image"></i>
                    <input type="file" name="update-dp" id="update-dp">
                </div>
                <div class="feilds-sec">
                    <h6>Your Informations</h6>
                    <span>
                        <input type="text" class="t-feild" name="update-firstName" id="update-firstName" placeholder="First Name" value="<?php echo $user[0]['first_name']?>">
                        <input type="text" class="t-feild" name="update-lastName" id="update-lastName" placeholder="Last Name" value="<?php echo $user[0]['last_name']?>">
                    </span>
                    <input type="text" class="t-feild" name="update-fullName" id="update-fullName" placeholder="Full Name" value="<?php echo $user[0]['full_name']?>">
                    <span>
                        <input type="date" pattern="\d{2}-\d{2}-\d{4}" class="t-feild tf2" name="birthday" id="birthday" placeholder="Birthday(DD/MM/YYYY)" value="<?php echo $user[0]['birthday']?>">
                        <select class="t-feild" name="update-gender" id="update-gender" sele >
                            <option value="">Gender</option>
                            <option value="male"<?php 
                            if($user[0]['gender']=="male"){
                                echo"selected";
                            }?>>Male</option>
                            <option value="female"<?php 
                            if($user[0]['gender']=="female"){
                                echo"selected";
                            }?>>female</option>
                        </select>
                    </span>
                    <span>
                        <input type="text" class="t-feild" name="update-nicNumber" id="update-nicNumber" placeholder="NIC Number" value="<?php echo $user[0]['nic']?>">
                        <input type="tel" class="t-feild" name="update-contactNumber" id="update-contactNumber" placeholder="Mobile Number" value="<?php echo $user[0]['tel']?>">
                    </span>
                </div>

                <div class="feilds-sec">
                    <h6>Home Address</h6>
                    <input type="text" class="t-feild" name="update-address" id="update-address" placeholder="Street Address" value="<?php echo $user[0]['home_address']?>">
                    <span>
                        <input type="text" class="t-feild" name="update-city" id="update-city" placeholder="City" value="<?php echo $user[0]['home_city']?>">
                        <input type="text" class="t-feild" name="update-zipCode" id="update-zipCode" placeholder="Zip Code" value="<?php echo $user[0]['zip_code']?>">
                    </span>
                </div>
                <input type="button" class="btn primary" name="confirmInfo" id="confirmInfo" onclick="updateUser(<?php echo $loggedUser['user_id']?>)" value="Update">
            </div>

        </div>
    </div>
</div>
<script>
    document.getElementById('update-dp').addEventListener('change', function (ev) {

if (ev.target.files && ev.target.files[0]) {
    let reader = new FileReader();
    reader.onload = function (e) {
        console.log(e.target.result);
        document.getElementById('update-img-preview').setAttribute('src',e.target.result);
    };

    reader.readAsDataURL(ev.target.files[0]);
}
});
</script>