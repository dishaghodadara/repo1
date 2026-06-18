<?php 
include("config.php"); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Manage Admin</title>
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
            background-color: #007bff;
            color: #fff;
            font-size: 14px;
            border-radius: 4px;
            padding: 5px 12px;
            margin-right: 5px;
            transition: background-color 0.2s ease;
            text-decoration: none;
        }

        .btn-edit:hover {
            background-color: #0056b3;
            color: #fff;
        }

        .btn-delete {
            background-color: #dc3545;
            color: #fff;
            font-size: 14px;
            border-radius: 4px;
            padding: 5px 12px;
            transition: background-color 0.2s ease;
            text-decoration: none;
        }

        .btn-delete:hover {
            background-color: #c82333;
            color: #fff;
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
                <h2>Manage Admin</h2>
                <p>View, edit, or delete admin accounts.</p>
            </div>

            <div class="table-container">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $sql = "SELECT * FROM admin";
                            $result = mysqli_query($link, $sql);
                            if(mysqli_num_rows($result) > 0){
                                while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                                <td data-label="ID"><?= $row["id"] ?></td>
                                <td data-label="Email"><?= htmlspecialchars($row["email"]) ?></td>
                                <td data-label="Password"><?= htmlspecialchars($row["password"]) ?></td>
                                <td data-label="Action">
                                    <a href="edit_admin.php?id=<?= $row['id']; ?>" class="btn-edit">Edit</a>
                                    <a href="delete_admin.php?id=<?= $row['id']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this admin?');">Delete</a>
                                </td>
                            </tr>
                            <?php 
                                }
                            } else {
                            ?>
                            <tr>
                                <td colspan="4" class="text-danger">🚫 No admin accounts found!</td>
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
