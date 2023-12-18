<?php
session_start();

$loggedUser = null;
$shopData = null;
//$_SESSION['user'] = null;

 if(!isset($_SESSION["user"])){
     header('Location: '."../index.php");
 }else{
     if(!isset($_SESSION["selectedShopID"])){
         //header()
     }
     $loggedUser = $_SESSION["user"];
 }
?>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
<nav class="col-md-2" style="position:sticky; z-index: 100;">
    <div class="nav-shopper nav-admin" style="position:fixed; width:250px">
        <div class="nav-top">
            <img class="logo" src="../assets/Mr.PC.png" style="cursor: pointer" onclick="location.href='../index.php'" alt="">
            <ul class="nav-list">
                <li  onclick="window.location.href ='./customer-orders.php'">
                    <div id="orders">
                        <i class="bi bi-box-seam"></i>
                        <span>Orders</span>
                    </div>
                </li>
                <li  onclick="window.location.href ='./customer-complaint.php'">
                    <div id="customers">
                        <i class="bi bi-people"></i>
                        <span>Complaint</span>
                    </div>
                </li>
                <li onclick="window.location.href ='../comming_soon.php'">
                    <div  id="cuschat">
                        <i class="bi bi-chat-left-dots"></i>
                        <span>CusChat</span>
                    </div>
                </li>
            </ul>
        </div>
        <div class="nav-bottom">
            <div class="profile-sec" >
                <p class="sec-title">People</p>
                <div class="card-thumb" id="shopper-profile" onclick="location.href='./customer-profile.php'">
                    <img onerror="this.src='../assets/product.jpg'" src="../uploads/user_images/<?php echo  $loggedUser['dp_img']; ?>" alt="">
                    <span>
                         <h6><?php echo $loggedUser["first_name"]?></h6>
                        <span class="orange-text">
                            Customer
                        </span>
                    </span>
                </div>
            </div>

            <div class="logout-btn" id="logout-confirmation" data-bs-toggle="modal" data-bs-target="#logout-confirmation-modal">
                <i class="bi bi-box-arrow-right"></i>
                <span>Log Out</span>
            </div>
            <div class="logout-btn" id="logout-confirmation" onclick="location.href='../index.php'">
                <i class="bi bi-bag"></i>
                <span>Let's Shopping</span>
            </div>

        </div>
    </div>
</nav>


