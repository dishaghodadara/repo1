<?php
session_start();
include("config.php");

if (!isset($_SESSION["user"])) {
    echo "<script>alert('Please login first'); window.location.href='login.php';</script>";
    exit();
}

if (isset($_POST["btnchange"])) {
    $email = $_SESSION["user"];
    $current = trim($_POST["currentpass"]);
    $new = trim($_POST["newpass"]);
    $confirm = trim($_POST["confirmpass"]);

    $query = "SELECT password FROM tbluser WHERE email='$email'";
    $result = mysqli_query($link, $query);
    $user = mysqli_fetch_assoc($result);

    if ($current != $user['password']) {
        echo "<script>alert('Current password is incorrect');</script>";
    } elseif (strlen($new) < 6) {
        echo "<script>alert('New password must be at least 6 characters');</script>";
    } elseif ($new !== $confirm) {
        echo "<script>alert('New passwords do not match');</script>";
    } else {
        $update = "UPDATE tbluser SET password='$new' WHERE email='$email'";
        if (mysqli_query($link, $update)) {
            echo "<script>alert('Password changed successfully'); window.location.href='login.php';</script>";
            session_destroy(); 
        } else {
            echo "<script>alert('Error updating password');</script>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Change Password</title>
  <?php include("link.php"); ?>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background: url('https://images.unsplash.com/photo-1605902711622-cfb43c4437f2?auto=format&fit=crop&w=1600&q=80') no-repeat center center fixed; background-size: cover;">

<?php include("header.php"); ?>

<div style="padding: 40px;">
  <div style="max-width: 500px; margin: 50px auto; background-color: white; padding: 30px; border-radius: 10px; box-shadow: 0 8px 30px rgba(0,0,0,0.1);">
    <h2 style="margin-bottom: 20px; text-align: center;">Change Password</h2>
    <form action="change_password.php" method="post">
      <input type="password" name="currentpass" placeholder="Current Password" style="width: 100%; padding: 12px; margin-bottom: 15px;" required><br>
      <input type="password" name="newpass" placeholder="New Password" style="width: 100%; padding: 12px; margin-bottom: 15px;" required><br>
      <input type="password" name="confirmpass" placeholder="Confirm New Password" style="width: 100%; padding: 12px; margin-bottom: 20px;" required><br>

      <button type="submit" name="btnchange" style="width: 100%; background-color: #83C300; color: white; border: none; padding: 12px;">CHANGE PASSWORD</button>
    </form>
  </div>
</div>

<?php include("footer.php"); ?>
</body>
</html>