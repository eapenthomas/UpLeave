<?php
include 'conn.php';
if(isset($_SESSION['empid'])) {
$x=$_SESSION['name'];
$empid=$_SESSION['empid'];
$deptid=$_SESSION['deptid'];
if(isset($_POST['report'])){
    ob_end_clean();
require_once('tcpdf/tcpdf.php');
$Dql = "select deptname from tbl_department where dept_id = $deptid;";
$r1 = $conn->query($Dql);
$r2= $r1->fetch_assoc();
$deptname = $r2['deptname'];
$sql = "SELECT a.*,e.empname,p.deptname FROM tbl_approval a,tbl_employee e, tbl_department p WHERE a.emp_id = e.emp_id and e.dept_id = p.dept_id and p.dept_id = $deptid;";
$result = $conn->query($sql);
$current_date = date("Y-m-d");

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
$pdf->Cell(0,20, "Leave summary of : $deptname Department", 0, 1, 'L');

$pdf->SetFont('times', 'B', 10);

// Output table header with adjusted cell widths
$pdf->Cell(40, 10, 'Employee Name', 1, 0, 'C');
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
        $pdf->Cell(40, 10, $row["empname"], 1, 0, 'C');
        $pdf->Cell(30, 10, $rows['leavetype'], 1, 0, 'C');
        $pdf->Cell(25, 10, $row["st_date"], 1, 0, 'C');
        $pdf->Cell(25, 10, $row["to_date"], 1, 0, 'C');
        $pdf->Cell(37, 10, $row["reason"], 1, 0, 'C');
        $pdf->Cell(38, 10, $row["remark"], 1, 1, 'C');
    }
    $pdf->Cell(0, 10, "Report Generated On : $current_date", 0, 1);
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
                            <a href="index.php" class='sidebar-link'>
                                <i class="fa fa-home text-success"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="fa fa-users text-success"></i>
                                <span>Employees</span>
                            </a>
                            <ul class="submenu ">
                                <li>
                                    <a href="add_employee.php">Add Employee</a>
                                </li>
                                <li>
                                    <a href="manage_employee.php">Manage Employee</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="fa fa-table text-success"></i>
                                <span>Leave Type</span>
                            </a>
                            <ul class="submenu ">
                                <li>
                                    <a href="add_leave_type.php">Add Leave Type</a>
                                </li>
                                <li>
                                    <a href="manage_leave_type.php">Manage Leave Type</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item  has-sub active">
                            <a href="#" class='sidebar-link'>
                                <i class="fa fa-table text-success"></i>
                                <span>Leave Management</span>
                            </a>
                            <ul class="submenu ">
                                <li>
                                    <a href="pending_leave.php">Pending Leaves</a>
                                </li>
                                <li>
                                    <a href="hodleavehistory.php">Leave Summary</a>
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

                        <li class="dropdown">
                            <a href="#" data-bs-toggle="dropdown"
                                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <div class="avatar me-1">
                                    <img src="assets/images/admin.png" alt="" srcset="">
                                </div>
                                <div class="d-none d-md-block d-lg-inline-block"><?php echo $x."<br>".$empid ?></div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="hvacc.php"><i data-feather="user"></i> Account</a>
                                <a class="dropdown-item" href="hod_update_pass.php"><i data-feather="settings"></i>
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
                                    <li class="breadcrumb-item active" aria-current="page">Leave History</li>
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
                                        <th>Employee Name</th>
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
                                    $sql="SELECT a.*,e.empname,p.deptname FROM tbl_approval a,tbl_employee e, tbl_department p WHERE a.emp_id = e.emp_id and e.dept_id = p.dept_id and p.dept_id = $deptid";
                                    $result=$conn->query($sql);
                                    if ($result){
                                         if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                            $empname=$row['empname'];
                                            $apptime = $row['appliedtime'];
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
                                            echo"<td>$empname</td>";
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