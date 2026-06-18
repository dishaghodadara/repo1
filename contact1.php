<!DOCTYPE html>
<html lang="zxx">
 <?php include("config.php"); ?>

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Loanday Template">
    <meta name="keywords" content="Loanday, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Loanday | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <?php include("link.php"); ?>

</head>

<body>
    <?php
if (isset($_REQUEST["btnsend"])) {
    $name = trim($_REQUEST["txtname"]);
    $email = trim($_REQUEST["txtemail"]);
    $phone = trim($_REQUEST["txtphone"]);
    $subject = trim($_REQUEST["txtsubject"]);
    $message = trim($_REQUEST["txtmessage"]);

    if (empty($name) || empty($email) || empty($phone) || empty($subject) || empty($message)) {
        echo "<script>alert('Please fill all fields');</script>";
    } else {
        $query = "INSERT INTO tblcontact (name, email, phone, subject, message) 
                  VALUES ('$name','$email','$phone','$subject','$message')";
        $result = mysqli_query($link, $query);

        if ($result) {
            echo "<script>alert('Message sent successfully!'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Something went wrong, try again later');</script>";
        }
    }
}
?>
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

    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__search">
            <i class="fa fa-search search-switch"></i>
        </div>
        <div class="offcanvas__logo">
            <a href="./index.html"><img src="img/logo.png" alt=""></a>
        </div>
        <nav class="offcanvas__menu mobile-menu">
            <ul>
                <li class="active"><a href="./index.php">Home</a></li>
                <li><a href="./about.html">About</a></li>
                <li><a href="./services.html">Services</a></li>
                <li><a href="./blog.html">Blog</a></li>
                <li><a href="#">Pages</a>
                    <ul class="dropdown">
                        <li><a href="./services.html">Features</a></li>
                        <li><a href="./services-details.html">Services Details</a></li>
                        <li><a href="./blog-details.html">Blog Details</a></li>
                    </ul>
                </li>
                <li><a href="./contact1.php">Contact</a></li>
            </ul>
        </nav>
    </div>
    
      

    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-option contact-breadcrumb set-bg" data-setbg="img/breadcrumb/contact-breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Contact Us</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <!-- Contact Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="contact__form">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="contact__form__text">
                            <div class="contact__form__title">
                                <h2>Get In Touch</h2>
                                <p>Please contact us or send us an email or go to our forum.</p>
                            </div>
                            <form action="#">
                                <div class="input-list">
                                    <input type="text" name="txtname" placeholder="Your name">
                                    <input type="text" name="txtemail" placeholder="Your email">
                                </div>
                                <div class="input-list">
                                    <input type="text" name="txtphone" placeholder="Your  phone number">
                                    <input type="text" name="txtsubject" placeholder="Your subject">
                                </div>
                                <textarea  name="txtmessage"placeholder="Your Message"></textarea>
                                <button type="submit" name="btnsend" class="site-btn">Send Message</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="contact__address__item">
                        <h4>New York Office</h4>
                        <ul>
                            <li><i class="fa fa-map-marker"></i> 917 Atlantic Lane, Strongsville, <br />NY, United State
                            </li>
                            <li><i class="fa fa-phone"></i> (+12) 345-678-910</li>
                            <li><i class="fa fa-envelope"></i> newyork.info@colorlib.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="contact__address__item">
                        <h4>New Jersey Office</h4>
                        <ul>
                            <li><i class="fa fa-map-marker"></i> 171 Logan Lane, Union City <br />NJ, United Statee</li>
                            <li><i class="fa fa-phone"></i> (+12) 345-678-910</li>
                            <li><i class="fa fa-envelope"></i> newjersey.info@colorlib.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="contact__address__item">
                        <h4>Washington Office</h4>
                        <ul>
                            <li><i class="fa fa-map-marker"></i> 9 East Bear Hill St. Great Falls <br />Washington,
                                United State</li>
                            <li><i class="fa fa-phone"></i> (+12) 345-678-910</li>
                            <li><i class="fa fa-envelope"></i> washington.info@colorlib.com</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact End -->

    
 <?php include("footer.php"); ?>
 <?php include("script.php"); ?>

   
</body>

</html>