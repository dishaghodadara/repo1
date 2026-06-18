<?php
include("config.php"); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Schemes</title>
  <?php include("link.php"); ?>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
      body {
          background-color: #f8f9fa;
      }
      .table img {
          width: 70px;
          height: 50px;
          object-fit: cover;
          border-radius: 6px;
      }
      .btn-group .btn {
          margin-right: 5px;
      }
      .card {
          margin-top: 30px;
          border-radius: 12px;
      }
      .card-header {
          font-size: 18px;
          font-weight: bold;
           background-color: #1ba241ff;
      }
     
  </style>
</head>
<body>
<?php include("admin_header.php"); ?>

<section>
<div class="container mt-5">
    <h2 class="text-center mb-4 text-success">Manage Loan Schemes</h2>

    <!-- Display Schemes Table -->
    <div class="card shadow mb-5">
        <div class="card-header  text-white">All Schemes</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $result = mysqli_query($link, "SELECT * FROM tblschemes ORDER BY id DESC");
                    if(mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td><?= $row['id']; ?></td>
                            <td><?= $row['title']; ?></td>
                            <td style="max-width:300px;"><?= $row['description']; ?></td>
                            <td><img src="<?= $row['image']; ?>" alt="Scheme"></td>
                            <td>
                                <div class="btn-group">
                                    <a href="edit_scheme.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                                    <a href="delete_scheme.php?id=<?= $row['id'] ?>" 
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('Are you sure you want to delete this scheme?');">
                                       Delete
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php 
                        } 
                    } else { 
                        echo "<tr><td colspan='5'>No Schemes Found</td></tr>"; 
                    } 
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add New Scheme Form -->
    <div class="card shadow">
        <div class="card-header  text-white">Add New Scheme</div>
        <div class="card-body">
            <form action="add_scheme.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Scheme Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Enter scheme title" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Enter scheme description" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Upload Image</label>
                    <input type="file" name="image" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success w-100"> Add Scheme</button>
            </form>
        </div>
    </div>
</div>
</section>
<?php include("footer.php"); ?> 
    <?php include("script.php"); ?> 
</body>
</html>
