<?php include("config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Feedback - Loanday</title>
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
  <?php include("link.php"); ?>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f8f9fa;
      min-height: 100vh;
    }

    .feedback-container {
      padding: 60px 20px;
      max-width: 700px;
      margin: 0 auto;
    }

    .feedback-card {
      background: white;
      border-radius: 15px;
      box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
      overflow: hidden;
      animation: slideUp 0.8s ease-out;
    }

    @keyframes slideUp {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .feedback-header {
      background: linear-gradient(135deg, #83C300 0%, #5FBA00 100%);
      padding: 50px 30px;
      text-align: center;
      color: white;
    }

    .feedback-header h1 {
      margin: 0 0 15px 0;
      font-size: 3em;
      font-weight: 700;
    }

    .feedback-header p {
      margin: 0;
      font-size: 1.2em;
      opacity: 0.95;
    }

    .feedback-icon {
      font-size: 3.5em;
      margin-bottom: 25px;
    }

    .form-container {
      padding: 50px 40px;
    }

    .form-group {
      margin-bottom: 30px;
    }

    .form-group label {
      display: block;
      margin-bottom: 12px;
      font-weight: 600;
      color: #333;
      font-size: 1em;
    }

    .form-control {
      width: 100%;
      padding: 18px 25px;
      border: 2px solid #e1e1e1;
      border-radius: 15px;
      font-size: 17px;
      transition: all 0.3s ease;
      box-sizing: border-box;
    }

    .form-control:focus {
      outline: none;
      border-color: #83C300;
      box-shadow: 0 0 0 4px rgba(131, 195, 0, 0.15);
      transform: translateY(-1px);
    }

    .textarea-control {
      min-height: 160px;
      resize: vertical;
      font-family: inherit;
    }

    .button-group {
      display: flex;
      gap: 20px;
      margin-top: 40px;
    }

    .btn {
      flex: 1;
      padding: 18px 30px;
      border: none;
      border-radius: 15px;
      font-size: 17px;
      font-weight: 600;
      text-decoration: none;
      text-align: center;
      cursor: pointer;
      transition: all 0.3s ease;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .btn-primary {
      background: linear-gradient(135deg, #83C300 0%, #5FBA00 100%);
      color: white;
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 12px 28px rgba(131, 195, 0, 0.35);
    }

    .btn-secondary {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
    }

    .btn-secondary:hover {
      transform: translateY(-2px);
      box-shadow: 0 12px 28px rgba(102, 126, 234, 0.35);
    }

    @media (max-width: 768px) {
      .feedback-container { padding: 40px 15px; }
      .feedback-header { padding: 40px 20px; }
      .feedback-header h1 { font-size: 2.2em; }
      .form-container { padding: 40px 20px; }
      .button-group { flex-direction: column; gap: 15px; }
    }
  </style>
</head>
<body>



<?php
if (isset($_REQUEST["btnfeedback"])) {
    $name = trim($_REQUEST["txtname"]);
    $email = trim($_REQUEST["txtemail"]);
    $message = trim($_REQUEST["txtmessage"]);

    if (empty($name) || empty($email) || empty($message)) {
        echo "<script>alert('Please fill all fields to submit your feedback!');</script>";
    } else {
        $query = "INSERT INTO tblfeedback (name, email, message, feedback_date) 
                  VALUES ('$name', '$email', '$message', NOW())";
        $result = mysqli_query($link, $query);

        if ($result) {
            echo "<script>
                    alert('Thank you! Your feedback has been submitted successfully.');
                    window.location.href='feedback.php';
                  </script>";
        } else {
            echo "<script>alert('Sorry, there was an error submitting your feedback. Please try again.');</script>";
        }
    }
}
?>
<?php include("header.php")?>

 <!-- Breadcrumb Section Begin -->
   
<section>
<div class="feedback-container">
  <div class="feedback-card">
    <div class="feedback-header">
      <h1>We Value Your Feedback</h1>
      <p>Help us improve our services by sharing your thoughts and suggestions</p>
    </div>

    <div class="form-container">
      <form action="feedback.php" method="post">
        <div class="form-group">
          <label for="txtname">Full Name</label>
          <input type="text" id="txtname" name="txtname" class="form-control" placeholder="Enter your full name" required>
        </div>

        <div class="form-group">
          <label for="txtemail"> Email Address</label>
          <input type="email" id="txtemail" name="txtemail" class="form-control" placeholder="Enter your email address" required>
        </div>

        <div class="form-group">
          <label for="txtmessage"> Your Message</label>
          <textarea id="txtmessage" name="txtmessage" class="form-control textarea-control" placeholder="Share your detailed feedback, suggestions, or concerns..." required></textarea>
        </div>

        <div class="button-group">
          <button type="submit" name="btnfeedback" class="btn btn-primary">Submit Feedback</button>
          <a href="login.php" class="btn btn-secondary">← Back to Login</a>
        </div>
      </form>
    </div>
  </div>
</div>
</section>
<?php include("footer.php"); ?>

</body>
</html>
