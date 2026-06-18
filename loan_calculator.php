<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Loan Calculator Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <?php include("link.php"); // your CSS or other links ?>
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Roboto', sans-serif; }
    
    body { background: #e0eafc; padding: 0; margin: 0; }

    .dashboard {
      max-width: 1000px;
      width: 100%;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
      margin: 30px auto;
      padding: 0 20px;
    }

    .card {
      background: #fff;
      border-radius: 20px;
      padding: 25px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .card h2 {
      margin-bottom: 20px;
      color: #333;
      text-align: center;
    }

    .input-group { margin-bottom: 15px; }
    .input-group label { display: block; margin-bottom: 5px; font-weight: 500; }
    .input-group input {
      width: 100%;
      padding: 12px;
      border-radius: 10px;
      border: 1px solid #ccc;
      font-size: 16px;
    }

    .summary {
      background: #f5f7ff;
      border-radius: 15px;
      padding: 15px;
      margin-top: 15px;
      text-align: center;
      font-weight: bold;
      color: #333;
    }

    .breakdown {
      max-height: 400px;
      overflow-y: auto;
      margin-top: 15px;
    }

    table { width: 100%; border-collapse: collapse; }
    th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
    th { background: #4CAF50; color: white; position: sticky; top: 0; }

    @media (max-width: 800px) { .dashboard { grid-template-columns: 1fr; } }
  </style>
</head>
<body>

  <?php include("header.php"); // your header ?>

  <!-- Dashboard -->
  <div class="dashboard">
    <!-- Loan Input Card -->
    <div class="card">
      <h2>Loan Inputs</h2>
      <div class="input-group">
        <label for="principal">Loan Amount (₹)</label>
        <input type="number" id="principal" placeholder="Enter loan amount" />
      </div>
      <div class="input-group">
        <label for="interest">Annual Interest Rate (%)</label>
        <input type="number" id="interest" placeholder="Enter interest rate" />
      </div>
      <div class="input-group">
        <label for="years">Loan Term (Years)</label>
        <input type="number" id="years" placeholder="Enter term in years" />
      </div>
    </div>

    <!-- Summary & EMI Card -->
    <div class="card">
      <h2>Loan Summary</h2>
      <div class="summary" id="summary">EMI, Total Interest & Payment will appear here...</div>
    </div>

    <!-- Monthly Breakdown Card -->
    <div class="card" style="grid-column: span 2;">
      <h2>Monthly Breakdown</h2>
      <div class="breakdown" id="breakdown"></div>
    </div>
  </div>

  <?php include("footer.php"); // your footer ?>
  <?php include("script.php"); // your JS scripts if any ?>

  <script>
    const principalInput = document.getElementById('principal');
    const interestInput = document.getElementById('interest');
    const yearsInput = document.getElementById('years');
    const summaryDiv = document.getElementById('summary');
    const breakdownDiv = document.getElementById('breakdown');

    function calculateLoan() {
      const principal = parseFloat(principalInput.value);
      const annualInterest = parseFloat(interestInput.value);
      const years = parseFloat(yearsInput.value);

      if (!principal || !annualInterest || !years) {
        summaryDiv.innerHTML = "Please fill all fields!";
        breakdownDiv.innerHTML = "";
        return;
      }

      const monthlyInterest = annualInterest / 12 / 100;
      const totalMonths = years * 12;
      const emi = (principal * monthlyInterest * Math.pow(1 + monthlyInterest, totalMonths)) / (Math.pow(1 + monthlyInterest, totalMonths) - 1);
      const totalPayment = emi * totalMonths;
      const totalInterest = totalPayment - principal;

      summaryDiv.innerHTML = `
        EMI per Month: ₹${emi.toFixed(2)}<br>
        Total Interest: ₹${totalInterest.toFixed(2)}<br>
        Total Payment: ₹${totalPayment.toFixed(2)}
      `;

      let tableHTML = '<table><tr><th>Month</th><th>Principal Paid</th><th>Interest Paid</th><th>Balance</th></tr>';
      let balance = principal;

      for (let i = 1; i <= totalMonths; i++) {
        const interestPayment = balance * monthlyInterest;
        const principalPayment = emi - interestPayment;
        balance -= principalPayment;
        tableHTML += `<tr>
          <td>${i}</td>
          <td>₹${principalPayment.toFixed(2)}</td>
          <td>₹${interestPayment.toFixed(2)}</td>
          <td>₹${balance.toFixed(2)}</td>
        </tr>`;
      }
      tableHTML += '</table>';
      breakdownDiv.innerHTML = tableHTML;
    }

    principalInput.addEventListener('input', calculateLoan);
    interestInput.addEventListener('input', calculateLoan);
    yearsInput.addEventListener('input', calculateLoan);
  </script>
</body>
</html>
