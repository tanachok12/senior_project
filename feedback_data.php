<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body {
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      margin-top: 20px;
      padding-left: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #f2f2f2;
    }

    .checkbox-cell {
      text-align: right;
    }

    .checkbox-cell input[type="checkbox"] {
      margin-right: 5px;
    }

    .button {
      padding: 15px;
      font-size: 15px;
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
</head>
<body>
<ul>
 

       <li><a href="javascript:void(0)" onclick="goToMapPage()">Home</a></li>
</ul>

  <table>
    <tr>
      <th>Feedback</th>
      <th>Time</th>
      <th>Action</th>
    </tr>

    <?php
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
    }

    // ดึงข้อมูลจากฐานข้อมูล
    $sql = "SELECT  id, feedback, time FROM feedback";
    $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // วนลูปแสดงผลข้อมูล
    while ($row = $result->fetch_assoc()) {
      $feedback = $row['feedback'];
      $time = $row['time'];
      $id = $row['id']; // ดึง ID ของ feedback มาใช้ในการลบ

      // ตรวจสอบสถานะ checkbox จาก LocalStorage
      $checked = '';
      if (isset($_POST['checkbox_' . $row['id']])) {
        $checked = 'checked';
      }

      echo "<tr>";
      echo "<td>" . $feedback . "</td>";
      echo "<td>" . $time . "</td>";
      echo "<td class='checkbox-cell'>";
      echo "<input type='checkbox' name='checkbox_" . $row['id'] . "' " . $checked . ">";
      echo "</td>";
      echo "<td class='action-cell'>";
      echo "<button class='delete-button' onclick='deleteFeedback(" . $id . ")'>Delete</button>";
      echo "</td>";
      echo "</tr>";
    }
  } else {
    echo "<tr><td colspan='3'>No feedback found.</td></tr>";
  }

    // ปิดการเชื่อมต่อ
    $conn->close();
    ?>
  </table>

  <script>
    
function deleteFeedback(id) {
    // ส่วนที่ลบ feedback เชื่อมต่อกับ delete_feedback.php
    fetch('delete_feedback.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ id: id }),
    })
    .then((response) => response.json())
    .then((data) => {
      // การลบ feedback เสร็จสมบูรณ์ คุณอาจต้องอัปเดต UI ตามต้องการ
      console.log('ลบ feedback แล้ว:', data);
      // เพิ่มเติม: หากต้องการ คุณสามารถรีโหลดหน้าเพื่อแสดงรายการ feedback ที่อัปเดต
      window.location.reload();
    })
    .catch((error) => {
      console.error('ข้อผิดพลาด:', error);
    });
  }


    // บันทึกสถานะของ checkbox ใน LocalStorage เมื่อมีการเปลี่ยนแปลง
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach(function(checkbox) {
      checkbox.addEventListener('change', function() {
        var checkboxName = this.name;
        var isChecked = this.checked;
        localStorage.setItem(checkboxName, isChecked);
      });

      // ตั้งค่าสถานะ checkbox จาก LocalStorage
      var checkboxName = checkbox.name;
      var isChecked = localStorage.getItem(checkboxName) === 'true';
      checkbox.checked = isChecked;
    });
     var checkboxName = checkbox.name;
    var isChecked = localStorage.getItem(checkboxName) === 'true';
    checkbox.checked = isChecked;
  });
  </script>
    <script>
    function goToMapPage() {
      window.location.href = 'map2.php';
    }
  </script>

</body>
</html>
