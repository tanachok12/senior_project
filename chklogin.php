<?php
ob_start(); // เริ่มต้นใช้งาน Output Buffering

session_start();
if (isset($_POST['m_user'])) {
    include("condb.php");
    $m_user = $_POST['m_user'];
    //$m_pass = sha1($_POST['m_pass']);
    $m_pass = $_POST['m_pass'];

    $sql = "SELECT * FROM tbl_member 
            WHERE m_user='" . $m_user . "' 
            AND m_pass='" . $m_pass . "' ";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);

        $_SESSION["m_id"] = $row["m_id"];
        //$_SESSION["m_name"] = $row["m_name"];
        $_SESSION["m_level"] = $row["m_level"];

        if ($_SESSION["m_level"] == "admin") {
            Header("Location: map2.php");
            exit(); // ออกจากสคริปต์หลังจากเปลี่ยนเส้นทาง
        } else if ($_SESSION["m_level"] == "member") {
            Header("Location: map.php");
            exit(); // ออกจากสคริปต์หลังจากเปลี่ยนเส้นทาง
        }
        else if ($_SESSION["m_level"] == "customer") {
            Header("Location: map3.php");
            exit(); // ออกจากสคริปต์หลังจากเปลี่ยนเส้นทาง
        }
    } else {
        echo "<script>";
        echo "alert(\" user หรือ  password ไม่ถูกต้อง\");";
        echo "window.history.back()";
        echo "</script>";
    }
} else {
    Header("Location: index.php"); //user & password incorrect back to login again
    exit(); // ออกจากสคริปต์หลังจากเปลี่ยนเส้นทาง
}
?>
