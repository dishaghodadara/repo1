<?php


// Start session only if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin'])) {
    header('Location: login.php'); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Loanday</title>
    <link rel="stylesheet" href="path_to_your_styles.css"> <!-- Optional -->
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: #f5f5f5;
        }

        .admin-header {
            background-color: #ffffff;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #e0e0e0;
        }

        .admin-logo {
            font-size: 24px;
            font-weight: bold;
            color: #2ecc71;
        }

        .admin-nav {
            display: flex;
            gap: 25px;
        }

        .admin-nav a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
        }

        .admin-nav a:hover {
            color: #2ecc71;
        }

        .admin-logout {
            color: red;
            font-weight: bold;
        }

        .welcome-msg {
            margin: 20px 30px;
            font-size: 18px;
        }
    </style>
</head>
<body>

<div class="admin-header">
    <div class="admin-logo">Loanday Admin</div>
    <nav class="admin-nav">
         <a href="admin_dashboard.php">Home</a>
        <a href="manage_user.php">Users</a>
        <a href="manage_contact.php"> contact</a>
        <a href="manage_loans.php"> Manage Loans</a>
         <a href="manage_schemes.php"> Add Schemes</a>
        <a href="add_loans.php"> Add Loans</a>
        <a href="manage_emi.php">EMI Calculator</a>
        <a href="manage_feedback.php"> Feedback</a>
        <a href="logout.php" class="admin-logout">Logout</a>
    </nav>
</div>

