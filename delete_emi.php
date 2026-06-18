<?php
include("config.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM tblemi WHERE id = $id";
    mysqli_query($link, $sql);
}

header("Location: manage_emi.php");
exit;
?>
