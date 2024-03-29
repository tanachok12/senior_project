<!DOCTYPE html>
<html>
     <html lang="en">

<head>
    <script>
    // Function to show the pop-up
     function showFirstPopup() {
      var firstPopup = document.getElementById("firstPopup");
      firstPopup.style.display = "block";
    }

    // Function to hide the first pop-up and show the second pop-up
    function showSecondPopup() {
      var firstPopup = document.getElementById("firstPopup");
      firstPopup.style.display = "none";

      var secondPopup = document.getElementById("secondPopup");
      secondPopup.style.display = "block";
    }

    // Function to hide both pop-ups
    function hidePopups() {
      var firstPopup = document.getElementById("firstPopup");
      firstPopup.style.display = "none";

      var secondPopup = document.getElementById("secondPopup");
      secondPopup.style.display = "none";
    }
  </script>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
  body {
   font-family: Arial, Helvetica, sans-serif;
      background-size: cover;
        background-size: cover;
    background-color: #ddd; 
    background-image: url('/379508396_623367619972440_4533436417393325839_n.jpg');
    background-size: cover;
background-repeat: no-repeat; 
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
.container-fluid {
  max-height: 80vh; /* Set a maximum height for the container */
  overflow-y: auto; /* Enable vertical scrolling if the content exceeds the height */
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
   .popup1 {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 1000;
      
          position: relative; /* เพิ่มบรรทัดนี้ */

    }

    .popup1 .modal-content1 {
  position: fixed;
  background-color: #fff;
  display: flex;
  flex-direction: column;
  align-items: center;
  max-height: 70vh; /* Set a maximum height for modal-content1 */
  overflow-y: auto; /* Enable vertical scrolling if the content exceeds the height */
  width: 90vw;
  padding: 5vw;
  margin: 4vw 0;
  border-radius: 10px;
}

    @media (max-width: 600px) {
  .popup1 .modal-content1 {
    width: 90%;
    padding: 10px;
    margin: 20px 0;
  }
}
    .popup1 p {
      margin-bottom: 15px;
    }

    .popup1 button {
      background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100px;
  border-radius: 10px; 
    }

    .popup1 button:hover {
      opacity: 0.8;
    }
</style>

</head>
<body onload="showFirstPopup()" >
 

<!--https://dustdetector.net/video.php-->


<div id="firstPopup" class="popup1">
  <div class="modal-content1">
    <h1>What is Dust Detector Activity</h1>
    <p>ในปัจจุบันเนื่องจากปัญหาที่เกิดจากผลกระทบของ PM 2.5 มีมากมาย และเทคโนโลยีการตรวจวัดฝุ่นก็มีข้อจำกัดค่อนข้างมาก เช่น เครื่องวัดฝุ่นส่วนใหญ่ติดตั้งถาวร และการดูข้อมูลฝุ่นในเว็บแอปพลิเคชันอื่นๆ จะแสดงผล เฉพาะข้อมูลโดยรวมที่ยากต่อการระบุ จะดีกว่าไหม ถ้ามี Web Application Platform ที่สามารถตรวจสอบค่าได้และเคลื่อนย้ายเครื่องตรวจวัดฝุ่นได้ง่ายกว่า จึงเป็นสาเหตุว่าทำไมจึงต้องการพัฒนา Dust Detector Activity เป็นแพลตฟอร์มตรวจจับฝุ่นที่สามารถตรวจวัดฝุ่นได้ในพื้นที่เฉพาะ เราจคงทำเครื่องตรวจจับฝุ่น อุปกรณ์ IOT แบบพกพา และเว็บแอปพลิเคชันเครื่องตรวจค่าฝุ่น.</p>
    <p>At present, due to problems caused by the impact of PM 2.5 There are a lot of them and the technology for measuring dust has quite some limitations, such as Most dust meters are permanently installed, and looking at dust data in other web applications will show only the overall data, which is difficult to determine, would it be better if there was a web application platform that could check the value and easier to  move the dust measure device around, so that is reason why want to have developed Dust Detector Activity, Dust Detector Activity  is dust detector platform that can measure dust in a specific area, Dust Detector Activity consists of Dust Detector Activity portable mobile IOT device and Dust Detector web application.</p>
    <div style="display: flex; justify-content: space-between; margin-top: 15px;">
      <button onclick="showSecondPopup()">Next</button>
      <a href="video.php">
        <button style="margin-left: 15px;">Go to Video Demo</button>
      </a>
    </div>
  </div>
</div>



<!-- Second pop-up -->
<div id="secondPopup" class="popup1">
  <div class="modal-content1">
<h2>This is the senior project </h2>
<h3>From SE Camt CMU : Tanachok & Wathunyu </h3>
<p>ท่านสามารถใช้งานได้โดยทำการสมัคสมาชิกหรือทำการใช้ข้อมูลผู้ใช้เริ่มต้นที่เรามีให้  </p> 
<p> โดยเราทำไว้3 Role 1 คือ Admin โดยทำการlogin Username:admin Password:admin </p>
<p>  Role 2 คือ User โดยทำการlogin Username:member Password:member</p>
<p>  Role 3 คือ Customer โดยทำการlogin Username:customer Password:customer</p>
<p style=" color:red">  *แต่ใน role ของ Member ท่านจะไม่สามารถเล่นกิจกรรมจากทางWebsite เราได้เนื่องจากท่านผู้เล่นจะต้องมีเครื่อง Device ของเราเพื่อทำภารกิจในแต่ละจุด</p>
    <button onclick="hidePopups()">Close</button>
  </div>
</div>
<!--<a href="feedback.php" class="popup-trigger" style="bottom: 20px; right: 100px; background-color: #4CAF50; display: flex; align-items: center; justify-content: center;">-->
<!--  <span style="font-size: 14px; margin: 0; text-align: center;">Feed back</span>-->
<!--</a>-->

<!--<div class="container" style="padding-top:100px">-->
  
<!--</div>-->

<div class="container-fluid" style="padding-top:100px">
  <div class="row">
    <div class="col-md-12" style="padding:100px">
      <center>
        <div id="id01" class="modal">
          <form class="modal-content animate" action="chklogin.php" method="post">
            <div class="imgcontainer">
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
