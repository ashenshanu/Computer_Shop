<div class="modal fade modal-box mini-modal" id="delete-shop-confirmation-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container">
                    <div class="title">
                        <h3>Confirm Shop Deletion</h3>
                    </div>
                    <p>Are you sure you want to delete your shop permanently ?</p>
                    <div class="btn-sec">
                        <button type="button" class="btn primary" onclick="deleteShop(<?php echo $shopData["shop_id"]?>)">Yes, of Course</button>
                        <button type="button" class="btn secondary" onclick="$('#delete-account-confirmation').modal('show');" data-bs-dismiss="modal">No, Don’t</button>
                    </div>
                </div>



            </div>

        </div>
    </div>
</div>