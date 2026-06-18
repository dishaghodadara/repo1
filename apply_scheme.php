<?php
include("config.php");
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ✅ Check login
if (!isset($_SESSION['user_id'])) { 
    header("Location: login.php"); 
    exit(); 
}

// ✅ Fetch scheme from DB
$scheme_id = $_GET['id'];
$query = "SELECT * FROM tblschemes WHERE id='$scheme_id'";
$result = mysqli_query($link, $query);
$scheme = mysqli_fetch_assoc($result);

if (!$scheme) {
    echo "Invalid Scheme!";
    exit();
}

if (isset($_POST['apply'])) {
    $name = mysqli_real_escape_string($link, $_POST['name']);
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $phone = mysqli_real_escape_string($link, $_POST['phone']);
    $address = mysqli_real_escape_string($link, $_POST['address']);
    $loan_amount = mysqli_real_escape_string($link, $_POST['loan_amount']);
    $loan_type = mysqli_real_escape_string($link, $_POST['loan_type']); // scheme title

    $insert = "INSERT INTO loan_applications 
               (name, email, phone, address, loan_amount, loan_type, status, apply_date) 
               VALUES ('$name', '$email', '$phone', '$address', '$loan_amount', '$loan_type', 'Pending', NOW())";

    if (mysqli_query($link, $insert)) {
        echo "<script>alert('Loan application submitted successfully!'); window.location='index.php';</script>";
    } else {
        echo "Error: " . mysqli_error($link);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Apply Scheme - <?php echo $scheme['title']; ?></title>
  <?php include("link.php"); ?>
</head>
<body>

<?php include("header.php"); ?>

<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-6"> <!-- 👈 Center card -->
      <div class="card shadow p-4">
        <h2 class="text-center mb-4">Apply for <?php echo $scheme['title']; ?></h2>
        <p class="text-muted text-center"><?php echo $scheme['description']; ?></p>

        <form method="post">
          <div class="mb-3">
            <label class="form-label">Full Name:</label>
            <input type="text" name="name" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Email:</label>
            <input type="email" name="email" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Phone:</label>
            <input type="text" name="phone" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Address:</label>
            <textarea name="address" rows="2" class="form-control" required></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">Loan Amount (₹):</label>
            <input type="number" name="loan_amount" class="form-control" required>
          </div>

          <input type="hidden" name="loan_type" value="<?php echo $scheme['title']; ?>">

          <!-- 🔹 Apply Now -->
          <button type="submit" name="apply" class="btn btn-success w-100">Apply Now</button>

          <!-- 🔹 EMI Calculator -->
          <div class="text-center mt-3">
              <a href="emi_calculator.php" class="btn btn-outline-primary w-100">
                  Want to check EMI? Click here
              </a>
          </div>

          <a href="schemes.php" class="btn btn-secondary mt-3 w-100">Cancel</a>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include("footer.php"); ?>
<?php include("script.php"); ?>
</body>
</html>
