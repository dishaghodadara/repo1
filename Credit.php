<?php include("config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Credit & Debit Cards - Loanday</title>
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
    background:url('https://images.unsplash.com/photo-1563013544-824ae1b704d3?auto=format&fit=crop&w=1600&q=80') 
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
    <h1>Credit & Debit Card Services</h1>
    <p>Enjoy seamless payments, exciting rewards, and financial convenience with our card services.</p>

    <!-- Features -->
    <h2>Key Features</h2>
    <div class="grid">
      <div class="card">
        <h3>✔ Wide Acceptance</h3>
        <p>Use cards at millions of merchants and ATMs worldwide.</p>
      </div>
      <div class="card">
        <h3>✔ Reward Programs</h3>
        <p>Earn cashback, reward points, and exclusive offers on every spend.</p>
      </div>
      <div class="card">
        <h3>✔ Secure Transactions</h3>
        <p>Advanced security with OTP, EMV chip, and fraud protection.</p>
      </div>
      <div class="card">
        <h3>✔ Easy Bill Payments</h3>
        <p>Pay your utility bills, mobile recharge, and online shopping instantly.</p>
      </div>
    </div>

    <!-- Eligibility -->
    <h2>Eligibility Criteria</h2>
    <ul>
      <li>Applicant age: 18 years or above</li>
      <li>Valid income proof (for credit card)</li>
      <li>Savings/Current account holder (for debit card)</li>
      <li>Good credit history (for credit card applicants)</li>
    </ul>

    <!-- Process -->
    <h2>Application Process</h2>
    <ol>
      <li>Choose your preferred card type</li>
      <li>Fill the online card application</li>
      <li>Upload KYC & income documents</li>
      <li>Verification by bank</li>
      <li>Card issued & delivered at your address</li>
    </ol>

    <a href="applyloan.php?type=card" class="btn">Apply Now</a>
  </div>
</div>

<?php include("footer.php"); ?>
</body>
</html>
