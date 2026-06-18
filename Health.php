<?php include("config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Health & Medical Loan - Loanday</title>
  <?php include("link.php"); ?>
  <style>
    body { font-family: 'Segoe UI', sans-serif; margin:0; background:#f4f6f8; }

    .split-container {
      display:flex;
      min-height:100vh;
    }

    /* Left Side - Image */
.left {
  flex: 1;
  background: url('img/20220910103120.jpeg') no-repeat center/cover;
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
    <h1>Health & Medical Loan Solutions</h1>
    <p>Get financial support for medical treatments, surgeries, and healthcare expenses with easy repayment options.</p>

    <!-- Features -->
    <h2>Key Features</h2>
    <div class="grid">
      <div class="card">
        <h3>✔ Quick Approval</h3>
        <p>Fast processing of medical loans so that treatment is never delayed.</p>
      </div>
      <div class="card">
        <h3>✔ Flexible EMI Options</h3>
        <p>Choose repayment plans that suit your financial capability.</p>
      </div>
      <div class="card">
        <h3>✔ Covers All Expenses</h3>
        <p>Funds can be used for hospitalization, surgery, medicines, and diagnostics.</p>
      </div>
      <div class="card">
        <h3>✔ Affordable Interest Rates</h3>
        <p>Competitive interest rates starting from 9% per annum.</p>
      </div>
    </div>

    <!-- Eligibility -->
    <h2>Eligibility Criteria</h2>
    <ul>
      <li>Applicant age: 21 – 60 years</li>
      <li>Indian resident with valid ID & medical documents</li>
      <li>Proof of income or co-applicant if required</li>
      <li>Hospital bills/estimates for the required treatment</li>
    </ul>

    <!-- Process -->
    <h2>Loan Process</h2>
    <ol>
      <li>Fill the online medical loan application</li>
      <li>Upload KYC & medical documents</li>
      <li>Eligibility check within 24 hours</li>
      <li>Loan sanction letter provided</li>
      <li>Funds transferred to hospital/medical service provider</li>
    </ol>

    <a href="applyloan.php?type=medical" class="btn">Apply Now</a>
  </div>
</div>

<?php include("footer.php"); ?>
<?php include("chatbot.php"); ?>

</body>
</html>
