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
        /* Đảm bảo hình ảnh và nội dung được phân chia theo chiều ngang */
        .container {
            display: flex;
            gap: 20px;
            margin: 20px;
        }

        /* Phần bên trái: hình ảnh */
        .left-side {
            flex: 1;
            /* Chiếm một nửa màn hình */
            max-width: 50%;
        }

        .package-image {
            width: 100%;
            /* Chiếm toàn bộ chiều rộng của phần tử cha */
            height: auto;
            /* Giữ tỷ lệ của hình ảnh */
            border-radius: 8px;
            /* Bo góc cho hình ảnh */
        }

        /* Phần bên phải: thông tin chi tiết */
        .right-side {
            flex: 1;
            /* Chiếm một nửa màn hình */
            max-width: 50%;
            padding: 20px;
            box-sizing: border-box;
            /* Đảm bảo padding không làm thay đổi chiều rộng */
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            /* Thêm bóng mờ cho phần nội dung */
        }

        h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 15px;
        }

        p {
            font-size: 16px;
            color: #555;
            line-height: 1.6;
        }

        h4 {
            font-size: 18px;
            color: #444;
            margin-top: 20px;
            margin-bottom: 10px;
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
            include "connect.php"; // Kết nối với cơ sở dữ liệu

            // Lấy ID từ URL
            if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                $id = intval($_GET['id']); // Ép kiểu ID thành số nguyên để bảo mật
            } else {
                echo "Invalid ID."; // Nếu không có ID hợp lệ, hiển thị thông báo lỗi
                exit;
            }

            // Truy vấn thông tin từ bảng `packages` theo ID
            $sql_package = "SELECT id, name, description AS package_description, price, image_url, destination, available_slots, start_date, end_date 
FROM packages
WHERE id = ?";

            // Truy vấn thông tin từ bảng `information_details` theo ID
            $sql_info = "SELECT description AS info_description, detailed_activities, additional_info
FROM information_details
WHERE package_id = ?";

            // Truy vấn từ bảng `packages`
            $stmt_package = $conn->prepare($sql_package);
            if ($stmt_package) {
                // Gắn ID vào câu truy vấn
                $stmt_package->bind_param("i", $id);
                $stmt_package->execute();
                $result_package = $stmt_package->get_result();

                // Kiểm tra nếu có kết quả từ bảng packages
                if ($result_package->num_rows > 0) {
                    $row_package = $result_package->fetch_assoc();
                    echo '<div class="container">';

                    // Bố cục Flexbox: Hình ảnh chiếm nửa màn hình
                    echo '<div class="left-side">';
                    echo '<img src="images/' . htmlspecialchars($row_package['image_url']) . '" alt="Package Image" class="package-image">';
                    echo '</div>';

                    // Nội dung chiếm nửa màn hình còn lại
                    echo '<div class="right-side">';
                    echo '<h2>' . htmlspecialchars($row_package['name']) . '</h2>';
                    echo '<p><strong>Price:</strong> ' . htmlspecialchars($row_package['price']) . '</p>';
                    echo '<p><strong>Destination:</strong> ' . htmlspecialchars($row_package['destination']) . '</p>';
                    echo '<p><strong>Available Slots:</strong> ' . htmlspecialchars($row_package['available_slots']) . '</p>';
                    echo '<p><strong>Start Date:</strong> ' . htmlspecialchars($row_package['start_date']) . '</p>';
                    echo '<p><strong>End Date:</strong> ' . htmlspecialchars($row_package['end_date']) . '</p>';

                    // Truy vấn thông tin từ bảng `information_details`
                    $stmt_info = $conn->prepare($sql_info);
                    if ($stmt_info) {
                        $stmt_info->bind_param("i", $id);
                        $stmt_info->execute();
                        $result_info = $stmt_info->get_result();

                        // Kiểm tra nếu có thông tin từ bảng `information_details`
                        if ($result_info->num_rows > 0) {
                            $row_info = $result_info->fetch_assoc();
                            if (!empty($row_info['info_description'])) {
                                echo '<h4>Package Description:</h4>';
                                echo '<p>' . nl2br(htmlspecialchars($row_info['info_description'])) . '</p>';
                            }

                            if (!empty($row_info['detailed_activities'])) {
                                echo '<h4>Detailed Activities:</h4>';
                                echo '<p>' . nl2br(htmlspecialchars($row_info['detailed_activities'])) . '</p>';
                            }

                            if (!empty($row_info['additional_info'])) {
                                echo '<h4>Additional Information:</h4>';
                                echo '<p>' . nl2br(htmlspecialchars($row_info['additional_info'])) . '</p>';
                            }
                        } else {
                            echo "<p>No additional information available.</p>";
                        }
                        $stmt_info->close();
                    }

                    echo '</div>'; // Kết thúc right-side
                    echo '</div>'; // Kết thúc container
                } else {
                    echo "<p>No package details found.</p>"; // Nếu không tìm thấy dữ liệu
                }
                $stmt_package->close();
            } else {
                echo "<p>Error preparing the query: " . $conn->error . "</p>"; // Lỗi khi chuẩn bị truy vấn
            }

            // Đóng kết nối cơ sở dữ liệu
            $conn->close();
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