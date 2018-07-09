<?php
include "Database.php";
$mydb = new Database("ecommerce","user");
 ?>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if (!isset($_POST["emailaddress"],$_POST["password"])) {
  header("location:login.php");
}
$email = $_POST["emailaddress"];

$sql = "SELECT * from user where emailaddress='$email'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0)
{
  $user = mysqli_fetch_assoc($result);
  if(password_verify($_POST["password"] ,$user["password"]))
  {
    $_SESSION["emailaddress"] = $user["emailaddress"];
    $_SESSION["firstname"] = $user["firstname"];
    $_SESSION["lastname"] = $user["lastname"];
    $_SESSION["username"] = $user["username"];
    $_SESSION["mobilenumber"] = $user["mobilenumber"];
    $_SESSION["active"] = $user["active"];
    $_SESSION["logged_in"] = true;

  }
  else
  {
    $_SESSION["logged_in"] = false;
    $_SESSION["errormessage"] = "You have entered wrong password,try again";
    // header("location: registrationform.php");
  }

} else {
    echo "0 results";
}

mysqli_close($conn);
 ?>
 <!doctype html>
 <html>
 <head>
 <title>orderkarao.pk an Ecommerce Online Shopping Category Flat Bootstrap Responsive Website Template | Registered :: w3layouts</title>
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
 <!-- //header -->
 <?php
  include"navbar.php"; ?>

 <!-- navigation -->

 <!-- //navigation -->
 <!-- breadcrumbs -->
 	<div class="breadcrumbs">
 		<div class="container">
 			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
 				<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
 				<li class="active">Log In error </li>
 			</ol>
 		</div>
 	</div>
 <!-- //breadcrumbs -->
 <!-- register -->
 	<div class="register">
 		<div class="container">
 			<h2>Log In error</h2>
       <br><br><br><br>
 			<div class="text-center">
         <h4>
           <?php
           if (isset($_SESSION["errormessage"])) {
             if($_SESSION['errormessage'] == "User with this Email Address is already registered")
             {
               echo $_SESSION["errormessage"];
             }
             elseif ($_SESSION['errormessage'] == "User with that email does not exist") {
               echo $_SESSION["errormessage"];
             }
             else {
               if (isset($_SESSION["errormessage"])) {
                 echo $_SESSION["errormessage"];
               }
               echo "<br>";
               echo "<br>";
               if (isset($_SESSION["message"])) {
                 echo $_SESSION["message"];
               }
             }
           }
           ?>
         </h4>
         <?php
         var_dump($_POST);
         var_dump($_SESSION);
          ?>
 			</div>
 			<div class="register-home">
 				<a href="index.php">Home</a>
 			</div>
 		</div>
 	</div>


 <!-- //register -->
 <!-- //footer -->
 <?php include"footer.php"; ?>
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
