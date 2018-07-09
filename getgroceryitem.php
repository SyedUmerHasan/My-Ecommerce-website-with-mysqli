<?php
include "groceryitem.php";
$myitem = new groceryitem();
if(isset($_POST["addcategory"]))
{
  $myitem->addcategory($_POST["category_name"]);
  unset($_POST["category_name"]);
}

if(isset($_POST["addbranch"]))
{
  $myitem->addbranch($_POST["branch_name"]);
  unset($_POST["branch_name"]);
}

if(isset($_POST["submitgrocerydetails"]))
{
   $grocery_item_name = $_POST["item_name"];
   $grocery_item_price = $_POST["item_price"];
   $grocery_item_discount = $_POST["discount"];
   $grocery_item_description = $_POST["description"];
   $grocery_item_image_name = $_POST["image_name"];
   $grocery_item_category = $_POST["category"];
  // echo var_dump($_FILES);
  // echo "<br>";
  
  $target_dir = "img/groceries/";
  $uploadOk = 1;
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  $target_file = $target_dir.$grocery_item_image_name.".".$imageFileType;
// Check if image file is a actual image or fake image
  if(isset($_POST["submitgrocerydetails"])) {
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {
          echo "File is an image - " . $check["mime"] . ".";
          $uploadOk = 1;
      } else {
          echo "File is not an image.";
          $uploadOk = 0;
      }
  }
  // Check if file already exists
  if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
  }
  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 500000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
  }
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
  }
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
          echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
          $grocery_item_discountedprice = $grocery_item_price - $grocery_item_discount;
        
          $myitem->addGroceryItem($grocery_item_name,$grocery_item_price,$grocery_item_discountedprice,
          $grocery_item_description,$target_file,$grocery_item_category,$grocery_item_discount);
      } else {
          echo "Sorry, there was an error uploading your file.";
      }
  }
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Grocery Item Admin Panel</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
  </head>
  <body>
  <div class="container">
    <h2>Enter new grocery Item</h2>
    <form action="#" method="post" enctype="multipart/form-data">
      <fieldset class="form-group">
        <label for="exampleInputEmail1">Product name </label>
        <input type="text" class="form-control" name="item_name" placeholder="Enter product name ">
        <small class="text-muted">Please enter the name of the product (Required)</small>
      </fieldset>
      <fieldset class="form-group">
        <label for="exampleInputEmail1">Product price in PKR</label>
        <input type="text" class="form-control" name="item_price" placeholder="Enter product price ">
        <small class="text-muted">Please enter the price of the product (Required)</small>
      </fieldset>
      <!-- <fieldset class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
      </fieldset> -->
      <fieldset class="form-group">
        <label for="exampleSelect1">Discount amount in PKR</label>
        <select class="form-control" name="discount" >
        <?php
        for($i = 0; $i <250 ;$i++)
        {
          echo "<option value=".$i.">".$i."</option>";
        }
        ?>
        </select>
      </fieldset>
      <!-- <fieldset class="form-group">
        <label for="exampleSelect2">Example multiple select</label>
        <select multiple class="form-control" id="exampleSelect2">
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
          <option>5</option>
        </select>
      </fieldset> -->
      <fieldset class="form-group">
        <label for="exampleTextarea">Description </label>
        <textarea class="form-control" name="description" rows="3"></textarea>
      </fieldset>
      <fieldset class="form-group">
        <label for="exampleInputEmail1">Image name </label>
        <input type="text" class="form-control" name="image_name" placeholder="Enter Image name ">
        <small class="text-muted">Please enter the name of the image (Required)</small>
      </fieldset>
      <fieldset class="form-group">
        <label for="exampleInputFile">Upload product image </label>
        <input type="file" name="fileToUpload" id="fileToUpload" class="form-control-file" required="">
        <small class="text-muted">Please enter the image of the product. (Required)</small>
      </fieldset>

      <fieldset class="form-group">
        <label for="exampleSelect1">Select category</label>
        <select class="form-control" name="category">
          <?php
          $myitem->getAllCategory();
          ?>
        </select>
      </fieldset>


      
      <!-- <div class="radio">
        <label>
          <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
          Option one is this and that&mdash;be sure to include why it's great
        </label>
      </div>
      <div class="radio">
        <label>
          <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
          Option two can be something else and selecting it will deselect option one
        </label>
      </div>
      <div class="radio disabled">
        <label>
          <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3" disabled>
          Option three is disabled
        </label>
      </div>
      <div class="checkbox">
        <label>
          <input type="checkbox"> Check me out
        </label>
      </div> -->
      <button type="submit" name="submitgrocerydetails" class="btn btn-primary">Submit</button>
    </form>
  </div>
  <br>
  <br>
  <br>
  
  <div class="container">
    <div class="col-lg-6 col-sm-12  col-xs-12 ">
    <h2>Add new Category</h2>
      <form method="post">
            <fieldset class="form-group">
              <label for="exampleInputEmail1">Create new Category </label>
              <input type="text" class="form-control" name="category_name" required=" " placeholder="Enter new Category name ">
              <small class="text-muted">Please enter the name of the Category(Required)</small>
            </fieldset>
            <button type="submit" name="addcategory" class="btn btn-primary">Add category</button>
      </form>
    </div>
    
    <div class="col-lg-6 col-sm-12  col-xs-12 ">
    <h2>Add new branch</h2>
      <form method="post">
            <fieldset class="form-group">
              <label for="exampleInputEmail1">Create new Branch </label>
              <input type="text" class="form-control" name="branch_name" required=" " placeholder="Enter new branch name ">
              <small class="text-muted">Please enter the name of the image (Required)</small>
            </fieldset>
            <button type="submit" name="addbranch" class="btn btn-primary">Add branch</button>
      </form>
    </div>
    
  </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
  </body>
</html>
