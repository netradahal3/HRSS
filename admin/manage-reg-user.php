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
     if(isset($_GET['del']))
     {
       $id=$_GET['del'];
       $sql = "delete from tblusers  WHERE id=:id";
       $query = $dbh->prepare($sql);
       $query -> bindParam(':id',$id, PDO::PARAM_STR);
       $query -> execute();
       $msg="Page data updated  successfully";
     }
 ?>
 <!doctype html>
 <html lang="en" class="no-js">

 <head>
  <?php include('includes/head.php');?>
     <title>House Rental System | Admin Manage Users   </title>

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
     .succWrap
     {
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
             <h2 class="page-title">Register Users</h2>
             <!-- Zero Configuration Table -->
             <div class="panel panel-default">
               <div class="panel-heading">
                 Register User
               </div>
               <div class="panel-body">
                 <?php if($error)
                 {?>
                   <div class="errorWrap">
                     <strong>ERROR</strong>:<?php echo htmlentities($error); ?>
                   </div>
                   <?php
                 }
                 else if($msg)
                 {?>
                   <div class="succWrap">
                     <strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?>
                   </div><?php
                 }?>

                 <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                   <thead>
                     <tr>
                      <th>#</th>
                      <th> Name</th>
                      <th>Email </th>
											<th>Contact no</th>
                      <th>DOB</th>
                      <th>Address</th>
                      <th>City</th>
                      <th>Country</th>
                      <th>Reg Date</th>
                      <th> Action</th>
                    </tr>
									</thead>

                   <tfoot>
                     <tr>
                       <th>#</th>
                       <th> Name</th>
                       <th>Email </th>
                       <th>Contact no</th>
                       <th>DOB</th>
                       <th>Address</th>
                       <th>City</th>
                      <th>Country</th>
                      <th>Reg Date</th>
                      <th> Action</th>
                    </tr>
                   </tfoot>
                   <tbody>
                     <?php $sql = "SELECT * from  tblusers ";
                     $query = $dbh -> prepare($sql);
                     $query->execute();
                     $results=$query->fetchAll(PDO::FETCH_OBJ);
                     $cnt=1;
                     if($query->rowCount() > 0)
                     {foreach($results as $result)
                       {?>
                         <tr>
                           <td><?php echo htmlentities($cnt);?></td>
                           <td><?php echo htmlentities($result->FullName);?></td>
                           <td><?php echo htmlentities($result->EmailId);?></td>
                           <td><?php echo htmlentities($result->ContactNo);?></td>
                           <td><?php echo htmlentities($result->dob);?></td>
                           <td><?php echo htmlentities($result->Address);?></td>
                           <td><?php echo htmlentities($result->City);?></td>
                           <td><?php echo htmlentities($result->Country);?></td>
                           <td><?php echo htmlentities($result->RegDate);?></td>
                           <td>
                             <a href="edit-user.php?id=<?php echo $result->id;?>">
                               <i class="fa fa-edit">
                               </i>
                             </a>&nbsp;&nbsp;
                             <a href="manage-reg-user.php?del=<?php echo $result->id;?>" onclick="return confirm('Do you want to delete');">
     													<i class="fa fa-close"></i></a>
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
