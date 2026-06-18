<?php 
include("config.php");
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ✅ Check only login (remove strict role check)
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// ✅ Add Loan
if (isset($_POST['btnadd'])) {
    $loan_name = mysqli_real_escape_string($link, $_POST['loan_name']);
    $interest_rate = floatval($_POST['interest_rate']);
    $description = mysqli_real_escape_string($link, $_POST['description']);

    if ($loan_name != "" && $interest_rate > 0) {
        $query = "INSERT INTO tblloans (loan_name, interest_rate, description) 
                  VALUES ('$loan_name','$interest_rate','$description')";
        mysqli_query($link, $query);
    }
}

// ✅ Delete Loan
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($link, "DELETE FROM tblloans WHERE id=$id");
    header("Location: manage_loans.php");
    exit();
}

// ✅ Edit Loan
if (isset($_POST['btnupdate'])) {
    $id = intval($_POST['loan_id']);
    $loan_name = mysqli_real_escape_string($link, $_POST['loan_name']);
    $interest_rate = floatval($_POST['interest_rate']);
    $description = mysqli_real_escape_string($link, $_POST['description']);

    $query = "UPDATE tblloans 
              SET loan_name='$loan_name', interest_rate='$interest_rate', description='$description' 
              WHERE id=$id";
    mysqli_query($link, $query);
}

// ✅ Fetch All Loans
$result = mysqli_query($link, "SELECT * FROM tblloans ORDER BY id DESC");
?>
