<?php
include("config.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($link) || !$link) {
    die("Database connection not found. Check config.php.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = mysqli_real_escape_string($link, trim($_POST['title']));
    $description = mysqli_real_escape_string($link, trim($_POST['description']));

    // File upload
    $image_path = "";
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
                $image_path = 'img/services/' . $new_name;
            }
        }
    }

    $sql = "INSERT INTO tblschemes (title, description, image) 
            VALUES ('$title','$description','$image_path')";
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
  <title>Add Scheme</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h2 class="mb-4">Add New Loan Scheme</h2>
  <?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <form method="post" enctype="multipart/form-data">
    <div class="mb-3">
      <label class="form-label">Scheme Title</label>
      <input type="text" name="title" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea name="description" class="form-control" rows="3" required></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Image</label>
      <input type="file" name="image" class="form-control" accept="image/*" required>
    </div>

    <button type="submit" class="btn btn-success">Add Scheme</button>
    <a href="manage_schemes.php" class="btn btn-secondary">Back</a>
  </form>
</div>
</body>
</html>
