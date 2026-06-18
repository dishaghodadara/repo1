<?php 
include("config.php"); 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login</title>
  <?php include("link.php"); ?>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background: url('https://images.unsplash.com/photo-1605902711622-cfb43c4437f2?auto=format&fit=crop&w=1600&q=80') no-repeat center center fixed; background-size: cover;">

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user_id'])) {
    include("header.php");   
} else {
    include("guestUserHeader.php");  // guest header
}
?>


<?php
if (isset($_REQUEST["btnlogin"])) {
    $email = trim($_REQUEST["txtemail"]);
    $password = trim($_REQUEST["txtpassword"]);

    if (empty($email) || empty($password)) {
        echo "<script>alert('Please enter both email and password');</script>";
    } else {
        // First check in admin table
        $query_admin = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
        $result_admin = mysqli_query($link, $query_admin);

        if (mysqli_num_rows($result_admin) == 1) {
            $_SESSION["admin"] = $email;
            echo "<script>alert('Admin login successful'); window.location.href='admin_dashboard.php';</script>";
            exit;
        }

        //If not admin, check in user table
        $query_user = "SELECT * FROM tbluser WHERE email='$email' AND password='$password'";
        $result_user = mysqli_query($link, $query_user);

        if (mysqli_num_rows($result_user) == 1) {
            $row = mysqli_fetch_assoc($result_user);

            //  store user id and email in session
            $_SESSION["user_id"] = $row['id'];
            $_SESSION["user"] = $row['email'];

            echo "<script>alert('User login successful'); window.location.href='index.php';</script>";
            exit;
        } else {
            echo "<script>alert('User not exist..');window.location.href='register.php';</script>";
        }
    }
}
?>

<!-- Login form container -->
<div style="padding: 40px;">
  <div style="max-width: 500px; margin: 60px auto; background-color: white; padding: 30px; border-radius: 10px; box-shadow: 0 8px 30px rgba(0,0,0,0.1);">
    <h2 style="text-align: center; margin-bottom: 25px;">Login</h2>
    
    <form action="login.php" method="post">
      <input type="email" name="txtemail" placeholder="Enter Email" 
             style="width: 100%; padding: 12px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px;">
      
      <input type="password" name="txtpassword" placeholder="Enter Password" 
             style="width: 100%; padding: 12px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 5px;">
      
      <div style="text-align: right; margin-bottom: 20px;">
        <a href="forgotpassword.php" style="color: #5FBA00; text-decoration: none; font-size: 14px;">Forgot Password?</a>
      </div>

      <div style="display: flex; gap: 10px;">
        <button type="submit" name="btnlogin" 
                style="flex: 1; background-color: #83C300; color: white; border: none; padding: 12px; border-radius: 5px;">
          LOGIN
        </button>
        <a href="register.php" 
           style="flex: 1; background-color: #5FBA00; color: white; text-align: center; display: inline-block; padding: 12px; text-decoration: none; border-radius: 5px;">
          NEW USER?
        </a>
      </div>
    </form>
  </div>
</div>

<?php include("footer.php"); ?>
</body>
</html>
