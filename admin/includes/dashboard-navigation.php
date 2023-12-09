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
    // $shopData = getShopById($_SESSION["selectedShopID"]);
}
?>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

<nav class="col-md-2" style="position:sticky; z-index: 100;">
    <div class="nav-shopper nav-admin" style="position:fixed; width:250px">
        <div class="nav-top">
            <img class="logo" src="../assets/sanakin-logo.png" style="cursor: pointer" onclick="location.href='../index.php'" alt="">
            <ul class="nav-list">
                <li onclick="window.location.href ='./admin-dashboard.php'">
                    <div id="dashboard">
                        <i class="bi bi-house"></i>
                        <span>Dashboard</span>
                    </div>
                </li>
                <li onclick="window.location.href ='./admin-complaint.php'">
                    <div id="complaints">
                    <i class="bi bi-file-earmark-text"></i>
                        <span>Complaints</span>
                    </div>
                </li>
                <li onclick="window.location.href ='./admin-account.php'">
                    <div id="accounts">
                    <i class="bi bi-people"></i>
                        <span>Accounts</span>
                    </div>
                </li>
                <li onclick="window.location.href ='./admin-shop.php'">
                    <div id="shops">
                        <i class="bi bi-bag"></i>
                        <span>Shops</span>
                    </div>
                </li>
                <li onclick="window.location.href ='./admin-product.php'">
                    <div id="products">
                    <i class="bi bi-box-seam"></i>
                        <span>Products</span>
                    </div>
                </li>
                <li onclick="window.location.href ='../comming_soon.php'">
                    <div id="cuschat">
                        <i class="bi bi-chat-left-dots"></i>
                        <span>CusChat</span>
                    </div>
                </li>
                <li onclick="window.location.href ='./admin-inquiry.php'">
                    <div id="inquiry">
                        <i class="bi bi-chat-left-text"></i>
                        <span>Inquiry</span>
                    </div>
                </li>
                <li onclick="window.location.href ='./admin-subscribe.php'">
                    <div id="subscribe">
                        <i class="bi bi-newspaper"></i>
                        <span>Subscribe</span>
                    </div>
                </li>
            </ul>
        </div>
        <div class="nav-bottom">
            <div class="profile-sec">
                <p class="sec-title">PROFILE</p>
                <div class="card-thumb" id="shopper-profile" onclick="location.href='./admin-profile.php'">
                    <img onerror="this.src='../assets/products.png'" src="../uploads/user_images/<?php echo  $loggedUser['dp_img']; ?>" alt="">
                    <span>
                        <h6><?php echo $loggedUser["first_name"] ?></h6>
                        <span class="orange-text">
                            Admin
                        </span>
                    </span>
                </div>
            </div>
            <div class="logout-btn" id="logout-confirmation" data-bs-toggle="modal" data-bs-target="#logout-confirmation-modal">
                <i class="bi bi-box-arrow-right"></i>
                <span>Log Out</span>
            </div>
        </div>
    </div>
</nav>