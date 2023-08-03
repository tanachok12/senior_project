<?php
/*
  Rui Santos
  Complete project details at https://RandomNerdTutorials.com
  
  Permission is hereby granted, free of charge, to any person obtaining a copy
  of this software and associated documentation files.
  
  The above copyright notice and this permission notice shall be included in all
  copies or substantial portions of the Software.
*/

$servername = "localhost";

// REPLACE with your Database name
$dbname = "dustdete_esp_data";
// REPLACE with Database user
$username = "dustdete_esp_board";
// REPLACE with Database user password
$password = "Tanachok01!";

// Keep this API Key value to be compatible with the ESP32 code provided in the project page. If you change this value, the ESP32 sketch needs to match
$api_key_value = "tPmAT5Ab3j7F9";

$api_key = $value1 = $value2 = $value3 = $Time = "";
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
echo "Test value data value1 = " . $_GET["value1"];
echo "<br/>";
echo "<br/>";
echo "<br/>";
echo "Test value data value2 = " . $_GET["value2"];
echo "<br/>";
echo "<br/>";
echo "<br/>";
echo "Test value data value3 = " . $_GET["value3"];
echo "<br/>";
echo "Test value data value4 = " . $_GET["value4"];

echo "<br/>";
echo "<br/>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $api_key = test_input($_POST["api_key"]);
    if ($api_key == $api_key_value) {
        $value1 = test_input($_POST["value1"]);
        $value2 = test_input($_POST["value2"]);
        $value3 = test_input($_POST["value3"]);
        $Time = date('Y-m-d H:i:s', strtotime('+13 hours'));
        echo "can post";

        $sql = "INSERT INTO Sensor (value1, value2, value3, Time)
        VALUES ('" . $value1 . "', '" . $value2 . "', '" . $value3 . "', '" . $Time . "')";

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
