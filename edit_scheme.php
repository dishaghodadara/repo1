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

// Fetch existing scheme
$res = mysqli_query($link, "SELECT * FROM tblschemes WHERE id=$id LIMIT 1");
if (!$res || mysqli_num_rows($res) === 0) {
    die("Scheme not found.");
}
$scheme = mysqli_fetch_assoc($res);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = mysqli_real_escape_string($link, trim($_POST['title']));
    $description = mysqli_real_escape_string($link, trim($_POST['description']));

    $image_path = $scheme['image']; // keep old unless replaced
    if (!empty($_FILES['image']['name'])) {
        $tmp  = $_FILES['image']['tmp_name'];
        $name = basename($_FILES['image']['name']);
        $ext  = strtolower(pathinfo($name, PATHINFO_EXTENSION));
        $allowed = ['jpg','jpeg','png','gif','webp'];

        if (in_array($ext, $allowed)) {
            $target_dir = __DIR__ . '/img/services/';
            if (!is_dir($target_dir)) mkdir($target_dir, 0755, true);

            $new_name = time().'_'.preg_replace('/[^a-z0-9\-_\.]/i','_', $name);
            $target_path = $target_dir . $new_name;

            if (move_uploaded_file($tmp, $target_path)) {
                // delete old image
                if ($scheme['image'] && file_exists(__DIR__ . '/' . $scheme['image'])) {
                    unlink(__DIR__ . '/' . $scheme['image']);
                }
                $image_path = 'img/services/' . $new_name;
            }
        }
    }

    $sql = "UPDATE tblschemes SET 
                title='$title', 
                description='$description', 
                image='$image_path'
            WHERE id=$id";
    if (mysqli_query($link, $sql)) {
        header("Location: manage_schemes.php");
        exit;
    } else {
        $error = "Error: " . mysqli_error($link);
    }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Edit Scheme</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include("admin_header.php"); ?>

<div class="container mt-5">
  <h2 class="mb-4">Edit Loan Scheme</h2>
  <?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <form method="post" enctype="multipart/form-data">
    <div class="mb-3">
      <label class="form-label">Scheme Title</label>
      <input type="text" name="title" value="<?= htmlspecialchars($scheme['title']) ?>" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea name="description" class="form-control" rows="3" required><?= htmlspecialchars($scheme['description']) ?></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Current Image</label><br>
      <?php if ($scheme['image']): ?>
        <img src="<?= htmlspecialchars($scheme['image']) ?>" width="120" class="mb-2">
      <?php else: ?>
        <span class="text-muted">No image</span>
      <?php endif; ?>
    </div>

    <div class="mb-3">
      <label class="form-label">Replace Image</label>
      <input type="file" name="image" class="form-control" accept="image/*">
    </div>

    <button type="submit" class="btn btn-primary">Update Scheme</button>
    <a href="manage_schemes.php" class="btn btn-secondary">Cancel</a>
  </form>
</div>
</body>
</html>
