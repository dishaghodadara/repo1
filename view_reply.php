<?php 
include("config.php");
session_start();

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$userEmail = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Feedback</title>
    <?php include("link.php"); ?>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f1f1f1;
        }

        .container {
            margin: 50px auto;
            max-width: 900px;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #3ed320ff;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
        }

        .table thead {
            background-color: #43ae20ff;
            color: white;
        }

        .table th, .table td {
            padding: 12px;
            text-align: center;
            vertical-align: middle;
        }

        .reply-box {
            color: green;
            font-weight: bold;
        }

        .no-reply {
            color: gray;
            font-style: italic;
        }
    </style>
</head>
<body>

<?php include("user_header.php"); ?> <!-- If you have a user header -->

<div class="container">
    <h2>My Feedback & Replies</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Feedback</th>
                <th>Date</th>
                <th>Admin Reply</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $sql = "SELECT * FROM tblfeedback WHERE email = '$userEmail' ORDER BY feedback_date DESC";
            $result = mysqli_query($link, $sql);
            if(mysqli_num_rows($result) > 0){
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?= htmlspecialchars($row['message']) ?></td>
                <td><?= $row['feedback_date'] ?></td>
                <td>
                    <?php 
                    if (!empty($row['reply'])) {
                        echo "<span class='reply-box'>" . htmlspecialchars($row['reply']) . "</span>";
                    } else {
                        echo "<span class='no-reply'>No reply yet</span>";
                    }
                    ?>
                </td>
            </tr>
            <?php 
                }
            } else {
            ?>
            <tr>
                <td colspan="3" class="text-danger">You haven't submitted any feedback yet.</td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include("footer.php"); ?>
<?php include("script.php"); ?>
</body>
</html>
