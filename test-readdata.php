<?php
// Database connection settings
$servername = "localhost";

// REPLACE with your Database name
$dbname = "dustdete_esp_data";
// REPLACE with Database user
$username = "dustdete_esp_board";
// REPLACE with Database user password
$password = "Tanachok01!";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query
$sql = "SELECT * FROM mytable";

// Execute query
$result = $conn->query($sql);

// Check for errors
if (!$result) {
    die("Query failed: " . $conn->error);
}

// Generate HTML table
echo "<table>";
echo "<tr><th>ID</th><th>Name</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["id"] . "</td><td>" . $row["name"] . "</td></tr>";
}
echo "</table>";

// Close connection
$conn->close();
?>