<?php
include("config.php");

// Fetch summary data

// Total users from tbluser
$total_users = mysqli_fetch_assoc(mysqli_query($link, "SELECT COUNT(*) AS total FROM tbluser"))['total'];

// Total loans from loan_applications
$total_loans = mysqli_fetch_assoc(mysqli_query($link, "SELECT COUNT(*) AS total FROM loan_applications"))['total'];

// Total disbursed amount (use loan_amount column)
$total_disbursed = mysqli_fetch_assoc(mysqli_query($link, "SELECT IFNULL(SUM(loan_amount), 0) AS total FROM loan_applications WHERE status='Approved'"))['total'];

// For EMI-related sums, need column details from tblemi table
// Temporarily setting them to 0 until you provide that info
$total_emi_paid = 0;
$total_pending_emi = 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Reports - Loan Management</title>
  <?php include("link.php"); ?>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background: #f8f9fa; }
    .summary-card { border-radius: 10px; box-shadow: 0 4px 8px rgb(0 0 0 / 0.1); padding: 20px; margin-bottom: 20px; }
    .summary-card h3 { font-weight: 700; }
    .summary-icon { font-size: 2.5rem; color: #28a745; }
  </style>
</head>
<body>
<?php include("admin_header.php"); ?>
<div class="container py-5">

  <h1 class="mb-4">Admin Reports Dashboard</h1>

  <div class="row g-4 mb-5">
    <div class="summary-card bg-white text-center">
  <div class="summary-icon">👥</div>
  <h3><?= $total_users ?></h3>
  <p>Total Users</p>
  <a href="manage_user.php" class="btn btn-outline-primary btn-sm mt-2">Manage Users</a>
</div>

    </div>
    <div class="col-md-3">
      <div class="summary-card bg-white text-center">
        <div class="summary-icon">💰</div>
        <h3><?= $total_loans ?></h3>
        <p>Total Loans</p>
      </div>
    </div>
    <div class="col-md-3">
      <div class="summary-card bg-white text-center">
        <div class="summary-icon">🏦</div>
        <h3>₹ <?= number_format($total_disbursed, 2) ?></h3>
        <p>Total Disbursed Amount</p>
      </div>
    </div>
    <div class="col-md-3">
      <div class="summary-card bg-white text-center">
        <div class="summary-icon">💵</div>
        <h3>₹ <?= number_format($total_emi_paid, 2) ?></h3>
        <p>Total EMI Paid</p>
      </div>
    </div>
  </div>

  <div class="row g-4 mb-5">
    <div class="col-md-3">
      <div class="summary-card bg-white text-center">
        <div class="summary-icon">⏳</div>
        <h3>₹ <?= number_format($total_pending_emi, 2) ?></h3>
        <p>Total Pending EMIs</p>
      </div>
    </div>
  </div>

</div>
<?php include("footer.php"); ?> 
    <?php include("script.php"); ?> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
