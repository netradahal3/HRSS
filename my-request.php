<?php
    session_start();
    error_reporting(0);
    include('includes/config.php');
    if(strlen($_SESSION['login'])==0)
      {
    header('location:index.php');
    }
    else{
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
        <section class="page-header profile_page">
          <div class="container">
            <div class="page-header_wrap">
              <div class="page-heading">
                <h1>Room Request</h1>
              </div>
              <ul class="coustom-breadcrumb">
                <li><a href="#">Home</a></li>
                <li>My request</li>
              </ul>
            </div>
          </div>
          <!-- Dark Overlay-->
          <div class="dark-overlay"></div>
        </section>
<!-- /Page Header-->

        <?php
          $useremail=$_SESSION['login'];
          $sql = "SELECT * from tblusers where EmailId=:useremail";
          $query = $dbh -> prepare($sql);
          $query -> bindParam(':useremail',$useremail, PDO::PARAM_STR);
          $query->execute();
          $results=$query->fetchAll(PDO::FETCH_OBJ);
          $cnt=1;
          if($query->rowCount() > 0)
          {
          foreach($results as $result)
          {
        ?>
<section class="user_profile inner_pages">
  <div class="container">
    <div class="user_profile_info gray-bg padding_4x4_40">
      <div class="upload_user_logo">
        <img src="assets/images/dealer-logo.png" alt="image">
      </div>
      <div class="dealer_info">
        <h5><?php echo htmlentities($result->FullName);?></h5>
        <p><?php echo htmlentities($result->Address);?><br>
          <?php echo htmlentities($result->City);?>&nbsp;<?php echo htmlentities($result->Country); }}?></p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3 col-sm-3">
       <?php include('includes/sidebar.php');?>

      <div class="col-md-6 col-sm-8">
        <div class="profile_wrap">
          <h5 class="uppercase underline">My Request respond </h5>
          <div class="my_vehicles_list">
            <ul class="vehicle_listing">
                <?php
                    $useremail=$_SESSION['login'];
                     $sql = "SELECT tblroomdetail.Rimage1 as Rimage1,tblroomdetail.ROOMTITLE,tblroomdetail.id as rid,tblhouse.HouseName,tblrequest.FromDate,tblrequest.ToDate,tblrequest.message,tblrequest.Status
                     from tblrequest
                     join tblroomdetail on tblrequest.RoomId=tblroomdetail.id
                     join tblhouse on tblhouse.id=tblroomdetail.HouseName where tblrequest.userEmail=:useremail";
                    $query = $dbh -> prepare($sql);
                    $query-> bindParam(':useremail', $useremail, PDO::PARAM_STR);
                    $query->execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                    $cnt=1;
                    if($query->rowCount() > 0)
                    {
                    foreach($results as $result)
                    {
                  ?>

<li>
                <div class="room_img"> <a href="room-details.php?rid=<?php echo htmlentities($result->rid);?>""><img src="admin/img/Roomimages/<?php echo htmlentities($result->Rimage1);?>" alt="image"></a> </div>
                <div class="vehicle_title">
                  <h6><a href="room-details.php?rid=<?php echo htmlentities($result->rid);?>""> <?php echo htmlentities($result->HouseName);?> , <?php echo htmlentities($result->ROOMTITLE);?></a></h6>
                  <p><b>From Date:</b> <?php echo htmlentities($result->FromDate);?><br /> <b>To Date:</b> <?php echo htmlentities($result->ToDate);?></p>
                </div>
                <?php if($result->Status==1)
                { ?>
                        <div class="room-status"> <a href="#" class="btn outline btn-xs active-btn">Confirmed</a>
                           <div class="clearfix"></div>
                         </div>

              <?php } else if($result->Status==2) { ?>
 <div class="room-status"> <a href="#" class="btn outline btn-xs">Cancelled</a>
            <div class="clearfix"></div>
        </div>



                <?php } else { ?>
 <div class="room-status"> <a href="#" class="btn outline btn-xs">Not Confirm yet</a>
            <div class="clearfix"></div>
        </div>
                <?php } ?>
       <div style="float: left"><p><b>Message:</b> <?php echo htmlentities($result->message);?> </p></div>
              </li>
              <?php }} ?>


            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/my-vehicles-->
<?php include('includes/footer.php');?>

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
<?php } ?>
