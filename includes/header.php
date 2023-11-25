<header class="header">
		<a href="#" class="logo"> <i class="fa fa-desktop"> </i> Mr.PC </a>



		<nav class="navbar">
                <span id="home-page"><a href="./index.php">Home</a></span>
                <span id="home-page"><a href="./index.php">Features</a></span>
                <span id="shop-online-page"><a href="./online-shop.php">Products</a></span>
                <span id="home-page"><a href="./index.php">Reviews</a></span>
                <span id="contact-page"><a href="./contact-us.php">Contact</a></span>
                <span id="about-page"><a href="./about-us.php">About Us</a></span>
		</nav>



		<div class="icons">
			<div class="fa fa-bars" id="menu-btn"></div>
			<div class="fa fa-search" id="search-btn"></div>
			<div class="fa fa-shopping-cart" id="cart-btn"></div>
			<div class="fa fa-user" id="login-btn"></div>
		</div>



		<form class="search-form">
			<input type="search" id="search-box" placeholder="Search Here...." onkeyup="handleSearchFiled(event)">
			<button id="search-btn" class="search-btn btn primary" onclick="handleSearchButton(document.getElementById('search_head').value)"><label for="search-box" class="fa fa-search"></label></button>
		</form>



		<div class="shopping-cart">
			<div class="box">
				<i class="fa fa-trash"></i>
				<img src="image/cart-img-1.jpg">
				<div class="content">
					<h3>Hard Drive</h3>
					<span class="price">LKR 15,000.00</span>
					<span class="quantity">Qty : 1</span>
				</div>
			</div>

			<div class="box">
				<i class="fa fa-trash"></i>
				<img src="image/cart-img-2.jpg">
				<div class="content">
					<h3>Motherboard</h3>
					<span class="price">LKR 32,000.00</span>
					<span class="quantity">Qty : 1</span>
				</div>
			</div>

			<div class="box">
				<i class="fa fa-trash"></i>
				<img src="image/cart-img-3.jpg">
				<div class="content">
					<h3>Mouse</h3>
					<span class="price">LKR 1,500.00</span>
					<span class="quantity">Qty : 1</span>
				</div>
			</div>
			<div class="total"> total : LKR 48,500.00</div>
			<a href="#" class="btn">Checkout</a>
		</div>



		<form action="#" class="login-form">
			<h3>login now</h3>
			<input type="email" placeholder="Enter your email" class="box">
			<input type="password" placeholder="Enter your password" class="box">


			<p> Forget Password <a href="#"> Click Here </a></p>
			<p> Don't Have An Account <a href="#"> Create Now </a></p>


			<input type="submit" name="Login Now" class="btn">
		</form>

		<meta name="viewport" content="width=device-width, initial-scale=1.0">

	</header>