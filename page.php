<?php
include "Database.php";
class page extends Database
{
  protected $connectionstring;
  function __construct()
  {

  }
  public function GetHeader()
  {

  }
  public function GetBreadcrumb($BreadcrumbTitle)
  {
    echo '	<div class="breadcrumbs">
    		<div class="container">
    			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
    				<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
    				<li class="active">'.$BreadcrumbTitle.'</li>
    			</ol>
    		</div>
    	</div>';
  }
  public function GetFooter()
  {
    include "footer.php";
  }
  public function GetCrousel()
  {
    include "slider.php";
  }

}

 ?>
