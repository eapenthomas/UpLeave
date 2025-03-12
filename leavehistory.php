<?php
include 'conn.php';
if(isset($_SESSION['empid'])) {
$x=$_SESSION['name'];
$empid=$_SESSION['empid'];
$deptid=$_SESSION['deptid'];
if(isset($_POST['report'])){
    ob_end_clean();
require_once('tcpdf/tcpdf.php');

$sql = "SELECT * FROM tbl_approval WHERE emp_id = '$empid';";
$result = $conn->query($sql);

// Initialize TCPDF
$pdf = new TCPDF();
$pdf->SetCreator('UPLeave');
$pdf->SetAuthor('UPLeave');
$pdf->SetTitle('Leave Details');
$pdf->SetSubject('Database Data');
$pdf->SetKeywords('PDF, Database, TCPDF');

// Add a page
$pdf->AddPage();
// Set font
$pdf->SetFont('times', 'B', 24);
$pdf->SetLineStyle(array('width' => 0.7, 'color' => array(0,0,0)));
$pdf->Rect(3, 3, $pdf->getPageWidth() - 6, $pdf->getPageHeight() - 6);
$pdf->Cell(0, 10, '                                       UPLeave.', 0, 1);
$pdf->SetFont('times', 'B', 20);
$pdf->Cell(0,20, "Leave History of the Employee: $x", 0, 1, 'L');

$pdf->SetFont('times', 'B', 12);

// Output table header with adjusted cell widths
$pdf->Cell(40, 10, 'Applied On', 1, 0, 'C');
$pdf->Cell(30, 10, 'Leave Type', 1, 0, 'C');
$pdf->Cell(25, 10, 'From Date', 1, 0, 'C');
$pdf->Cell(25, 10, 'To Date', 1, 0, 'C');
$pdf->Cell(37, 10, 'Reason', 1, 0, 'C');
$pdf->Cell(38, 10, 'Remark', 1, 1, 'C');

// Iterate through the fetched data and add it to the PDF
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $lid = $row['l_id'];
        $lql = "SELECT leavetype FROM tbl_leavetype WHERE l_id = $lid";
        $res = $conn->query($lql);
        if ($res) {
            $rows = $res->fetch_assoc();
        }
        $pdf->Cell(40, 10, $row["appliedtime"], 1, 0, 'C');
        $pdf->Cell(30, 10, $rows['leavetype'], 1, 0, 'C');
        $pdf->Cell(25, 10, $row["st_date"], 1, 0, 'C');
        $pdf->Cell(25, 10, $row["to_date"], 1, 0, 'C');
        $pdf->Cell(37, 10, $row["reason"], 1, 0, 'C');
        $pdf->Cell(38, 10, $row["remark"], 1, 1, 'C');
    }
} else {
    $pdf->Cell(0, 10, 'No data found.', 0, 1);
}

// Output the PDF (force download)
$pdf->Output('leavedetails.pdf', 'D');

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Leave Summary</title>

<link rel="stylesheet" href="assets/css/bootstrap.css">

<link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">

<script defer src="assets/fontawesome/js/all.min.js"></script>
<link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
<link rel="stylesheet" href="assets/css/app.css">
<style>
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
                      <li class="sidebar-item active">
                        <a href="leavehistory.php" class='sidebar-link'>
                        <i class="fa fa-plane text-success"></i>
                        <span>Leave history</span>
                        </a>
                     </li>
                      <li class="sidebar-item ">
                        <a href="notifications.php" class='sidebar-link'>
                        <i class="fa fa-plane text-success"></i>
                        <span>Notifications <?php echo $_SESSION['not'];?></span>
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
                                <div class="d-none d-md-block d-lg-inline-block"><?php echo $x."<br>".$empid ?></div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                           <a class="dropdown-item" href="evacc.php"><i data-feather="user"></i> Account</a>
                                <a class="dropdown-item" href="update_password.php"><i data-feather="settings"></i>
                                    Settings</a>
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
               
                            <h3>Leave history    </h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="employee.php" class="text-success">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">View Leave History</li>
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
                                        <th>Applied On</th>
                                        <th>Leave Type</th>
                                        <th>From Date</th>
                                        <th>To Date</th>
                                        <th>Reason</th>
                                        <th>Remark</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  
                                    $sql="SELECT * FROM tbl_approval WHERE emp_id = $empid and status = 1";
                                    $result=$conn->query($sql);
                                    if ($result){
                                         if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                            $apptime=$row['appliedtime'];
                                            $lid=$row['l_id'];
                                            $stdate=$row['st_date']; 
                                            $todate=$row['to_date'];
                                            $status=$row['status']; 
                                            $remark=$row['remark'];
                                            $reason = $row['reason'];
                                            $lql="select leavetype from tbl_leavetype where l_id = $lid";
                                            $res=$conn->query($lql);
                                            if($res){
                                                $rows = $res->fetch_assoc();
                                            echo " <tr>";
                                            echo " <td>$apptime</td>";
                                            echo "<td>".$rows['leavetype']."</td>";
                                            echo"<td>$stdate</td>";
                                            echo "<td>$todate</td>";
                                            echo"<td>$reason</td>"; 
                                            echo"<td>$remark</td>"; 

                                            echo"<td><span class='badge bg-success'>Approved</span></td>";
                                            
                                            
                                            echo"</tr>";
                                            }
                                       
                                         }}}    
                                      ?>
                                </tbody>
                                 <center>
                            <form action="#" method="post">
                                <input type="submit" value="Generate Report" name="report" class="btn btn-primary me-1 mb-1">
                            </form></center>
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
    header('Location: login.php');
    exit();
}
?>