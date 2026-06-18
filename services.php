<?php
include("config.php");
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ✅ Load header based on login
if (isset($_SESSION['user_id'])) {
    include("header.php");   
} else {
    include("guestUserHeader.php");
}

// ✅ Fetch all loans from tblloans
$query = "SELECT * FROM tblloans ORDER BY id ASC";
$result = mysqli_query($link, $query);
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Loan Services">
    <meta name="keywords" content="Loans, EMI, Services">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Loan Services</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">

    <style>
        .services__item__img img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-radius: 8px;
        }
    </style>
</head>

<body>

    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-option set-bg" data-setbg="img/breadcrumb/breadcrumb-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Main Loan Services</h2>
                        <div class="breadcrumb__links">
                            <a href="index.php">Home</a>
                            <a href="#">Features</a>
                            <span>Services</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <!-- Services Section Begin -->
    <section class="services spad">
        <div class="container">
            <div class="row">
                <?php 
                $count = 1;
                while ($row = mysqli_fetch_assoc($result)) { ?>
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="services__item">
                            <div class="services__item__img">
                                <?php if (!empty($row['loan_image'])) { ?>
                                    <img src="<?php echo htmlspecialchars($row['loan_image']); ?>" alt="Loan Image">
                                <?php } else { ?>
                                    <!-- Fallback image -->
                                    <img src="img/services/services-1.jpg" alt="Default Loan Image">
                                <?php } ?>
                            </div>
                            <div class="services__item__text mt-3">
                                <h4>
                                    <span><?php echo sprintf("%02d.", $count); ?></span> 
                                    <?php echo htmlspecialchars($row['loan_name']); ?>
                                </h4>
                                <p><?php echo htmlspecialchars($row['description']); ?></p>
                                <p><strong>Interest Rate:</strong> <?php echo htmlspecialchars($row['interest_rate']); ?>%</p>
                                <a href="applyloan.php?id=<?php echo $row['id']; ?>">Apply Now</a>
                            </div>
                        </div>
                    </div>
                <?php 
                $count++;
                } 
                ?>
            </div>
        </div>
    </section>
    <!-- Services End -->

    <?php include("footer.php"); ?>
    <?php include("script.php"); ?>
</body>
</html>
