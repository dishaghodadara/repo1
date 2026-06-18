<?php
$name = isset($_GET['name']) ? $_GET['name'] : 'User';
$type = isset($_GET['type']) ? ucfirst($_GET['type']) : 'Loan';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Application Successful</title>
  <?php include("link.php"); ?> <!-- CSS / Bootstrap Links -->
  <style>
    body {
      background: #f8f9fa;
      font-family: 'Segoe UI', sans-serif;
    }
    .success-container {
      max-width: 600px;
      margin: 100px auto;
      text-align: center;
    }
    .card {
      background: #fff;
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 6px 15px rgba(0,0,0,0.1);
      animation: fadeIn 1s ease-in-out;
    }
    .card h2 {
      color: #28a745;
      font-weight: bold;
    }
    .card p {
      font-size: 16px;
      color: #555;
    }
    .btn-custom {
      margin-top: 20px;
      background: #0fa314ff;
      color: white;
      padding: 12px 25px;
      border-radius: 8px;
      font-size: 16px;
      transition: 0.3s;
      text-decoration: none;
      display: inline-block;
    }
    .btn-custom:hover {
      background: #16a34fff;
    }
    @keyframes fadeIn {
      from {opacity: 0; transform: translateY(-20px);}
      to {opacity: 1; transform: translateY(0);}
    }
  </style>
</head>
<body>
  <?php include("header.php"); ?> <!-- Website Header -->

  <div class="success-container">
    <div class="card">
      <h2>✅ Thank You, <?php echo $name; ?>!</h2><br/>

      <p>Your application for <b><?php echo $type; ?></b> has been submitted successfully.</p>
      <p>We will contact you shortly with further details.</p>
      <a href="index.php" class="btn-custom">⬅ Back to Home</a>
    </div>
  </div>

  <?php include("footer.php"); ?> <!-- Website Footer -->
</body>
</html>
