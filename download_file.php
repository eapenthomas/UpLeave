<?php
include 'conn.php';
if(isset($_POST['doc'])){
    $rid=$_POST['req_id'];
    $dql = "SELECT document FROM tbl_leave WHERE req_id='$rid';";
    $res = $conn->query($dql);
    if($res->num_rows > 0){
        $row = $res->fetch_assoc();
        $file = $row['document'];

        if (file_exists($file)) {
            // Set headers for force download
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($file) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            // Read the file contents and echo it to the browser
            readfile($file);
            // Exit script
            exit;
        } else {
            // If the file doesn't exist, redirect or show an error message
            echo "File not found!";
        }
    }
}
?>
