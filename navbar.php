<?php
if (isset($_SESSION["logged_in"],$_SESSION["active"])) {
  if ($_SESSION["logged_in"] == true && $_SESSION["active"] == '0' ) {
    echo ' <div class="agileits_header" style="margin:auto;">
    <div class="container">
    <div class="agile-login">
    <ul>
    <li><a>Dear '.$_SESSION["username"].'! kindly activate your account.</a></li>
    </ul>
    </div>
    </div>
    </div>';
  }
}
var_dump($_SESSION);
 ?>

<!-- header -->
<div class="agileits_header">
  <div class="container">
    <div class="w3l_offers">
      <p>SALE UP TO 70% OFF. USE CODE "SALE70%" . <a href="products.php">SHOP NOW</a></p>
    </div>
    <div class="agile-login">
      <ul>
        <?php
          if(isset($_SESSION["logged_in"])){
            if ($_SESSION["logged_in"] == true) {
              echo '<li><a href="index.php"> Welcome '.$_SESSION["firstname"].' </a></li>';
            }
            else {
              echo '<li><a href="registered.php"> Create Account </a></li>';
            }
          }
          else {
            echo '<li><a href="registered.php"> Create Account </a></li>';
          }
         ?>
        <!-- <li><a href="registered.php"> Create Account </a></li> -->
        <!-- <li><a href="login.php">Log In</a></li> -->
          <?php
            if(isset($_SESSION["logged_in"])){
              if ($_SESSION["logged_in"] == true) {
                $myobj = new Database("ecommerce","user");
                echo '<li><a href="login.php" onClick ="$myobj->SessionClose()" >Logout</a></li>';
                // echo '<li><a href="login.php">Logout</a></li>';
              }
              else {
                echo '<li><a href="login.php">Log In</a></li>';
              }
            }
            else {
              echo '<li><a href="login.php">Log In</a></li>';
            }
          ?>
        <li><a href="contact.php">Help</a></li>

      </ul>
    </div>
    <div class="product_list_header">
        <form action="#" method="post" class="last">
          <input type="hidden" name="cmd" value="_cart">
          <input type="hidden" name="display" value="1">
          <button class="w3view-cart" type="submit" name="submit" value=""><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></button>
        </form>
    </div>
    <div class="clearfix"> </div>
  </div>
</div>
<div class="logo_products">
  <div class="container">
  <div class="w3ls_logo_products_left1">
      <ul class="phone_email">
        <li><i class="fa fa-phone" aria-hidden="true"></i>Order online or call us : (+0123) 234 567</li>

      </ul>
    </div>
    <div class="w3ls_logo_products_left">
      <h1><a href="index.php">orderkarao.pk</a></h1>
    </div>
  <div class="w3l_search">
    <form action="#" method="post">
      <input type="search" name="Search" placeholder="Search for a Product..." required="">
      <button type="submit" class="btn btn-default search" aria-label="Left Align">
        <i class="fa fa-search" aria-hidden="true"> </i>
      </button>
      <div class="clearfix"></div>
    </form>
  </div>

    <div class="clearfix"> </div>
  </div>
</div>
<!-- header -->

<!-- navigation -->
	<div class="navigation-agileits">
		<div class="container">
			<nav class="navbar navbar-default">
							<!-- Brand and toggle get grouped for better mobile display -->
							<div class="navbar-header nav_2">
								<button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
							</div>
							<div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
								<ul class="nav navbar-nav">
									<li class="active"><a href="index.php" class="act">Home</a></li>
									<!-- Mega Menu -->
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Groceries<b class="caret"></b></a>
										<ul class="dropdown-menu multi-column columns-3">
											<div class="row">
												<div class="multi-gd-img">
													<ul class="multi-column-dropdown">
														<h6>All Groceries</h6>
														<li><a href="groceries.php">Dals & Pulses</a></li>
														<li><a href="groceries.php">Almonds</a></li>
														<li><a href="groceries.php">Cashews</a></li>
														<li><a href="groceries.php">Dry Fruit</a></li>
														<li><a href="groceries.php"> Mukhwas </a></li>
														<li><a href="groceries.php">Rice & Rice Products</a></li>
													</ul>
												</div>

											</div>
										</ul>
									</li>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Household<b class="caret"></b></a>
										<ul class="dropdown-menu multi-column columns-3">
											<div class="row">
												<div class="multi-gd-img">
													<ul class="multi-column-dropdown">
														<h6>All Household</h6>
														<li><a href="household.php">Cookware</a></li>
														<li><a href="household.php">Dust Pans</a></li>
														<li><a href="household.php">Scrubbers</a></li>
														<li><a href="household.php">Dust Cloth</a></li>
														<li><a href="household.php"> Mops </a></li>
														<li><a href="household.php">Kitchenware</a></li>
													</ul>
												</div>


											</div>
										</ul>
									</li>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Personal Care<b class="caret"></b></a>
										<ul class="dropdown-menu multi-column columns-3">
											<div class="row">
												<div class="multi-gd-img">
													<ul class="multi-column-dropdown">
														<h6>Baby Care</h6>
														<li><a href="personalcare.php">Baby Soap</a></li>
														<li><a href="personalcare.php">Baby Care Accessories</a></li>
														<li><a href="personalcare.php">Baby Oil & Shampoos</a></li>
														<li><a href="personalcare.php">Baby Creams & Lotion</a></li>
														<li><a href="personalcare.php"> Baby Powder</a></li>
														<li><a href="personalcare.php">Diapers & Wipes</a></li>
													</ul>
												</div>

											</div>
										</ul>
									</li>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Packaged Foods<b class="caret"></b></a>
										<ul class="dropdown-menu multi-column columns-3">
											<div class="row">
												<div class="multi-gd-img">
													<ul class="multi-column-dropdown">
														<h6>All Accessories</h6>
														<li><a href="packagedfoods.php">Baby Food</a></li>
														<li><a href="packagedfoods.php">Dessert Items</a></li>
														<li><a href="packagedfoods.php">Biscuits</a></li>
														<li><a href="packagedfoods.php">Breakfast Cereals</a></li>
														<li><a href="packagedfoods.php"> Canned Food </a></li>
														<li><a href="packagedfoods.php">Chocolates & Sweets</a></li>
													</ul>
												</div>


											</div>
										</ul>
									</li>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Beverages<b class="caret"></b></a>
										<ul class="dropdown-menu multi-column columns-3">
											<div class="row">
												<div class="multi-gd-img">
													<ul class="multi-column-dropdown">
														<h6>Tea & Coeffe</h6>
														<li><a href="beverages.php">Green Tea</a></li>
														<li><a href="beverages.php">Ground Coffee</a></li>
														<li><a href="beverages.php">Herbal Tea</a></li>
														<li><a href="beverages.php">Instant Coffee</a></li>
														<li><a href="beverages.php"> Tea </a></li>
														<li><a href="beverages.php">Tea Bags</a></li>
													</ul>
												</div>

											</div>
										</ul>
									</li>
									<li><a href="gourmet.php">Gourmet</a></li>
									<li><a href="offers.php">Offers</a></li>
									<li><a href="contact.php">Contact</a></li>
								</ul>
							</div>
							</nav>
			</div>
		</div>

<!-- //navigation -->
