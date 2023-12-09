<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="icon" type="image/x-icon" href="./assets/favicon.png">
    <title>Sanakin.LK | Trusted Shops</title>
    <title>Document</title>
</head>
<?php
require_once "./connectors/db-connector.php";
require_once "./configs/config.php";

include "./controller/product_controller.php";

include "./includes/home-navigation.php";
include "./includes/home-header.php"; ?>

<body class="about-us">
    <section class="row">
        <div class="col-md-12 hero-sec">
            <h1 class="page-title">About Us</h1>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row sec-1">
                <div class="col-md-12">
                    <div class="white-bd-card">
                        <div class="row head-title">
                            <h2>We Makes Reliable Online Shopping Easier For You</h2>

                        </div>
                        <div class="row">
                            <div class="col-md-3 sub-card">
                                <h1 class="orange-text">200+</h1>
                                <h4>Orders Completed</h4>

                            </div>
                            <div class="col-md-3 sub-card">
                                <h1 class="orange-text">99%</h1>
                                <h4>Successful Orders</h4>

                            </div>
                            <div class="col-md-3 sub-card">
                                <h1 class="orange-text">8K</h1>
                                <h4>User Accounts</h4>

                            </div>
                            <div class="col-md-3 sub-card">
                                <h1 class="orange-text">100+</h1>
                                <h4>5 Stars Reviews</h4>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row sec-2">
                <div class="col-md-6">
                    <div class="white-bd-card">
                        <h2>Mission</h2>
                        <p>Our mission to create a good market place for local sellers & to create a good online shopping store.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="white-bd-card">
                        <h2>Vision</h2>
                        <p>Our vision is to. build a trustable online store for both customers and sellers.</p>
                    </div>
                </div>
            </div>

            <div class="row sec-4">
                <div class="white-bd-card col-md-12">
                    <h3>Testimonials</h3>
                    <div id="carouselExampleIndicators" class="carousel slide">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="testimonial-card">
                                    <p class="comment">“Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.”</p>
                                    <h5 class="testimonial-name">Amishka Amarasignhe</h5>
                                    <h6 class="orange-text acc-type">Customer</h6>
                                </div>
                            </div>
                            <div class="carousel-item">
                            <div class="testimonial-card">
                                    <p class="comment">“Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.”</p>
                                    <h5 class="testimonial-name">Amishka Amarasignhe</h5>
                                    <h6 class="orange-text acc-type">Shopper</h6>
                                </div>
                            </div>
                            <div class="carousel-item">
                            <div class="testimonial-card">
                                    <p class="comment">“Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.”</p>
                                    <h5 class="testimonial-name">Amishka Amarasignhe</h5>
                                    <h6 class="orange-text acc-type">Shopper</h6>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true">dfg</span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="false">ew</span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <?php include "./includes/home-footer.php"; ?>
    <?php include "./includes/home-modals-mapping.php"; ?>
    <script src="./js/bootstrap.js"></script>
    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="./js/tools.js"></script>
    <script src="./js/product-pagination.js"></script>
    <script>
        document.getElementById('about-page').classList.add('selected');
    </script>
</body>

</html>