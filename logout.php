<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <?php
   
session_start();
session_destroy();
echo "<script>alert('Logged out successfully'); window.location.href='index.php';</script>";
?>

   
</head>
<body>
    
</body>
</html>