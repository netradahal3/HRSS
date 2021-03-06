<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{
header('location:index.php');
}
else{
	?>
<!doctype html>
<html lang="en" class="no-js">

<head>
	<?php include('includes/head.php');?>
	<title>House Rental System | Admin Dashboard</title>


</head>

<body>
		<?php include('includes/header.php');?>
	<div class="ts-main-content">
		<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">
						<h2 class="page-title">Dashboard</h2>
							<!-- first row -->
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<!-- Number of register user -->
									<div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-body bk-primary text-light">
												<div class="stat-panel text-center">
															<?php
															$sql ="SELECT id from tblusers ";
															$query = $dbh -> prepare($sql);
															$query->execute();
															$results=$query->fetchAll(PDO::FETCH_OBJ);
															$regusers=$query->rowCount();
															?>
													<div class="stat-panel-number h1 "><?php echo htmlentities($regusers);?></div>
													<div class="stat-panel-title text-uppercase">Reg Tenants</div>
												</div>
											</div>
											<a href="manage-reg-user.php" class="block-anchor panel-footer">Full Detail <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>
									<!-- Number of register house -->
									<div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-body bk-warning text-light">
												<div class="stat-panel text-center">
													<?php
													$sql3 ="SELECT id from tblhouse ";
													$query3= $dbh -> prepare($sql3);
													$query3->execute();
													$results3=$query3->fetchAll(PDO::FETCH_OBJ);
													$house=$query3->rowCount();
													?>
												<div class="stat-panel-number h1 "><?php echo htmlentities($house);?></div>
											  <div class="stat-panel-title text-uppercase">Register House</div>
											</div>
										</div>
										<a href="manage-house.php" class="block-anchor panel-footer text-center">Full Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
									</div>
									</div>
								<!-- number of register floor -->
									<div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-body bk-warning text-light">
												<div class="stat-panel text-center">
													<?php
													$sql3 ="SELECT id from tblfloor ";
													$query3= $dbh -> prepare($sql3);
													$query3->execute();
													$results3=$query3->fetchAll(PDO::FETCH_OBJ);
													$floor=$query3->rowCount();
													?>
													<div class="stat-panel-number h1 "><?php echo htmlentities($floor);?></div>
													<div class="stat-panel-title text-uppercase">Register Floor</div>
												</div>
											</div>
											<a href="manage-floor.php" class="block-anchor panel-footer text-center">Full Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>
									<!-- number of total room -->
									<div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-body bk-info text-light">
												<div class="stat-panel text-center">
														<?php
														$sql2 ="SELECT id from tblrequest ";
														$query2= $dbh -> prepare($sql2);
														$query2->execute();
														$results2=$query2->fetchAll(PDO::FETCH_OBJ);
														$request=$query2->rowCount();
														?>

													<div class="stat-panel-number h1 "><?php echo htmlentities($request);?></div>
													<div class="stat-panel-title text-uppercase">Total Room Request</div>
												</div>
											</div>
											<a href="manage-request.php" class="block-anchor panel-footer text-center">Full Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>
					<!-- second row -->
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<!-- total Subscibers  -->
									<div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-body bk-primary text-light">
												<div class="stat-panel text-center">
															<?php
															$sql4 ="SELECT id from tblsubscribers ";
															$query4 = $dbh -> prepare($sql4);
															$query4->execute();
															$results4=$query4->fetchAll(PDO::FETCH_OBJ);
															$subscribers=$query4->rowCount();
															?>
													<div class="stat-panel-number h1 "><?php echo htmlentities($subscribers);?></div>
													<div class="stat-panel-title text-uppercase">Subscibers</div>
												</div>
											</div>
											<a href="manage-subscribers.php" class="block-anchor panel-footer">Full Detail <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>
									<!-- number of queries -->
									<div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-body bk-success text-light">
												<div class="stat-panel text-center">
												<?php
																$sql6 ="SELECT id from tblcontactusquery ";
																$query6 = $dbh -> prepare($sql6);;
																$query6->execute();
																$results6=$query6->fetchAll(PDO::FETCH_OBJ);
																$query=$query6->rowCount();
																?>
													<div class="stat-panel-number h1 "><?php echo htmlentities($query);?></div>
													<div class="stat-panel-title text-uppercase">Queries</div>
												</div>
											</div>
											<a href="manage-conactusquery.php" class="block-anchor panel-footer text-center">Full Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>
									<!-- Number of listed room -->
									<div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-body bk-success text-light">
												<div class="stat-panel text-center">
												<?php
															$sql1 ="SELECT id from tblroomdetail ";
															$query1 = $dbh -> prepare($sql1);;
															$query1->execute();
															$results1=$query1->fetchAll(PDO::FETCH_OBJ);
															$totalroom=$query1->rowCount();
															?>
													<div class="stat-panel-number h1 "><?php echo htmlentities($totalroom);?></div>
													<div class="stat-panel-title text-uppercase">Listed Room</div>
												</div>
											</div>
											<a href="edit-room.php" class="block-anchor panel-footer text-center">Full Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>
									<!-- number of testimonials -->
									<div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-body bk-info text-light">
												<div class="stat-panel text-center">
															<?php
															$sql5 ="SELECT id from tbltestimonial ";
															$query5= $dbh -> prepare($sql5);
															$query5->execute();
															$results5=$query5->fetchAll(PDO::FETCH_OBJ);
															$testimonials=$query5->rowCount();
															?>

													<div class="stat-panel-number h1 "><?php echo htmlentities($testimonials);?></div>
													<div class="stat-panel-title text-uppercase">Testimonials</div>
												</div>
											</div>
											<a href="testimonials.php" class="block-anchor panel-footer text-center">Full Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>
					<!-- third row -->
					<div class="row">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-3">
											<div class="panel panel-default">
												<div class="panel-body bk-primary text-light">
													<div class="stat-panel text-center">
														<?php
														$sql4 ="SELECT id from tblcmps ";
														$query4 = $dbh -> prepare($sql4);
														$query4->execute();
														$results4=$query4->fetchAll(PDO::FETCH_OBJ);
														$complaints=$query4->rowCount();
														?>
															<div class="stat-panel-number h1 "><?php echo htmlentities($complaints);?></div>
															<div class="stat-panel-title text-uppercase">Complaints</div>
													</div>
												</div>
												<a href="view-complaints.php" class="block-anchor panel-footer">Full Detail <i class="fa fa-arrow-right"></i></a>
											</div>
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
	<?php include('includes/JsLink.php');?>
	<script>

	window.onload = function(){

		// Line chart from swirlData for dashReport
		var ctx = document.getElementById("dashReport").getContext("2d");
		window.myLine = new Chart(ctx).Line(swirlData, {
			responsive: true,
			scaleShowVerticalLines: false,
			scaleBeginAtZero : true,
			multiTooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
		});

		// Pie Chart from doughutData
		var doctx = document.getElementById("chart-area3").getContext("2d");
		window.myDoughnut = new Chart(doctx).Pie(doughnutData, {responsive : true});

		// Dougnut Chart from doughnutData
		var doctx = document.getElementById("chart-area4").getContext("2d");
		window.myDoughnut = new Chart(doctx).Doughnut(doughnutData, {responsive : true});

	}
	</script>
</body>
</html>
<?php } ?>
