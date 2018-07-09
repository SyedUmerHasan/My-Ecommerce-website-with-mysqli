<div class="col-md-4 products-left">
  <div class="categories">
    <h2>Categories</h2>
    <ul class="cate">
      <li><a href="products.php"><i class="fa fa-arrow-right" aria-hidden="true"></i>Fruits And Vegetables</a></li>
        <ul>
          <li><a href="products.php"><i class="fa fa-arrow-right" aria-hidden="true"></i>Cuts & Sprouts</a></li>
          <li><a href="products.php"><i class="fa fa-arrow-right" aria-hidden="true"></i>Flowers</a></li>
          <li><a href="products.php"><i class="fa fa-arrow-right" aria-hidden="true"></i>Fresh Herbs & Seasonings</a></li>
          <li><a href="products.php"><i class="fa fa-arrow-right" aria-hidden="true"></i>Fresh Vegetables</a> </li>
          <li><a href="products.php"><i class="fa fa-arrow-right" aria-hidden="true"></i>International Vegetables</a> </li>
          <li><a href="products.php"><i class="fa fa-arrow-right" aria-hidden="true"></i>Organic Fruits & Vegetables</a></li>
        </ul>
      <li><a href="products.php"><i class="fa fa-arrow-right" aria-hidden="true"></i>Grocery & Staples</a></li>
        <ul>
        <?php
        include_once "groceryitem.php";
        $myitem = new groceryitem();

         $myitem->getAllCategoryForMenu();
        ?>
        </ul>
      <li><a href="products.php"><i class="fa fa-arrow-right" aria-hidden="true"></i>PersonalCare</a></li>
        <ul>
          <li><a href="products.php"><i class="fa fa-arrow-right" aria-hidden="true"></i>Baby Care</a> </li>
          <li><a href="products.php"><i class="fa fa-arrow-right" aria-hidden="true"></i>Cosmetics</a> </li>
          <li><a href="products.php"><i class="fa fa-arrow-right" aria-hidden="true"></i>Deos & Perfumes</a> </li>
          <li><a href="products.php"><i class="fa fa-arrow-right" aria-hidden="true"></i>Skin Care</a> </li>
          <li><a href="products.php"><i class="fa fa-arrow-right" aria-hidden="true"></i>Sanitary Needs</a> </li>
          <li><a href="products.php"><i class="fa fa-arrow-right" aria-hidden="true"></i>Oral Care</a> </li>
          <li><a href="products.php"><i class="fa fa-arrow-right" aria-hidden="true"></i>Personal Hygiene</a> </li>
          <li><a href="products.php"><i class="fa fa-arrow-right" aria-hidden="true"></i>Shaving Needs</a></li>
        </ul>
    </ul>
  </div>
</div>
