<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <!-- swiper css link    -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- font awesome link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- custom stylesheets -->

    <!-- <link rel="stylesheet" href="css/about.css"> -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <!-- header section starts -->
    <section class="header">

        <a href="home.php" class="logo">travel.</a>

        <nav class="navbar">
            <a href="home.php">home</a>
            <a href="about.php">about</a>
            <a href="package.php">package</a>
            <a href="book.php">book</a>

            <!-- thêm section mới -->
            <!-- <a href="login.php">Login</a> -->
            <a href="info.php" class="">Info</a>
        </nav>

        <div id="menu-btn" class="fas fa-bars"></div>

    </section>

    <!-- header section -->
    <div class="heading" style="background:url(images/header-bg-1.png) no-repeat">
        <h1 class="">About Us</h1>
    </div>

    <!-- about section start -->
    <section class="about">
        <div class="image">
            <img src="images/about-img.jpg" alt="About our travel service" class="about-img">
        </div>
        <div class="content">
            <h3 class="about-title">Discover the World with Us</h3>
            <p class="about-text">We are dedicated to helping you explore the most stunning destinations around the world, providing top-quality travel services and unforgettable experiences.</p>
            <p class="about-text">With exclusive deals on flights, hotels, and tours, our mission is to make travel accessible and enjoyable for everyone. Your journey begins with us!</p>

            <div class="icons-container">
                <div class="icons">
                    <i class="fas fa-map"></i>
                    <span class="icon-label">Explore Destinations</span>
                </div>
                <div class="icons">
                    <i class="fas fa-hotel"></i>
                    <span class="icon-label">Best Hotels</span>
                </div>
                <div class="icons">
                    <i class="fas fa-plane"></i>
                    <span class="icon-label">Flight Deals</span>
                </div>
            </div>
        </div>
    </section>

    <!-- review section -->
    <!-- sử dụng thanh cuộn kéo ngang - default swiper -->
    <section class="reviews">

        <h1 class="heading-title"> Clients' Reviews </h1>

        <div class="swiper reviews-slider">
            <div class="swiper-wrapper">

                <div class="swiper-slide slide">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p>Lorem, dịch vụ thật tuyệt vời! Tôi chưa bao giờ cảm thấy thoải mái như thế khi đi du lịch. Highly recommend!</p>
                    <h3>John Doe</h3>
                    <span>traveler</span>
                    <img src="images/pic-1.png" alt="">
                </div>

                <div class="swiper-slide slide">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p>This tour was amazing! Chuyến đi này thực sự đã làm tôi hài lòng từ đầu đến cuối.</p>
                    <h3>Jane Smith</h3>
                    <span>traveler</span>
                    <img src="images/pic-2.png" alt="">
                </div>

                <div class="swiper-slide slide">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p>The experience was fantastic! Hướng dẫn viên rất thân thiện và chuyên nghiệp. Definitely worth it!</p>
                    <h3>Mike Nguyen</h3>
                    <span>traveler</span>
                    <img src="images/pic-3.png" alt="">
                </div>

                <div class="swiper-slide slide">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p>Best experience ever! Tôi thực sự rất hài lòng và sẽ trở lại lần nữa.</p>
                    <h3>Anna Le</h3>
                    <span>traveler</span>
                    <img src="images/pic-4.png" alt="">
                </div>

                <div class="swiper-slide slide">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p>Great service and friendly staff. Nhân viên rất nhiệt tình và chu đáo. Thank you!</p>
                    <h3>Alex Tran</h3>
                    <span>traveler</span>
                    <img src="images/pic-5.png" alt="">
                </div>

                <div class="swiper-slide slide">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p>Wonderful tour experience! Chuyến du lịch đáng nhớ nhất từ trước đến giờ. Highly recommended!</p>
                    <h3>Emily Pham</h3>
                    <span>traveler</span>
                    <img src="images/pic-6.png" alt="">
                </div>

            </div>
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
    <script src="js/main_script.js"></script>

    <!-- có thể bỏ -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var swiper = new Swiper(".reviews-slider", {
                loop: true, // Loop through the slides infinitely
                autoplay: {
                    delay: 2000, // 3 seconds per slide
                    disableOnInteraction: false, // Continue autoplay even after user interaction
                },
                speed: 800, // Transition speed in milliseconds
                slidesPerView: 1, // Display one slide at a time
                spaceBetween: 20, // Space between slides
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true, // Enable pagination dots to be clickable
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
            });
        });
    </script>

</body>

</html>