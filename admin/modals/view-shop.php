<div class="modal fade modal-box view-type-modal customer-modal admin-modal" id="view-shop-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row body-top ">
                    <div class="col-4 img-sec" id="shop_img">

                        <img src="../assets/products.png" alt="">
                    </div>
                    <div class="col-8">
                        <div style="display: flex;flex-direction: row;justify-content: space-between;align-items: flex-start">
                            <div class="shop-info-top">
                                <div class="info-tab">
                                    <label for="shop_name">Shop Name - #<span id="shop_id"></span></label>
                                    <h4 id="shop_name">Account Name</h4>
                                </div>
                                <div class="info-tab">
                                    <label for="shop_nob">Nature of Business</label>
                                    <p id="shop_nob">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries.</p>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="row shop-info-bottom">
                            <div class="col-6">
                                <div class="info-tab">
                                    <label for="shop_address">Address</label>
                                    <p id="shop_address">Account Name</p>
                                </div>
                                <div class="info-tab">
                                    <label for="shop_email">E-Mail Address</label>
                                    <p id="shop_email">Account Name</p>
                                </div>
                                <div class="info-tab">
                                    <label for="shop_tel">Telephone / Mobile</label>
                                    <p id="shop_tel">Account Name</p>
                                </div>
                                <div class="info-tab">
                                    <label for="shop_roc">ROC Number</label>
                                    <p id="shop_roc">Account Name</p>
                                </div>
                                <div class="info-tab">
                                    <label for="shop_reg">Registered Date</label>
                                    <p id="shop_reg">Account Name</p>
                                </div>
                                <div class="info-tab" id="shop_Shopper">
                                    <label for="shop_shopper">Shopper Account</label>
                                    <p id="shop_Shopper" onclick="locaton.href='../">Account Name</p>
                                </div>
                            </div>
                            <div class="col-6" id="dataTabs" >
                                <div class="info-tab">
                                    <label for="shop_tot_earn">Totally Earned (Without delivery charges)</label>
                                    <p id="shop_tot_earn">Account Name</p>
                                </div>
                                <div class="info-tab">
                                    <label for="shop_tot_orders">Total Orders</label>
                                    <p id="shop_tot_orders">Account Name</p>
                                </div>
                                <div class="info-tab">
                                    <label for="shop_tot_cus">Total Customers</label>
                                    <p id="shop_tot_cus">Account Name</p>
                                </div>
                                <div class="info-tab" id="shop_get_action">
                                    <label for="shop_get_action">Get Action</label>
                                    <select class="t-feild" name="shop_get_action" id="shop_get_action">
                                        <option value="ACTIVE">Active</option>
                                        <option value="VERIFIED">Verified</option>
                                        <option value="BANNED">Banned</option>
                                        <option value="BLACK">Black listed</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input type="button" class="btn primary" value="Save" onclick="shopStatusUpdate()">
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>