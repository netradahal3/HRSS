<?php
	session_start();
	error_reporting(0);
	include('includes/config.php');
	if(strlen($_SESSION['alogin'])==0)
		{
			header('location:index.php');
		}
		else{
if(isset($_REQUEST['eid']))
	{
$eid=intval($_GET['eid']);
$status="2";
$sql = "UPDATE tblrequest SET Status=:status WHERE  id=:eid";
$query = $dbh->prepare($sql);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query-> bindParam(':eid',$eid, PDO::PARAM_STR);
$query -> execute();

$msg="request Successfully Cancelled";
}


if(isset($_REQUEST['aeid']))
	{
$aeid=intval($_GET['aeid']);
$status=1;

$sql = "UPDATE tblrequest SET Status=:status WHERE  id=:aeid";
$query = $dbh->prepare($sql);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query-> bindParam(':aeid',$aeid, PDO::PARAM_STR);
$query -> execute();

$msg="request Successfully Confirmed";
}


 ?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<?php include('includes/head.php');?>
	<title>House Rental System |Manage Request   </title>


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

						<h2 class="page-title">Manage Request</h2>

						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">Request Info</div>
							<div class="panel-body">
							<?php if($error){?><div class="errorWrap">
								<strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php }
				else if($msg){?><div class="succWrap">
					<strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										<th>#</th>
											<th>Name</th>
											<th>House</th>
											<th>From Date</th>
											<th>To Date</th>
											<th>Message</th>
											<th>Status</th>
											<th>Posting date</th>
											<th>Action</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
										<th>#</th>
										<th>Name</th>
											<th>House</th>
											<th>From Date</th>
											<th>To Date</th>
											<th>Message</th>
											<th>Status</th>
											<th>Posting date</th>
											<th>Action</th>
										</tr>
									</tfoot>
									<tbody>

									<?php $sql = "SELECT tblusers.FullName,tblhouse.HouseName,tblroomdetail.ROOMTITLE,tblrequest.FromDate,
									tblrequest.ToDate,tblrequest.message,tblrequest.Roomid as rid,tblrequest.Status,tblrequest.PostingDate,
									tblrequest.id  from tblrequest
									join tblroomdetail on tblroomdetail.id=tblrequest.RoomId
									 join tblusers on tblusers.EmailId=tblrequest.userEmail
									 join tblhouse on tblroomdetail.HouseName=tblhouse.id  ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{				?>
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($result->FullName);?></td>
											<td><a href="edit-room.php?id=<?php echo htmlentities($result->vid);?>">
												<?php echo htmlentities($result->HouseName);?> , <?php echo htmlentities($result->ROOMTITLE);?></td>
											<td><?php echo htmlentities($result->FromDate);?></td>
											<td><?php echo htmlentities($result->ToDate);?></td>
											<td><?php echo htmlentities($result->message);?></td>
											<td><?php
if($result->Status==0)
{
echo htmlentities('Not Confirmed yet');
} else if ($result->Status==1) {
echo htmlentities('Confirmed');
}
 else{
 	echo htmlentities('Cancelled');
 }
										?></td>
											<td><?php echo htmlentities($result->PostingDate);?></td>
										<td>
											<a href="manage-request.php?aeid=<?php echo htmlentities($result->id);?>" onclick="return confirm('Do you really want to Confirm this request')"> Confirm
											</a>


<a href="manage-request.php?eid=<?php echo htmlentities($result->id);?>" onclick="return confirm('Do you really want to Cancel this request')"> Cancel</a>
</td>

										</tr>
										<?php $cnt=$cnt+1; }} ?>

									</tbody>
								</table>



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
