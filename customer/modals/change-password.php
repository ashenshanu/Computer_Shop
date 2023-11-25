<div class="modal fade modal-box update-info-modal" id="change-password-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="width: 400px">
            <div class="modal-header " style="border: transparent;">
                <img src="../assets/icons/previous-arrow.svg" class="back-button" onclick="$('#customer-settings-modal').modal('show');" data-bs-dismiss="modal">

                <div class="title" style="width:100%; display:flex; flex-direction:row; justify-content:center;">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Change Password</h1>
                </div>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body" style="width: 100%">
                
                <div class="feilds-sec">
                    
                    <input type="text" class="t-feild" name="current-password" id="current-password" placeholder="Current Password" >
                    <input type="text" class="t-feild" name="new-password" id="new-password" onkeyup="checkNewPasswordMatch()" placeholder="New Password" >
                    <input type="text" class="t-feild" name="confirm-new-password" id="confirm-new-password" onkeyup="checkNewPasswordMatch()" placeholder="Confirm New Password" >
                   <div id="divCheckPasswordMatch"></div>
                </div>
                <input type="button" class="btn primary" name="update-password" id="update-password" onclick="" value="Update">
            </div>

        </div>
    </div>
</div>
<script>
   function checkNewPasswordMatch() {
        var password = document.getElementById("new-password").value;
        var confirmPassword = document.getElementById("confirm-new-password").value;
        if (password != confirmPassword) {
            document.getElementById("divCheckPasswordMatch").innerHTML = "Passwords do not match!";
            document.getElementById("update-password").disabled = true;
        } else {
            document.getElementById("divCheckPasswordMatch").innerHTML = "Passwords match.";
            document.getElementById("update-password").disabled = false;
        }
    }
</script>