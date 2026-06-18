<?php
include("config.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($link) || !$link) {
    die("Database connection not found. Check config.php.");
}

$id = intval($_GET['id'] ?? 0);
if ($id <= 0) {
    die("Invalid scheme ID.");
}

// Fetch scheme to delete image also
$res = mysqli_query($link, "SELECT image FROM tblschemes WHERE id=$id LIMIT 1");
if ($res && mysqli_num_rows($res) > 0) {
    $scheme = mysqli_fetch_assoc($res);

    // Delete image from folder
    if ($scheme['image'] && file_exists(__DIR__ . "/" . $scheme['image'])) {
        unlink(__DIR__ . "/" . $scheme['image']);
    }

    // Delete record
    mysqli_query($link, "DELETE FROM tblschemes WHERE id=$id");
}

header("Location: manage_schemes.php");
exit;
?>
