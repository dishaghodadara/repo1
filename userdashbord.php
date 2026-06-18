
<?php
session_start(); // MUST be at the very top

include("config.php"); 

if (!isset($_SESSION["user"])) {
    echo "⚠ Session expired or user not logged in.";
    exit();
} 
$email = $_SESSION["user"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>User Dashboard</title>
  <?php include("link.php"); ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Arial, sans-serif;
      background: url('https://images.unsplash.com/photo-1605902711622-cfb43c4437f2?auto=format&fit=crop&w=1600&q=80') no-repeat center center fixed;
      background-size: cover;
    }

    .dashboard-container {
      max-width: 1000px;
      margin: 60px auto;
      background: white;
      border-radius: 12px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.15);
      overflow: hidden;
      padding-bottom: 30px;
    }

    .profile-header {
      background: linear-gradient(135deg, #2ecc71, #27ae60);
      color: white;
      text-align: center;
      padding: 40px 20px;
      position: relative;
    }

    .profile-header img {
      border-radius: 50%;
      border: 4px solid white;
      width: 120px;
      height: 120px;
      object-fit: cover;
      box-shadow: 0 4px 15px rgba(0,0,0,0.2);
      margin-bottom: 15px;
    }

    .settings-btn {
      position: absolute;
      top: 15px;
      right: 20px;
    }

    .profile-header h2 { margin: 5px 0; font-weight: bold; }
    .profile-header p { margin: 0; font-size: 15px; }

    .content-section { padding: 30px; }

    .welcome-box {
      background: #f9f9f9;
      padding: 20px;
      border-radius: 10px;
      margin-bottom: 25px;
      text-align: center;
    }

    .feature-card {
      border: none;
      border-radius: 10px;
      box-shadow: 0 3px 10px rgba(0,0,0,0.08);
      padding: 20px;
      text-align: center;
      transition: transform 0.2s, box-shadow 0.2s;
      cursor: pointer;
    }

    .feature-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0,0,0,0.15);
    }

    .feature-card i {
      font-size: 35px;
      margin-bottom: 10px;
      color: #27ae60;
    }

    .loan-summary {
      display: flex;
      justify-content: space-between;
      gap: 20px;
      flex-wrap: wrap;
      margin-bottom: 30px;
    }

    .loan-summary .card {
      flex: 1 1 30%;
      border-radius: 12px;
      padding: 20px;
      color: white;
    }

    .bg-pending { background: #f39c12; }
    .bg-approved { background: #27ae60; }
    .bg-rejected { background: #e74c3c; }

    .quick-actions {
      display: flex;
      gap: 15px;
      flex-wrap: wrap;
      margin-bottom: 25px;
    }

    .quick-actions .btn {
      flex: 1 1 30%;
      padding: 15px;
      font-weight: bold;
      border-radius: 10px;
      transition: transform 0.2s;
    }

    .quick-actions .btn:hover {
      transform: translateY(-3px);
    }

    .recent-activity {
      margin-top: 30px;
    }

    .recent-activity ul {
      list-style: none;
      padding: 0;
    }

    .recent-activity li {
      padding: 10px 15px;
      background: #f5f5f5;
      border-radius: 8px;
      margin-bottom: 8px;
      display: flex;
      justify-content: space-between;
      font-size: 14px;
    }

    .recent-activity li span { font-weight: bold; }
  </style>
</head>
<body>
<?php 
include("header.php"); 

$userQuery = "SELECT name, email, city FROM tbluser WHERE email = '$email'";
$result = mysqli_query($link, $userQuery); 
$user = mysqli_fetch_assoc($result); 

$loanQuery = mysqli_query($link, "SELECT loan_id, loan_amount, loan_type, status, apply_date FROM loan_applications WHERE email='$email' ORDER BY apply_date DESC");
$loans = mysqli_fetch_all($loanQuery, MYSQLI_ASSOC); 

if (!$user) { echo "❌ User not found in database."; exit(); } 

// Loan counts for summary cards
$pendingCount = mysqli_num_rows(mysqli_query($link, "SELECT * FROM loan_applications WHERE email='$email' AND status='Pending'"));
$approvedCount = mysqli_num_rows(mysqli_query($link, "SELECT * FROM loan_applications WHERE email='$email' AND status='Approved'"));
$rejectedCount = mysqli_num_rows(mysqli_query($link, "SELECT * FROM loan_applications WHERE email='$email' AND status='Rejected'"));
?>
<div class="dashboard-container">
  <div class="profile-header">
    <div class="settings-btn dropdown">
      <button class="btn btn-light dropdown-toggle" type="button" id="settingsDropdown" data-bs-toggle="dropdown" aria-expanded="false">⚙</button>
      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="settingsDropdown">
        <li><a class="dropdown-item" href="change_password.php">🔐 Change Password</a></li>
        <li><a class="dropdown-item text-danger" href="logout.php">🚪 Logout</a></li>
      </ul>
    </div>
    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="User Profile">
    <h2><?= htmlspecialchars($user['name']) ?></h2>
    <p><?= htmlspecialchars($user['email']) ?></p>
    <p>📍 <?= htmlspecialchars($user['city']) ?></p>
  </div>

  <div class="content-section">
    <div class="welcome-box">
      <h4>Welcome back, <?= htmlspecialchars($user['name']) ?>! 👋</h4>
      <p>Here’s your personal dashboard where you can manage your account, view your loan status, and track activities.</p>
    </div>

    <!-- Loan Summary Cards -->
    <div class="loan-summary">
      <div class="card bg-pending text-center">
        <h4>Pending</h4>
        <h2><?= $pendingCount ?></h2>
      </div>
      <div class="card bg-approved text-center">
        <h4>Approved</h4>
        <h2><?= $approvedCount ?></h2>
      </div>
      <div class="card bg-rejected text-center">
        <h4>Rejected</h4>
        <h2><?= $rejectedCount ?></h2>
      </div>
    </div>

    <!-- Quick Action Buttons -->
    <div class="quick-actions">
      <a href="services.php" class="btn btn-success">💰 Apply New Loan</a>
      <a href="contact1.php" class="btn btn-warning">✉ Messages</a>
    </div>

    <!-- Loan Status Table -->
    <div class="mb-4">
      <h5>My Loans</h5>
      <?php if(count($loans) > 0): ?>
        <div class="table-responsive">
          <table class="table table-bordered table-hover">
            <thead class="table-success">
              <tr>
                <th>Loan ID</th>
                
                <th>Amount</th>
                <th>Status</th>
                <th>Applied On</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($loans as $loan): ?>
                <tr>
                  <td><?= $loan['loan_id'] ?></td>
                  <td>₹<?= number_format($loan['loan_amount'], 2) ?></td>
                  <td>
                    <?php
                      if($loan['status'] == 'Pending') echo "<span class='badge bg-warning'>Pending</span>";
                      elseif($loan['status'] == 'Approved') echo "<span class='badge bg-success'>Approved</span>";
                      elseif($loan['status'] == 'Rejected') echo "<span class='badge bg-danger'>Rejected</span>";
                    ?>
                  </td>
                  <td><?= date('d M Y', strtotime($loan['apply_date'])) ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php else: ?>
        <p>You have no loan applications yet. <a href="apply_loan.php">Apply for a loan now</a>.</p>
      <?php endif; ?>
    </div>

    <!-- Recent Activities -->
    <div class="recent-activity">
      <h5>Recent Activities</h5>
      <ul>
        <?php if(count($loans) > 0): ?>
          <?php foreach(array_slice($loans, 0, 5) as $loan): ?>
            <li>
              <span>Loan #<?= $loan['loan_id'] ?></span> 
              <?= $loan['status'] ?> on <?= date('d M Y', strtotime($loan['apply_date'])) ?>
            </li>
          <?php endforeach; ?>
        <?php else: ?>
          <li>No recent activity found.</li>
        <?php endif; ?>
      </ul>
    </div>

  </div>
</div>
<?php include("footer.php"); ?>
</body>
</html>
