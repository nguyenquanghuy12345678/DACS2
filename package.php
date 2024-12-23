<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Packages</title>
    <!-- swiper css link -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <style>

        
    </style>

    <!-- header section starts -->
    <section class="header">
        <a href="home.php" class="logo">travel.</a>
        <nav class="navbar">
            <a href="home.php">home</a>
            <a href="about.php">about</a>
            <a href="package.php">package</a>
            <a href="book.php">book</a>
            <a href="info.php">info</a>
        </nav>
        <div id="menu-btn" class="fas fa-bars"></div>
    </section>

    <div class="heading" style="background:url(images/header-bg-2.png) no-repeat">
        <h1>Packages</h1>
    </div>
    <!-- packages section starts -->
    <section class="packages">
        <h1 class="heading-title">Top Destinations</h1>
        <div class="box-container">

            <?php
            include "connect.php";

            // Truy vấn lấy dữ liệu từ bảng packages
            $sql = "SELECT * FROM packages";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Hiển thị dữ liệu từ cơ sở dữ liệu
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="box">';
                    echo '<div class="image">';
                    // Hiển thị hình ảnh từ thư mục images/
                    echo '<img src="images/' . $row['image_url'] . '" alt="">'; // sai tên cột image -> image_urlurl
                    echo '</div>';
                    echo '<div class="content">';
                    echo '<h3>' . $row['name'] . '</h3>'; // title -> name //
                    echo '<p>' . $row['description'] . '</p>';
                    echo '<p style="color: black;">$' . $row['price'] . '</p>';
                    // echo '<a href="book.php?id=' . $row['id'] . '" class="btn">book now</a>';
                    // echo '<a href="package_booking.php?id=' . $row['id'] . '" class="btn">book now</a>';
                    
                    echo '<a href="package_booking.php?id=' . $row['id'] . '" class="btn">book now</a>';

                    echo '<a href="info.php?id=' . $row['id'] . '" class="btn">info</a>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p>No packages available.</p>';
            }
            ?>



        </div>
        <div class="load-more"><span class="btn">load more</span></div>
    </section>

    <!-- footer section starts -->
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
        <div class="credit">Created by <span>Huy-Dev-Web-3</span>. All rights reserved!</div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="js/main_script.js"></script>
</body>

</html>