<?php
      session_start();
      error_reporting(0);
      include('includes/config.php');
      if(strlen($_SESSION['alogin'])==0)
	       {
           header('location:index.php');
         }
         else{

          if(isset($_POST['submit']))
           {
             $roomtitle=$_POST['roomtitle'];
             $house=$_POST['housename'];
             $floor=$_POST['floorname'];
             $overview=$_POST['overview'];
             $pricepermonth=$_POST['pricepermonth'];
             $buildingyear=$_POST['buildingyear'];
             $tenantscapacity=$_POST['tenantscapacity'];
             $attachtoilet=$_POST['attachtoilet'];
             $AC=$_POST['AC'];
             $water=$_POST['water'];
             $kitchen=$_POST['kitchen'];
             $parking=$_POST['parking'];
             $id=intval($_GET['id']);

             $sql="update tblroomdetail SET
             ROOMTITLE=:roomtitle, HouseName=:house, FloorName=:floor, HouseOverview=:overview,
             PricePerMonth=:pricepermonth,BuildingYear=:buildingyear, TenantsCapacity=:tenantscapacity,
             AttachToilet=:attachtoilet,AirConditionar=:AC, Water=:water, Parking=:parking where id=:id ";

             $query = $dbh->prepare($sql);
             $query->bindParam(':roomtitle',$roomtitle,PDO::PARAM_STR);
             $query->bindParam(':house',$house,PDO::PARAM_STR);
             $query->bindParam(':floor',$floor,PDO::PARAM_STR);
             $query->bindParam(':overview',$overview,PDO::PARAM_STR);
             $query->bindParam(':pricepermonth',$pricepermonth,PDO::PARAM_STR);
             $query->bindParam(':buildingyear',$buildingyear,PDO::PARAM_STR);
             $query->bindParam(':tenantscapacity',$tenantscapacity,PDO::PARAM_STR);
             $query->bindParam(':attachtoilet',$attachtoilet,PDO::PARAM_STR);
             $query->bindParam(':AC',$AC,PDO::PARAM_STR);
             $query->bindParam(':water',$water,PDO::PARAM_STR);
             $query->bindParam(':kitchen',$kitchen,PDO::PARAM_STR);
             $query->bindParam(':parking',$parking,PDO::PARAM_STR);
             $query->bindParam(':id',$id,PDO::PARAM_STR);
             $query->execute();

             $msg="Data updated successfully";
           } ?>

<!doctype html>
<html lang="en" class="no-js">

    <head>

      <title>House Rental System | Admin Edit Room Details Info</title>
      <?php include('includes/head.php');?>
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
                <h2 class="page-title">Edit Room Details</h2>
                <div class="row">
                  <div class="col-md-12">
                    <div class="panel panel-default">
                      <div class="panel-heading">Basic Info</div>
                      <div class="panel-body">
                        <?php if($msg){?>
                          <div class="succWrap">
                            <strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?>
                          </div><?php } ?>
                          <?php
                          $id=intval($_GET['id']);
                          $sql="SELECT tblroomdetail.*,tblhouse.HouseName,tblhouse.id as hid, tblfloor.FloorName,tblfloor.id as fid
                          FROM tblroomdetail
                          JOIN tblhouse ON tblhouse.id=tblroomdetail.HouseName
                          JOIN tblfloor ON tblfloor.id=tblroomdetail.FloorName
                          WHERE tblroomdetail.id=:id";

                          $query = $dbh -> prepare($sql);
                          $query-> bindParam(':id', $id, PDO::PARAM_STR);
                          $query->execute();
                          $results=$query->fetchAll(PDO::FETCH_OBJ);
                          $cnt=1;
                          if($query->rowCount() > 0)
                            {
                            foreach($results as $result)
                            {
                              ?>

                        <form method="post" class="form-horizontal" enctype="multipart/form-data">
                          <!-- Add room title and house name -->
                          <div class="form-group">
                            <!-- add room title field -->
                            <label class="col-sm-2 control-label">Room Title
                              <span style="color:red">*</span>
                            </label>
                            <div class="col-sm-4">
                              <input type="text" name="roomtitle" class="form-control"
                              value="<?php echo htmlentities($result->ROOMTITLE)?>" required>
                            </div>
                            <!-- add house name -->
                            <label class="col-sm-2 control-label">Select House
                              <span style="color:red">*</span>
                            </label>
                            <div class="col-sm-4">
                              <select class="selectpicker" name="housename" required>
                                <option value="<?php echo htmlentities($result->hid);?>">
                                  <?php echo htmlentities($housename=$result->HouseName); ?>
                                </option>
                                <?php $ret="select id,HouseName from tblhouse";
                                $query= $dbh -> prepare($ret);
                                $query-> execute();
                                $resultss = $query -> fetchAll(PDO::FETCH_OBJ);
                                if($query -> rowCount() > 0)
                                {
                                  foreach($resultss as $results)
                                  {
                                    if($results->HouseName==$housename)
                                    {
                                      continue;
                                    } else{
                                      ?>
                                      <option value="<?php echo htmlentities($results->id);?>">
                                        <?php echo htmlentities($results->HouseName);?>
                                      </option>
                                    <?php }}} ?>
                                  </select>
                                </div>
                          </div>
                          <div class="hr-dashed"></div>
                          <!-- Add floor name and overview field -->
                          <div class="form-group">
                            <label class="col-sm-2 control-label">Floor Name
                              <span style="color:red">*</span>
                            </label>
                            <div class="col-sm-4">
                              <select class="selectpicker" name="floorname" required>
                                <option value="<?php echo htmlentities($result->fid);?>">
                                  <?php echo htmlentities($floorname=$result->FloorName); ?>
                                </option>
                                <?php $ret="select id,FloorName from tblfloor";
                                $query= $dbh -> prepare($ret);
                                $query-> execute();
                                $resultss = $query -> fetchAll(PDO::FETCH_OBJ);
                                if($query -> rowCount() > 0)
                                {
                                  foreach($resultss as $results)
                                  {
                                    if($results->FloorName==$floorname)
                                    {
                                      continue;
                                    } else{
                                      ?>
                                      <option value="<?php echo htmlentities($results->id);?>">
                                        <?php echo htmlentities($results->FloorName);?>
                                      </option>
                                    <?php }}} ?>
                                  </select>
                            </div>
                            <!-- Add house overview -->
                            <label class="col-sm-2 control-label">Room Overview
                              <span style="color:red">*</span>
                            </label>
                            <div class="col-sm-4">
                              <textarea class="form-control" name="overview" rows="3" required>
                                <?php echo htmlentities($result->HouseOverview);?>
                              </textarea>
                            </div>
                          </div>
                          <!-- Add price per month and building year -->
                          <div class="form-group">
                            <!-- Add price per month -->
                            <label class="col-sm-2 control-label">Price Per Month(in NPR)
                              <span style="color:red">*</span>
                            </label>
                            <div class="col-sm-4">
                              <input type="text" name="priceperday" class="form-control"
                              value="<?php echo htmlentities($result->PricePerMonth);?>" required>
                            </div>
                            <label class="col-sm-2 control-label">Building Year
                              <span style="color:red">*</span>
                            </label>
                            <div class="col-sm-4">
                              <input type="text" name="buildingyear" class="form-control"
                              value="<?php echo htmlentities($result->BuildingYear);?>" required>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-sm-2 control-label">Tenants Capacity
                              <span style="color:red">*</span>
                            </label>
                            <div class="col-sm-4">
                              <input type="text" name="tenantscapacity" class="form-control"
                              value="<?php echo htmlentities($result->TenantsCapacity);?>" required>
                            </div>
                          </div>
                          <div class="hr-dashed"></div>
                          <!-- change image -->
                          <div class="form-group">
                            <div class="col-sm-12">
                              <h4><b>Room Images</b></h4>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-4">First Image
                              <img src="img\Roomimages/<?php echo htmlentities($result->Rimage1);?>" width="300" height="200" style="border:solid 1px #000">
                              <a href="changeimage\changeimage1.php?imgid=<?php echo htmlentities($result->id)?>">Update First Image</a>
                            </div>
                            <div class="col-sm-4">Second Image
                              <img src="img\Roomimages/<?php echo htmlentities($result->Rimage2);?>" width="300" height="200" style="border:solid 1px #000">
                              <a href="changeimage\changeimage2.php?imgid=<?php echo htmlentities($result->id)?>">Update Second Image</a>
                            </div>
                          </div>

                          <div class="hr-dashed"></div>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="panel panel-default">
                                <div class="panel-heading">Accessories</div>
                                <div class="panel-body">
                                  <div class="form-group">
                                    <div class="col-sm-3">
                                      <?php if($result->AttachToilet==1)
                                      {?>
                                        <div class="checkbox checkbox-inline">
                                          <input type="checkbox" id="inlineCheckbox1" name="attachtoilet" checked value="1">
                                          <label for="inlineCheckbox1"> Attach Toilet </label>
                                        </div>
                                      <?php } else { ?>
                                        <div class="checkbox checkbox-inline">
                                          <input type="checkbox" id="inlineCheckbox1" name="attachtoilet" value="1">
                                          <label for="inlineCheckbox1"> Attach Toilet </label>
                                        </div>
                                      <?php } ?>
                                    </div>

                                    <div class="col-sm-3">
                                      <?php if($result->AirConditionar==1)
                                      {?>
                                        <div class="checkbox checkbox-inline">
                                          <input type="checkbox" id="inlineCheckbox1" name="AC" checked value="1">
                                          <label for="inlineCheckbox1"> Air Conditionar </label>
                                        </div>
                                      <?php } else { ?>
                                        <div class="checkbox checkbox-inline">
                                          <input type="checkbox" id="inlineCheckbox1" name="AC" value="1">
                                          <label for="inlineCheckbox1"> Air Conditionar </label>
                                        </div>
                                      <?php } ?>
                                    </div>

                                    <div class="col-sm-3">
                                      <?php if($result->Water==1)
                                      {?>
                                        <div class="checkbox checkbox-inline">
                                          <input type="checkbox" id="inlineCheckbox1" name="water" checked value="1">
                                          <label for="inlineCheckbox1"> Water </label>
                                        </div>
                                      <?php } else { ?>
                                        <div class="checkbox checkbox-inline">
                                          <input type="checkbox" id="inlineCheckbox1" name="water" value="1">
                                          <label for="inlineCheckbox1"> Water </label>
                                        </div>
                                      <?php } ?>
                                    </div>
                                    <!-- hhd -->
                                    <div class="col-sm-3">
                                      <?php if($result->Kitchen==1)
                                      {?>
                                        <div class="checkbox checkbox-inline">
                                          <input type="checkbox" id="inlineCheckbox1" name="kitchen" checked value="1">
                                          <label for="inlineCheckbox1">Kitchen</label>
                                        </div>
                                      <?php } else { ?>
                                        <div class="checkbox checkbox-inline">
                                          <input type="checkbox" id="inlineCheckbox1" name="kitchen" value="1">
                                          <label for="inlineCheckbox1">Kitchen</label>
                                        </div>
                                      <?php } ?>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="col-sm-3">
                                      <?php if($result->Parking==1)
                                      {?>
                                        <div class="checkbox checkbox-inline">
                                          <input type="checkbox" id="inlineCheckbox1" name="parking" checked value="1">
                                          <label for="inlineCheckbox1">Parking</label>
                                        </div>
                                      <?php } else { ?>
                                        <div class="checkbox checkbox-inline">
                                          <input type="checkbox" id="inlineCheckbox1" name="parking" value="1">
                                          <label for="inlineCheckbox1">Parking</label>
                                        </div>
                                      <?php } ?>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <?php }} ?>
                          <div class="form-group">
                            <div class="col-sm-8 col-sm-offset-2" >
                              <button class="btn btn-primary" name="submit" type="submit" style="margin-top:4%">Save changes</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Loading Scripts -->
      <?php include('includes/head.php');?>
    </body>
</html>
<?php } ?>
