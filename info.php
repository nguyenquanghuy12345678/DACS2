<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info</title>
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
        /* Style cho container chứa các cột */
        .container {
            display: flex;
            justify-content: space-between;
            gap: 30px;
            /* Khoảng cách giữa hai cột */
            margin-top: 30px;
        }

        /* Style cho cột chứa hình ảnh */
        .image-column {
            flex: 1;
            max-width: 50%;
            /* Giới hạn chiều rộng tối đa cho hình ảnh */
        }

        .image-column img {
            width: 100%;
            /* Hình ảnh chiếm hết chiều rộng của cột */
            height: auto;
            /* Giữ tỷ lệ hình ảnh */
        }

        /* Style cho cột chứa thông tin chi tiết */
        .info-column {
            flex: 1;
            max-width: 50%;
        }

        /* Style cho các phần tử trong cột thông tin */
        .info-column h3 {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .info-column p {
            font-size: 1.1rem;
            line-height: 1.5;
        }

        /* Style cho các tiêu đề của phần thông tin bổ sung */
        .info-column h4 {
            font-size: 1.3rem;
            margin-top: 20px;
        }

        .info-column img {
            width: 100%;
            height: auto;
            margin-top: 20px;
        }
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
        <h1>Info</h1>
    </div>

    <!-- packages section starts -->
    <section class="packages">
        <h1 class="heading-title">Infomation Details</h1>
        <div class="box-container">

            <?php
            include "connect.php";

            // Lấy ID của package từ URL
            if (isset($_GET['id'])) {
                $id = $_GET['id'];

                // Truy vấn lấy dữ liệu kết hợp từ bảng packages và information_details theo id
                $sql = "
            SELECT p.*, i.description AS detail_description, i.detailed_activities, i.images, i.additional_info
            FROM packages p
            JOIN information_details i ON p.id = i.package_id
            WHERE p.id = ?";

                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id); // Truyền tham số ID vào câu truy vấn
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    // Lấy dữ liệu từ cơ sở dữ liệu và hiển thị
                    $row = $result->fetch_assoc();
                    echo '<div class="container">';

                    // Cột Hình ảnh
                    echo '<div class="image-column">';
                    // Hiển thị hình ảnh từ cả bảng packages và information_details
                    echo '<img src="images/' . $row['image_url'] . '" alt="Package Image" style="width: 100%;">';
                    echo '</div>';

                    // Cột Thông tin chi tiết
                    echo '<div class="info-column">';
                    echo '<h3>' . $row['name'] . '</h3>';
                    echo '<p><strong>Description:</strong> ' . $row['description'] . '</p>';
                    echo '<p><strong>Price:</strong> $' . $row['price'] . '</p>';
                    echo '<p><strong>Destination:</strong> ' . $row['destination'] . '</p>';
                    echo '<p><strong>Available Slots:</strong> ' . $row['available_slots'] . '</p>';
                    echo '<p><strong>Start Date:</strong> ' . $row['start_date'] . '</p>';
                    echo '<p><strong>End Date:</strong> ' . $row['end_date'] . '</p>';

                    // Thông tin bổ sung từ bảng information_details
                    if (!empty($row['additional_info'])) {
                        echo '<h4>Additional Information</h4>';
                        echo '<p>' . $row['additional_info'] . '</p>';
                    }

                    if (!empty($row['detailed_activities'])) {
                        echo '<h4>Detailed Activities</h4>';
                        echo '<p>' . $row['detailed_activities'] . '</p>';
                    }

                    // if (!empty($row['images'])) {
                    //     echo '<h4>Activity Images</h4>';
                    //     echo '<img src="images/' . $row['images'] . '" alt="Activity Image" style="width: 100%;">';
                    // }

                    echo '</div>';  // end of info-column
                    echo '</div>';  // end of container
                } else {
                    echo '<p>No details available for this package.</p>';
                }
            } else {
                echo '<p>No package selected.</p>';
            }
            ?>


        </div>
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