<?php
include 'conn.php';
    if(isset($_SESSION["empid"])){

$x=$_SESSION['name'];
$empid=$_SESSION['empid'];
$deptid=$_SESSION['deptid'];
if(isset($_POST["docsubmit"])){
$reqid = $_POST['req_id'];
$doc1 = $_FILES['doc'];
$status = $_POST['status'];
 if(isset($_FILES['doc']) && $_FILES['doc']['error'] === UPLOAD_ERR_OK) {
    $filename = $_FILES['doc']['name'];
    $tempFilePath = $_FILES['doc']['tmp_name'];
         $fileDestination = 'docu/' . $filename;


    // Move uploaded file to destination directory
    if(move_uploaded_file($tempFilePath, $fileDestination)) {
        // File uploaded successfully, proceed with form submission
        // Now you can use $fileDestination to store the file path in your database

        // Proceed with form submission
    } else {
        // Failed to move file, handle the error accordingly
        $leaveFailureMessage = 'Failed to upload file.';
    }
} 
$sql = "update tbl_docs set doc2 = '$fileDestination' where req_id = '$reqid'";
if($conn ->query($sql)){
   $upl= "update tbl_docs set status = 0 where req_id = '$reqid'";
   $conn->query($upl);
   if($status == 3){
   $sql = "SELECT dr_id from tbl_deanrecommendation where r_id in (select r_id from tbl_hodrecommendation WHERE req_id  = $reqid);";
   $req = $conn -> query($sql);
   $row = $req -> fetch_assoc();
   $drid = $row['dr_id'];
   $uql = "update tbl_deanrecommendation set status = 0 where dr_id = $drid";
   $conn -> query($uql);
   }if($status == 2){
      $sql = "SELECT r_id from tbl_hodrecommendation where  req_id  = $reqid;";
   $req = $conn -> query($sql);
   $row = $req -> fetch_assoc();
   $drid = $row['r_id'];
   $uql = "update tbl_hodrecommendation set status = 0 where r_id = $drid";
   $conn -> query($uql);
   }
}

}
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>UPLeave</title>
      <link rel="stylesheet" href="assets/css/bootstrap.css">
      <script defer src="assets/fontawesome/js/all.min.js"></script>
      <link rel="stylesheet" href="assets/vendors/chartjs/Chart.min.css">
      <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
      <link rel="stylesheet" href="assets/css/app.css">
      <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
      <style>
    #span5{
      font-size:30px;
      color: red;
      font-weight: bold;
    }
    .container {
      display: flex;
        justify-content: center;
        align-items: center;
        height: 90vh;
        margin: 0;
        font-size: 16px; /* Change the font size as needed */
        text-align: center;
        padding: 60px;
    }
    td{
        text-align: left; /* Align text to the left */
    }input{
      
      }
