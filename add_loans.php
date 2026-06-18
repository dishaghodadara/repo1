<?php
include("config.php");
//session_start();

// ✅ Only allow admin
// if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
//     header("Location: login.php");
//     exit();
// }

$message = "";

// ✅ Handle Delete
if (isset($_GET['delete'])) {
    $loan_id = intval($_GET['delete']);
    $query = "DELETE FROM tblloans WHERE id = $loan_id";
    mysqli_query($link, $query);
    $message = "Loan deleted successfully!";
}

// ✅ Handle Add / Update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $loan_name = $_POST['loan_name'];
    $interest_rate = $_POST['interest_rate'];
    $description = $_POST['description'];

    // Handle file upload
    $loan_image = "";
    if (!empty($_FILES['loan_image']['name'])) {
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $loan_image = $targetDir . time() . "_" . basename($_FILES["loan_image"]["name"]);
        move_uploaded_file($_FILES["loan_image"]["tmp_name"], $loan_image);
    }

    // If editing
    if (isset($_POST['loan_id']) && $_POST['loan_id'] != "") {
        $loan_id = $_POST['loan_id'];
        if ($loan_image != "") {
            $query = "UPDATE tblloans SET loan_name='$loan_name', interest_rate='$interest_rate', description='$description', loan_image='$loan_image' WHERE id=$loan_id";
        } else {
            $query = "UPDATE tblloans SET loan_name='$loan_name', interest_rate='$interest_rate', description='$description' WHERE id=$loan_id";
        }
        mysqli_query($link, $query);
        $message = "Loan updated successfully!";
    } else {
        // Add new
        $query = "INSERT INTO tblloans (loan_name, interest_rate, description, loan_image, created_at) 
                  VALUES ('$loan_name', '$interest_rate', '$description', '$loan_image', NOW())";
        mysqli_query($link, $query);
        $message = "Loan added successfully!";
    }
}

// ✅ If edit request → fetch details
$editData = null;
if (isset($_GET['edit'])) {
    $loan_id = intval($_GET['edit']);
    $result = mysqli_query($link, "SELECT * FROM tblloans WHERE id=$loan_id");
    $editData = mysqli_fetch_assoc($result);
}

// ✅ Fetch all loans
$loans = mysqli_query($link, "SELECT * FROM tblloans ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Loans</title>
    <?php include("link.php"); ?> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
     <style>
/* Section Title */
.section-title h2 {
    font-size: 32px;
    color: #26a826;
    font-weight: 700;
    margin-bottom: 5px;
}

.section-title p {
    font-size: 16px;
    color: #26a826;
    margin-bottom: 20px;
}

/* Table Styling */
.table {
    border-radius: 8px;
    overflow: hidden;
}

.table thead {
    background-color: #26a826;
    color: #fff;
    font-weight: 600;
    font-size: 14px;
}

.table tbody tr {
    background-color: #fff;
    transition: 0.3s;
}

.table tbody tr:hover {
    background-color: #f1fdf1;
}

.table td, .table th {
    vertical-align: middle;
    text-align: center;
}

/* Buttons */
.btn-primary {
    background-color: #26a826;
    border-color: #26a826;
}

.btn-primary:hover {
    background-color: #1e871f;
    border-color: #1e871f;
}

.btn-danger {
    background-color: #dc3545;
    border-color: #dc3545;
}

.btn-danger:hover {
    background-color: #b02a37;
    border-color: #b02a37;
}

.btn-success {
    background-color: #26a826;
    border-color: #26a826;
}

.btn-success:hover {
    background-color: #1e871f;
    border-color: #1e871f;
}

/* Card */
.card {
    border-radius: 10px;
    overflow: hidden;
}

/* Form Inputs */
.form-control {
    border-radius: 6px;
}
</style>

</head>
<body class="bg-light">
<?php
include("admin_header.php");?>
<div class="container py-4">
    

    <!-- <?php if ($message) { ?>
        <div class="alert alert-success"><?= $message ?></div>
    <?php } ?> -->
    <div class="section-title text-center">
    <h2>Manage Loans</h2>
    <p>Add, edit, or delete loans</p>
</div>

    <!-- ✅ Loan List Table -->
    <table class="table table-bordered bg-white shadow-sm">
        
        <thead class="" style="font-size: 16px;
            color: #26a826ff;">
            <tr>
                <th>ID</th>
                <th>Loan Name</th>
                <th>Interest Rate</th>
                <th>Description</th>
                <th>Image</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($loan = mysqli_fetch_assoc($loans)) { ?>
                <tr>
                    <td><?= $loan['id'] ?></td>
                    <td><?= $loan['loan_name'] ?></td>
                    <td><?= $loan['interest_rate'] ?>%</td>
                    <td><?= $loan['description'] ?></td>
                    <td>
                        <?php if ($loan['loan_image']) { ?>
                            <img src="<?= $loan['loan_image'] ?>" width="60">
                        <?php } ?>
                    </td>
                    <td><?= $loan['created_at'] ?></td>
                    <td>
                        <a href="add_loans.php?edit=<?= $loan['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                        <a href="add_loans.php?delete=<?= $loan['id'] ?>" class="btn btn-sm btn-danger"
                           onclick="return confirm('Are you sure you want to delete this loan?');">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- ✅ Add / Edit Form -->
    <div class="card shadow-sm mt-4">
        <div class="card-header bg-dark text-white">
            <?= $editData ? "Edit Loan" : "Add New Loan" ?>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <?php if ($editData) { ?>
                    <input type="hidden" name="loan_id" value="<?= $editData['id'] ?>">
                <?php } ?>

                <div class="mb-3">
                    <label class="form-label">Loan Name</label>
                    <input type="text" name="loan_name" class="form-control" 
                           value="<?= $editData['loan_name'] ?? '' ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Interest Rate (%)</label>
                    <input type="number" step="0.01" name="interest_rate" class="form-control" 
                           value="<?= $editData['interest_rate'] ?? '' ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3" required><?= $editData['description'] ?? '' ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Loan Image</label>
                    <input type="file" name="loan_image" class="form-control">
                    <?php if ($editData && $editData['loan_image']) { ?>
                        <p>Current: <img src="<?= $editData['loan_image'] ?>" width="80"></p>
                    <?php } ?>
                </div>

                <button type="submit" class="btn btn-success">
                    <?= $editData ? "Update Loan" : "Add Loan" ?>
                </button>
            </form>
        </div>
        
    </div>
    
</div>
 <?php include("footer.php"); ?> 
    <?php include("script.php"); ?>
</body>
</html>
