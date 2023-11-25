<nav id="nav">
    <div class="container header">
        <div class="search-bar">
            <input type="search" class="search" name="Search" placeholder="Search Here Shop or Product" id="search_head" onkeyup="handleSearchFiled(event)">
            <input type="button" id="search-btn" class="search-btn btn primary" value="Search" onclick="handleSearchButton(document.getElementById('search_head').value)">
        </div>
        <div class="cart" data-bs-toggle="offcanvas" data-bs-target="#s-cart-offcanvasRight" aria-controls="s-cart-offcanvasRight">
            <img src="./assets/icons/shopping-cart (3).svg" alt="" >
        </div>
    </div>

</nav>