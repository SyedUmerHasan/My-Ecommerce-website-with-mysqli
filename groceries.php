
<?php
include "Database.php";
include "groceryitem.php";
$mydb = new Database("ecommerce","user");
$myitem =  new groceryitem();

	if(isset($_POST["paginatesorting"]))
	{
		$paginatesorting = $_POST["paginatesorting"];
	}
	else {
		$paginatesorting = null;
	}

	if(isset($_GET["paginateitems"]))
	{
		$paginateitems = $_GET["paginateitems"];
	}
	else {
		$paginateitems = 9;
	}
	if(isset($_GET["page"]))
	{
		$page = $_GET["page"];
	}
	else {
		$page = 1;
	}
	$myvalidpage = $myitem->GetAllitemCount("groceryitems");
	$myvalidpage/=$paginateitems;
	$myvalidpage = ceil($myvalidpage);
	var_dump($page);
	var_dump("$myvalidpage");
		
	if($page > "$myvalidpage")
	{
		header("Location : index.php?paginatesorting=$paginatesorting&paginateitems=$paginateitems&page=$page");
	}
 ?>
 <!doctype html>
 <html>
 <head>
 <title>orderkarao.pk an Ecommerce Online Shopping Category Flat Bootstrap Responsive Website Template | Groceries :: w3layouts</title>
 <!-- for-mobile-apps -->
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta name="keywords" content="orderkarao.pk Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
 Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
 <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
 		function hideURLbar(){ window.scrollTo(0,1); } </script>
 <!-- //for-mobile-apps -->
 <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
 <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
 <!-- font-awesome icons -->
 <link href="css/font-awesome.css" rel="stylesheet">
 <!-- //font-awesome icons -->
 <!-- js -->
 <script src="js/jquery-1.11.1.min.js"></script>
 <!-- //js -->
 <link href='//fonts.googleapis.com/css?family=Raleway:400,100,100italic,200,200italic,300,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic' rel='stylesheet' type='text/css'>
 <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
 <!-- start-smoth-scrolling -->
 <script type="text/javascript" src="js/move-top.js"></script>
 <script type="text/javascript" src="js/easing.js"></script>
 <script type="text/javascript">
 	jQuery(document).ready(function($) {
 		$(".scroll").click(function(event){
 			event.preventDefault();
 			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
 		});
 	});
 </script>
 <!-- start-smoth-scrolling -->
 </head>

 <body>
 <!-- header -->
 	<?php
  include "navbar.php";
   ?>
 <!-- //navigation -->
 <!-- breadcrumbs -->
 	<div class="breadcrumbs">
 		<div class="container">
 			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
 				<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
 				<li class="active">Groceries</li>
 			</ol>
 		</div>
 	</div>
 <!-- //breadcrumbs -->
 <!--- groceries --->
 	<div class="products">
 		<div class="container">
      <?php
      include "category.php";
       ?>

	 	<form>
 			<div class="col-md-8 products-right">
 				<div class="products-right-grid">
 					<div class="products-right-grids">
 						<div class="sorting">
 							<select onchange='this.form.submit()' name="paginatesorting" id="paginatesorting" class="frm-field required sect">
 								<option value="item_name" selected><i class="fa fa-arrow-right" aria-hidden="true"></i>Default sorting</option>
 								<option value="null"><i class="fa fa-arrow-right" aria-hidden="true"></i>Sort by popularity</option>
 								<option value="null"><i class="fa fa-arrow-right" aria-hidden="true"></i>Sort by average rating</option>
 								<option value="item_discountprice"><i class="fa fa-arrow-right" aria-hidden="true"></i>Sort by price</option>
 							</select>
 						</div>
 						<div class="sorting-left">
 							<select onchange='this.form.submit()' name="paginateitems" id="paginateitems" class="frm-field required sect">
 								<option value="9"><i class="fa fa-arrow-right" aria-hidden="true"></i>Default Items</option>
 								<option value="9"><i class="fa fa-arrow-right" aria-hidden="true"></i>Item on page 9</option>
 								<option value="18"><i class="fa fa-arrow-right" aria-hidden="true"></i>Item on page 18</option>
 								<option value="30"><i class="fa fa-arrow-right" aria-hidden="true"></i>Item on page 32</option>
 								<option value="100"><i class="fa fa-arrow-right" aria-hidden="true"></i>All</option>
 							</select>
 						</div>
						 <input type="hidden" name="page" value="<?php echo $page; ?>" />
 						<div class="clearfix"> </div>
 					</div>
 				</div>
	 		</form>
