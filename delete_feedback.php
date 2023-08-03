<?php
// การเชื่อมต่อฐานข้อมูล
$servername = "localhost";
$username = "dustdete_user";
$password = "Tanachok01!";
$dbname = "dustdete_feedback";

// สร้างการเชื่อมต่อ
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
    echo json_encode(array('error' => 'Some error message'));
}


// รับค่า id ของ feedback ที่ต้องการลบจาก request
// รับค่า id ของ feedback ที่ต้องการลบจาก request
$data = json_decode(file_get_contents('php://input'), true);
$feedbackId = intval($data['id']); // แปลงเป็นตัวเลข

// ตรวจสอบว่ามี feedback นี้ในฐานข้อมูลหรือไม่
$sql = "SELECT * FROM feedback WHERE id = $feedbackId";
$result = $conn->query($sql);

// ตรวจสอบผลลัพธ์
if ($result) {
    if ($result->num_rows > 0) {
        // ถ้ามี feedback นี้ในฐานข้อมูล ให้ลบข้อมูล feedback
        $deleteSql = "DELETE FROM feedback WHERE id = $feedbackId";
        if ($conn->query($deleteSql) === TRUE) {
            // ส่งข้อมูลให้กลับไปยัง frontend ในรูปแบบ JSON
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('error' => 'Error deleting feedback: ' . $conn->error));
        }
    } else {
        echo json_encode(array('error' => 'Feedback not found'));
    }
} else {
    echo json_encode(array('error' => 'Error executing SQL query: ' . $conn->error));
}


// ปิดการเชื่อมต่อ
$conn->close();
?>
