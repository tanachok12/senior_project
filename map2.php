<?php
$servername = "localhost";
$username = "dustdete_esp";
$password = "Tanachok01!";
$dbname = "dustdete_test_esp";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

// Create connection
$con1 = mysqli_connect("localhost", "dustdete_member", "Tanachok01!", "dustdete_Authen");

// Check connection
if (!$con1) {
    die("Connection failed: " . mysqli_connect_error());
}

$m_id = $_SESSION['m_id'];
$m_level = $_SESSION['m_level'];
$sql = "SELECT * FROM tbl_member WHERE m_id=$m_id";
$result = mysqli_query($con1, $sql) or die ("Error in query: $sql " . mysqli_error($con1));
$row = mysqli_fetch_array($result);
extract($row);
$m_username = $row['m_user']; 
$m_name = $row['m_name']; 

$sql = "SELECT lat, lng, aqi, pm25, pm1, pm10, Time FROM Sensor";
$result = $conn->query($sql);

$locations = array(); // Array to store latitude and longitude values
$dataArray = array(); // Array to store data for each marker

if ($result->num_rows > 0) {
    
    while ($row = $result->fetch_assoc()) {
        $lat = $row['lat'];
        $lng = $row['lng'];
        $aqi = $row['aqi'];
        $pm25 = $row['pm25'];
        $pm1 = $row['pm1'];
        $pm10 = $row['pm10'];
        $Time = $row['Time'];

        $locations[] = array('lat' => $lat, 'lng' => $lng); // Store latitude and longitude values in the array

        $data = array(
            'aqi' => $aqi,
            'pm25' => $pm25,
            'pm1' => $pm1,
            'pm10' => $pm10,
            'Time' => $Time
        );
        $dataArray[] = $data; // Store the data for each marker in the array
    }
} else {
    echo "0 results";
}

$conn->close();
$con1->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dust Detector Activity Maps</title>
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
            width: 100%;
            height: 100%;
            border: 1px solid blue;
        }
        #data,
        #allData {
            display: none;
        }
         .button-container {
      position: fixed;
      top: 20px;
      left: 20px;
      padding: 10px;
      background-color: red;
      border-radius: 5px;
      border: none;
      font-size: 16px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      text-decoration: none;
    }
    .aqi-color-bar {
  width: 1200px; /* ปรับความยาวตามที่ต้องการ */
  height: 20px;
  position: absolute;
  bottom: 20px;
  left: 20px;
  display: flex;
  align-items: center;
  overflow: hidden; /* เพิ่ม overflow: hidden เพื่อซ่อนส่วนที่เกินขอบเขต */
}

.aqi-color-bar span {
  width: 300px;
  height: 100%;
  margin-right: 5px;
}
.green {
  background-color: green;
}

.yellow {
  background-color: yellow;
}

.orange {
  background-color: orange;
}

.red {
  background-color: red;
}

.purple {
  background-color: purple;
}

.maroon {
  background-color: maroon;
}
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
.member-info {
        position: absolute;
        top: 50px;
        left: 20px;
        padding: 10px;
    }
    </style>
</head>
<body>
   <ul>
    <li><a href="feedback_data.php">Go to Feedback Data</a></li>
    <li id="downloadLi"><a href="#">ดาวน์โหลด CSV</a></li>
        <li><a href="map4.php">Customer require</a></li>

    <li style="float:right"><a href="/index.php" onclick="return confirm('คุณต้องการออกจากระบบหรือไม่ ?');"><span class="glyphicon glyphicon-share"> Logout</span></a></li>
</ul>


    <div class="container">
        <div class="member-info">
        </div>
        <center>
            <h1>Map Test Admin</h1>
         <div class="member-info">
        <p>Name: <?php echo $m_name; ?></p>       
        <p>Role: <?php echo $m_level; ?></p>
    </div>
        <!--<button id="downloadButton">ดาวน์โหลด CSV</button>-->
  <!--      <a href="feedback_data.php" class="button-container">-->
  <!--  Go to Feedback Data-->
  <!--</a>-->
  
  <div class="aqi-color-bar">
  <span class="green">0 - 30</span>
  <span class="yellow">30 - 50</span>
  <span class="orange">50 - 100</span>
  <span class="red">100 - 150</span>
  <span class="purple">150 - 200</span>
  <span class="maroon">&gt; 200</span>
