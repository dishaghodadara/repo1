<?php include("config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Business Loan - Loanday</title>
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
      background:url('https://images.unsplash.com/photo-1520607162513-77705c0f0d4a?auto=format&fit=crop&w=1600&q=80') 
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
    <h1>Business Loan Solutions</h1>
    <p>Boost your business growth with flexible funding, quick approvals, and competitive rates.</p>

    <!-- Features -->
    <h2>Key Features</h2>
    <div class="grid">
      <div class="card">
        <h3>✔ Flexible Tenure</h3>
        <p>Repayment period ranging from 12 to 60 months tailored to your business needs.</p>
      </div>
      <div class="card">
        <h3>✔ Competitive Rates</h3>
        <p>Interest starting from 10.5% with no hidden charges.</p>
      </div>
      <div class="card">
        <h3>✔ Quick Disbursal</h3>
        <p>Get funds in your account within 48 hours of approval.</p>
      </div>
      <div class="card">
        <h3>✔ No Collateral</h3>
        <p>Loans up to ₹10 Lakhs without security for small businesses.</p>
      </div>
    </div>

    <!-- Eligibility -->
    <h2>Eligibility Criteria</h2>
    <ul>
      <li>Applicant age: 21 – 60 years</li>
      <li>Business vintage: minimum 2 years</li>
      <li>Annual turnover of ₹5 Lakhs or more</li>
      <li>Valid registration & financial proof</li>
    </ul>

    <!-- Process -->
    <h2>Loan Process</h2>
    <ol>
      <li>Fill the online loan application</li>
      <li>Upload KYC & financial documents</li>
      <li>Instant eligibility check</li>
      <li>Approval within 48 hours</li>
      <li>Funds credited directly</li>
    </ol>

    <a href="applyloan.php?type=business" class="btn">Apply Now</a>
  </div>
</div>

<?php include("footer.php"); ?>
</body>
</html>
