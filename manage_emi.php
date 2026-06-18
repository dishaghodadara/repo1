<?php 
include("config.php"); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage EMI</title>
    <?php include("link.php"); ?> 
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .section-title {
            text-align: center;
            margin: 40px 0 20px;
        }

        .section-title h2 {
            font-size: 30px;
            font-weight: 600;
            color: #3ed320ff;
        }

        .section-title p {
            font-size: 16px;
            color: #11ed5eff;
        }

        .table-container {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
            margin-bottom: 60px;
        }

        .table thead {
            background-color: #43ae20ff;
            color: white;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .btn-edit {
            background-color: #ffc107;
            color: #000;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 14px;
        }

        .btn-delete {
            background-color: #dc3545;
            color: #fff;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 14px;
        }

        .btn-edit:hover {
            background-color: #e0a800;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }

        @media (max-width: 768px) {
            .table thead {
                display: none;
            }
            .table, .table tbody, .table tr, .table td {
                display: block;
                width: 100%;
            }
            .table td {
                text-align: right;
                padding-left: 50%;
                position: relative;
            }
            .table td::before {
                content: attr(data-label);
                position: absolute;
                left: 15px;
                width: 45%;
                text-align: left;
                font-weight: bold;
            }
        }
    </style>
</head>
<body>

<?php include("admin_header.php"); ?> 

<section class="ftco-section bg-light">
    <div class="container">

        <div class="section-title">
            <h2>Manage EMI Records</h2>
            <p>Update or Delete EMI calculations.</p>
        </div>

        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Principal</th>
                            <th>Rate (%)</th>
                            <th>Tenure (Months)</th>
                            <th>EMI Amount</th>
                            <th>Calculation Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $sql = "SELECT * FROM tblemi ORDER BY id DESC";
                        $result = mysqli_query($link, $sql);
                        if(mysqli_num_rows($result) > 0){
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td data-label="ID"><?= $row["id"] ?></td>
                            <td data-label="Principal">₹<?= number_format($row["principal"], 2) ?></td>
                            <td data-label="Rate"><?= $row["rate"] ?>%</td>
                            <td data-label="Tenure"><?= $row["tenure"] ?> months</td>
                            <td data-label="EMI">₹<?= number_format($row["emi_amount"], 2) ?></td>
                            <td data-label="Date"><?= $row["calculation_date"] ?></td>
                            <td data-label="Action">
                                <a href="edit_emi.php?id=<?= $row['id'] ?>" class="btn btn-edit">Edit</a>
                                <a href="delete_emi.php?id=<?= $row['id'] ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this EMI?');">Delete</a>
                            </td>
                        </tr>
                        <?php 
                            }
                        } else {
                        ?>
                        <tr>
                            <td colspan="7" class="text-danger">🚫 No EMI records found!</td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</section>

<?php include("footer.php"); ?> 
<?php include("script.php"); ?> 

</body>
</html>
