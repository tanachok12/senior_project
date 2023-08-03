<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<style type="text/css">
body, td, th {
	font-family: Verdana, Geneva, sans-serif;
	font-size: small;
}
</style>
</head>

<body>
    <h1>Hi  Hi </h1>
<?php
        echo "<br/>";
        echo "<br/>";
        echo "<br/>";
        echo "<br/>";


$servername = "localhost";
$username = "dustdete_esp";
$password = "Tanachok01!";
$dbname = "dustdete_test_esp";
$api_key_value = "tPmAT5Ab3j7F9";

$api_key = $lat = $lng = $pm1 = $pm10 = $pm25 = $aqi = $Time = "";
echo "create connection";
echo "<br/>";
echo "<br/>";
echo "<br/>";
echo "<br/>";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
echo "can connection";
echo "<br/>";
echo "<br/>";
echo "<br/>";
echo "<br/>";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Test value data lat = " . $_GET["lat"];
echo "<br/>";
echo "<br/>";
echo "<br/>";
echo "Test value data log = " . $_GET["log"];
echo "<br/>";
echo "<br/>";
echo "<br/>";
echo "Test value data pm1 = " . $_GET["pm1"];
echo "<br/>";
echo "<br/>";
echo "<br/>";
echo "Test value data pm10 = " . $_GET["pm10"];
echo "<br/>";
echo "<br/>";
echo "<br/>";
echo "Test value data pm25 = " . $_GET["pm25"];
echo "<br/>";
echo "<br/>";
echo "<br/>";
echo "Test value data aqi = " . $_GET["aqi"];
echo "<br/>";
echo "<br/>";
echo "<br/>";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $api_key = test_input($_POST["api_key"]);
    if ($api_key == $api_key_value) {
        $lat = test_input($_POST["lat"]);
        $lng = test_input($_POST["lng"]);
        $pm1 = test_input($_POST["pm1"]);
        $pm10 = test_input($_POST["pm10"]);
        $pm25 = test_input($_POST["pm25"]);
        $aqi = test_input($_POST["aqi"]);
        $Time = date('Y-m-d H:i:s', strtotime('+13 hours'));
        echo "can post";

        $sql = "INSERT INTO Sensor (lat, lng, pm1, pm10, pm25, aqi, Time)
        VALUES ('" . $lat . "', '" . $lng . "', '" . $pm1 . "', '" . $pm10 . "', '" . $pm25 . "', '" . $aqi . "', '" . $Time . "')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    } else {
        echo "Wrong API Key provided.";
    }
} else {
    echo "No data posted with HTTP POST And not connect";
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
</body>
</html>
