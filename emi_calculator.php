<?php 
include("config.php");
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ✅ Load header based on login
if (isset($_SESSION['user_id'])) {
    include("header.php");   
} else {
    include("guestUserHeader.php");
}
 ?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Loan EMI Calculator">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan EMI Calculator</title>
    <?php include("link.php"); ?> 
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f4f8;
            margin: 0;
            padding: 0;
        }
        .calculator-container {
            max-width: 600px;
            margin: 60px auto;
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #5FBA00;
            margin-bottom: 30px;
        }
        .form-group { margin-bottom: 20px; }
        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 10px;
            font-size: 16px;
        }
        .btn {
            width: 100%;
            padding: 15px;
            background: #83C300;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 17px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }
        .btn:hover { background: #5FBA00; }
        .result {
            margin-top: 30px;
            padding: 20px;
            background: #e8f5e9;
            border-left: 5px solid #5FBA00;
            border-radius: 10px;
            font-size: 18px;
        }
    </style>
</head>
<body>



<div class="calculator-container">
    <h2>Loan EMI Calculator</h2>

    <?php
    $emi = "";
    $selectedLoan = "";
    $rate = 0;

    // ✅ Fetch loan schemes with ID + rate
    $loanQuery = "SELECT id, loan_name, interest_rate FROM tblloans";
    $loanResult = mysqli_query($link, $loanQuery);

    if (isset($_POST['btncalculate'])) {
        $selectedLoan = intval($_POST['loan_id']);
        $principal = floatval($_POST['txtamount']);
        $tenure = intval($_POST['txttenure']);

        // ✅ Fetch interest rate for selected loan
        $rateQuery = "SELECT interest_rate FROM tblloans WHERE id='$selectedLoan'";
        $rateRes = mysqli_query($link, $rateQuery);
        $rateRow = mysqli_fetch_assoc($rateRes);
        $rate = $rateRow['interest_rate'];

        if ($principal <= 0 || $rate <= 0 || $tenure <= 0) {
            echo "<div class='result'>Please enter valid values!</div>";
        } else {
            // ✅ EMI Calculation
            $monthlyRate = $rate / 12 / 100;
            $emi = ($principal * $monthlyRate * pow(1 + $monthlyRate, $tenure)) /
                   (pow(1 + $monthlyRate, $tenure) - 1);
            $emi = round($emi, 2);

            // ✅ Save to DB (without loan_id because not in your table)
            $query = "INSERT INTO tblemi (principal, rate, tenure, emi_amount, calculation_date)
                      VALUES ('$principal','$rate','$tenure','$emi', NOW())";
            $result = mysqli_query($link, $query);

            if(!$result){
                echo "<div class='result'>Failed to save EMI in database! Error: " . mysqli_error($link) . "</div>";
            }
        }
    }
    ?>

    <form action="emi_calculator.php" method="post">
        <div class="form-group">
            <label>Select Loan Type</label>
            <select name="loan_id" required>
                <option value="">-- Select Loan --</option>
                <?php while($row = mysqli_fetch_assoc($loanResult)) { ?>
                    <option value="<?php echo $row['id']; ?>" 
                        <?php if($selectedLoan == $row['id']) echo "selected"; ?>>
                        <?php echo $row['loan_name'] . " (" . $row['interest_rate'] . "%)"; ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <label>Loan Amount</label>
            <input type="number" name="txtamount" placeholder="Enter loan amount" required>
        </div>

        <div class="form-group">
            <label>Tenure (Months)</label>
            <input type="number" name="txttenure" placeholder="Enter tenure in months" required>
        </div>

        <button type="submit" name="btncalculate" class="btn">Calculate EMI</button>
    </form>

    <?php if ($emi != ""): ?>
        <div class="result">
            Selected Loan Rate: <strong><?php echo $rate; ?>%</strong><br>
            Your Monthly EMI is: <strong>₹<?php echo $emi; ?></strong>
        </div>
    <?php endif; ?>
</div>

<?php include("footer.php"); ?>

</body>
</html>
