<?php include("config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Car Loan - Loanday</title>
  <?php include("link.php"); ?>
  <style>
    body { font-family: 'Segoe UI', sans-serif; margin:0; background:#f4f6f8; }

    .split-container {
      display:flex;
      min-height:100vh;
    }

    /* Left Side - Image */
    .left {
      flex:1;
      background:url('https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=1600&q=80') 
           no-repeat center/cover;

    }

    /* Right Side - Content */
    .right {
      flex:1;
      background:#fff;
      padding:40px;
      overflow-y:auto;
    }

    h1 { font-size:36px; color:#222; margin-bottom:15px; }
    p { font-size:18px; color:#555; margin-bottom:25px; }

    h2 { color:#333; margin-bottom:15px; }
    h3 { color:#5FBA00; margin-top:20px; }
    ul,ol { line-height:1.8; color:#444; padding-left:20px; }

    .grid {
      display:grid; grid-template-columns:1fr 1fr; gap:20px;
    }
    .card {
      background:#f9f9f9; padding:20px; border-radius:10px; 
      box-shadow:0 2px 10px rgba(0,0,0,0.05);
    }
    .btn {
      background:#5FBA00; color:#fff; padding:12px 25px; text-decoration:none;
      border-radius:6px; display:inline-block; margin-top:20px; font-weight:bold;
      transition:0.3s;
    }
    .btn:hover { background:#489500; }
  </style>
</head>
<body>

<?php include("header.php"); ?>

<div class="split-container">
  <!-- Left image -->
  <div class="left"></div>

  <!-- Right content -->
  <div class="right">
    <h1>Car Loan Solutions</h1>
    <p>Drive your dream car with quick approvals, low interest rates, and flexible repayment options.</p>

    <!-- Features -->
    <h2>Key Features</h2>
    <div class="grid">
      <div class="card">
        <h3>✔ Attractive Rates</h3>
        <p>Get car loans starting from 8.5% interest rate per annum.</p>
      </div>
      <div class="card">
        <h3>✔ Flexible Tenure</h3>
        <p>Repayment tenure ranging from 1 year to 7 years.</p>
      </div>
      <div class="card">
        <h3>✔ Up to 90% Funding</h3>
        <p>Finance available up to 90% of the on-road price of the car.</p>
      </div>
      <div class="card">
        <h3>✔ Quick Processing</h3>
        <p>Loan approval and disbursal within 24-48 hours.</p>
      </div>
    </div>

    <!-- Eligibility -->
    <h2>Eligibility Criteria</h2>
    <ul>
      <li>Applicant age: 21 – 60 years</li>
      <li>Minimum monthly income: ₹20,000</li>
      <li>Stable employment or business proof</li>
      <li>Valid KYC and income documents</li>
    </ul>

    <!-- Process -->
    <h2>Loan Process</h2>
    <ol>
      <li>Apply online by filling car loan application</li>
      <li>Submit KYC & income documents</li>
      <li>Quick eligibility check</li>
      <li>Loan approval within 48 hours</li>
      <li>Funds disbursed directly to the dealer</li>
    </ol>

    <a href="applyloan.php?type=car" class="btn">Apply Now</a>
  </div>
</div>

<?php include("footer.php"); ?>
</body>
</html>
