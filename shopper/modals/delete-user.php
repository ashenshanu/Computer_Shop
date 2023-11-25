<div class="modal fade modal-box mini-modal" id="delete-user-confirmation-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container">
                    <div class="title">
                        <h3>Confirm Account Deletion</h3>
                    </div>
                    <p>Are you sure you want to delete your account permanently ?</p>
                    <div class="btn-sec">
                        <button type="button" class="btn primary" onclick="deleteUser(<?php echo $loggedUser['user_id']?>)">Yes, of Course</button>
                        <button type="button" class="btn secondary" onclick="$('#user-settings-modal').modal('show');" data-bs-dismiss="modal">No, Don’t</button>
                    </div>
                </div>



            </div>

        </div>
    </div>
</div>