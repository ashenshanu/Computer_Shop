<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.css">
     <link rel="stylesheet" href="./css/main.css">
    <link rel="icon" type="image/x-icon" href="./assets/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

    <title>Mr.PC | Trusted Shops</title>
</head>
<section id="loader" style="position:fixed; width:100vw; height:100vh; z-index:10000; display:flex; flex-direction:column; justify-content:center; align-items:center; background:#ffffff;">
    <img src="./assets/logo.png"  style="margin-bottom: 20px; width:40vW;" alt="">
    <div class="spinner-grow text-warning" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</section>
<?php
require_once "./configs/config.php";
  
include './includes/header.php';

require_once "./connectors/db-connector.php";

include "./controller/product_controller.php";
include "./controller/shop_controller.php";

//$_SESSION['cart'] = array();
//var_dump($_SESSION["cart"])

?>
<body>
    <div class="section hero-sec">
        <!-- <div class="container"> -->
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="./assets/hero-slides/slide 1.png" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="./assets/hero-slides/slide 2.png" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="./assets/hero-slides/slide 1.png" class="d-block w-100" alt="...">
                    </div>
                </div>
                <div class="carousel-caption d-none d-md-block hero-banner-content">
                    <div class="row hero-content">
                        <h1 class="main-title">Find the Best Products<br>with <span class="primarycolor-text">Reliability</h1>
                    </div>
                </div>
            </div>
        <!-- </div> -->
    </div>

<!-- features section -->

<section class="features" id="features">
		<h1 class="heading"> our <span> features</span> </h1>

		<div class="box-container">
			<div class="box">
				<img src="./assets/image/features-img-1.jpg">
				<h3> Second Hand </h3>

			</div>

			<div class="box">
				<img src="./assets/image/features-img-2.jpg">
				<h3> Dilivery </h3>
			</div>

			<div class="box">
				<img src="./assets/image/features-img-3.png">
				<h3> Payment </h3>

			</div>

            <div class="box">
                <img src="./assets/image/features-img-3.png">
                <h3> Discounts </h3>

            </div>

            <div class="box">
                <img src="./assets/image/features-img-3.png">
                <h3> Online Oder </h3>
 
            </div>

            <div class="box">
                <img src="./assets/image/features-img-3.png">
                <h3> Happy Sell </h3>

            </div>

            <div class="box">
                <img src="./assets/image/features-img-3.png">
                <h3> Promotion </h3>

            </div>

		</div>
	</section>

	<!-- features section -->

    <!-- products section -->
	<section class="products" id="products">
        <div class="container">
            <div class="row">        
        		<h1 class="heading"> our <span> products </span></h1>
            </div>
            <div class="row">
            <?php
                $bestDealList = getBestDealsProducts();
                if($bestDealList != null) {
                    if (count($bestDealList)<=6){
                        $maxCount = count($bestDealList);
                    }else{
                        $maxCount = 6;
                    }
                    for ($besD = 0; $besD < $maxCount; $besD++) {

                        ?>
                        <div class="product-card col-md-4">
			        		<div class="inner-container">
                                <div class="product-img-s" style="background: url('uploads/product_images/<?php echo $bestDealList[$besD][10]?>')" onclick=location.href='./single-product.php?id=<?php echo $bestDealList[$besD][0]?>'></div>
			        		    <h1 class="title"><?php echo $bestDealList[$besD][1]?></h1>
			        		    <div class="price">LKR <?php echo number_format((float)$bestDealList[$besD][3], 2, '.', ',');?></div>
			        		    <div class="stars">
			        		    	<i class="fa fa-star"></i>
			        		    	<i class="fa fa-star"></i>
			        		    	<i class="fa fa-star"></i>
			        		    	<i class="fa fa-star"></i>
			        		    	<i class="fa fa-star-half"></i>
			        		    </div>
			        		    <a href="" class="btn" onclick="addtoCart('<?php echo $bestDealList[$besD][0]?>',1)"> add to cart</a>
                            </div>
			        	</div>
                        <?php
                    }
                }
                ?>
                
               

            </div>
        </div>



	</section>
	<!-- products section -->

    
	<!-- services section -->

	<section class="services" id="services">
		<h1 class="heading"> Our <span> Services</span></h1>

		<div class="box-container">
			<div class="box">
				<img src="./assets/image/sev-1.jpg">
				<div class="content">
					<h3> Laptop Repair </h3>
					<p> We repir the laptop and clean the laptop add new items</p>
					<a href="#" class="btn"> Read More </a>
				</div>
			</div>

			<div class="box">
				<img src="./assets/image/sev-2.jpg">
				<div class="content">
					<h3> Desktop Repair </h3>
					<p> We repir the laptop and clean the laptop add new items</p>
					<a href="#" class="btn"> Read More </a>
				</div>
			</div>


			<div class="box">
				<img src="./assets/image/sev-3.jpg">
				<div class="content">
					<h3> Desktop Assemble </h3>
					<p> We repir the laptop and clean the laptop add new items</p>
					<a href="#" class="btn"> Read More </a>
				</div>
			</div>

		</div>
	</section>

	<!-- services section -->


  



    <div class="section ad-banner-1">
        <div id="ad-banner-carousel1" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators" style="display: none;">
                <button type="button" data-bs-target="#ad-banner-carousel1" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#ad-banner-carousel1" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#ad-banner-carousel1" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="./assets/hero-slides/slide 1.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="./assets/hero-slides/slide 2.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="./assets/hero-slides/slide 1.png" class="d-block w-100" alt="...">
                </div>
            </div>
        </div>
    </div>

    <div class="section deals">
        <div class="container">
            <h2 class="section-header">Today Best Deals For You</h2>

            <div class="row products">

                <ul class="nav nav-pills mb-3 deal-tags" id="pills-tab" role="tablist">
                    <?php
                    $categoryList = getAvailableCategories();
