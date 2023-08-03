<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    /* CSS styles... */
  </style>
</head>
<body>
  <h4 class="form-title">Feedback Form</h4>

  <div class="body">
    <form action="submit_feedback.php" method="post" class="form-horizontal" onsubmit="showAlert()">
      <div class="form-group">
        <div class="col-sm-2 control-label">
          Feedback:
        </div>
        <div class="col-sm-4">
          <textarea name="feedback" required class="form-control" rows="4" cols="50"></textarea>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-2"></div>
        <div class="col-sm-3">
          <button class="btn btn-info" type="submit">
            Submit
          </button>
          <a class="btn btn-danger" href="index.html" role="button">
            Cancel
          </a>
        </div>
      </div>
    </form>
  </div>

  <script>
    // Function to show alert message
    function showAlert() {
      alert("Feedback submitted successfully!");
    }
  </script>
</body>
</html>
