<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.css">
     <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="./css/contact.css">
    <link rel="icon" type="image/x-icon" href="./assets/favicon.png">
    <title>Sanakin.LK | Trusted Shops</title>
</head>
<?php
require_once "./configs/config.php";
 
include "./includes/home-header.php";

require_once "./connectors/db-connector.php";

include "./controller/product_controller.php";
include "./controller/shop_controller.php";
$categoryList = getAllCategories();
?>
<body>
<div class="topic">
    <h1 class="page-title"> Contact Us</h1>
    <p>24 hrs instant reply</p>
</div>
<section class="section">
    <div class="contact-container">
        <div class="contactInfo">
            <div>
                <h3>What will be next step?</h3>
                <p>Follow the steps given to join the site</p><br>
                <h5>Fill the form & submit</h5>
                <p>Fill the given form and submit it</p><br>
                <h5>Will receive a reply with in 24hrs</h5>
                <p>One of our members will reach out you with in 24 hrs to discuss about your issue</p><br>
                <h5>Let’s start</h5>
                <p>follow the instructions of our member and join the site and build a customer base for your business</p>
            </div>
        </div>
        <div class="contactForm">
            <h3>Send a Message</h3>
            <div class="formBox">
                <div class="inputBox w50">
                    <p>Name</p>
                    <input class="t-feild" type="text" placeholder="Your Name" id="name" required>
                </div>
                <div class="inputBox w50">
                    <p>Email</p>
                    <input class="t-feild" type="email" placeholder="Your Email Address" id="email" required>
                </div>
                <div class="inputBox w50">
                    <p>Phone</p>
                    <input class="t-feild" type="tel" placeholder="Your Phone number" id="phone" required>
                </div>
                <div class="inputBox w50">
                    <p>Message</p>
                    <textarea class="t-feild" placeholder="Message" id="msg" required></textarea>
                </div>
                <div class="inputBox w50">
                    <input class="btn primary" type="button" onclick="uploadInquiry()" value="Submit">
                </div>
            </div>
            </form>
        </div>
    </div>
</section>
<section >
    <div class="container">
        <div class="row white-bd-card" style="margin-top: 50px">
            <div class="col-3 r1">
                <h1>Get in touch <br>
                    with us!</h1>
            </div>
            <div class="col-3 detail-box">
                <i class="bi bi-telephone con"></i>
                <h5>Phone</h5>
                <p class="con-p"><a class="" href="tel:+94763133646">0112345678</a></p>
            </div>
            <div class="col-3 detail-box">
                <i class="bi bi-map con"></i>
                <h5 >Address</h5>
                <p class="con-p">123/S, Buddhaloka Mw,<br>
                    Suwarapola,<br>
                    Piliyandal</p>
            </div>
            <div class="col-3 detail-box">
                <i class="bi bi-envelope con"></i>
                <h5>Email</h5>
                <p class="con-p"><a href="mailto:info@sanakin.lk">info@sanakin.lk</a></p>
            </div>
        </div>
    </div>

</section>
    <?php include "./includes/footer.php"; ?>
    <?php include "./includes/home-modals-mapping.php"; ?>
    <script src="./js/bootstrap.js"></script>
    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="./js/tools.js?a=12341234"></script>
    <script src="./js/product-pagination.js"></script>
    <script>
       document.getElementById('contact-page').classList.add('selected');
    </script>
</body>
</html>