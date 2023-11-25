
<div class="modal fade modal-box" id="add-product-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Product</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="col-4">
                        <div class="img-upload" >
                            <img id="img-preview" >
                            <input type="file" name="" id="product-img">
                        </div>
                        <input type="number" class="t-feild form_data" name="quantity" id="quantity" placeholder="Quantity">
                        <input type="number" class="t-feild form_data" name="price" id="per-price" placeholder="Per Price">
                    </div>
                    <div class="col-8">
                        <input type="text" class="t-feild form_data" name="product-name" id="product-name" placeholder="Product Name">
                        <select class="t-feild form_data" name="" id="product-cat" aria-placeholder="Product Category">
                            <option value="-1">-Select Category-</option>
                            <?php
                                if($categoryList != null){
                                    for ($cou = 0; $cou < count($categoryList); $cou++) {
                            ?>
                            <option value="<?php echo $categoryList[$cou][0]?>"><?php echo $categoryList[$cou][1]?></option>
                            <?php }
                                    } ?>
                        </select>
                        <textarea class="t-feild form_data" name="description" id="description" placeholder="Product  Description"></textarea>
                    </div>
                </div>

                <div class="bottom container">
                    <div class="col-4">
                        <input type="radio" name="is-active" value="ACTIVE" id="active">
                        <label for="">Active</label>
                        <input type="radio" name="is-active" value="DRAFT" id="draft">
                        <label for="">Draft</label>
                    </div>
                    <div class="col-8">
                        <button type="button" class="btn primary" onclick="addProduct()">Publish</button>
                        <button type="button" class="btn secondary" data-bs-dismiss="modal">Cancel</button>

                    </div>
                </div>



            </div>

        </div>
    </div>
</div>
