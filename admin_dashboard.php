<?php 

// Start session only if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['admin'])) {
    // if not logged in as admin, redirect to login
    header("Location: login.php");
    exit;
}
include("config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <?php include("link.php"); ?>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f9f9f9;
    }
    .dashboard-container {
      max-width: 1200px;
      margin: 40px auto;
      padding: 20px;
    }
    h2 {
      text-align: center;
      margin-bottom: 30px;
    }
    .card-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
    }
    .card {
      background: #fff;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.08);
      text-align: center;
      transition: 0.3s;
    }
    .card:hover {
      transform: translateY(-5px);
    }
    .card h3 {
      margin-bottom: 10px;
      color: #333;
    }
    .btn {
      display: inline-block;
      margin-top: 10px;
      padding: 10px 18px;
      background-color: #5FBA00;
      color: #fff;
      border-radius: 6px;
      text-decoration: none;
    }
    .btn:hover {
      background-color: #4a9000;
    }
    .logout {
      text-align: right;
      margin-bottom: 20px;
    }
    .logout a {
      color: red;
      text-decoration: none;
      font-weight: bold;
    }
  </style>
</head>
<body>

<?php include("admin_header.php"); ?>



  <div class="dashboard-container">
  <h2>Welcome Admin, <?php echo $_SESSION['admin']; ?> </h2>

  
  <div class="card-container">
    
   <div class="row mt-4">

   
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm text-center p-3">
            <h4 class="mb-3">Manage Users</h4>
            <p>View, edit or delete registered users.</p>
            <a href="manage_user.php" class="btn btn-success w-100">Go</a>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card shadow-sm text-center p-3">
            <h4 class="mb-3">Manage Loans</h4>
            <p>Approve or Reject loan applications.</p>
            <a href="manage_loans.php" class="btn btn-success w-100">Go</a>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card shadow-sm text-center p-3">
            <h4 class="mb-3">Manage Schemes</h4>
            <p>Add, edit or delete loan schemes.</p>
            <a href="manage_schemes.php" class="btn btn-success w-100">Go</a>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card shadow-sm text-center p-3">
            <h4 class="mb-3">Manage EMI</h4>
            <p>View and analyze calculated EMI records.</p>
            <a href="manage_emi.php" class="btn btn-success w-100">Go</a>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card shadow-sm text-center p-3">
            <h4 class="mb-3">Manage Feedback</h4>
            <p>Read and resolve user feedback & suggestions.</p>
            <a href="manage_feedback.php" class="btn btn-success w-100">Go</a>
        </div>
    </div>


</div>


  </div>
</div>

<?php include("footer.php"); ?>
</body>
</html>
