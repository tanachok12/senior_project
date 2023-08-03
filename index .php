





<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
  body {
    font-family: Arial, Helvetica, sans-serif;
    background-size: cover;
    background-color: #ddd; /* เปลี่ยนสีพื้นหลังเป็นสีเทา (#f0f0f0) */
  }

 .modal-content {
  background-color: #fff;
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 450px;
  padding: 12px 20px;
  margin: 8px 0;
  border-radius: 10px; /* เพิ่มเส้นโค้งมุมของ .modal-content */
}

.popup-container {
  position: fixed;
  bottom: 40px;
  right: 40px;
  width: 300px;
  max-height: 80vh;
  overflow-y: auto;
  background-color: #fff;
  border: 1px solid #ccc;
  border-radius: 5px;
  padding: 30px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
  display: none;
}

/* Style for the popup trigger button */
.popup-trigger {
  position: fixed;
  bottom: 20px;
  right: 20px;
  width: 60px;
  height: 60px;
  background-color: #4CAF50;
  color: #fff;
  border-radius: 50%;
  border: none;
  font-size: 24px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  clip-path: circle(50%); /* ใช้ clip-path เพื่อทำมุมที่ไม่แหลม */
}

.container {
  display: flex;
  flex-direction: column;
  align-items: center; /* ปรับเปลี่ยนเป็น center */
}

.container h1 {
  color: #000;
}

.container label {
  color: #808080;
  margin-left: 10px; /* เพิ่มการขยับข้อความให้อยู่ทางซ้าย */
}

.container .modal-content {
  background-color: #4e94c0;
}

.container input[type="text"],
.container input[type="password"] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: none;
  background-color: #f1f1f1;
}

.container button[type="submit"] {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 200px;
  border-radius: 10px; /* เพิ่มเส้นโค้งมุมของ button */
}

.container button[type="submit"]:hover {
  opacity: 0.8;
}

.container label {
  color: white;
}

.container .psw a {
  color: #f1f1f1;
}

.container .signup-link {
  color: #4CAF50;
  margin-top: 10px;
  cursor: pointer;
  text-decoration: none; /* เอาเส้นใต้ออก */
}

.container .signup-link:hover {
  opacity: 0.8;
  text-decoration: underline; /* เพิ่มเส้นใต้เมื่อเม้าส์ hover ไปที่ลิงก์ */
}

.container .signup-link::before {
  content: "Don't have a Account? "; 
  color: #808080; /* เปลี่ยนสีข้อความ "Don't have a Coins Account? " เป็นสีเทา */
}

.container .signup-link:hover {
  opacity: 0.8;
}

/* @media (max-width: 768px) {
  body {
    padding-top: 50px;
  }

  .container {
    padding: 20px;
  }

  .container input[type="text"],
  .container input[type="password"] {
    font-size: 14px;
  }
} */
  
@media (max-width: 768px) {
  .container {
    padding: 20px;
  }
}

label[for="uname"] {
  color: #808080;
}

label[for="psw"] {
  color: #808080;
}

label[for="rmb"] {
  color: #808080;
}
.hidden-content {
      display: none;
    }

    /* แอนนิเมชันสำหรับหน้าก่อนเข้าสู่หน้า Login */
    @keyframes fadein {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    .pre-login-page {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
      background-color: #4e94c0;
      color: #fff;
      animation: fadein 2s;
    }

    .pre-login-text {
      font-size: 36px;
      margin-bottom: 20px;
    }
</style>

</head>
<body>
  <!--<div class="pre-login-page" id="preLoginPage">-->
  <!--  <div class="pre-login-text">Dust Detector Activity</div>-->
    <!-- กรอกเนื้อหาที่ต้องการให้แสดงในหน้าก่อนเข้าสู่หน้า Login ตรงนี้ -->
    <!-- อาจเป็นข้อความ รูปภาพ หรือเนื้อหาอื่นๆ ที่คุณต้องการแสดง -->
  <!--</div>-->

<a href="feedback.php" class="popup-trigger" style="bottom: 20px; right: 100px; background-color: #4CAF50; display: flex; align-items: center; justify-content: center;">
  <span style="font-size: 14px; margin: 0; text-align: center;">Feed back</span>
</a>

<div class="container" style="padding-top:100px">
  
</div>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12" style="padding:100px">
      <center>
        <div id="id01" class="modal">
          <form class="modal-content animate" action="chklogin.php" method="post">
            <div class="imgcontainer">
              <!-- <span onclick="hideLoginModal()" class="close" title="Close Modal">&times;</span> -->
            </div>

            <div class="container">
              <center>
                <h1 class="center"> Dust Detector Activity</h1>
              </center>
              <label for="uname"><b>Username</b></label>
              <input type="text" placeholder="Enter Username" name="m_user" required>

              <label for="psw"><b>Password</b></label>
              <input type="password" placeholder="Enter Password" name="m_pass" required>
              
              <button type="submit">Log in</button>
              <div style="display: flex; align-items: center; justify-content: center;">
                <a href="member_form_add.php" class="signup-link">
                  <span>Sign Up</span>
                </a>
              </div>
            </div>
          </form>
        </div>
      </center>
    </div>
  </div>
</div>
 
</body>
</html>

