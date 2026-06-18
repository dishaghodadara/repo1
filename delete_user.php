<?php
include("config.php"); // connect to database

// Check if ID is set
if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];

    // Run DELETE query
    $query = "DELETE FROM tbluser WHERE id = '$id'";
    $result = mysqli_query($link, $query);

    // Check if deletion was successful
    if ($result) {
        // Redirect back to user list page with success message (optional)
        header("Location: manage_user.php?msg=deleted");
        exit;
    } else {
        echo "❌ Error deleting user: " . mysqli_error($link);
    }
} else {
    echo "⚠️ No user ID provided.";
}
?>
