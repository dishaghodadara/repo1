<?php 
include("config.php"); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Loans</title>
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
            color: #3ac11fff;
        }

        .section-title p {
            font-size: 16px;
            color: #1d9e1dff;
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

        .btn-approve {
            background-color: #28a745;
            color: #fff;
            font-size: 14px;
            border-radius: 4px;
            padding: 5px 12px;
            transition: background-color 0.2s ease;
        }

        .btn-approve:hover {
            background-color: #218838;
        }

        .btn-reject {
            background-color: #dc3545;
            color: #fff;
            font-size: 14px;
            border-radius: 4px;
            padding: 5px 12px;
            transition: background-color 0.2s ease;
        }

        .btn-reject:hover {
            background-color: #c82333;
        }

        .badge {
            padding: 6px 12px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: bold;
        }

        .Pending { background-color: #ffc107; color: #000; }
        .Approved { background-color: #28a745; color: #fff; }
        .Rejected { background-color: #dc3545; color: #fff; }

    </style>
</head>
<body>

    <?php include("admin_header.php"); ?> 

    <section class="ftco-section bg-light">
        <div class="container">

            <div class="section-title">
                <h2>Manage Loans</h2>
                <p>Review, Approve, or Reject loan applications with ease.</p>
            </div>

            <div class="table-container">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NAME</th>
                                <th>EMAIL</th>
                                <th>PHONE</th>
                                <th>ADDRESS</th>
                                <th>LOAN AMOUNT</th>
                                <th>TYPE</th>
                                <th>Aadhar</th>
                                <th>PAN</th>
                                <th>Income Proof</th>
                                <th>STATUS</th>
                                <th>APPLY DATE</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $sql = "SELECT * FROM loan_applications";
                            $result = mysqli_query($link, $sql);
                            if(mysqli_num_rows($result) > 0){
                                while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                                <td><?= $row["loan_id"] ?></td>
                                <td><?= $row["name"] ?></td>
                                <td><?= $row["email"] ?></td>
                                <td><?= $row["phone"] ?></td>
                                <td><?= $row["address"] ?></td>
                                <td>₹<?= number_format($row["loan_amount"]) ?></td>
                                <td><?= ucfirst($row["loan_type"]) ?></td>

                                <!-- ⭐ DOCUMENT LINKS -->
                                <td>
                                    <a href="uploads/<?= $row['aadhar_doc']; ?>" target="_blank" class="btn btn-sm btn-primary">
                                        View
                                    </a>
                                </td>

                                <td>
                                    <a href="uploads/<?= $row['pan_doc']; ?>" target="_blank" class="btn btn-sm btn-primary">
                                        View
                                    </a>
                                </td>

                                <td>
                                    <a href="uploads/<?= $row['income_doc']; ?>" target="_blank" class="btn btn-sm btn-primary">
                                        View
                                    </a>
                                </td>

                                <td>
                                    <span class="badge <?= $row['status'] ?>"><?= $row["status"] ?></span>
                                </td>

                                <td><?= $row["apply_date"] ?></td>

                                <td>
                                    <div class="btn-group" role="group">
                                        <?php if($row['status'] == 'Pending'){ ?>
                                            <a href="loan_action.php?id=<?= $row['loan_id']; ?>&action=approve" class="btn btn-approve">Approve</a>
                                            <a href="loan_action.php?id=<?= $row['loan_id']; ?>&action=reject" class="btn btn-reject">Reject</a>
                                        <?php } elseif($row['status'] == 'Approved'){ ?>
                                            <a href="loan_action.php?id=<?= $row['loan_id']; ?>&action=reject" class="btn btn-reject">Reject</a>
                                        <?php } elseif($row['status'] == 'Rejected'){ ?>
                                            <a href="loan_action.php?id=<?= $row['loan_id']; ?>&action=approve" class="btn btn-approve">Approve</a>
                                        <?php } ?>
                                    </div>
                                </td>

                            </tr>
                            <?php 
                                }
                            } else {
                            ?>
                            <tr>
                                <td colspan="13" class="text-danger">🚫 No loan applications found!</td>
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
