<?php
  session_start();
  error_reporting(0);
  include('includes/config.php');
  if(strlen($_SESSION['alogin'])==0)
  {
    header('location:index.php');
  }else
  {
    if(isset($_REQUEST['del']))
	{
    $delid=intval($_GET['del']);
    $sql = "delete from tblroomdetail  WHERE  id=:delid";
    $query = $dbh->prepare($sql);
    $query -> bindParam(':delid',$delid, PDO::PARAM_STR);
    $query -> execute();
    $msg="house detail  record deleted successfully";
  }
?>
<!doctype html>
<html lang="en" class="no-js">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">
      <meta name="theme-color" content="#3e454c">
      <title>HOUSE RENTAL SYSTEM |Admin Manage ROOM details   </title>
      <!-- Font awesome/bootstrap css/bootstrap datatable/Bootstrap library/CSS/ -->
      <link rel="stylesheet" href="css/font-awesome.min.css">
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
      <link rel="stylesheet" href="css/bootstrap-social.css">
      <link rel="stylesheet" href="css/bootstrap-select.css">
      <link rel="stylesheet" href="css/fileinput.min.css">
      <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
      <link rel="stylesheet" href="css/style.css">
        <style>
		       .errorWrap {
            padding: 10px;
            margin: 0 0 20px 0;
            background: #fff;
            border-left: 4px solid #dd3d36;
            -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
            box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
            }
            .succWrap{
            padding: 10px;
            margin: 0 0 20px 0;
            background: #fff;
            border-left: 4px solid #5cb85c;
            -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
            box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
          }
		     </style>
  </head>
  <body>
    <?php include('includes/header.php');?>
    <div class="ts-main-content">
      <?php include('includes/leftbar.php');?>
      <div class="content-wrapper">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <h2 class="page-title">Manage Room Details</h2>
              <!-- Zero Configuration Table -->
              <div class="panel panel-default">
                <div class="panel-heading">Room Details</div>
                <div class="panel-body">
                  <?php if($error){?>
                    <div class="errorWrap">
                      <strong>ERROR</strong>:<?php echo htmlentities($error); ?>
                    </div><?php }
                    else if($msg){?>
                      <div class="succWrap">
                        <strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?>
                      </div><?php }?>
                      <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Room Title</th>
                            <th>House Name</th>
                            <th>Floor Name</th>
                            <th>House Overview</th>
                            <th>Price per Month</th>
                            <th>Building Year</th>
                            <th>Tenants Capacity</th>
                            <th>Action</th>
                          </tr>
                        <thead>
                        <tfoot>
                          <tr>
                            <th>#</th>
                            <th>Room Title</th>
                            <th>House Name</th>
                            <th>Floor Name</th>
                            <th>House Overview</th>
                            <th>Price per Month</th>
                            <th>Building Year</th>
                            <th>Tenants Capacity</th>
                            <th>Action</th>
                          </tr>
                        </tfoot>
                        <tbody>
                          <?php
                          $sql = "SELECT tblroomdetail.*,tblhouse.HouseName,tblfloor.FloorName,tblhouse.id as hid,tblfloor.id as fid
                                  FROM tblroomdetail
                                  JOIN tblhouse ON tblhouse.id=tblroomdetail.HouseName
                                  JOIN tblfloor ON tblfloor.id=tblroomdetail.FloorName";



                          $query = $dbh -> prepare($sql);
                          $query->execute();
                          $results=$query->fetchAll(PDO::FETCH_OBJ);
                          $cnt=1;

                          if($query->rowCount() > 0)
                          {foreach($results as $result)
                            {
                              ?>
                              <tr>
                                <td><?php echo htmlentities($cnt);?></td>
                                <td><?php echo htmlentities($result->RoomTitle);?></td>
											          <td><?php echo htmlentities($result->HouseName);?></td>
                                <td><?php echo htmlentities($result->FloorName);?></td>
                                <td><?php echo htmlentities($result->HouseOverview);?></td>
                                <td><?php echo htmlentities($result->PricePerMonth);?></td>
                                <td><?php echo htmlentities($result->BuildingYear);?></td>
                                <td><?php echo htmlentities($result->TenantsCapacity);?></td>
                                <td><a href="edit-room.php?id=<?php echo $result->id;?>">
                                  <i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                <a href="manage-tenants.php?del=<?php echo $result->id;?>" onclick="return confirm('Do you want to delete');"><i class="fa fa-close"></i></a></td>
                              </tr>
                              <?php $cnt=$cnt+1; }} ?>

                        </tbody>
                      </table>
                      <!-- 141 -->

                  <!-- 145 -->
                </div>
              </div>

                  <!-- 150 -->
            </div>
          </div>
        </div>
      </div>
    </div>

      <!-- Loading Scripts -->
	    <script src="js/jquery.min.js"></script>
	    <script src="js/bootstrap-select.min.js"></script>
	    <script src="js/bootstrap.min.js"></script>
	    <script src="js/jquery.dataTables.min.js"></script>
	    <script src="js/dataTables.bootstrap.min.js"></script>
	    <script src="js/Chart.min.js"></script>
	    <script src="js/fileinput.js"></script>
	    <script src="js/chartData.js"></script>
	    <script src="js/main.js"></script>
  </body>

</html>
<?php } ?>
