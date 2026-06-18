<?php include("config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Loan Management System</title>
    <?php include("link.php")?>
</head>
<body> 
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user_id'])) {
    include("header.php");   
} else {
    include("guestUserHeader.php");  // guest header
}
?>

    <!-- Hero Section Start -->
    <section class="hero set-bg" data-setbg="img/hero-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="hero__text">
                        <h2>Welcome to Our Loan Management System</h2>
                        <p>Get instant access to multiple loan schemes and choose what suits you best.</p>  
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Why People Choose Us Section Start -->
    <section class="chooseus spad" style="padding:80px 0; background:#fff;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4">
                    <div class="chooseus__text">
                        <h2 style="color:green;">Why People Choose Us</h2><br><br>
                        <p style="margin-bottom:20px; color:black;">
                            We provide transparent loan management with easy EMI options, multiple loan schemes, and trusted customer service.
                        </p>
                        <ul style="list-style:none; padding:0; font-size:16px;">
                            <li><i class="fa fa-check-circle text-success"></i> Easy & Fast Processing</li>
                            <li><i class="fa fa-check-circle text-success"></i> Multiple Loan Schemes</li>
                            <li><i class="fa fa-check-circle text-success"></i> Secure & Trusted</li>
                            <li><i class="fa fa-check-circle text-success"></i> 24/7 Customer Support</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="https://cloudbankin.com/wp-content/uploads/2023/02/Loan-Management-system.png" 
                        alt="Why Choose Us" 
                        class="rounded shadow" 
                        style="width: 800px; height: auto;">
                </div>
            </div>
        </div>
    </section>
    <!-- Why People Choose Us Section End -->

    <!-- Counter Section Start -->
    <section class="counter spad" style="background:#f9f9f9; padding:60px 0;">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-3 col-sm-6 mb-4">
                    <div class="counter__item">
                        <img src="https://cdn-icons-png.flaticon.com/512/3064/3064197.png" style="width:100px; height:100px; margin-bottom:15px;">
                        <h2 class="counter_num">1200+</h2>
                        <p style="color:green;">Happy Clients</p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-4">
                    <div class="counter__item">
                        <img src="https://cdn-icons-png.flaticon.com/512/2838/2838912.png" style="width:100px; height:100px; margin-bottom:15px;">
                        <h2 class="counter_num">150+</h2>
                        <p style="color:green;">Loan Schemes</p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-4">
                    <div class="counter__item">
                        <img src="https://cdn-icons-png.flaticon.com/512/3349/3349127.png" style="width:100px; height:100px; margin-bottom:15px;">
                        <h2 class="counter_num">50+</h2>
                        <p style="color:green;">Branches</p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-4">
                    <div class="counter__item">
                        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" style="width:100px; height:100px; margin-bottom:15px;">
                        <h2 class="counter_num">10+</h2>
                        <p style="color:green;">Years of Experience</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Counter Section End -->

    <!-- Schemes Section Start (Dynamic from DB) -->
   <section class="services spad" style="padding:80px 0; background:#fff;">
    <div class="container">
        <h2 class="text-center mb-5" style="color:green;">Our Loan Schemes</h2>
        <div class="row">
            <?php
            $query = "SELECT * FROM tblschemes";
            $result = mysqli_query($link, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '
                    <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                        <div class="services__item shadow-sm" style="border:1px solid #eee; border-radius:8px; overflow:hidden;">
                            <div class="services__item__img">
                                <img src="'.$row['image'].'" alt="'.$row['title'].'" style="width:100%; height:220px; object-fit:cover;">
                            </div>
                            <div class="services__item__text p-3">
                                <h4 style="color:#333;">'.$row['title'].'</h4>
                                <p style="color:#555;">'.$row['description'].'</p>
                                <a href="apply_scheme.php?id='.$row['id'].'" class="btn btn-success mt-3">Apply Now</a>

                            </div>
                        </div>
                    </div>';
                }
            } else {
                echo "<p class='text-center'>No schemes available right now.</p>";
            }
            ?>
        </div>
    </div>
</section>
    <!-- Schemes Section End -->

    <?php include("footer.php")?>
    <?php include("script.php")?>
</body>
</html>
