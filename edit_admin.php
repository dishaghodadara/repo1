<?php
include("config.php");

if (!isset($_GET['id'])) {
    header("Location: manage_admin.php");
    exit;
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM admin WHERE id = $id";
$result = mysqli_query($link, $sql);
$data = mysqli_fetch_assoc($result);

$error = "";

if (!$data) {
    // If no record found, redirect
    header("Location: manage_admin.php");
    exit;
}

if (isset($_POST['update'])) {
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $password = mysqli_real_escape_string($link, $_POST['password']);

    if (empty($email) || empty($password)) {
        $error = "Please fill all fields.";
    } else {
        $update = "UPDATE admin SET email = '$email', password = '$password' WHERE id = $id";
        if (mysqli_query($link, $update)) {
            header("Location: manage_admin.php?msg=updated");
            exit;
        } else {
            $error = "Update failed: " . mysqli_error($link);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Admin</title>
    <?php include("link.php"); ?>
    <style>
        body {
            background-color: #f0f4f8;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 450px;
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
        input[type=email], input[type=text] {
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
        .error {
            color: red;
            font-weight: 600;
            margin-bottom: 20px;
            text-align: center;
        }
        .cancel-link {
            display: block;
            margin-top: 15px;
            text-align: center;
            color: #5FBA00;
            text-decoration: none;
            font-weight: 600;
        }
        .cancel-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<?php include("admin_header.php"); ?>
<section>
<div class="container">
    <h2>Edit Admin</h2>
    
    <?php if ($error): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
        <label>Email</label>
        <input type="email" name="email" value="<?= htmlspecialchars($data['email']) ?>" required>

        <label>Password</label>
        <input type="text" name="password" value="<?= htmlspecialchars($data['password']) ?>" required>

        <button type="submit" name="update" class="btn">Update Admin</button>
    </form>
    <a href="manage_admin.php" class="cancel-link">Cancel</a>
</div>
</section>

<?php include("footer.php"); ?>

</body>
</html>
