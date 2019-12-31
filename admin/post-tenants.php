<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{
  header('location:index.php');
}
else
  {
  if(isset($_POST['submit']))
  {
    $RT=$_POST['RT'];   $HN=$_POST['HN'];     $FN=$_POST['FN'];
    $HO=$_POST['HO'];   $PPM=$_POST['PPM'];   $BY=$_POST['BY'];   $TC=$_POST['TC'];
    $RI1=$_FILES["RI1"]["NAME"];   $RI2=$_FILES["RI2"]["NAME"];
    $AT=$_POST['AT'];               $AC=$_POST['AC'];
    $H2O=$_POST['H2O'];             $KT=$_POST['KT'];   $PK=$_POST['PK'];
    move_uploaded_file($_FILES["RI1"]["tmp_name"],"img/Roomimages/".$_FILES["RI1"]["name"]);
    move_uploaded_file($_FILES["RI2"]["tmp_name"],"img/Roomimages/".$_FILES["RI2"]["name"]);

    $sql="INSERT INTO tblroomdetail (ROOMTITLE, HouseName, FloorName, HouseOverview,
          PricePerMonth, BuildingYear, TenantsCapacity, Rimage1,
          Rimage2, AttachToilet, AirConditionar, Water, Kitchen,Parking)
          VALUES(:RT, :HN, :FN, :HO, :PPM, :BY, :TC, :RI1, :RI2, :AT, :AC, :H2O, :KT,:PK)";



      $query = $dbh->prepare($sql);
      $query->bindParam(':RT',$RT,PDO::PARAM_STR);
      $query->bindParam(':HN',$HN,PDO::PARAM_STR);
      $query->bindParam(':FN',$FN,PDO::PARAM_STR);
      $query->bindParam(':HO',$HO,PDO::PARAM_STR);
      $query->bindParam(':PPM',$PPM,PDO::PARAM_STR);
      $query->bindParam(':BY',$BY,PDO::PARAM_STR);
      $query->bindParam(':TC',$TC,PDO::PARAM_STR);
      $query->bindParam(':RI1',$RI1,PDO::PARAM_STR);
      $query->bindParam(':RI2',$RI2,PDO::PARAM_STR);
      $query->bindParam(':AT',$AT,PDO::PARAM_STR);
      $query->bindParam(':AC',$AC,PDO::PARAM_STR);
      $query->bindParam(':H2O',$H2O,PDO::PARAM_STR);
      $query->bindParam(':KT',$KT,PDO::PARAM_STR);
      $query->bindParam(':PK',$PK,PDO::PARAM_STR);
      $query->execute();
      $lastInsertId = $dbh->lastInsertId();
      if($lastInsertId)
      {
        $msg="Room Detail posted successfully";
      }
      else
      {
        // echo "Error: " . $sql . "<br>" . $conn->error;
        $error="Something went wrong. Please try again";
  }
}
 ?>

 <!doctype html>
