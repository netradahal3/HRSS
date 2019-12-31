<?php
session_start();
include('includes/config.php');
error_reporting(0);
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
	<?php include('includes/head.php');?>
</head>
<body>

<!-- Start Switcher -->
<?php include('includes/colorswitcher.php');?>
<!-- /Switcher -->

<!--Header-->
<?php include('includes/header.php');?>
<!-- /Header -->

<!--Page Header-->
<section class="page-header listing_page">
  <div class="container">
    <div class="page-header_wrap">
      <div class="page-heading">
        <h1>Car Listing</h1>
      </div>
      <ul class="coustom-breadcrumb">
        <li><a href="#">Home</a></li>
        <li>House Listing</li>
      </ul>
    </div>
  </div>
  <!-- Dark Overlay-->
  <div class="dark-overlay"></div>
</section>
<!-- /Page Header-->

<!--Listing-->
<section class="listing-page">
  <div class="container">
    <div class="row">
      <div class="col-md-9 col-md-push-3">
        <div class="result-sorting-wrapper">
          <div class="sorting-count">
<?php
//Query for Listing count
$house=$_POST['house'];
$FloorName=$_POST['FloorName'];
$sql = "SELECT id from tblroomdetail where tblroomdetail.HouseName=:house and tblroomdetail.FloorName=:FloorName";
$query = $dbh -> prepare($sql);
$query -> bindParam(':house',$house, PDO::PARAM_STR);
$query -> bindParam(':FloorName',$FloorName, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=$query->rowCount();
?>
<p><span><?php echo htmlentities($cnt);?> Listings</span></p>
</div>
</div>

<?php

$sql = "SELECT tblroomdetail.*,tblhouse.HouseName,tblfloor.FloorName,tblhouse.id as hid,tblfloor.id as fid
from tblroomdetail
join tblhouse on tblhouse.id=tblroomdetail.HouseName
join tblfloor on tblfloor.id=tblroomdetail.FloorName
 where tblroomdetail.HouseName=:house and tblroomdetail.FloorName=:FloorName";
$query = $dbh -> prepare($sql);
$query -> bindParam(':house',$house, PDO::PARAM_STR);
$query -> bindParam(':FloorName',$FloorName, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{  ?>
        <div class="product-listing-m gray-bg">
          <div class="product-listing-img"><img src="admin/img/Roomimages/<?php echo htmlentities($result->Rimage1);?>" class="img-responsive" alt="Image" /> </a>
          </div>
          <div class="product-listing-content">
            <h5><a href="room-details.php?vhid=<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->HouseName);?> , <?php echo htmlentities($result->ROOMTITLE);?></a></h5>
            <p class="list-price">$<?php echo htmlentities($result->PricePerMonth);?> Per month</p>
            <ul>
              <li><i class="fa fa-user" aria-hidden="true"></i><?php echo htmlentities($result->TenantsCapacity);?> Room Capacity</li>
              <li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo htmlentities($result->BuildingYear);?> Establish date</li>
              <li><i class="fa fa-car" aria-hidden="true"></i><?php echo htmlentities($result->FloorName);?></li>
            </ul>
            <a href="room-details.php?vhid=<?php echo htmlentities($result->id);?>" class="btn">View Details <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></a>
          </div>
        </div>
      <?php }} ?>
         </div>

      <!--Side-Bar-->
      <aside class="col-md-3 col-md-pull-9">
        <div class="sidebar_widget">
          <div class="widget_heading">
            <h5><i class="fa fa-filter" aria-hidden="true"></i> Find Your  Room </h5>
          </div>
          <div class="sidebar_filter">
            <form action="#" method="get">
              <div class="form-group select">
                <select class="form-control">
                  <option>Select house</option>

                  <?php $sql = "SELECT * from  tblhouse ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{       ?>
<option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->HouseName);?></option>
<?php }} ?>

                </select>
              </div>
              <div class="form-group select">
                <select class="form-control">
                  <option>Select house</option>

                  <?php $sql = "SELECT * from  tblfloor ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{       ?>
<option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->FloorName);?></option>
<?php }} ?>

                </select>
              </div>

              <div class="form-group">
                <button type="submit" class="btn btn-block"><i class="fa fa-search" aria-hidden="true"></i> Search Room</button>
              </div>
            </form>
          </div>
        </div>

        <div class="sidebar_widget">
          <div class="widget_heading">
            <h5><i class="fa fa-car" aria-hidden="true"></i> Recently Listed Room</h5>
          </div>
          <div class="recent_addedcars">
            <ul>
<?php $sql = "SELECT tblroomdetail.*,tblhouse.HouseName,tblfloor.FloorName,tblhouse.id as hid, tblfloor.id as fid
from tblroomdetail
join tblhouse on tblhouse.id=tblroomdetail.HouseName
join tblfloor on tblfloor.id=tblroomdetail.FloorName
 order by id desc limit 4";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{  ?>

              <li class="gray-bg">
                <div class="recent_post_img"> <a href="room-details.php?vhid=<?php echo htmlentities($result->id);?>"><img src="admin/img/Roomimages/<?php echo htmlentities($result->Rimage1);?>" alt="image"></a> </div>
                <div class="recent_post_title"> <a href="room-details.php?vhid=<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->HouseName);?> , <?php echo htmlentities($result->ROOMTITLE);?></a>
                  <p class="widget_price">$<?php echo htmlentities($result->PricePerMonth);?> Per Month</p>

                </div>
              </li>
              <?php }} ?>

            </ul>
          </div>
        </div>
      </aside>
      <!--/Side-Bar-->
    </div>
  </div>
</section>
<!-- /Listing-->

<!--Footer -->
<?php include('includes/footer.php');?>
<!-- /Footer-->

<!--Back to top-->
<div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>
<!--/Back to top-->

<!--Login-Form -->
<?php include('includes/login.php');?>
<!--/Login-Form -->

<!--Register-Form -->
<?php include('includes/registration.php');?>

<!--/Register-Form -->

<!--Forgot-password-Form -->
<?php include('includes/forgotpassword.php');?>

<!-- Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/interface.js"></script>
<!--Switcher-->
<script src="assets/switcher/js/switcher.js"></script>
<!--bootstrap-slider-JS-->
<script src="assets/js/bootstrap-slider.min.js"></script>
<!--Slider-JS-->
<script src="assets/js/slick.min.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>

</body>
</html>
