

<?php
 include("header.php"); 
session_start();
include("config.php"); 

if(!isset($_SESSION["user"])){
    echo "⚠ Session expired or user not logged in.";
    exit();
}

$email = $_SESSION["user"];
$userQuery = mysqli_query($link, "SELECT name FROM tbluser WHERE email='$email'");
$user = mysqli_fetch_assoc($userQuery);

// Fetch all loans
$loanQuery = mysqli_query($link, "SELECT loan_id, loan_type, loan_amount, status, apply_date FROM loan_applications WHERE email='$email' ORDER BY apply_date DESC");
$loans = mysqli_fetch_all($loanQuery, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Loan History</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>


<div class="container my-5">
    <h2 class="mb-4">Loan History for <?= htmlspecialchars($user['name']) ?></h2>

    <?php if(count($loans) > 0): ?>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Loan ID</th>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Applied On</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($loans as $loan): ?>
                <tr>
                    <td><?= $loan['loan_id'] ?></td>
                    <td><?= htmlspecialchars($loan['loan_type']) ?></td>
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
        <p>You have not applied for any loans yet. <a href="apply_loan.php">Apply for a loan now</a>.</p>
    <?php endif; ?>
</div>

<?php include("footer.php"); ?>
</body>
</html>
