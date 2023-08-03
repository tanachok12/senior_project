<?php
ob_start(); // เริ่มต้นใช้งาน Output Buffering

$con = mysqli_connect("localhost", "dustdete_member", "Tanachok01!", "dustdete_Authen");

// Check connection
if (mysqli_connect_errno()) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "Connected successfully";

mysqli_set_charset($con, "utf8");
error_reporting(error_reporting() & ~E_NOTICE);
date_default_timezone_set('Asia/Bangkok');
?>
