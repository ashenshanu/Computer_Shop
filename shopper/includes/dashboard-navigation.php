<?php
session_start();

$loggedUser = null;
$shopData = null;
//$_SESSION['user'] = null;

if (!isset($_SESSION["user"])) {
    header('Location: ' . "../index.php");
} else {
    if (!isset($_SESSION["selectedShopID"])) {
        //header()
    }
    $loggedUser = $_SESSION["user"];
    $shopData = getShopById($_SESSION["selectedShopID"]);
}
?>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

<nav class="col-md-2" style="position:sticky; z-index: 100;">
    <div class="nav-shopper nav-admin" style="position:fixed; width:250px">
        <div class="nav-top">
            <img class="logo" src="../assets/sanakin-logo.png" style="cursor: pointer" onclick="location.href='../index.php'" alt="">
            <ul class="nav-list">
                <li onclick="window.location.href ='./shopper-dashboard.php'">
                    <div id="dashboard">
                        <i class="bi bi-house"></i>
                        <span>Dashboard</span>
                    </div>
                </li>
                <li onclick="window.location.href ='./shopper-product.php'">
                    <div id="products">
                        <i class="bi bi-box-seam"></i>
                        <span>Products</span>
                    </div>
                </li>
                <li onclick="window.location.href ='./shopper-orders.php'">
                    <div id="orders">
                        <i class="bi bi-file-earmark-medical"></i>
                        <span>Orders</span>
                    </div>
                </li>
                <li onclick="window.location.href ='./shopper-customer.php'">
                    <div id="customers">
                        <i class="bi bi-people"></i>
                        <span>Customers</span>
                    </div>
                </li>
                <li onclick="window.location.href ='../comming_soon.php'">
                    <div id="cuschat">
                        <i class="bi bi-chat-left-dots"></i>
                        <span>CusChat</span>
                    </div>
                </li>
            </ul>
        </div>
        <div class="nav-bottom">
            <div class="profile-sec">
                <p class="sec-title">PROFILE</p>
                <div class="card-thumb" id="shopper-profile" onclick="location.href='./shopper-profile.php'">
                    <img onerror="this.src='../assets/products.png'" src="../uploads/user_images/<?php echo  $loggedUser['dp_img']; ?>" alt="">
                    <span>
                        <h6><?php echo $loggedUser["first_name"] ?></h6>
                        <span class="orange-text">
                            shopper
                        </span>
                    </span>
                </div>
            </div>








            <div class="shop-sec">
                <p class="sec-title">SHOP</p>
                <div class="a-group dropend">
                    <div class="card-thumb " id="shop-profile" data-bs-toggle="dropdown" aria-expanded="false">
                        <img onerror="this.src='../assets/products.png'" src="../uploads/shop_images/shop_dp/<?php echo  $shopData['dp_logo']; ?>" alt="">
                        <span>
                            <h6><?php echo $shopData["shop_name"] ?></h6>
                            <span class="green-text">
                                Verified
                            </span>
                        </span>
                    </div>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" onclick="location.href='./admin-shopper.php'">Switch Shop</a></li>
                        <li><a class="dropdown-item" onclick="location.href='./shopper-shop-profile.php'"href="#">Shop Profile</a></li>
                    </ul>

                </div>

            </div>
            <div class="logout-btn" id="logout-confirmation" data-bs-toggle="modal" data-bs-target="#logout-confirmation-modal">
                <i class="bi bi-box-arrow-right"></i>
                <span>Log Out</span>
            </div>
        </div>
    </div>
</nav>