//                    var_dump($categoryList);
                    if($categoryList != null) {
                        if (count($categoryList)<=8){
                            $maxCount = count($categoryList);
                        }else{
                            $maxCount = 8;
                        }
                        for ($cou = 0; $cou < $maxCount; $cou++) {
                            if ($cou != 0){
                                $select = "false";
                                $active = "";
                            }else{
                                $select = "true";
                                $active = "active";
                            }

                            ?>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link <?php echo $active?>" id="pill-<?php echo $categoryList[$cou][0]?>-tab" data-bs-toggle="pill" data-bs-target="#pill-<?php echo $categoryList[$cou][0]?>" type="button" role="tab" aria-controls="pill-<?php echo $categoryList[$cou][0]?>" aria-selected="<?php echo $select ?>"><?php echo $categoryList[$cou][1]?></button>
                            </li>
                            <?php
                        }
                    }
                    ?>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <?php
                    $categoryList = getAvailableCategories();
                    if($categoryList != null) {
                        if (count($categoryList)<=8){
                            $maxCat = count($categoryList);
                        }else{
                            $maxCat = 8;
                        }
                    for ($cou = 0; $cou < $maxCat; $cou++) {
                        if ($cou == 0){
                            $select = "active";
                        }else{
                            $select = "";
                        }
                    ?>

                    <div class="tab-pane fade show <?php echo $select ?>" id="pill-<?php echo $categoryList[$cou][0] ?>" role="tabpanel" aria-labelledby="pill-<?php echo $categoryList[$cou][0] ?>-tab">
                        <div class="row">
                            <?php
                            $categorizedList = getCategorizedProducts($categoryList[$cou][0]);
//                            var_dump($categorizedList);
                            if($categorizedList != null) {
                                if (count($categorizedList)<=8){
                                    $maxProduct = count($categorizedList);
                                }else{
                                    $maxProduct = 8;
                                }
                            for ($pro = 0; $pro < $maxProduct; $pro++) {
                                ?>


                                <div class="product-card col-md-4">
			        	        	<div class="inner-container">
                                        <div class="product-img-s" style="background: url('uploads/product_images/<?php echo $categorizedList[$pro][10]?>')" onclick=location.href='./single-product.php?id=<?php echo $categorizedList[$pro][0] ?>'></div>
			        	        	    <h1 class="title"><?php echo $categorizedList[$pro][1] ?></h1>
			        	        	    <div class="price">LKR <?php echo number_format((float)$categorizedList[$pro][3], 2, '.', ',');?></div>
			        	        	    <div class="stars">
			        	        	    	<i class="fa fa-star"></i>
			        	        	    	<i class="fa fa-star"></i>
			        	        	    	<i class="fa fa-star"></i>
			        	        	    	<i class="fa fa-star"></i>
			        	        	    	<i class="fa fa-star-half"></i>
			        	        	    </div>
			        	        	    <a href="" class="btn" onclick="addtoCart('<?php echo $categorizedList[$pro][0]?>',1)"> add to cart</a>
                                    </div>
			        	        </div>

                                
                                <?php
                            }
                    }
                    ?>
                    <div class="center-btn">
                        <a class="explore-btn" href="./online-shop.php?cat_id=<?php echo $categoryList[$cou][0] ?>">
                            Explore More <img src="./assets/icons/more-arrow.svg" alt="" sizes="w-16" srcset="">
                        </a>
                    </div>
                </div>
            </div>
                    <?php
                    }
                    }
                    ?>


                </div>

            </div>

            



        </div>
    </div>

    <div class="section ad-banner-2">
        <div class="container">
            <div id="ad-banner-carousel2" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#ad-banner-carousel2" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#ad-banner-carousel2" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#ad-banner-carousel2" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="./assets/hero-slides/slide 1.png" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="./assets/hero-slides/slide 2.png" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="./assets/hero-slides/slide 1.png" class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#ad-banner-carousel2" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#ad-banner-carousel2" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
     <!-- review section -->

	<section class="review" id="review">
		<h1 class="heading"> Customer's <span>Reviews</span></h1>

		<div class="swiper review-slider">
			<div class="swiper-wrapper">
				<div class="swiper-slide box">
					<img src="./assets/image/cu-1.jpg">
					<p>Quick service & very trustworthy. Worked with Tom Nolan on a quick fix on my mirror. He was very knowledgeable about potential issues before getting into it & was able to get it fixed very quickly. I would trust them with any future repairs, I would not take my car anywhere else.” </p>
					<h3> Tessa </h3>
					<div class="stars">
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
					</div>
				</div>

				<div class="swiper-slide box">
					<img src="./assets/image/cu-2.jpg">
					<p>Quick service & very trustworthy. Worked with Tom Nolan on a quick fix on my mirror. He was very knowledgeable about potential issues before getting into it & was able to get it fixed very quickly. I would trust them with any future repairs, I would not take my car anywhere else.” </p>
					<h3> Tessa </h3>
					<div class="stars">
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
					</div>
				</div>

				<div class="swiper-slide box">
					<img src="./assets/image/cu-3.jpg">
					<p>Quick service & very trustworthy. Worked with Tom Nolan on a quick fix on my mirror. He was very knowledgeable about potential issues before getting into it & was able to get it fixed very quickly. I would trust them with any future repairs, I would not take my car anywhere else.” </p>
					<h3> Tessa </h3>
					<div class="stars">
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
					</div>
				</div>

				<div class="swiper-slide box">
					<img src="./assets/image/cu-4.jpg">
					<p>Quick service & very trustworthy. Worked with Tom Nolan on a quick fix on my mirror. He was very knowledgeable about potential issues before getting into it & was able to get it fixed very quickly. I would trust them with any future repairs, I would not take my car anywhere else.” </p>
					<h3> Tessa </h3>
					<div class="stars">
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
					</div>
				</div>

				<div class="swiper-slide box">
					<img src="./assets/image/cu-5.jpg">
					<p>Quick service & very trustworthy. Worked with Tom Nolan on a quick fix on my mirror. He was very knowledgeable about potential issues before getting into it & was able to get it fixed very quickly. I would trust them with any future repairs, I would not take my car anywhere else.” </p>
					<h3> Tessa </h3>
					<div class="stars">
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- review section -->


    <script src="./js/bootstrap.js"></script>
    <script src="./js/bootstrap.bundle.min.js"></script>

    
	<?php include "./includes/footer.php"; ?>
	<?php include "./includes/com_links.php"; ?>
    <?php include "./includes/home-modals-mapping.php"; ?>

    <script src="./js/tools.js?v=7416514"></script>
    <script src="./js/cart.js?v=368333"></script>
    <script>
       document.getElementById('home-page').classList.add('selected');
    </script>
</body>

</html>