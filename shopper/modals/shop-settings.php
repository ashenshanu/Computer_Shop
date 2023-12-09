<div class="modal fade modal-box mini-modal setting-modal" id="shop-settings-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header " style="border: transparent;">
                <div class="title" style="width:100%; display:flex; flex-direction:row; justify-content:center;">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Account Settings</h1>
                </div>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="setting-options">
                        <div class="opt-btn" onclick="$('#update-shop-modal').modal('show');" data-bs-dismiss="modal">
                            <p>Edit & update Shop informations</p>
                            <i class="bi bi-chevron-right"></i>
                        </div>
                        <div class="opt-btn" onclick="$('#delete-shop-confirmation-modal').modal('show');" data-bs-dismiss="modal">
                            <p>Delete Shop</p>
                            <i class="bi bi-chevron-right"></i>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>