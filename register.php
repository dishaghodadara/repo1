<?php include("config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register</title>
  <?php include("link.php"); ?>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background: url('https://images.unsplash.com/photo-1605902711622-cfb43c4437f2?auto=format&fit=crop&w=1600&q=80') no-repeat center center fixed; background-size: cover;">

<?php
if (isset($_REQUEST["btnregister"])) {
    $name = trim($_REQUEST["txtname"]);
    $email = trim($_REQUEST["txtemail"]);
    $password = $_REQUEST["txtpassword"];
    $confirm_password = $_REQUEST["txtcpassword"];
    $city = $_REQUEST["city"];

    if (empty($name) || empty($email) || empty($password) || empty($confirm_password) || empty($city)) {
        echo "<script>alert('Please fill all fields');</script>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email');</script>";
    } elseif (!preg_match('/^[a-zA-Z ]+$/', $name)) {
        echo "<script>alert('Invalid name format');</script>";
    } elseif (strlen($password) < 6) {
        echo "<script>alert('Password must be at least 6 characters');</script>";
    } elseif ($password !== $confirm_password) {
        echo "<script>alert('Passwords and confirm password must be same');</script>";
    } else {
        // 🔹 Check for existing name OR email
        $check_query = "SELECT * FROM tbluser WHERE name='$name' OR email='$email'";
        $result = mysqli_query($link, $check_query);

        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Name or Email already exists...!!');</script>";
        } else {
            $insert_query = "INSERT INTO tbluser (name, email, password, city) VALUES ('$name', '$email', '$password', '$city')";
            if (mysqli_query($link, $insert_query)) {
                echo "<script>alert('Registration Successful'); window.location.href='login.php';</script>";
            } else {
                echo "<script>alert('Error: " . mysqli_error($link) . "');</script>";
            }
        }
    }
    mysqli_close($link);
}
?>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user_id'])) {
    include("header.php");   
} else {
    include("guestUserHeader.php");  // guest header
}
?>
<!-- Registration form with card-style container -->
<div style="padding: 40px;">
  <div style="max-width: 600px; margin: 50px auto; background-color: white; padding: 30px; border-radius: 10px; box-shadow: 0 8px 30px rgba(0,0,0,0.1);">
    <h2 style="margin-bottom: 20px; text-align: center;">Register Here</h2>
    <form action="register.php" method="post">
      <input type="text" name="txtname" placeholder="Enter Name" style="width: 100%; padding: 12px; margin-bottom: 15px;"><br>
      <input type="email" name="txtemail" placeholder="Your Email" style="width: 100%; padding: 12px; margin-bottom: 15px;"><br>
      <input type="password" name="txtpassword" placeholder="Enter Password" style="width: 100%; padding: 12px; margin-bottom: 15px;"><br>
      <input type="password" name="txtcpassword" placeholder="Confirm Password" style="width: 100%; padding: 12px; margin-bottom: 15px;"><br>

      <select name="city" style="width: 100%; padding: 12px; margin-bottom: 20px;">
        <option value="">Select City</option>
        <option value="delhi">Delhi</option>
        <option value="mumbai">Mumbai</option>
        <option value="bangalore">Bangalore</option>
        <option value="chennai">Chennai</option>
        <option value="hyderabad">Hyderabad</option>
        <option value="kolkata">Kolkata</option>
        <option value="pune">Pune</option>
        <option value="ahmedabad">Ahmedabad</option>
        <option value="surat">Surat</option>
        <option value="jaipur">Jaipur</option>
        <option value="lucknow">Lucknow</option>
        <option value="chandigarh">Chandigarh</option>
        <option value="indore">Indore</option>
        <option value="bhopal">Bhopal</option>
        <option value="varanasi">Varanasi</option>
      </select><br>

      <div style="display: flex; gap: 10px;">
        <button type="submit" name="btnregister" style="flex: 1; background-color: #83C300; color: white; border: none; padding: 12px;">REGISTER</button>
        <a href="login.php" style="flex: 1; background-color: #5FBA00; color: white; text-align: center; display: inline-block; padding: 12px; text-decoration: none;">ALREADY HAVE AN ACCOUNT?</a>
      </div>
    </form>
  </div>
</div>

<?php include("footer.php"); ?>
</body>
</html>
