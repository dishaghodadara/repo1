<?php
include("config.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM tblcontact WHERE id = $id";

    if (mysqli_query($link, $sql)) {
        echo "<script>alert(' Contact deleted successfully'); window.location='manage_contact.php';</script>";
    } else {
        echo "Error: " . mysqli_error($link);
    }
} else {
    header("Location: manage_contact.php");
    exit();
}
?>
