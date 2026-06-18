<?php
include("config.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM tblcontact WHERE id = $id";
    $result = mysqli_query($link, $sql);
    $contact = mysqli_fetch_assoc($result);

    if (!$contact) {
        die("❌ Contact not found!");
    }
}

// ✅ Update logic
if (isset($_POST['update'])) {
    $name = mysqli_real_escape_string($link, $_POST['name']);
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $phone = mysqli_real_escape_string($link, $_POST['phone']);
    $subject = mysqli_real_escape_string($link, $_POST['subject']);
    $message = mysqli_real_escape_string($link, $_POST['message']);

    $update_sql = "UPDATE tblcontact SET 
                    name='$name', 
                    email='$email', 
                    phone='$phone', 
                    subject='$subject', 
                    message='$message'
                   WHERE id=$id";

    if (mysqli_query($link, $update_sql)) {
        echo "<script>alert('✅ Contact updated successfully'); window.location='manage_contact.php';</script>";
    } else {
        echo "Error: " . mysqli_error($link);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Contact</title>
    <?php include("link.php"); ?>
</head>
<body>
<?php include("admin_header.php"); ?>

<div class="container mt-5">
    <h2 class="mb-4">Edit Contact</h2>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="<?= $contact['name'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?= $contact['email'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" value="<?= $contact['phone'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Subject</label>
            <input type="text" name="subject" class="form-control" value="<?= $contact['subject'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Message</label>
            <textarea name="message" class="form-control" rows="4" required><?= $contact['message'] ?></textarea>
        </div>
        <button type="submit" name="update" class="btn btn-success">Update</button>
        <a href="manage_contact.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php include("footer.php"); ?>
<?php include("script.php"); ?>
</body>
</html>
