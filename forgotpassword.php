<?php
session_start();
include("config.php");

if (isset($_POST["btnforgot"])) {
    $email = trim($_POST["email"]);

    if (!empty($email)) {
        $query = "SELECT password FROM tbluser WHERE email='$email'";
        $result = mysqli_query($link, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $password = $row["password"];
            echo "<script>alert('Your password is: $password'); window.location.href='login.php';</script>";
        } else {
            echo "<script>alert('Email not found!');</script>";
        }
    } else {
        echo "<script>alert('Please enter your email');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Forgot Password</title>
  <?php include("link.php"); ?>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background: url('https://images.unsplash.com/photo-1605902711622-cfb43c4437f2?auto=format&fit=crop&w=1600&q=80') no-repeat center center fixed; background-size: cover;">

<?php include("header.php"); ?>

<div style="padding: 40px;">
  <div style="max-width: 500px; margin: 50px auto; background-color: white; padding: 30px; border-radius: 10px; box-shadow: 0 8px 30px rgba(0,0,0,0.1);">
    <h2 style="margin-bottom: 20px; text-align: center;">Forgot Password</h2>
    <form action="forgotpassword.php" method="post">
      <input type="email" name="email" placeholder="Enter your Email ID" style="width: 100%; padding: 12px; margin-bottom: 15px;" required><br>
      <button type="submit" name="btnforgot" style="width: 100%; background-color: #83C300; color: white; border: none; padding: 12px;">Get Password</button>
    </form>
  </div>
</div>

<?php include("footer.php"); ?>
</body>
</html>
