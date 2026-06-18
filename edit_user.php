<?php
include("config.php");

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM tbluser WHERE id = $id";
    $result = mysqli_query($link, $sql);
    if($result && mysqli_num_rows($result) == 1){
        $user = mysqli_fetch_assoc($result);
    } else {
        echo "User not found!";
        exit;
    }
}

if(isset($_POST['update'])){
    $name = mysqli_real_escape_string($link, $_POST['name']);
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $city = mysqli_real_escape_string($link, $_POST['city']);

    $update_sql = "UPDATE tbluser SET name='$name', email='$email', city='$city' WHERE id=$id";
    if(mysqli_query($link, $update_sql)){
        header("Location: manage_user.php"); // redirect back after update
    } else {
        echo "Error updating record: " . mysqli_error($link);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <?php include("link.php"); ?>
</head>
<body>
    <?php include("admin_header.php"); ?>

    <div class="container" style="margin-top:50px;">
        <h2>Edit User</h2>
        <form method="POST">
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="<?= $user['name'] ?>" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?= $user['email'] ?>" required>
            </div>
            <div class="mb-3">
                <label>City</label>
                <input type="text" name="city" class="form-control" value="<?= $user['city'] ?>" required>
            </div>
            <button type="submit" name="update" class="btn btn-success">Update User</button>
        </form>
    </div>

    <?php include("footer.php"); ?>
    <?php include("script.php"); ?>
</body>
</html>
