<?php include("config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home Loan - Loanday</title>
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
      background:url('https://images.unsplash.com/photo-1568605114967-8130f3a36994?auto=format&fit=crop&w=1600&q=80') 
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
    <h1>Home Loan Solutions</h1>
    <p>Make your dream home a reality with our affordable and flexible home loan plans.</p>

    <!-- Features -->
    <h2>Key Features</h2>
    <div class="grid">
      <div class="card">
        <h3>✔ High Loan Amount</h3>
        <p>Get loans up to ₹50 Lakhs for purchasing or constructing your home.</p>
      </div>
      <div class="card">
        <h3>✔ Attractive Interest Rates</h3>
        <p>Interest starting from 8.5% p.a. with flexible repayment options.</p>
      </div>
      <div class="card">
        <h3>✔ Long Repayment Tenure</h3>
        <p>Enjoy repayment tenure up to 30 years to reduce EMI burden.</p>
      </div>
      <div class="card">
        <h3>✔ Balance Transfer Facility</h3>
        <p>Transfer your existing home loan for lower EMIs and better terms.</p>
      </div>
    </div>

    <!-- Eligibility -->
    <h2>Eligibility Criteria</h2>
    <ul>
      <li>Applicant age: 21 – 65 years</li>
      <li>Applicant must be salaried or self-employed</li>
      <li>Minimum annual income: ₹3 Lakhs</li>
      <li>Good credit score (700+ preferred)</li>
    </ul>

    <!-- Process -->
    <h2>Loan Process</h2>
    <ol>
      <li>Fill the online home loan application</li>
      <li>Submit income & property documents</li>
      <li>Eligibility check & verification</li>
      <li>Approval within 5-7 working days</li>
      <li>Loan amount disbursed directly to your account</li>
    </ol>

    <a href="applyloan.php?type=home" class="btn">Apply Now</a>
  </div>
</div>

<?php include("footer.php"); ?>
<!-- <?php include("chatbot.php"); ?> -->

</body>
</html>