<html lang="en" class="no-js">
  <head>
    <?php include('includes/head.php');?>
    <title>House Rental System | Admin Post Room Details</title>
    <style>
      .errorWrap
      {
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
            <h2 class="page-title">Post Room Details</h2>
            <div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Basic Info</div>
                  <?php if($error){?>
                    <div class="errorWrap">
                      <strong>ERROR</strong>:<?php echo htmlentities($error); ?>
                    </div><?php }
                    else if($msg){?>
                      <div class="succWrap">
                        <strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?>
                      </div>
                    <?php }?>
                    <div class="panel-body">
                      <form method="post" class="form-horizontal" enctype="multipart/form-data">
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Room Title
                            <span style="color:red">*</span>
                          </label>
                          <div class="col-sm-4">
                            <input type="text" id="RT" name="RT" class="form-control" required>
                          </div>
                          <label class="col-sm-2 control-label">Select House
                            <span style="color:red">*</span>
                          </label>
                          <div class="col-sm-4">
                            <select class="selectpicker" name="HN" id="HN" required>
                              <option value=""> Select </option>
                              <?php $ret="select id,HouseName from tblhouse";
                              $query= $dbh -> prepare($ret);
                              $query-> execute();
                              $results = $query -> fetchAll(PDO::FETCH_OBJ);
                              if($query -> rowCount() > 0)
                              {
                                foreach($results as $result)
                                {?>
                                  <option value="<?php echo htmlentities($result->id);?>">
                                    <?php echo htmlentities($result->HouseName);?></option>
                                <?php }} ?>
                              </select>
                            </div>
                          </div>

                          <div class="hr-dashed"></div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">Select Floor
                              <span style="color:red">*</span>
                            </label>
                            <div class="col-sm-4">
                              <select class="selectpicker" name="FN" id="FN" required>
                                <option value=""> Select </option>
                                <?php $ret="select id,FloorName from tblfloor";
                                $query= $dbh -> prepare($ret);
                                $query-> execute();
                                $results = $query -> fetchAll(PDO::FETCH_OBJ);
                                if($query -> rowCount() > 0)
                                {
                                  foreach($results as $result)
                                  {?>
                                    <option value="<?php echo htmlentities($result->id);?>">
                                      <?php echo htmlentities($result->FloorName);?></option>
                                  <?php }} ?>
                                </select>
                              </div>
                            <label class="col-sm-2 control-label">House/Flat/Room Overview
                              <span style="color:red">*</span>
                            </label>
                            <div class="col-sm-4">
                              <textarea class="form-control" id="HO" name="HO" rows="3" required></textarea>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-sm-2 control-label">Price Per Month(in NRP)
                              <span style="color:red">*</span>
                            </label>
                            <div class="col-sm-4">
                              <input type="text" name="PPM" id="PPM" class="form-control" required>
                            </div>
                            <!-- <label class="col-sm-2 control-label">Select Fuel Type
                              <span style="color:red">*</span>
                            </label>
                            <div class="col-sm-4">
                              <select class="selectpicker" name="fueltype" required>
                                <option value=""> Select </option>
                                <option value="Petrol">Petrol</option>
                                <option value="Diesel">Diesel</option>
                                <option value="CNG">CNG</option>
                              </select>
                            </div> -->
                            <label class="col-sm-2 control-label">BuildingYear
                              <span style="color:red">*</span>
                            </label>
                            <div class="col-sm-4">
                              <input type="date" name="BY" id="BY" class="form-control" required>
                            </div>
                          </div>
                          <div class="forrm-group">
                          <label class="col-sm-2 control-label">Tenants Capacity
                            <span style="color:red">*</span>
                          </label>
                          <div class="col-sm-4">
                            <input type="text" class="form-control" name="TC" id="TC" required>
                          </div>
                        </div>

                        <div class="hr-dashed"></div>
                        <div class="form-group">
                          <div class="col-sm-12">
                            <h4><b>Upload Images</b></h4>
                          </div>
                        </div></hr>
                        <div class="form-group">
                          <div class="col-sm-6">FIRST IMAGE
                            <span style="color:red">*</span>
                            <input type="file" name="RI1" required>
                          </div>
                          <div class="col-sm-6">SECOND IMAGE
                            <span style="color:red">*</span>
                            <input type="file" name="RI2" required>
                          </div>
                        </div>
                        <div class="hr-dashed"></div>
                    </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="panel panel-default">
                  <div class="panel-heading"><h3>Accessories</h3></div>
                    <div class="panel-body">
                      <div class="form-group">
                       <div class="col-sm-3">
                         <div class="checkbox checkbox-inline">
                           <input type="checkbox" id="AT" name="AT" value="1">
                           <label for="AT"> Attach Toilet</label>
                         </div>
                       </div>
                       <div class="col-sm-3">
                         <div class="checkbox checkbox-inline">
                           <input type="checkbox" id="AC" name="AC" value="1">
                           <label for="AC"> Air Conditionar </label>
                         </div>
                       </div>
                       <div class="col-sm-3">
                         <div class="checkbox checkbox-inline">
                           <input type="checkbox" id="H2O" name="H2O" value="1">
                           <label for="H2O"> Water </label>
                         </div>
                       </div>
                       <div class="col-sm-3">
                         <div class="checkbox checkbox-inline">
                           <input type="checkbox" id="KT" name="KT" value="1">
                           <label for="KT"> Kitchen  </label>
                         </div>
                       </div>
                     </div>
                     <div class="form-group">
                       <div class="col-sm-3">
                         <div class="checkbox checkbox-inline">
                           <input type="checkbox" id="PK" name="PK" value="1">
                           <label for="PK"> Parking </label>
                         </div>
                       </div>

                       <div class="form-group">
												<div class="col-sm-8 col-sm-offset-2">
													<button class="btn btn-default" type="reset">Cancel</button>
													<button class="btn btn-primary" name="submit" type="submit">Save changes</button>
												</div>
											</div>
                     </div>
                   </form>
                   </div>
                 </div>
               </div>
             </div>

<!-- ///////// -->
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
