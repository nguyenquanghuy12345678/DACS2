<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Packages</title>
    <!-- swiper css link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Gói du lịch */
        .package-info {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 30px;
        }

        .package-info .image,
        .package-info .info,
        .package-info .order-form {
            width: 30%;
            padding: 15px;
        }

        .package-info img {
            width: 100%;
            max-width: 100%;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .package-info h3 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .package-info p {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .order-form {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .order-form label {
            display: block;
            font-size: 14px;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .order-form input,
        .order-form select,
        .order-form textarea {
            /* Thêm kiểu cho textarea */
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        /* Style cho textarea (notes) */
        .order-form textarea {
            height: 150px;
            /* Chiều cao lớn hơn */
            resize: vertical;
            /* Cho phép thay đổi kích thước theo chiều dọc */
        }

        .order-form button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .order-form button:hover {
            background-color: #45a049;
        }
    </style>
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
            <a href="info.php">info</a>
        </nav>
        <div id="menu-btn" class="fas fa-bars"></div>
    </section>

    <div class="heading" style="background:url(images/header-bg-2.png) no-repeat">
        <h1>Booking</h1>
    </div>

    <!-- packages section starts -->
    <section class="packages-book">
        <div class="box-container-book">
            <?php
            // Bao gồm file kết nối cơ sở dữ liệu
            include "connect.php";

            // Kiểm tra ID của gói du lịch từ URL
            if (isset($_GET['id'])) {
                $package_id = $_GET['id'];

                // Truy vấn thông tin gói du lịch từ bảng 'packages'
                $query = "SELECT * FROM packages WHERE id = ?";

                if ($stmt = $conn->prepare($query)) {
                    $stmt->bind_param("i", $package_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $package = $result->fetch_assoc();

                    if ($package) {
                        echo '<div class="package-info">';

                        // Hiển thị thông tin gói du lịch
                        echo '<div class="image">';
                        echo '<img src="images/' . htmlspecialchars($package['image_url']) . '" alt="' . htmlspecialchars($package['name']) . '">';
                        echo '</div>';

                        echo '<div class="info">';
                        echo '<h3>' . htmlspecialchars($package['name']) . '</h3>';
                        echo '<p>' . htmlspecialchars($package['description']) . '</p>';
                        echo '<p>Price: ' . number_format($package['price'], 2) . ' VND</p>';
                        echo '<p>Available Slots: ' . htmlspecialchars($package['available_slots']) . '</p>';
                        echo '<p>Start Date: ' . htmlspecialchars($package['start_date']) . '</p>';
                        echo '<p>End Date: ' . htmlspecialchars($package['end_date']) . '</p>';
                        echo '</div>';

                        // Form đặt gói du lịch
                        echo '<div class="order-form">';
                        echo '<form action="process_order.php" method="post">';
                        echo '<input type="hidden" name="package_id" value="' . htmlspecialchars($package['id']) . '">';

                        echo '<label for="customer_name">Your Name:</label>';
                        echo '<input type="text" name="customer_name" required><br>';

                        echo '<label for="customer_email">Your Email:</label>';
                        echo '<input type="email" name="customer_email" required><br>';

                        echo '<label for="phone_number">Phone Number:</label>';
                        echo '<input type="text" name="phone_number"><br>';

                        echo '<label for="quantity">Quantity (Slots):</label>';
                        echo '<input type="number" id="quantity" name="quantity" min="1" max="' . htmlspecialchars($package['available_slots']) . '" value="1" required><br>';

                        echo '<label for="total_price">Total Price (VND):</label>';
                        echo '<input type="text" id="total_price" name="total_price" readonly value="' . number_format($package['price'], 2) . '"><br>';

                        echo '<label for="order_date">Select Date:</label>';
                        echo '<input type="date" name="order_date" required ';
                        echo 'min="' . htmlspecialchars($package['start_date']) . '" max="' . htmlspecialchars($package['end_date']) . '"><br>';

                        echo '<label for="payment_method">Payment Method:</label>';
                        echo '<select name="payment_method">';
                        echo '<option value="Cash">Cash</option>';
                        echo '<option value="Credit Card">Credit Card</option>';
                        echo '<option value="Bank Transfer">Bank Transfer</option>';
                        echo '</select><br>';

                        echo '<label for="transport_option">Transport Option:</label>';
                        echo '<select name="transport_option">';
                        echo '<option value="Bus">Bus</option>';
                        echo '<option value="Plane">Plane</option>';
                        echo '<option value="Train">Train</option>';
                        echo '</select><br>';

                        echo '<label for="insurance">Insurance:</label>';
                        echo '<input type="checkbox" name="insurance" value="1"><br>';

                        echo '<label for="notes">Notes:</label>';
                        echo '<textarea name="notes" placeholder="Add your notes here..."></textarea><br>';

                        echo '<button type="submit">Confirm Booking</button>';
                        echo '</form>';
                        echo '</div>';
                        echo '</div>';

                        // JavaScript tính tổng giá
                        echo '<script>';
                        echo 'const pricePerSlot = ' . htmlspecialchars($package['price']) . ';';
                        echo 'const quantityInput = document.getElementById("quantity");';
                        echo 'const totalPriceInput = document.getElementById("total_price");';
                        echo 'quantityInput.addEventListener("input", function () {';
                        echo '    const quantity = parseInt(quantityInput.value) || 1;';
                        echo '    const totalPrice = pricePerSlot * quantity;';
                        echo '    totalPriceInput.value = totalPrice.toLocaleString("en-VN");';
                        echo '});';
                        echo '</script>';
                    } else {
                        echo '<p>Package not found!</p>';
                    }
                } else {
                    echo "Error preparing query.";
                }
            } else {
                echo '<p>No package selected!</p>';
            }

            // Đóng kết nối
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
                <h3>Contact Us</h3>
                <a href="tel:+1234567890"><i class="fas fa-phone"></i> +1234567890</a>
                <a href="mailto:contact@travel.com"><i class="fas fa-envelope"></i> contact@travel.com</a>
                <a href="#"><i class="fas fa-map"></i> 123 Travel Street, City, Country</a>
            </div>
        </div>
        <div class="credit">Created by <span> Your Name </span> | All rights reserved!</div>
    </section>
</body>

</html>