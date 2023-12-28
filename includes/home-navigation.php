<?php

session_start();

$isShopper = false;
$addCart = "";
$isUserLogged = false;
$loggedUser = null;

if(isset($_SESSION["user"])){
    $loggedUser = $_SESSION["user"];
    $isUserLogged = true;
    if($loggedUser["acc_type"] === ACCOUNT_TYPE_SHOPPER){
        $isShopper = true;
        $addCart = "disabled";
    }
}

?>

<nav id="nav">
        <div class="container">
            <a href="index.php">
            <img src="./assets/Mr.PC.png" id="nav-logo" alt="Mr.PC" srcset="">
            </a>

            <button class="btn btn-primary ham-button" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobile-menu" aria-controls="mobile-menu">
            <svg fill="none" height="20" viewBox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg"><path d="m19 11h-18c-.265216 0-.51957-.1054-.707107-.2929-.187536-.1875-.292893-.4419-.292893-.7071 0-.26522.105357-.51957.292893-.70711.187537-.18753.441891-.29289.707107-.29289h18c.2652 0 .5196.10536.7071.29289.1875.18754.2929.44189.2929.70711 0 .2652-.1054.5196-.2929.7071s-.4419.2929-.7071.2929zm0-7h-18c-.265216 0-.51957-.10536-.707107-.29289-.187536-.18754-.292893-.44189-.292893-.70711s.105357-.51957.292893-.70711c.187537-.18753.441891-.29289.707107-.29289h18c.2652 0 .5196.10536.7071.29289.1875.18754.2929.44189.2929.70711s-.1054.51957-.2929.70711c-.1875.18753-.4419.29289-.7071.29289zm0 14h-18c-.265216 0-.51957-.1054-.707107-.2929-.187536-.1875-.292893-.4419-.292893-.7071s.105357-.5196.292893-.7071c.187537-.1875.441891-.2929.707107-.2929h18c.2652 0 .5196.1054.7071.2929s.2929.4419.2929.7071-.1054.5196-.2929.7071-.4419.2929-.7071.2929z" fill="rgb(0,0,0)"/></svg>
            </button>

            <ul class="nav-items">
                <li id="home-page"><a href="./index.php">Home</a></li>
                <li id="shop-online-page"><a href="./online-shop.php">Products</a></li>
                <li id="contact-page"><a href="./contact-us.php">Contact</a></li>
                <li id="about-page"><a href="./about-us.php">About Us</a></li>
            </ul>
            <?php
                if(!isset($_SESSION["user"])){
            ?>
            <div id="nav-sign">
                <!-- <input type="button" class="cus-btn primary" id="sign-up" value="Sign up" data-bs-toggle="offcanvas" data-bs-target="#sign-up-offcanvasRight" aria-controls="sign-up-offcanvasRight"> -->
                <button class="cus-btn secondary" id="cart-btn" value="cart" data-bs-toggle="offcanvas" data-bs-target="#s-cart-offcanvasRight" aria-controls="s-cart-offcanvasRight">
                    <img src="./assets/icons/shopping-cart2.svg" alt="" width="20" height="20">
                </button>
                <div class="dropdown search-feild">
                    <button class="cus-btn secondary dropdown-toggle" id="search-feild-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="./assets/icons/search.svg" alt="" width="20" height="20">
                    </button>
                    <ul class="dropdown-menu">
                        <div class="search-bar">
                            <input type="search" class="search" name="Search" placeholder="Search Here Shop or Product" id="search_head" onkeyup="handleSearchFiled(event)">
                            <input type="button" id="search-btn" class="search-btn btn primary" value="Search" onclick="handleSearchButton(document.getElementById('search_head').value)">
                        </div>
                    </ul>
                </div>
                <button class="cus-btn secondary" id="sign-in" value="Sign in" data-bs-toggle="offcanvas" data-bs-target="#sign-in-offcanvasRight" aria-controls="sign-in-offcanvasRight">
                    <img src="./assets/icons/user.svg" alt="" width="20" height="20">
                </button>
            </div>

            <?php }elseif(isset($_SESSION["user"]) && $_SESSION["user"]['acc_type']== ACCOUNT_TYPE_SHOPPER) {

                    ?>
                    <div id="nav-sign" style="cursor: pointer" onclick="location.href='./shopper/admin-shopper.php'">
                        <img style="width: 40px; height: 40px; border-radius: 100%; object-fit: cover;" onerror="this.src='./assets/product.jpg'" src='./uploads/user_images/<?php echo $_SESSION['user']['dp_img']?>' alt='Card image cap'>
                        <h6 style="margin: 0px;">Welcome, <?php echo $_SESSION['user']['first_name'] ?></h6>
                    </div>

                    <?php
                }elseif(isset($_SESSION["user"]) && $_SESSION["user"]['acc_type']== ACCOUNT_TYPE_CUSTOMER) {

                    ?>
                    <div id="nav-sign">
                <!-- <input type="button" class="cus-btn primary" id="sign-up" value="Sign up" data-bs-toggle="offcanvas" data-bs-target="#sign-up-offcanvasRight" aria-controls="sign-up-offcanvasRight"> -->
                <button class="cus-btn secondary" id="cart-btn" value="cart" data-bs-toggle="offcanvas" data-bs-target="#s-cart-offcanvasRight" aria-controls="s-cart-offcanvasRight">
                    <img src="./assets/icons/shopping-cart2.svg" alt="" width="20" height="20">
                </button>
                <div class="dropdown search-feild">
                    <button class="cus-btn secondary dropdown-toggle" id="search-feild-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="./assets/icons/search.svg" alt="" width="20" height="20">
                    </button>
                    <ul class="dropdown-menu">
                        <div class="search-bar">
                            <input type="search" class="search" name="Search" placeholder="Search Here Shop or Product" id="search_head" onkeyup="handleSearchFiled(event)">
                            <input type="button" id="search-btn" class="search-btn btn primary" value="Search" onclick="handleSearchButton(document.getElementById('search_head').value)">
                        </div>
                    </ul>
                </div>
                <button class="cus-btn secondary" id="nav-sign" style="cursor: pointer" onclick="location.href='./customer/customer-orders.php'">
                    <img style="width: 40px; height: 40px; object-fit: cover;" onerror="this.src='./assets/product.jpg'" src='./uploads/user_images/<?php echo $_SESSION['user']['dp_img']?>' alt='Card image cap'>
                </button>
            </div>
                    <!-- <div >
                        <img >
                        <h6 style="margin: 0px;">Welcome, <?php echo $_SESSION['user']['first_name'] ?></h6>
                    </div> -->

                    <?php
                }elseif(isset($_SESSION["user"]) && $_SESSION["user"]['acc_type']== ACCOUNT_TYPE_ADMIN) {

                    ?>
                    <div id="nav-sign" style="cursor: pointer; display: flex; flex-direction: row; gap:10px;" onclick="location.href='./admin/admin-dashboard.php'">
                        <img style="width: 40px; height: 40px; border-radius: 100%; object-fit: cover;" onerror="this.src='./assets/product.jpg'" src='./uploads/user_images/<?php echo $_SESSION['user']['dp_img']?>' alt='Card image cap'>
                        <h6 style="margin: 0px;">Welcome, <?php echo $_SESSION['user']['first_name'] ?></h6>
                    </div>

                    <?php
                }
            ?>
        </div>
        
</nav>
<?php include"./includes/mobile-nav-menu.php" ?>

<script src="./js/bootstrap.bundle.js"></script>