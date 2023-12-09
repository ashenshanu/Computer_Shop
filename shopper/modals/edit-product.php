
<div class="modal fade modal-box" id="edit-product-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Product</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="col-4">
                        <div class="img-upload">
                            <img src="" id="e-image-preview">
                            <input type="file" name="" id="e-product-img">
                            <input type="hidden" id="isImageChanged" value="0">
                            <input type="hidden" id="e-product_id" value="">
                        </div>
                        <input type="number" class="t-feild form_data" name="quantity" id="e-quantity" placeholder="Quantity">
                        <input type="number" class="t-feild form_data" name="price" id="e-per-price" placeholder="Per Price">
                    </div>
                    <div class="col-8">
                        <input type="text" class="t-feild form_data" name="product-name" id="e-product-name" placeholder="Product Name">
                        <select class="t-feild form_data" name="" id="e-product-cat" aria-placeholder="Product Category">
                            <option value="-1">-Select Category-</option>
                            <?php
                                if($categoryList != null){
                                    for ($cou = 0; $cou < count($categoryList); $cou++) {
                            ?>
                            <option value="<?php echo $categoryList[$cou][0]?>"><?php echo $categoryList[$cou][1]?></option>
                            <?php }
                                    } ?>
                        </select>
                        <textarea class="t-feild form_data" name="description" id="e-description" placeholder="Product  Description"></textarea>
                    </div>
                </div>

                <div class="bottom container">
                    <div class="col-4">
                        <input type="radio" name="e-is-active" value="ACTIVE" id="e-active">
                        <label for="">Active</label>
                        <input type="radio" name="e-is-active" value="DRAFT" id="e-draft">
                        <label for="">Draft</label>
                    </div>
                    <div class="col-8">
                        <div class="btn delete" id="product-delete" id="delete-confirmation" data-bs-toggle="modal" data-bs-target="#delete-confirmation-modal" data-bs-dismiss="modal" aria-label="Close">Delete</div>
                        <button type="button" class="btn primary" onclick="updateProduct()">Update</button>
                        <button type="button" class="btn secondary" data-bs-dismiss="modal">Cancel</button>

                    </div>
                </div>



            </div>

        </div>
    </div>
</div>
