<?php
include("config.php");

if (!isset($_GET['id'])) {
    header("Location: admin_manage_emi.php");
    exit;
}

$id = $_GET['id'];
$sql = "SELECT * FROM tblemi WHERE id = $id";
$result = mysqli_query($link, $sql);
$data = mysqli_fetch_assoc($result);

$emi = "";

if (isset($_POST['update'])) {
    $amount = $_POST['amount'];
    $rate = $_POST['rate'];
    $tenure = $_POST['tenure'];

    // EMI calculation
    $r = $rate / 12 / 100;
    $emi = ($amount * $r * pow(1 + $r, $tenure)) / (pow(1 + $r, $tenure) - 1);
    $emi = round($emi, 2);
    $date = date("Y-m-d H:i:s");

    $update = "UPDATE tblemi SET 
                principal = '$amount', 
                rate = '$rate', 
                tenure = '$tenure', 
                emi_amount = '$emi', 
                calculation_date = '$date' 
                WHERE id = $id";

    mysqli_query($link, $update);
    header("Location: manage_emi.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit EMI</title>
    <?php include("link.php"); ?>
    <style>
        body {
            background-color: #f0f4f8;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 500px;
            margin: 60px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }
        h2 {
            text-align: center;
            color: #5FBA00;
            margin-bottom: 25px;
        }
        input[type=number] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 2px solid #ddd;
            border-radius: 8px;
        }
        .btn {
            background-color: #5FBA00;
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #4aa700;
        }
    </style>
</head>
<body>

<?php include("admin_header.php"); ?>

<div class="container">
    <h2>Edit EMI</h2>
    <form method="POST">
        <label>Loan Amount</label>
        <input type="number" name="amount" value="<?= $data['principal'] ?>" required>

        <label>Interest Rate (%)</label>
        <input type="number" name="rate" step="0.01" value="<?= $data['rate'] ?>" required>

        <label>Tenure (Months)</label>
        <input type="number" name="tenure" value="<?= $data['tenure'] ?>" required>

        <button type="submit" name="update" class="btn">Update EMI</button>
    </form>
</div>

<?php include("footer.php"); ?>

</body>
</html>
