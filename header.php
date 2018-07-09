<?php
// if (session_status() == PHP_SESSION_NONE) {
//   $_SESSION["logged_in"] = false;
//     session_start();
//     $_SESSION["logged_in"] = false;
// }
var_dump($_SESSION);
// if ($_SESSION["logged_in"] && $_SESSION["active"]==0) {
//   echo ' <div class="agileits_header" style="margin:auto;">
//      <div class="container">
//        <div class="agile-login">
//          <ul>
//            <li><a>Dear '.$_SESSION["username"].'! kindly activate your account.</a></li>
//          </ul>
//        </div>
//      </div>
//    </div>';
// }
 ?>


<div class="agileits_header">
  <div class="container">
    <div class="w3l_offers">
      <p>SALE UP TO 70% OFF. USE CODE "SALE70%" . <a href="products.php">SHOP NOW</a></p>
    </div>
    <div class="agile-login">
      <ul>
        <?php
        // if (session_status() != PHP_SESSION_NONE) {
        //   if($_SESSION["logged_in"] == true){
        //     echo "<li><a>Welcome ".$_SESSION["firstname"]."</a></li> ";
        //   }
        //   else {
            echo '<li><a href="registered.php"> Create Account </a></li>';
        //   }
        // }
         ?>
        <li>
          <?php
          if (session_status() != PHP_SESSION_NONE) {
            if($_SESSION["logged_in"] == true){
              echo '<a href="login.php" onclick="session_start()" >Logout</a>';

            }
            else {
              echo '<a href="login.php">Log In</a>';
    }
          }
          ?>
        </li>
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