</div>
<script>
    document.getElementById('downloadLi').addEventListener('click', function() {
        // สร้าง XMLHttpRequest object
        var xhr = new XMLHttpRequest();

        // กำหนด URL ของไฟล์ PHP ที่จะดาวน์โหลดข้อมูล CSV
        var url = 'download_csv.php';

        // เปิดการเชื่อมต่อกับ URL
        xhr.open('GET', url, true);

        // กำหนดค่า responseType เป็น 'blob' เพื่อรับข้อมูลเป็นไฟล์ blob
        xhr.responseType = 'blob';

        // เมื่อโหลดข้อมูลเสร็จสิ้น
        xhr.onload = function() {
            if (xhr.status === 200) {
                // สร้าง URL สำหรับไฟล์ blob
                var blobURL = URL.createObjectURL(xhr.response);

                // สร้างลิงก์ดาวน์โหลด
                var link = document.createElement('a');
                link.href = blobURL;
                link.download = 'sensor_data.csv';
                link.style.display = 'none';

                // เพิ่มลิงก์ไปยัง DOM
                document.body.appendChild(link);

                // คลิกลิงก์เพื่อดาวน์โหลด
                link.click();

                // ลบลิงก์ทิ้ง
                document.body.removeChild(link);
            }
        };

        // ส่งคำขอ
        xhr.send();
    });
</script>


        </center>
        <div id="map"></div>
        <!--<div class="logout">-->
        <!--    <li>-->
        <!--        <a href="/index.php" onclick="return confirm('คุณต้องการออกจากระบบหรือไม่ ?');">-->
        <!--            <span class="glyphicon glyphicon-share"> Logout</span>-->
        <!--        </a>-->
        <!--    </li>-->
        <!--</div>-->
    </div>
   
    <script>
      function initMap() {
  var map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: 18.800804, lng: 98.950782 },
    zoom: 15,
  });

  var locations = <?php echo json_encode($locations); ?>;
  var dataArray = <?php echo json_encode($dataArray); ?>;

  if (locations.length !== dataArray.length) {
    console.error(
      "The length of the locations array does not match the length of the data array."
    );
    return;
  }

  var markerGroup = [];

  for (var i = 0; i < locations.length; i++) {
    var location = locations[i];
    var data = dataArray[i];

    var isClose = false;

    for (var j = 0; j < markerGroup.length; j++) {
      var latDiff = Math.abs(
        parseFloat(location.lat) - markerGroup[j].getPosition().lat()
      );
      var lngDiff = Math.abs(
        parseFloat(location.lng) - markerGroup[j].getPosition().lng()
      );

      if (latDiff <= 0.0001 && lngDiff <= 0.0001) { // ปรับค่าระยะที่ใช้ตรวจสอบให้มากขึ้น
        isClose = true;
        break;
      }
    }

    if (!isClose) {
      var markerColor = getMarkerColor(data.aqi);

      var marker = new google.maps.Marker({
        position: {
          lat: parseFloat(location.lat),
          lng: parseFloat(location.lng),
        },
        map: map,
        label: data.aqi.toString(),
        icon:
          "https://maps.google.com/mapfiles/ms/icons/" +
          markerColor +
          ".png",
      });

      markerGroup.push(marker);

      var contentString =
        '<div>' +
        "<p>AQI: " +
        data.aqi +
        "</p>" +
        "<p>PM2.5: " +
        data.pm25 +
        "</p>" +
        "<p>PM10: " +
        data.pm10 +
        "</p>" +
        "<p>PM1: " +
        data.pm1 +
        "</p>" +
        "<p>Time: " +
        data.Time +
        "</p>" +
        "</div>";

      var infoWindow = new google.maps.InfoWindow();
      attachInfoWindow(marker, contentString, infoWindow);
    }
  }

  for (var k = 0; k < markerGroup.length; k++) {
    markerGroup[k].setMap(map);
  }
}

function attachInfoWindow(marker, contentString, infoWindow) {
  marker.addListener("click", function () {
    infoWindow.setContent(contentString);
    infoWindow.open(marker.getMap(), marker);

    setTimeout(function () {
      infoWindow.close();
    }, 3000);
  });
}

function getMarkerColor(aqi) {
  if (aqi <= 30) {
    return "green";
  } else if (aqi <= 50) {
    return "yellow";
  } else if (aqi <= 100) {
    return "orange";
  } else if (aqi <= 150) {
    return "red";
  } else if (aqi <= 200) {
    return "purple";
  } else {
    return "maroon";
  }
}

      
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDvO7W0FvuhmHhE-HVtRV_DOuq_Dn08lnU&callback=initMap"></script>
    
</body>

</html>
