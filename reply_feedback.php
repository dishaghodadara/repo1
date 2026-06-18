<?php
include("config.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = intval($_POST['id']);
    $reply = mysqli_real_escape_string($link, $_POST['reply']);

    $sql = "UPDATE tblfeedback SET reply = '$reply' WHERE id = $id";

    if (mysqli_query($link, $sql)) {
        header("Location: manage_feedback.php?success=Reply sent");
        exit;
    } else {
        echo "Error updating reply: " . mysqli_error($link);
    }
} else {
    header("Location: manage_feedback.php");
    exit;
}
?>
