<?php
	session_start();
	error_reporting(0);
	include('includes/config.php');
	if(strlen($_SESSION['login'])==0)
	  {
	header('location:index.php');
	}
	else{
		if(isset($_POST['register'])) {
			$name = $_POST['name'];
			$cmp = $_POST['cmp'];
			$username = $_POST['user_id'];
			$fullname = $_POST['fullname'];

					$sql ="INSERT INTO tblcmps(name,cmp,username,fullname) values(:name,:cmp,:username,:fullname)";
					$query= $dbh -> prepare($sql);
					$query->bindParam(':name',$name,PDO::PARAM_STR);
					$query->bindParam(':cmp',$cmp,PDO::PARAM_STR);
					$query->bindParam(':username',$username,PDO::PARAM_STR);
					$query->bindParam(':fullname',$fullname,PDO::PARAM_STR);

					$query->execute();
					$lastInsertId = $dbh->lastInsertId();
					if($lastInsertId)
					{
					$msg="complaints submitted successfully";
					}
					else
					{
					$error="Something went wrong. Please try again";
					}
		}
?>


<!DOCTYPE HTML>
<html lang="en">
			<head>
					<?php include('includes/head.php');?>
					<link rel="stylesheet" href="assets/css/styles.css" type="text/css">
			</head>
		<body>
					<!-- Start Switcher -->
					<?php include('includes/colorswitcher.php');?>
					<!-- /Switcher -->

					<!--Header-->
					<?php include('includes/header.php');?>
					<!-- /Header -->
					<!-- page header start-->
					<section class="page-header profile_page">
					  <div class="container">
					    <div class="page-header_wrap">
					      <div class="page-heading">
					        <h1>Send Complaint</h1>
					      </div>
					      <ul class="coustom-breadcrumb">
					        <li><a href="#">Home</a></li>
					        <li>Send Complaints</li>
					      </ul>
					    </div>
					  </div>
					  <!-- Dark Overlay-->
					  <div class="dark-overlay"></div>
					</section>
					<!-- page header start-->
					<section class="contact_us section-padding">
					  <div class="container">
					    <div  class="row">
								<div class="col-md-6">
									<h3> send complaint using the form below</h3>
										<?php if($error){?>
											<div class="errorWrap">
												<strong>ERROR</strong>:<?php echo htmlentities($error); ?>
											</div><?php }
				        				else if($msg){?>
											<div class="succWrap">
												<strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?>
											</div><?php }?>
											<div class="contact_form gray-bg">
												<form action="" method="post">
										  		<div class="row">
											  	    <div class="col-6">
												  	  		<div class="form-group">
																    <label for="name">Apartment No/Name Room No/Name</label>
																    <input type="text" class="form-control" id="name" placeholder="Full Name" name="name" required>
																    <input type="hidden" name="user_id" value="<?php echo $_SESSION['EmailId']; ?>">
																    <input type="hidden" name="fullname" value="<?php echo $_SESSION['FullName']; ?>">
													  			</div>
															</div>
													<div class="col-6">
													  <div class="form-group">
													    <label for="cmp">Complaint</label>
													    <input type="text" class="form-control" id="cmp" placeholder="Text" name="cmp" required>
													  </div>
												    </div>
											   </div>
											  <button type="submit" class="btn btn-primary" name='register' value="register">Submit</button>
											</form>
											</div>
								</div>
								<div class="col-md-6">
									<h3> view complaint reply below</h3>
								</div>
							</div>
						</div>
					</section>
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
				<!--/Forgot-password-Form -->
				<!-- Scripts -->
					<?php include('includes/JsLink.php');?>
			</body>
</html>
<?php } ?>
