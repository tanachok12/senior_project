<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
      background-size: cover;
    }

    .body {
      padding-left: 0;
      margin-top: 50px;
      display: flex;
      justify-content: center;
    }

    .form-horizontal {
      width: 400px;
    }

    .form-group {
      border: 1px solid #ccc;
      padding: 10px;
      border-radius: 5px;
      margin-bottom: 10px;
    }

    .form-horizontal .control-label {
      text-align: right;
      font-size: 16px;
    }

    .form-horizontal .form-control {
      width: 100%;
      height: 30px;
      font-size: 14px;
    }

    .form-horizontal textarea.form-control {
      height: auto;
      resize: vertical;
    }

    .form-horizontal .col-sm-2,
    .form-horizontal .col-sm-3,
    .form-horizontal .col-sm-4 {
      display: inline-block;
      vertical-align: top;
      margin-bottom: 10px;
    }

    .form-horizontal .col-sm-2.control-label {
      padding-top: 7px;
    }

    .form-horizontal .col-sm-2+.col-sm-3,
    .form-horizontal .col-sm-2+.col-sm-4 {
      padding-left: 15px;
    }

    .form-horizontal .btn {
              width: 120px;

      height: 40px;
      border-radius: 5px;
      font-size: 16px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      transition-duration: 0.4s;
      cursor: pointer;
            margin-left: 30px;

    }

    .form-horizontal .btn-info {
      background-color: #4CAF50;
      color: #fff;
      border: none;
      margin-right: 10px;
    }

    .form-horizontal .btn-danger {
      width: 120px;
      background-color: #DC3545;
      color: #fff;
      border: none;
      margin-left: 30px;
      margin-top: 15px;
    }

    .form-horizontal .btn:hover {
      opacity: 0.8;
    }

    .form-title {
      text-align: center;
      font-size: 24px;
      padding-top: 20px;
    }

    .cancel {
      text-align: center;
      display: block;
      margin-top: 10px;
    }

    label[for="uname"] {
    color: #000;
  }
  </style>
</head>
<body>

 
  <h4 class="form-title">Registration Forms</h4>

  <div class="body">
    <form action="member_form_add_db.php" method="post" class="form-horizontal" enctype="multipart/form-data">
      <div class="form-group">
        <div class="col-sm-2 control-label">
          Username:
        </div>
        <div class="col-sm-3">
          <input type="text" name="m_user" required class="form-control" autocomplete="off">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-2 control-label">
          Password:
        </div>
        <div class="col-sm-3">
          <input type="password" name="m_pass" required class="form-control">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-2 control-label">
          First name:
        </div>
        <div class="col-sm-3">
          <input type="text" name="m_name" required class="form-control" maxlength="50">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-2 control-label">
          Surname:
        </div>
        <div class="col-sm-3">
          <input type="text" name="m_lname" required class="form-control" maxlength="50">
        </div>
      </div>
      <div class="form-group api-key">
  <div class="col-sm-2 control-label">
    API Key:
  </div>
  <div class="col-sm-3">
    <input type="text" name="api_key" class="form-control" autocomplete="off">
  </div>
</div>

      <div class="form-group">
        <div class="col-sm-2 control-label">
          Role:
        </div>
        <div class="col-sm-2">
          <select name="m_level" class="form-control" required>
            <option value="">Select Role</option>
            <option value="member">member</option>
            <option value="customer">customer</option>

          </select>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-2 control-label">
          Phone number:
        </div>
        <div class="col-sm-3">
          <input type="tel" name="m_tel" required class="form-control" pattern="[0-9]{10}" minlength="9">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-2 control-label">
          Email:
        </div>
        <div class="col-sm-3">
          <input type="email" name="m_email" required class="form-control">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-2 control-label">
          Address:
        </div>
        <div class="col-sm-4">
          <textarea name="m_address" required class="form-control" rows="4" cols="50"></textarea>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-2"></div>
        <div class="col-sm-3">
          <button class="btn btn-info" type="submit">
            <i class="fa fa-fw fa-save"></i> Confirm
          </button>
          <a class="btn btn-danger" href="member.php" role="button">
            <i class="cancel"></i> Cancel
          </a>
        </div>
      </div>
    </form>
  </div>
  
   <script>
  document.addEventListener("DOMContentLoaded", function () {
    const roleSelect = document.querySelector('select[name="m_level"]');
    const apiKeyFormGroup = document.querySelector('.api-key');
    const apiKeyInput = document.querySelector('input[name="api_key"]');

    if (roleSelect.value === "customer") {
      apiKeyFormGroup.style.display = "none";
      apiKeyInput.removeAttribute("required");
    }

    roleSelect.addEventListener("change", function () {
      if (roleSelect.value === "customer") {
        apiKeyFormGroup.style.display = "none";
        apiKeyInput.removeAttribute("required");
      } else {
        apiKeyFormGroup.style.display = "block";
        apiKeyInput.setAttribute("required", true);
      }
    });
  });
</script>


</body>
</html>
