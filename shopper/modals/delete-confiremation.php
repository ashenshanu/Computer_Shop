<div class="modal fade modal-box mini-modal" id="delete-confirmation-modal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container">
                    <div class="title">
                        <h3>Confirm Delete</h3>
                    </div>
                    <p>Are you sure you want to Delete this product?<br>
                    Product Name: <span id="del-pro-name"></span></p>
                    <div class="btn-sec">
                        <input type="hidden" id="del-productID" value="">
                        <button type="button" class="btn primary" onclick="deleteProduct()">Yes,Delete</button>
                        <button type="button" class="btn secondary" data-bs-dismiss="modal">No,Cancel</button>
                    </div>
                </div>



            </div>

        </div>
    </div>
</div>