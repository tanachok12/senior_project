<?php
// เชื่อมต่อกับฐานข้อมูล
$servername = "localhost";
$username = "dustdete_esp";
$password = "Tanachok01!";
$dbname = "dustdete_test_esp";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// สร้างคำสั่ง SQL สำหรับดึงข้อมูลจากฐานข้อมูล
$sql = "SELECT id, lat, lng, aqi, pm25, pm1, pm10, Time FROM Sensor";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // สร้างชื่อไฟล์ CSV
    $filename = 'sensor_data.csv';

    // เปิดไฟล์ CSV เพื่อเขียนข้อมูล
    $file = fopen($filename, 'w');

    // เขียนหัวข้อคอลัมน์ในไฟล์ CSV
    $header = array('ID', 'Latitude', 'Longitude', 'AQI', 'PM2.5', 'PM1', 'PM10', 'Time');
    fputcsv($file, $header);

    // เขียนข้อมูลในไฟล์ CSV
    while ($row = $result->fetch_assoc()) {
        $data = array($row['id'], $row['lat'], $row['lng'], $row['aqi'], $row['pm25'], $row['pm1'], $row['pm10'], $row['Time']);
        fputcsv($file, $data);
    }

    // ปิดไฟล์ CSV
    fclose($file);

    // กำหนดหัวข้อและประเภทของไฟล์ที่จะดาวน์โหลด
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');

    // ส่งเนื้อหาของไฟล์ CSV ให้กับผู้ใช้
    readfile($filename);

    // ลบไฟล์ CSV หลังจากดาวน์โหลดเสร็จสิ้น (ถ้าไม่ต้องการเก็บไฟล์ไว้ในเซิร์ฟเวอร์)
    unlink($filename);
} else {
    echo "ไม่พบข้อมูล";
}

$conn->close();
?>
