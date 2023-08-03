<?php
$servername = "localhost";
$username = "dustdete_user";
$password = "Tanachok01!";
$dbname = "dustdete_customer";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();


$sql = "SELECT lat, lng  FROM customer";
$result = $conn->query($sql);

$locations = array(); // Array to store latitude and longitude values

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
      $lat = $row['lat'];
        $lng = $row['lng'];
       

        $locations[] = array('lat' => $lat, 'lng' => $lng); // Store latitude and longitude values in the array
        // Store the data for each marker in the array
        // echo ($locations);

    }
} else {
    echo "0 results";
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title> customer require </title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/googlemap.js"></script>
    <style type="text/css">
        .container {
            
            height: 650px;
           

        }
        .logout {
            position: fixed;
            top: 10px;
            right: 10px;
            background-color: #f1f1f1;
            padding: 10px;
            border: 1px solid #ddd;
        }
        /*.member-info {*/
        /*    position: absolute;*/
        /*    top: 10px;*/
        /*    left: 10px;*/
        /*    background-color: #f1f1f1;*/
        /*    padding: 10px;*/
        /*    border: 1px solid #ddd;*/
        /*}*/
        #map {
            margin-top: 40px;
            width: 100%;
            height: 100%;
            border: 1px solid blue;
        }
        /*#data,*/
        /*#allData {*/
        /*    display: none;*/
        /*}*/
        /* CSS for AQI color bar */
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover:not(.active) {
  background-color: #111;
}

.active {
  background-color: #04AA6D;
}


    </style>
</head>
<body>
    
  <ul>


       <li><a href="javascript:void(0)" onclick="goToMapPage()">Home</a></li>

</ul>
    <div class="container">
        <div class="member-info">
        </div>
        <center>
            <!--<h1>customer require</h1>-->


        </center>
         


        <div id="map"></div>
        <!--<div class="logout">-->
        <!--    <li>-->
        <!--        <a href="/index.php" onclick="return confirm('คุณต้องการออกจากระบบหรือไม่ ?');">-->
        <!--            <span class="glyphicon glyphicon-share"> </span>-->
        <!--        </a>-->
        <!--    </li>-->
        <!--</div>-->
    </div>
                <h1>customer require</h1>

    <script>
     
      function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: 18.800804, lng: 98.950782 },
        zoom: 15
    });

    var locations = <?php echo json_encode($locations); ?>; // Get the array of locations

    for (var i = 0; i < locations.length; i++) {
        var location = locations[i];

        var marker = new google.maps.Marker({
            position: { lat: parseFloat(location.lat), lng: parseFloat(location.lng) },
            map: map,
        });
    }
}



    </script>
    <script >
        
        function goToMapPage() {
      window.location.href = 'map2.php';
    }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDvO7W0FvuhmHhE-HVtRV_DOuq_Dn08lnU&callback=initMap"></script>
     
</body>

</html>
