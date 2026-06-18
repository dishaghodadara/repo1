<?php
include("config.php");

if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];

    $delete_query = "DELETE FROM admin WHERE id='$id'";
    $delete_result = mysqli_query($link, $delete_query);

    if ($delete_result) {
        header("Location: manage_admin.php");
        exit;
    } else {
        echo "Error deleting admin: " . mysqli_error($link);
    }
} else {
    echo "No admin ID provided!";
}
?>
