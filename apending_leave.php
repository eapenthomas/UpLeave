<?php
include 'conn.php';
if(isset($_SESSION['empid'])) {
$X=$_SESSION['name'];
$empid=$_SESSION['empid'];
$postid=$_SESSION['post_id'];
$deptid=$_SESSION['deptid'];
if(isset($_POST['takeaction'])){
    $drid=$_POST['dr_id'];
    $reqid = $_POST['req_id'];
    echo $drid;
    $empname=$_POST['empname'];
    echo "<div id='disableFormContainer' style='display: block; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: white; padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); z-index: 9999;'>";
    echo "<form method='post' action='#'>";
    echo "Employee Name - ".$empname;
    echo "<textarea name='remark' id='reason'   class='form-control' rows='5' cols='50' placeholder='Add Remark'></textarea><br>";
    echo "<input type='hidden' name='dr_id' value='$drid'>
        <input type='hidden' name='req_id' value='$reqid'>";

    echo"<input type='submit' value='Approve' name='Approve' class='btn btn-primary me-1 mb-1'> &nbsp &nbsp";
    echo"  <input type='submit' value='request more documents' name='moredoc' class='button button-decline'> &nbsp &nbsp";
        echo"  <input type='submit' value='Decline' name='decline' class='button button-decline'> &nbsp &nbsp";
    echo "<input type='submit' name='can' class='button button-approve' value='cancel'>";
    echo "</form>";
    echo "</div>";
}
if(isset($_POST['decline'])){
    $reqid = $_POST['req_id'];
    $drid=$_POST['dr_id'];
    $tql="update tbl_leave set status = 2 where req_id = $reqid;";
    $conn->query($tql);
    $sq="update tbl_deanrecommendation set status = 2 where dr_id = $drid;";
    $conn->query($sq);
    header("location:apending_leave.php");
}
if(isset($_POST['Approve'])){
    $remark = $_POST['remark'];
    $drid=$_POST['dr_id'];
    $reqid = $_POST['req_id'];

    $sql="SELECT d.*,l.*,e.empname,h.comments as hremarks from tbl_deanrecommendation d, tbl_hodrecommendation h, tbl_leave l,tbl_employee e where d.status = 0 and dr_id = '$drid' and d.r_id = h.r_id and h.req_id = l.req_id AND l.emp_id = e.emp_id;";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $eid = $row['emp_id'];
    $lid = $row['l_id'];
    $stdate = $row['st_date'];
    $todate = $row['to_date'];
    $daybtw = $row['daydiff'];
    $apptime=$row['appliedtime'];
    $reason = $row['reason'];
    $doc = $row['document'];
    $iql ="insert into tbl_approval(emp_id,l_id,st_date,to_date,status,daydiff,appliedtime,document,remark,reason) values('$eid','$lid','$stdate','$todate',1,'$daybtw','$apptime','$doc','$remark','$reason');";
    $conn->query($iql);
    $sqll="update tbl_leave set status = 1 where req_id = $reqid;";
    $conn->query($sqll);
    $sqll="update tbl_deanrecommendation set status = 1 where dr_id = $drid;";
    $conn->query($sqll);

    
    header("location:apending_leave.php");
}if(isset($_POST['moredoc'])){
    $drid = $_POST['dr_id'];
    $reqid=$_POST['req_id'];
    $remark = $_POST['remark'];

    $sql = "update tbl_deanrecommendation set status =2 where dr_id = $drid";
    $conn->query($sql);    
$sql = "UPDATE tbl_docs SET status = 3, reason = '$remark' WHERE req_id = $reqid";
    $conn->query($sql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending</title>

    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <script defer src="assets/fontawesome/js/all.min.js"></script>
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <style>
          button {
        background : none;
        border : none; 
    }

    .button {
        display: inline-block;
        padding: 10px 20px;
        font-size: 16px;
        text-align: center;
        cursor: pointer;
        border: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }
    
    .button-approve {
        background-color: #4CAF50; /* Green */
        color: white;
    }
    
    .button-decline {
        background-color: #f44336; /* Red */
        color: white;
    }
    
    .button:hover {
        background-color: #555;
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
                        <li class="sidebar-item ">
                            <a href="principal.php" class='sidebar-link'>
                                <i class="fa fa-home text-success"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                       
                        <li class="sidebar-item active has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="fa fa-table text-success"></i>
                                <span>Leave Management</span>
                            </a>
                            <ul class="submenu ">
                                <li>
                                    <a href="apending_leave.php">Pending Leaves</a>
                                </li>
                                <li>
                                    <a href="pall_leave.php">All Leaves</a>
                                </li>
                               
                            </ul>
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
                        <li class="dropdown nav-icon">
                            <a href="#" data-bs-toggle="dropdown"
                                class="nav-link  dropdown-toggle nav-link-lg nav-link-user">
                                
                            </a>
                           
                        </li>
                        <li class="dropdown">
                            <a href="#" data-bs-toggle="dropdown"
                                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <div class="avatar me-1">
                                    <img src="assets/images/admin.png" alt="" srcset="">
                                </div>
                                <div class="d-none d-md-block d-lg-inline-block"><?php echo $_SESSION['name'] ?></div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="pvacc.php"><i data-feather="user"></i> Account</a>
                                <a class="dropdown-item" href="p_update_pass.php"><i data-feather="settings"></i> Settings</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php"><i data-feather="log-out"></i> Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="main-content container-fluid">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Pending Requests</h3>
                        </div>
                         <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'> 
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="principal.php" class="text-success">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Pending</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <table class='table' id="table1">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Leave Type</th>
                                        <th>From Date</th>
                                        <th>To Date</th>
                                        <th>Reason</th>
                                        <th > Document</th>
                                        <th>HoD Remark</th>
                                        <th>Dean remark</th>
                                        <th  ><center>Action</center></th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                           <?php  
                                    $sql="SELECT d.*,l.*,e.empname,h.comments as hremarks from tbl_deanrecommendation d, tbl_hodrecommendation h, tbl_leave l,tbl_employee e where d.status = 0 and d.r_id = h.r_id and h.req_id = l.req_id AND l.emp_id = e.emp_id;";     
                                    $result=$conn->query($sql);
                                    if ($result){
                                        if ($result->num_rows > 0) {
                                            
                                            while ($row = $result->fetch_assoc()) {
                                            $eid=$row['emp_id'];
                                            $reqid=$row['req_id'];
                                            $dr_id = $row['dr_id'];
                                            $empname = $row['empname'];
                                            $r_id = $row['r_id'];
                                            $hcomments = $row['hremarks'];
                                            $comments= $row['comments'];
                                            $lid=$row['l_id'];
                                            $stdate=$row['st_date']; 
                                            $todate=$row['to_date'];
                                            $doc = $row['document'];
                                            // $status=$row['status']; 
                                            $reason=$row['reason'];
                                            $lql="select leavetype from tbl_leavetype where l_id = $lid";
                                            $res=$conn->query($lql);
                                            if($res){
                                                $rows = $res->fetch_assoc();
                                                $ltype=$rows['leavetype'];
                                            }
                                            echo"<tr>";
                                            echo"<td>$empname</td>";
                                            echo"<td>$ltype</td>";
                                            echo"<td>$stdate</td>";
                                            echo"<td>$todate</td>";
                                            echo"<td>$reason</td>";

                                            if($doc){
                                            $fql = "SELECT * FROM tbl_docs WHERE req_id = $reqid";
                                            $refile = $conn->query($fql);
                                            $rf = $refile->fetch_assoc();
                                            if(! $rf['doc2']){
                                                echo "<td>
                                            <a href='$doc' target='_blank'> <i class='fas fa-download download-icon'></i> </a>
                                            </td>"; // Redirect to download_file.php after
                                            }else{
                                                $f2 = $rf['doc2'];
                                                 echo "<td>
                                            <a href='$doc' target='_blank'> <i class='fas fa-download download-icon'></i> </a> &nbsp;&nbsp;&nbsp;
                                            <a href='$f2' target='_blank'> <i class='fas fa-download download-icon'></i> </a>
                                            </td>"; // Redirect to download_file.php after
                                            }
                                            
                                            }else{
                                                echo "<td></td>";
                                            }
                                            echo"<td>$hcomments</td>";

                                            echo"<td>$comments</td>";

                                            echo"<td >
                                            <form action='#' method='post'>
                                            <input type='hidden' name='dr_id' value='$dr_id'>
                                            <input type='hidden' name='req_id' value='$reqid'>
                                            <input type='hidden' name='empname' value='$empname'>";
                                            echo" <input type='submit' value='Take Action' name='takeaction' class='btn btn-primary me-1 mb-1' >
                                            </form>
                                            </td>
                                            </tr>";
                                        }   
                                        }else{
                                            }
                                            }?>
                                      
                                </tbody>
                            </table>
                        </div>
                    </div>

                </section>
            </div>
        </div>
    </div>
    <script src="assets/js/feather-icons/feather.min.js"></script>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/app.js"></script>

    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script src="assets/js/vendors.js"></script>

    <script src="assets/js/main.js"></script>
</body>

</html>
<?php
}else{
    header("Location: logout.php");
    exit();
}