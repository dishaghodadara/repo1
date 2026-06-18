<?php include("config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Education Loan - Loanday</title>
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
      background:url('https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&w=1600&q=80') 
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
    <h1>Education Loan Solutions</h1>
    <p>Fulfill your dreams of higher education with easy financing options, affordable interest rates, and flexible repayment.</p>

    <!-- Features -->
    <h2>Key Features</h2>
    <div class="grid">
      <div class="card">
        <h3>✔ Affordable Interest</h3>
        <p>Low-interest rates starting from 8.5% per annum for students.</p>
      </div>
      <div class="card">
        <h3>✔ Flexible Repayment</h3>
        <p>Repayment starts after completion of the course with multiple EMI options.</p>
      </div>
      <div class="card">
        <h3>✔ Covers All Expenses</h3>
        <p>Includes tuition fees, hostel, books, travel, and other education costs.</p>
      </div>
      <div class="card">
        <h3>✔ Quick Disbursal</h3>
        <p>Fast loan processing so you can focus on your studies without stress.</p>
      </div>
    </div>

    <!-- Eligibility -->
    <h2>Eligibility Criteria</h2>
    <ul>
      <li>Applicant age: 18 – 35 years</li>
      <li>Indian resident with admission in a recognized institution</li>
      <li>Parents/Guardians as co-applicant</li>
      <li>Valid KYC & admission documents</li>
    </ul>

    <!-- Process -->
    <h2>Loan Process</h2>
    <ol>
      <li>Fill the online education loan application</li>
      <li>Upload KYC & admission documents</li>
      <li>Eligibility check within 24 hours</li>
      <li>Loan sanction letter provided</li>
      <li>Funds disbursed to institution</li>
    </ol>

    <a href="applyloan.php?type=education" class="btn">Apply Now</a>
  </div>
</div>

<?php include("footer.php"); ?>
</body>
</html>
