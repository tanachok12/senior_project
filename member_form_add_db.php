<meta charset="utf-8">
<?php
include('condb.php');

// รับค่าที่ส่งมาจากฟอร์ม
$m_user = $_POST["m_user"];
$m_pass = $_POST["m_pass"];
$m_name = $_POST["m_name"];
$m_lname = $_POST["m_lname"];
$api_key = $_POST["api_key"];
$m_level = $_POST["m_level"];
$m_address = $_POST["m_address"];
$m_email = $_POST["m_email"];
$m_tel = $_POST["m_tel"];

// ตั้งค่าเวลาให้เป็นเวลาในประเทศไทย
date_default_timezone_set('Asia/Bangkok');
$time_thailand = date('Y-m-d H:i:s');
$numrand = (mt_rand());

// เช็คว่ามีข้อมูลที่ซ้ำกับในฐานข้อมูลหรือไม่
$check = "
    SELECT m_user, m_email, m_tel, api_key
    FROM tbl_member  
    WHERE m_user = '$m_user' 
    OR m_email = '$m_email'
    OR m_tel = '$m_tel'
    OR api_key = '$api_key'
    ";

$result1 = mysqli_query($con, $check) or die(mysqli_error());
$num = mysqli_num_rows($result1);

if ($num > 0) {
    $duplicateFields = array();
    while ($row = mysqli_fetch_assoc($result1)) {
        if ($row['m_user'] == $m_user) {
            $duplicateFields[] = 'ชื่อผู้ใช้';
        }
        if ($row['m_email'] == $m_email) {
            $duplicateFields[] = 'อีเมล์';
        }
        if ($row['m_tel'] == $m_tel) {
            $duplicateFields[] = 'หมายเลขโทรศัพท์มือถือ';
        }
        if ($row['api_key'] == $api_key) {
            $duplicateFields[] = 'API key';
        }
    }

    $duplicateFieldsStr = implode(", ", $duplicateFields);
    echo "<script>";
    echo "alert('ข้อมูลซ้ำในฟิลด์: $duplicateFieldsStr กรุณาเพิ่มใหม่อีกครั้ง!');";
    echo "window.history.back();";
    echo "</script>";
} else {
    $sql = "INSERT INTO tbl_member
            (
            m_user,
            m_pass,
            m_name,
            m_lname,
            api_key,
            m_level,
            m_address,
            m_email,
            m_tel,
            time
            )
            VALUES
            (
            '$m_user',
            '$m_pass',
            '$m_name',
            '$m_lname',
            '$api_key',
            '$m_level',
            '$m_address',
            '$m_email',
            '$m_tel',
            '$time_thailand'
            )";

    $result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());

    mysqli_close($con);

    if ($result) {
        echo "<script type='text/javascript'>";
        echo "alert('เพิ่มข้อมูลสำเร็จ');";
        echo "window.location = 'index.php'; ";
        echo "</script>";
    } else {
        echo "<script type='text/javascript'>";
        echo "window.location = 'index.php'; ";
        echo "</script>";
    }
}
?>
