<!DOCTYPE html>
<html>
<head>
    <style type="text/css">
        
         .map{
             height: 400px;
             top: 50px;
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

    </style>
    
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDvO7W0FvuhmHhE-HVtRV_DOuq_Dn08lnU&callback=initMap" async defer></script>
  <script>
    var markers = []; // เก็บ Marker ที่คลิกค้างไว้ทั้งหมด

    function initMap() {
      var map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: 18.800804, lng: 98.950782 },
        zoom: 14,
      });

      // กำหนดการดักฟังค์ชันคลิกบนแผนที่
      google.maps.event.addListener(map, "click", function (event) {
        // สร้าง Marker ใหม่ที่ตำแหน่งที่คลิก
        var marker = new google.maps.Marker({
          position: event.latLng,
          map: map,
        });

        // เก็บ Marker ในอาเรย์เพื่อให้สามารถแสดงทุก Marker ที่คลิกค้างไว้
        markers.push(marker);

        // ดึงค่า Latitude และ Longitude จากตำแหน่งที่คลิก
        var lat = event.latLng.lat();
        var lng = event.latLng.lng();

        // ส่งค่า Latitude และ Longitude ไปยังเซิร์ฟเวอร์ของคุณผ่าน AJAX
        sendDataToServer(lat, lng);
      });
    }

    function sendDataToServer(lat, lng) {
      // ส่งค่า Latitude และ Longitude ไปยังเซิร์ฟเวอร์ของคุณผ่าน AJAX
      var data = { lat: lat, lng: lng };
      fetch("save_coordinates.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
      })
        .then((response) => response.json())
        .then((data) => {
          // รับข้อมูลตอบกลับจากเซิร์ฟเวอร์ของคุณ (ถ้ามี)
          console.log(data);
        })
        .catch((error) => {
          console.error("Error:", error);
        });
    }
  </script>
</head>
<body>
    <ul>
   

    <li style="float:right"><a href="/index.php" onclick="return confirm('คุณต้องการออกจากระบบหรือไม่ ?');"><span class="glyphicon glyphicon-share"> Logout</span></a></li>
</ul>
  <h1>Test for customer</h1>

  <div id="map" style="height: 500px; top:50px;"></div>
</body>
</html>
