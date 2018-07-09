

<?php
include_once "Database.php";
class groceryitem{
    public $category;
    public $connection;    
    function __construct()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "ecommerce";

        // Create connection
        $this->connection = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }
    function __destruct()
    {
        $this->connection->close();
    }

    public function addbranch($branchname)
    {
        $branchitems = $branchname."items";
        $sql ="CREATE TABLE `".$branchitems."` (
        `item_id` int(6) unsigned NOT NULL AUTO_INCREMENT,
        `item_name` varchar(50) DEFAULT NULL,
        `item_price` varchar(10) NOT NULL,
        `item_discountprice` varchar(10) NOT NULL,
        `item_description` varchar(200) NOT NULL,
        `item_imagelocation` varchar(75) NOT NULL,
        `item_category` varchar(50) NOT NULL,
        `item_discountamount` varchar(10) NOT NULL,
        PRIMARY KEY (`item_id`)
        )
        ";
        if ($this->connection->query($sql) === TRUE) {
            echo "Table $branchname created successfully";
        } else {
            echo "Error creating table: " . $this->connection->error;
        }

        $branchcategory = $branchname."category";
        $sql ="
        ALTER TABLE category
        ADD ".$branchcategory." varchar(50)
        ";
        if ($this->connection->query($sql) === TRUE) {
            echo "New table $branchname category created successfully";
        } else {
            echo "Error creating column: " . $this->connection->error;
        }

        $sql = "INSERT INTO items (itemname,itemcolumn,itemtable)
        VALUES ($branchname,$branchcategory,$branchitems)";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }


    }

    public function getAllCategory()
    {
        $sql = "SELECT DISTINCT  grocerycategory FROM category";
        $result = mysqli_query($this->connection, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                $myvar = $row["grocerycategory"];
                echo "<option value='".$myvar."'>".$row["grocerycategory"]."</option>";
            }
        } 
        else
        {
            echo "0 results";
        }

    }
    public function getAllCategoryForMenu()
    {
        $sql = "SELECT DISTINCT  grocerycategory FROM category";
        $result = mysqli_query($this->connection, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                $myvar = $row["grocerycategory"];
                echo '<li><a href="products.php?category=grocerycategory&item=groceryitems&subcategory='.urlencode($myvar).'"><i class="fa fa-arrow-right" aria-hidden="true"></i>'.$myvar.'</a></li>';
            }
        } 
        else
        {
            echo "No categories";
        }
    }
    public function addcategory($categoryname)
    {
        $sql = "INSERT INTO category (grocerycategory) VALUES ('$categoryname')";
        if (mysqli_query($this->connection, $sql)) {
            echo "New record with value = $categoryname created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($this->connection);
        }
    }

    public function addGroceryItem($name,$price,$discount,$description,$imagelocation,$category,$discountamount)
    {
        $sql = "INSERT INTO groceryitems (item_name,item_price,item_discountprice,
        item_description,item_imagelocation,item_category,item_discountamount) VALUES
        ('$name','$price','$discount','$description','$imagelocation','$category','$discountamount')";
        if (mysqli_query($this->connection, $sql)) {
            echo "New record with value = $category created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($this->connection);
        }
    }
    public function GetAllitemCount($tablename)
    {
        $sql = "SELECT * FROM $tablename";
        $result = mysqli_query($this->connection, $sql);
        return mysqli_num_rows($result);
    }
    public function getAllGroceryItem($page,$paginateitems,$paginatesorting)
    {
        $i = 0;
        $from = ($page - 1) * $paginateitems;
        $sql = "SELECT * FROM groceryitems  ORDER BY '$paginatesorting' LIMIT $from , $paginateitems";
        $result = mysqli_query($this->connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $i++;
                if($i % 3  == 0)
                {
                    echo '<div class="agile_top_brands_grids">';
                }
                echo '
                <div class="col-md-4 top_brand_left">
 						<div class="hover14 column">
 							<div class="agile_top_brand_left_grid">
 								<div class="agile_top_brand_left_grid_pos">
 									<img src="images/offer.png" alt=" " class="img-responsive">
 								</div>
 								<div class="agile_top_brand_left_grid1">
 									<figure>
 										<div class="snipcart-item block">
 											<div class="snipcart-thumb">
 												<a href="single.php"><img title="'.$row["item_description"].'" alt=" " src="'.$row["item_imagelocation"].'"></a>
 												<p>'.$row["item_name"].'</p>
 												<h4>'.$row["item_discountprice"].'PKR<span>'.$row["item_price"].'</span></h4>
 											</div>
 											<div class="snipcart-details top_brand_home_details">
 												<form action="#" method="post">
 													<fieldset>
 														<input type="hidden" name="cmd" value="_cart">
 														<input type="hidden" name="add" value="1">
 														<input type="hidden" name="business" value=" ">
 														<input type="hidden" name="item_name" value="'.$row["item_name"].'">
 														<input type="hidden" name="amount" value="'.$row["item_price"].'">
 														<input type="hidden" name="discount_amount" value="'.$row["item_discountamount"].'">
 														<input type="hidden" name="currency_code" value="USD">
 														<input type="hidden" name="return" value=" ">
 														<input type="hidden" name="cancel_return" value=" ">
 														<input type="submit" name="submit" value="Add to cart" class="button">
 													</fieldset>
 												</form>
 											</div>
 										</div>
 									</figure>
 								</div>
 							</div>
 						</div>
                    </div>';
                if($i % 3  == 0)
                {
                    echo '<div class="clearfix"> </div>';
                    echo '</div>';
                }

            } /*End while loop*/ 
        } else {
            echo "0 results";
        }
        
        $sql = "SELECT * FROM groceryitems";
         $result = mysqli_query($this->connection, $sql);
        return mysqli_num_rows($result);
    }


    public function getAllItem($subcategory)
    {
        $i = 0;
        $sql = "SELECT * FROM groceryitems where item_category='$subcategory'";
        $result = mysqli_query($this->connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $i++;
                if($i % 3  == 0)
                {
                    echo '<div class="agile_top_brands_grids">';
                }
                echo '
                <div class="col-md-4 top_brand_left">
 						<div class="hover14 column">
 							<div class="agile_top_brand_left_grid">
 								<div class="agile_top_brand_left_grid_pos">
 									<img src="images/offer.png" alt=" " class="img-responsive">
 								</div>
 								<div class="agile_top_brand_left_grid1">
 									<figure>
 										<div class="snipcart-item block">
 											<div class="snipcart-thumb">
 												<a href="single.php?row='.http_build_query($row).'&subcategory='.urlencode($subcategory).'"><img title="'.$row["item_description"].'" alt=" " src="'.$row["item_imagelocation"].'"></a>
 												<p>'.$row["item_name"].'</p>
 												<h4>'.$row["item_discountprice"].'PKR<span>'.$row["item_price"].'</span></h4>
 											</div>
 											<div class="snipcart-details top_brand_home_details">
 												<form action="#" method="post">
 													<fieldset>
 														<input type="hidden" name="cmd" value="_cart">
 														<input type="hidden" name="add" value="1">
 														<input type="hidden" name="business" value=" ">
 														<input type="hidden" name="item_name" value="'.$row["item_name"].'">
 														<input type="hidden" name="amount" value="'.$row["item_price"].'">
 														<input type="hidden" name="discount_amount" value="'.$row["item_discountamount"].'">
 														<input type="hidden" name="currency_code" value="USD">
 														<input type="hidden" name="return" value=" ">
 														<input type="hidden" name="cancel_return" value=" ">
 														<input type="submit" name="submit" value="Add to cart" class="button">
 													</fieldset>
 												</form>
 											</div>
 										</div>
 									</figure>
 								</div>
 							</div>
 						</div>
                    </div>';
                if($i % 3  == 0)
                {
                    echo '<div class="clearfix"> </div>';
                    echo '</div>';
                }

            } /*End while loop*/ 
        } else {
            header("Location : ?paginatesorting=<?php echo $paginatesorting ?>&paginateitems=<?php echo $paginateitems; ?>&page=<?php echo $page-1 ?>");
        }
    }
}
?>