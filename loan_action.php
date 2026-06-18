<?php
include("config.php");

if (isset($_GET['id']) && isset($_GET['action'])) {
    $loan_id = $_GET['id'];
    $action = $_GET['action'];

    // Only allow approve or reject actions
    if ($action == "approve" || $action == "reject") {
        $status = ($action == "approve") ? "Approved" : "Rejected";

        $sql = "UPDATE loan_applications SET status = '$status' WHERE loan_id = '$loan_id'";
        $result = mysqli_query($link, $sql);

        if ($result) {
            // Redirect back to manage page with a success message (optional)
            header("Location: manage_loans.php?msg=Loan $status successfully");
            exit();
        } else {
            echo "❌ Error updating loan status: " . mysqli_error($link);
        }
    } else {
        echo "❌ Invalid action!";
    }
} else {
    echo "❌ Loan ID or action not provided!";
}
?>
