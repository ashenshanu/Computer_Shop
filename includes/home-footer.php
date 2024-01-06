<footer class="w-100 py-4 flex-shrink-0">
    <div class="container py-4">
        <div class="row gy-4 gx-5">
            <div class="col-lg-4 col-md-6 text-muted">
                <img src="./assets/Mr.PC.png" alt="" onclick="location.href='./index.php'" srcset="">
                <!-- <h5 class="h1 text-white">FB.</h5> -->
                <p class="medium text-muted">Mr.PC is the best online platform for you, Join us today & Experience the best online shopping experience with us.</p>
                <h5 class="mb-3 sub-sec-title">Contact Us</h5>
                <div class="contact-details">
                    <a class="" href="#">79/7, Polhena<br> Madapatha<br> Piliyandala</a>
                    <a class="" href="tel:+94763133646">(+94) 75 608 7339</a>
                </div>
                <p class="small text-muted mb-0">&copy; Copyrights. All rights reserved. <a class="text-primary" href="./index.php">Mr.PC</a></p>
            </div>
            <div class="col-lg-2 col-md-6">
                <h5 class="mb-3 sub-sec-title">Pages</h5>
                <ul class="list-unstyled text-muted">
                    <li><a href="./index.php">Home</a></li>
                    <li><a href="./online-shop.php">Shop Online</a></li>
                    <li><a href="./contact-us.php">Contact Us</a></li>
                    <li><a href="./about-us.php">About Us</a></li>
                    <li><a href="./whats-new.php">What's New</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-6">
                <h5 class="mb-3 sub-sec-title">Categories</h5>
                <ul class="list-unstyled text-muted">
                    <?php $categoryList = getAllCategories();
                    $catCount = count(getAllCategories());
                    if($categoryList != null) {
                        for ($cou = 0; $cou < $catCount; $cou++) {
                            ?>
                            <li><a href="./online-shop.php?cat_id=<?php echo $categoryList[$cou][0]?>"><?php echo $categoryList[$cou][1]?></a></li>

                        <?php }
                    }?>
                </ul>
            </div>
            <div class="col-lg-4 col-md-6">
                <h5 class="mb-3 sub-sec-title">Newsletter</h5>
                <p class="medium text-muted">One-stop shop–find it all here!<br>Subscribe us to get in touch</p>
                <form action="#">
                    <div class="search-bar">
                        <input type="email" class="search" name="text" placeholder="Your Email Address" id="newsletter_email">
                        <input type="button" id="search-btn" class="search-btn btn primary" onclick="addNewSubscriber()" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</footer>