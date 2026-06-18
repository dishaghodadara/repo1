<?php 
include("config.php"); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Contacts</title>
    <?php include("link.php"); ?> 
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        .action-buttons {
    display: flex;
    justify-content: center; 
    gap: 10px; 
}

        .section-title {
            text-align: center;
            margin: 40px 0 20px;
        }

        .section-title h2 {
            font-size: 30px;
            font-weight: 600;
            color: #49bb32ff;
        }

        .section-title p {
            font-size: 16px;
            color: #26a826ff;
        }

        .table-container {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
            margin-bottom: 60px;
        }

        .table thead {
            background-color: #13b042ff;
            color: white;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .btn-edit {
            background-color: #28a745;
            color: #fff;
            font-size: 14px;
            border-radius: 4px;
            padding: 5px 12px;
            transition: background-color 0.2s ease;
        }
        .btn-edit:hover {
            background-color: #218838;
        }

        .btn-delete {
            background-color: #dc3545;
            color: #fff;
            font-size: 14px;
            border-radius: 4px;
            padding: 5px 12px;
            transition: background-color 0.2s ease;
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
                <h2>Manage Contacts</h2>
                <p>View, edit, or delete user contact queries.</p>
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
                                <th>SUBJECT</th>
                                <th>MESSAGE</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $sql = "SELECT * FROM tblcontact ORDER BY id DESC";
                            $result = mysqli_query($link, $sql);
                            if(mysqli_num_rows($result) > 0){
                                while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                                <td data-label="ID"><?= $row["id"] ?></td>
                                <td data-label="Name"><?= $row["name"] ?></td>
                                <td data-label="Email"><?= $row["email"] ?></td>
                                <td data-label="Phone"><?= $row["phone"] ?></td>
                                <td data-label="Subject"><?= $row["subject"] ?></td>
                                <td data-label="Message"><?= $row["message"] ?></td>
                                    <td data-label="Action">
    <div class="action-buttons">
        
        <a href="delete_contact.php?id=<?= $row['id']; ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this contact?');">Delete</a>
    </div>
</td>


                            </tr>
                            <?php 
                                }
                            } else {
                            ?>
                            <tr>
                                <td colspan="7" class="text-danger">🚫 No contact records found!</td>
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