</style>
   </head>
   <body>
      <div id="app">
         <div id="sidebar" class='active'>
            <div class="sidebar-wrapper active">
               <div class="sidebar-header" style="height: 50px;margin-top: -30px">
                      <i class="fa fa-users text-success me-4"></i>
                      <span id="span01" style="font-size: smaller;">UPLeave</span>

                </div>
               <div class="sidebar-menu">
                  <ul class="menu">
                     <li class="sidebar-item  ">
                        <a href="employee.php" class='sidebar-link'>
                        <i class="fa fa-home text-success"></i>
                        <span>Dashboard</span>
                        </a>
                     </li>
                     <li class="sidebar-item ">
                        <a href="apply_leave.php" class='sidebar-link'>
                        <i class="fa fa-plane text-success"></i>
                        <span>Apply Leave</span>
                        </a>
                     </li>
                      <li class="sidebar-item ">
                        <a href="cancel_leave.php" class='sidebar-link'>
                        <i class="fa fa-plane text-success"></i>
                        <span>Cancel Leave Request</span>
                        </a>
                     </li>
                     <li class="sidebar-item ">
                        <a href="leave_status.php" class='sidebar-link'>
                        <i class="fa fa-plane text-success"></i>
                        <span>Leave Status</span>
                        </a>
                     </li>
                     <li class="sidebar-item ">
                        <a href="leavelist.php" class='sidebar-link'>
                        <i class="fa fa-plane text-success"></i>
                        <span>Permissions</span>
                        </a>
                     </li>
                     <li class="sidebar-item ">
                        <a href="leavehistory.php" class='sidebar-link'>
                        <i class="fa fa-plane text-success"></i>
                        <span>Leave history</span>
                        </a>
                     </li>
                      <li class="sidebar-item active">
                        <a href="notifications.php" class='sidebar-link'>
                        <i class="fa fa-plane text-success"></i>
                        <span>Notifications</span>
                        </a>
                     </li>
                  </ul>
               </div>
               <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
         </div>
         <div id="main">
            <nav class="navbar navbar-header navbar-expand navbar-light">
               <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
               <button class="btn navbar-toggler" type="button" data-bs-toggle="collapse"
                  data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                  aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
               </button>
               <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">
                    
                     <li class="dropdown">
                        <a href="#" data-bs-toggle="dropdown"
                           class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                           <div class="avatar me-1">
                              <img src="assets/images/admin.png" alt="" srcset="">
                           </div>
                           <div class="d-none d-md-block d-lg-inline-block"><?php echo $x."<br>".$empid?></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                           <!-- <a class="dropdown-item" href="update.html"><i data-feather="user"></i> Account</a> -->
                           <a class="dropdown-item" href="update_password.php"><i data-feather="settings"></i> Settings</a>
                           <div class="dropdown-divider"></div>
                           <a class="dropdown-item" href="logout.php"><i data-feather="log-out"></i> Logout</a>
                        </div>
                     </li>
                  </ul>
               </div>
            </nav>
               <!-- <table class="table" id="table1">
                  <thead>
                     <tr>
                        <th>S.no</th>
                        <th>Employee Name</th>
                        <th>Leave Type</th>
                        <th>date</th>
                        <th>Hod Remark</th>
                        <th>Dean Remark</th>
                        <th>principal Remark</th>
                        <th>file Upload</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        
                     </tr>
                  </tbody>
               </table> -->
               <?php
            
               ?>
               <div class="container">
                  <div>
                     
                        
                           <?php
                           $sql = "SELECT * FROM tbl_docs where status in (1,2,3) and emp_id = '$empid';";
                           $result = $conn->query($sql);
                           if($result->num_rows > 0){
                           while ($row = $result->fetch_assoc()) {
                              $reqid  = $row['req_id'];
                              $status = $row['status'];
                              $reason = $row['reason'];
                              $sa="select * from tbl_leave where req_id = $reqid";
                              $res1 = $conn->query($sa);
                              $r1 = $res1->fetch_assoc();
                              $ltype = $r1['l_id'];
                              $sql = "select leavetype from tbl_leavetype where l_id = $ltype;";
                              $res2 = $conn->query($sql);
                              $r2 = $res2->fetch_assoc();
                              if($status == 1){
                                 $who = "HoD";
                              }else if($status == 2){
                                 $who = "Academic Dean";
                              }else{
                                 $who = "Principal";
                              }
                           ?>
                           <table class = "table">
                           <tr>
                           <th colspan="2" style="font-size: 20px;color : green;">More document Requested</th>
                        </tr>
                        <tr>
                           <td>Leave Type</td><td><?php echo $r2['leavetype']; ?></td>
                        </tr>
                        <tr>
                           <td>Date</td><td><?php echo $r1['st_date'] .'  TO  '. $r1['to_date'];  ?></td>
                        </tr>
                        <tr>
                           <td><?php echo $who?> Remark</td><td> <?php 
                              echo $reason;
                           ?></td>
                        </tr>
                        
                        <tr>
                           <td>Upload Document</td>
                           <td>
                              <form action="#" method="post" enctype="multipart/form-data" class="form">  
                               <input type="hidden" name="req_id" value = "<?php echo $reqid; ?>" >
                              <input type="hidden" name="status" value = "<?php echo $status; ?>" >

                               <input type="file" name="doc" id="d1" required>
                               <input type="submit" value="Submit Document" class="btn btn-primary me-1 mb-1" name="docsubmit">
                              </form>
                           </td>
                        </tr>
                        <tr></tr>
                     </table><br><br>
                        <?php
                           }
                           ?>

                  </div>
                  <?php
                   }else{     ?>                   
                              <span id="span5">* You Don't have any new notifications</span>
<?php
                   }?>
               </div>
               <!-- container ivideya theerane --> 
            <?php
                          
    
    }else{
        header('Location: logout.php');
        exit();
    }