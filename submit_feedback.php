<?php
// ตั้งค่าโซนเวลาเป็นไทย
date_default_timezone_set('Asia/Bangkok');

// การเชื่อมต่อฐานข้อมูล
$servername = "localhost";
$username = "dustdete_user";
$password = "Tanachok01!";
$dbname = "dustdete_feedback";

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// รับข้อมูลจากฟอร์ม
$feedback = $_POST['feedback'];
$time = date('Y-m-d H:i:s');

// เพิ่มข้อมูลลงในฐานข้อมูล
$sql = "INSERT INTO feedback (feedback, time) VALUES ('$feedback', '$time')";

if ($conn->query($sql) === TRUE) {
    $last_id = $conn->insert_id;
    echo "<script>alert('Feedback submitted successfully! ID: " . $last_id . "');</script>";
    echo "<script>window.location.href = 'index.html';</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// ปิดการเชื่อมต่อ
$conn->close();
?>
