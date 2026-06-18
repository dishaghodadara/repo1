<?php
include("config.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 🚨 User must be logged in to access this page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?msg=login_required");
    exit();
}

// Load correct header
if (isset($_SESSION['user_id'])) {
    include("header.php");   
} else {
    include("guestUserHeader.php");
}

// get loan type
$loan_type = isset($_REQUEST['type']) ? $_REQUEST['type'] : '';

if(isset($_REQUEST['apply'])){

    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    $phone = $_REQUEST['phone'];
    $address = $_REQUEST['address'];
    $loan_amount = $_REQUEST['loan_amount'];
    $loan_type = $_REQUEST['loan_type'];

    // -----------------------------
    // 📌 DOCUMENT UPLOAD SYSTEM
    // -----------------------------

    $upload_folder = "uploads/";

    // Create folder if not exists
    if(!is_dir($upload_folder)){
        mkdir($upload_folder, 0777, true);
    }

    // Aadhar Upload
    $aadhar = $_FILES['aadhar']['name'];
    $aadhar_tmp = $_FILES['aadhar']['tmp_name'];
    move_uploaded_file($aadhar_tmp, $upload_folder.$aadhar);

    // PAN Upload
    $pan = $_FILES['pan']['name'];
    $pan_tmp = $_FILES['pan']['tmp_name'];
    move_uploaded_file($pan_tmp, $upload_folder.$pan);

    // Income Proof Upload
    $income = $_FILES['income']['name'];
    $income_tmp = $_FILES['income']['tmp_name'];
    move_uploaded_file($income_tmp, $upload_folder.$income);

    // -----------------------------
    // 📌 Insert Into Database
    // -----------------------------

    $sql = "INSERT INTO loan_applications 
            (name,email,phone,address,loan_amount,loan_type,aadhar_doc,pan_doc,income_doc) 
            VALUES 
            ('$name','$email','$phone','$address','$loan_amount','$loan_type','$aadhar','$pan','$income')";
    
    if(mysqli_query($link,$sql)){
        header("Location: success.php?name=".urlencode($name)."&type=".urlencode($loan_type));
        exit;
    } else {
        echo "Error: " . mysqli_error($link);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Apply Loan - Loanday</title>
  <?php include("link.php"); ?>
</head>
<body>

  <div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow p-4">
        <h2 class="text-center mb-4">Apply for <?php echo ucfirst($loan_type); ?> Loan</h2>

        <!-- ⭐ IMPORTANT: enctype added -->
        <form method="post" enctype="multipart/form-data">

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

          <!-- 📌 DOCUMENT UPLOAD FIELDS -->
          <div class="mb-3">
            <label class="form-label">Upload Aadhar Card:</label>
            <input type="file" name="aadhar" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Upload PAN Card:</label>
            <input type="file" name="pan" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Upload Income Proof:</label>
            <input type="file" name="income" class="form-control" required>
          </div>

          <input type="hidden" name="loan_type" value="<?php echo $loan_type; ?>">

          <!-- Apply Button -->
          <button type="submit" name="apply" class="btn btn-success w-100">Apply Now</button>

          <!-- EMI Calculator -->
          <div class="text-center mt-3">
              <a href="emi_calculator.php" class="btn btn-outline-primary w-100">
                  Want to check EMI? Click here
              </a>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

  <?php include("footer.php"); ?>
  <?php include("script.php"); ?>

</body>
</html>