<?php
	$count = $myitem->getAllGroceryItem($page,$paginateitems,$paginatesorting);
	var_dump($count);
	$totalpage =  ceil($count/$paginateitems);
	var_dump($totalpage);

	 /*
	 
	 Left yahan py 
	 totalpage me number of pages agye hain just link ko pakka karna hai 
	 disable type
	 
	 */





?>
 						<div class="clearfix"> </div>

 				<nav class="numbering">
 					<ul class="pagination paging">
 						<li>
 							<a href="?paginatesorting=<?php echo $paginatesorting ?>&paginateitems=<?php echo $paginateitems; ?>&page=<?php echo $page-1 ?>" aria-label="Previous">
 								<span aria-hidden="true">&laquo;</span>
 							</a>
 						</li>
 						<li class="active"><a href=""><?php echo $page++ ?><span class="sr-only">(current)</span></a></li>
 						<li><a href="?paginatesorting=<?php echo $paginatesorting ?>&paginateitems=<?php echo $paginateitems; ?>&page=<?php echo $page ?>"><?php echo $page++ ?></a></li>
 						<li><a href="?paginatesorting=<?php echo $paginatesorting ?>&paginateitems=<?php echo $paginateitems; ?>&page=<?php echo $page ?>"><?php echo $page++ ?></a></li>
 						<li><a href="?paginatesorting=<?php echo $paginatesorting ?>&paginateitems=<?php echo $paginateitems; ?>&page=<?php echo $page ?>"><?php echo $page++ ?></a></li>
 						<li><a href="?paginatesorting=<?php echo $paginatesorting ?>&paginateitems=<?php echo $paginateitems; ?>&page=<?php echo $page ?>"><?php echo $page++ ?></a></li>
 						<li>
 							<a href="?paginatesorting=<?php echo $paginatesorting ?>&paginateitems=<?php echo $paginateitems; ?>&page=<?php echo $page+1 ?>" aria-label="Next">
 							<span aria-hidden="true">&raquo;</span>
 							</a>
 						</li>
 					</ul>
 				</nav>
 			</div>
 			<div class="clearfix"> </div>
 		</div>
 	</div>
 <!--- groceries --->
 <!-- //footer -->
<?php
  include "footer.php";
 ?>
 <!-- //footer -->
 <!-- Bootstrap Core JavaScript -->
 <script src="js/bootstrap.min.js"></script>
 <!-- top-header and slider -->
 <!-- here stars scrolling icon -->
 	<script type="text/javascript">
 		$(document).ready(function() {
 			/*
 				var defaults = {
 				containerID: 'toTop', // fading element id
 				containerHoverID: 'toTopHover', // fading element hover id
 				scrollSpeed: 1200,
 				easingType: 'linear'
 				};
 			*/

 			$().UItoTop({ easingType: 'easeOutQuart' });

 			});
 	</script>
 <!-- //here ends scrolling icon -->
 <script src="js/minicart.min.js"></script>
 <script>
 	// Mini Cart
 	paypal.minicart.render({
 		action: '#'
 	});

 	if (~window.location.search.indexOf('reset=true')) {
 		paypal.minicart.reset();
 	}
 </script>
 <!-- main slider-banner -->
 <script src="js/skdslider.min.js"></script>
 <link href="css/skdslider.css" rel="stylesheet">
 <script type="text/javascript">
 		jQuery(document).ready(function(){
 			jQuery('#demo1').skdslider({'delay':5000, 'animationSpeed': 2000,'showNextPrev':true,'showPlayButton':true,'autoSlide':true,'animationType':'fading'});

 			jQuery('#responsive').change(function(){
 			  $('#responsive_wrapper').width(jQuery(this).val());
 			});

 		});
 </script>
 <!-- //main slider-banner -->

 </body>
 </html>
