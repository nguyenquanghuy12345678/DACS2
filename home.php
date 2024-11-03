<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- swiper css link    -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- font awesome link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <!-- header section starts -->
    <section class="header">
        <a href="home.php" class="logo">Travel</a>
        <nav class="navbar">
            <a href="home.php">Home</a>
            <a href="about.php">About</a>
            <a href="package.php">Package</a>
            <a href="book.php">Book</a>
        </nav>
        <div id="menu-btn" class="fas fa-bars"></div>
    </section>


    <!-- home section start -->
    <!-- thư viện java script: swiper -->
    <section class="home">
        <div class="swiper home-slider">
            <div class="swiper-wrapper">
                <!-- sử dụng 2 class -->
                <div class="swiper-slide slide" style="background: url(images/home-slide-1.jpg)">
                    <div class="content">
                        <span class="">explore, discover, travel</span>
                        <h3 class="">travel arround the world</h3>
                        <a href="package.php" class="btn">discover more</a>
                    </div>
                </div>
                <div class="swiper-slide slide" style="background: url(images/home-slide-2.jpg)">
                    <div class="content">
                        <span class="">explore, discover, travel</span>
                        <h3 class="">discover the new places</h3>
                        <a href="package.php" class="btn">discover more</a>
                    </div>
                </div>
                <div class="swiper-slide slide" style="background: url(images/home-slide-3.jpg)">
                    <div class="content">
                        <span class="">explore, discover, travel</span>
                        <h3 class="">make you tour worthwhile</h3>
                        <a href="package.php" class="btn">discover more</a>
                    </div>
                </div>
            </div>
            <!-- 2 nút chuyển <> -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </section>


    <!-- services section start -->
    <section class="services">

        <h1 class="heading-title"> our services </h1>

        <div class="box-container">

            <div class="box">
                <img src="images/icon-1.png" alt="">
                <h3>adventure</h3>
            </div>

            <div class="box">
                <img src="images/icon-2.png" alt="">
                <h3>tour guide</h3>
            </div>

            <div class="box">
                <img src="images/icon-3.png" alt="">
                <h3>trekking</h3>
            </div>

            <div class="box">
                <img src="images/icon-4.png" alt="">
                <h3>camp fire</h3>
            </div>

            <div class="box">
                <img src="images/icon-5.png" alt="">
                <h3>off road</h3>
            </div>

            <div class="box">
                <img src="images/icon-6.png" alt="">
                <h3>camping</h3>
            </div>

        </div>

    </section>

    <!-- home about section start -->
    <section class="home-about">
        <div class="image">
            <img src="images/about-img.jpg" alt="">
        </div>
        <div class="content">
            <h3 class="">About Us</h3>
            <p class="">
                Welcome to Travel with Huy – your destination for unique and memorable travel experiences. We are a passionate team of travel enthusiasts, always on the lookout for new and exciting destinations and activities to share with you.
            </p>
            <p class="">
                With many years of experience in the travel industry, we are committed to providing detailed information, helpful tips, and the best services to help you plan your trip easily and conveniently.
            </p>
            <a href="about.php" class="btn">Read More</a>
        </div>
    </section>
    
    <!-- package section start -->
    <!--+ tiêu đề 
            + chứa
                +box(3)
                    + div.image 
                    + div.content -->
    <section class="home-packages">
        <h1 class="heading-title">our packages</h1>
        <div class="box-container">
            <div class="box">
                <div class="image">
                    <img src="images/img-1.jpg" alt="" class="">
                </div>
                <div class="content">
                    <h3 class="">adventure & tour</h3>
                    <p class="">Discover thrilling adventures with this exclusive tour package.</p>
                    <!-- Khám phá những cuộc phiêu lưu đầy kịch tính với gói tour đặc biệt này. -->
                    <a href="book.php" class="btn">book now</a>
                </div>
            </div>
            <div class="box">
                <div class="image">
                    <img src="images/img-2.jpg" alt="" class="">
                </div>
                <div class="content">
                    <h3 class="">adventure & tour</h3>
                    <!-- Khám phá vẻ đẹp của thiên nhiên và những hoạt động thú vị với gói này. -->
                    <p class="">Explore the beauty of nature and exciting activities with this package.</p>
                    <a href="book.php" class="btn">book now</a>
                </div>
            </div>
            <div class="box">
                <div class="image">
                    <img src="images/img-3.jpg" alt="" class="">
                </div>
                <div class="content">
                    <h3 class="">adventure & tour</h3>
                    <!-- Bắt đầu hành trình đầy phiêu lưu và những trải nghiệm khó quên. -->
                    <p class="">Embark on a journey filled with adventure and unforgettable experiences.</p>
                    <a href="book.php" class="btn">book now</a>
                </div>
            </div>
        </div>
        <div class="load-more">
            <a href="package.php" class="btn">Load More</a>
        </div>
    </section>

    <!-- home offer section -->
    <section class="home-offer">
        <div class="content">
            <h3 class="">Travel Up to 50% Off</h3>
            <p class="">Discover breathtaking destinations with exclusive deals. Book now and save up to 50% on select trips and experiences!</p>
            <a href="book.php" class="btn">Book Now</a>
        </div>
    </section>

    <!-- footer section start -->
    <section class="footer">
        <div class="box-container">
            <div class="box">
                <h3>Quick Links</h3>
                <a href="home.php"><i class="fas fa-angle-right"></i> Home</a>
                <a href="about.php"><i class="fas fa-angle-right"></i> About</a>
                <a href="package.php"><i class="fas fa-angle-right"></i> Packages</a>
                <a href="book.php"><i class="fas fa-angle-right"></i> Book</a>
            </div>
            <div class="box">
                <h3>Extra Links</h3>
                <a href="#"><i class="fas fa-angle-right"></i> Ask Question</a>
                <a href="#"><i class="fas fa-angle-right"></i> About Us</a>
                <a href="#"><i class="fas fa-angle-right"></i> Privacy Policy</a>
                <a href="#"><i class="fas fa-angle-right"></i> Book</a>
            </div>
            <div class="box">
                <h3>Contact Info</h3>
                <a href="#"><i class="fas fa-phone"></i> +84 866114154</a>
                <a href="#"><i class="fas fa-phone"></i> +84 329425677</a>
                <a href="#"><i class="fas fa-envelope"></i> huyhuy0510v@gmail.com</a>
                <a href="#"><i class="fas fa-map"></i> 470 Trần Đại Nghĩa, Việt-Hàn</a>
            </div>
            <div class="box">
                <h3>Follow Us</h3>
                <a href="#"><i class="fab fa-facebook-f"></i> Facebook</a>
                <a href="#"><i class="fab fa-twitter"></i> Twitter</a>
                <a href="#"><i class="fab fa-instagram"></i> Instagram</a>
                <a href="#"><i class="fab fa-linkedin"></i> LinkedIn</a>
            </div>
        </div>
        <div class="credit">
            Created by <span>Huy-Dev-Web-3</span>. All rights reserved!
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>