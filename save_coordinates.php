<?php
// เชื่อมต่อฐานข้อมูล MySQL
$servername = "localhost";
$username = "dustdete_user";
$password = "Tanachok01!";
$dbname = "dustdete_customer";
//  echo "before connect";

$conn = mysqli_connect($servername, $username, $password, $dbname);
//  echo "can connect";
// ตรวจสอบการเชื่อมต่อฐานข้อมูล
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// รับค่า Latitude และ Longitude จาก JavaScript
$data = json_decode(file_get_contents('php://input'), true);
$lat = $data['lat'];
$lng = $data['lng'];

// เก็บเวลาปัจจุบันของประเทศไทย
date_default_timezone_set('Asia/Bangkok');
$time_thailand = date('Y-m-d H:i:s');

// ทำการบันทึกค่าลงในตาราง "customer"
$sql = "INSERT INTO customer (lat, lng, time) VALUES ('$lat', '$lng', '$time_thailand')";
if (mysqli_query($conn, $sql)) {
  $response = array('status' => 'success', 'message' => 'Coordinates saved successfully');
} else {
  $response = array('status' => 'error', 'message' => 'Error: ' . mysqli_error($conn));
}

// ส่งข้อมูลตอบกลับให้ JavaScript
header('Content-Type: application/json');
echo json_encode($response);

// ปิดการเชื่อมต่อฐานข้อมูล
mysqli_close($conn);
?>
