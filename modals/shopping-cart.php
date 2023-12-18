    <div class="offcanvas offcanvas-end s-cart-canvas" tabindex="-1" id="s-cart-offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-body">
            <div class="container">
                <div class="offcanvas-header">
                    <h3>Shopping Cart</h3>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close" onclick="freshStep()"></button>
                </div>
                <div class="view " id="view1">
                    <div class="product-table">
                        <?php
                        $totalCart = 0.00;
                        if (isset($_SESSION["cart"])) {
                            if (count($_SESSION["cart"]) > 0) {
                                $cartProductList = $_SESSION["cart"];
                                for ($i = 0; $i < count($cartProductList); $i++) {

                                    $subTotal = $cartProductList[$i]["product"]["per_price"] * $cartProductList[$i]["quantity"];
                                    $totalCart += $subTotal;

                        ?>
                                    <div class="product-card">
                                        <img src="./assets/product.jpg" alt="">
                                        <div class="product-info">
                                            <h5 class="product-name"><?php echo $cartProductList[$i]["product"]["product_name"] ?></h5>

                                            <div class="product-quantity">
                                                <div class="counter">
                                                    <?php
                                                    if ($cartProductList[$i]["quantity"] > 1) {
                                                    ?>
                                                        <div class="btn" onclick="addtoCart('<?php echo $cartProductList[$i]['product']['product_id'] ?>',-1)">-<img src="" alt=""></div>
                                                    <?php } else { ?>
                                                        <div class="btn" style="opacity: 0.3">-<img src="" alt=""></div>
                                                    <?php } ?>
                                                    <div class="count" id="cart-count"><?php echo $cartProductList[$i]["quantity"] ?></div>

                                                    <?php
                                                    if ($cartProductList[$i]["max_qty"] <= $cartProductList[$i]["quantity"]) {
                                                        $cartProductList[$i]["quantity"] = $cartProductList[$i]["max_qty"];
                                                    ?>
                                                        <div class="btn" style="opacity: 0.3">+</div>

                                                    <?php } else { ?>
                                                        <div class="btn" id="cart-minus" onclick="addtoCart('<?php echo $cartProductList[$i]['product']['product_id'] ?>',1)">+</div>
                                                    <?php } ?>
                                                </div>
                                                <h6 class="product-total-price">Rs. <span id="total-price"><?php echo $subTotal ?></span></h6>
                                            </div>
                                            <p id="remove-item" onclick="itemRemovefromcart(<?php echo $cartProductList[$i]['product']['product_id'] ?>)">Remove</p>
                                        </div>
                                    </div>
                        <?php
                                }
                            }
                        }
                        ?>
                    </div>
                    <div class="total-order">
                        <h6>Total Items Cost</h6>
                        <h4 class="order-price">Rs. <span><?php echo $totalCart ?></span></h4>
                    </div>
                    <?php
                    if (!$isShopper) {
                        if ($isUserLogged) {
                    ?>
                            <input type="button" class="primary btn" value="Check Out" id="check-out" name="check-out" <?php
                                                                                                                        if (!isset($cartProductList)) {
                                                                                                                        ?> disabled <?php
                                                                                                                        }
                                            ?>>
                        <?php } else {
                        ?>
                            <input type="button" class="primary btn" value="Sign in" data-bs-toggle="offcanvas" data-bs-target="#sign-in-offcanvasRight" aria-controls="sign-in-offcanvasRight">
                    <?php }
                    } ?>
                </div>

                <div class="view hidden" id="view2">
                    <div class="info-area">
                        <div class="info">
                            <h6>Full Name</h6>
                            <p><?php echo $loggedUser["first_name"] . " " . $loggedUser["last_name"] ?></>
                        </div>
                        <div class="info">
                            <h6>Address</h6>
                            <input id="cart-address" class="t-feild" type="text" value="<?php echo $loggedUser["home_address"] ?>">
                        </div>
                        <br />
                        <div class="info">
                            <h6>City</h6>
                            <input id="cart-city" class="t-feild" type="text" value="<?php echo $loggedUser["home_city"] ?>">
                        </div>
                        <br />
                        <div class="info">
                            <h6>Contact Number</h6>
                            <p><?php echo $loggedUser["tel"] ?></p>
                        </div>
                        <br />
                        <div class="info">
                            <h6>Special Message</h6>
                            <textarea id="cart-msg" class="t-feild">
                            </textarea>
                        </div>
                        <br />
                        <div class="info">
                            <h6>Payment Method</h6>
                            <p>COD (Cash On Delivery)</p>
                        </div>
                    </div>
                    <input type="button" onclick="placeOrder()" class=" primary btn" value="Confirm & Place Order" id="check-out-confirm" name="check-out-confirm">
                </div>

                <div class="view hidden" id="cart-sucess">
                    <div class="info-area">
                        <h4>Your Order Has been Placed Successfully.</h4>
                        <br />
                        <p>Please Keep Rs.<?php echo number_format((float)$totalCart, 2, '.', ',') ?> arranged when delivery.</p>
                        <br />
                        <h5>Your Order Number - <span id="new-order-number"></span></h5>
                        <br />
                        <input type="button" onclick="window.location.reload();" class=" primary btn" value="Continue Shopping">
                    </div>
                </div>

            </div>
        </div>
    </div>

<script>
    function itemRemovefromcart(itemID) {

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'functions/api.php', true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.setRequestHeader("application-auth", "computershop-auth");

        xhr.onload = function() {
            if (xhr.readyState === xhr.DONE && xhr.status === 200) {
                if (xhr.responseText) {
                    var responseObj = JSON.parse(xhr.responseText);
                    if (responseObj) {
                        if (responseObj.status === "SUCCESS") {
                            location.reload();
                        }
                    }
                }
            }
        };
        xhr.send("action=remove_item&productID=" + itemID);
    }

</script>