<div class="modal fade modal-box view-type-modal customer-modal admin-modal" id="view-product-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row body-top ">
                    <div class="col-4 img-sec" id="pro_img">

                    </div>
                    <div class="col-8">
                        <div style="display: flex;flex-direction: row;justify-content: space-between;align-items: flex-start">
                            <div class="shop-info-top">
                                <div class="info-tab">
                                    <label for="pro_name">Product Name - #<span id="pro_id"></span></label>
                                    <h4 id="pro_name">Account Name</h4>
                                </div>
                                <div class="info-tab">
                                    <label for="pro_description">product Description</label>
                                    <p id="pro_description">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries.</p>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="row shop-info-bottom">
                            <div class="col-6">
                                <div class="info-tab">
                                    <label for="pro_unit_price">Unit Price</label>
                                    <p id="pro_unit_price">Account Name</p>
                                </div>
                                <div class="info-tab">
                                    <label for="pro_cat">Category</label>
                                    <p id="pro_cat">Account Name</p>
                                </div>
                                <div class="info-tab">
                                    <label for="pro_added_date">Added Date</label>
                                    <p id="pro_added_date">Account Name</p>
                                </div>
                                <div class="info-tab" id="pro_shop_id">

                                </div>
                            </div>
                            <div class="col-6" id="dataTabs">

                            </div>
                        </div>
                        <input type="button" class="btn primary" value="Save" onclick="productStatusUpdate()">
                    </div>
                </div>
<!--                <div class="row body-bottom">-->
<!--                    <div class="col-12">-->
<!--                    <iframe src="" class="iframe_table_outer" frameborder="0"></iframe>-->
<!--                    </div>-->
<!--                </div>-->
            </div>

        </div>
    </div>
</div>