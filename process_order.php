<?php
// Bao gồm file kết nối cơ sở dữ liệu
include "connect.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $package_id = $_POST['package_id'];
    $customer_name = $_POST['customer_name'];
    $customer_email = $_POST['customer_email'];
    $phone_number = $_POST['phone_number'];
    $quantity = $_POST['quantity'];
    $order_date = $_POST['order_date'];
    $payment_method = $_POST['payment_method'];
    $transport_option = $_POST['transport_option'];
    $insurance = isset($_POST['insurance']) ? 1 : 0; // Giá trị boolean
    $notes = $_POST['notes'];

    // Lấy giá của package từ bảng `packages`
    $query = "SELECT price FROM packages WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $package_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $package = $result->fetch_assoc();

    if ($package) {
        $price_per_slot = $package['price'];
        $total_price = $price_per_slot * $quantity; // Tính tổng giá

        // Thêm đơn hàng vào bảng `orders`
        $insert_query = "
            INSERT INTO orders (
                package_id, customer_name, customer_email, phone_number, 
                quantity, order_date, payment_method, transport_option, 
                total_price, insurance, notes
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param(
            "isssisssdis",
            $package_id,
            $customer_name,
            $customer_email,
            $phone_number,
            $quantity,
            $order_date,
            $payment_method,
            $transport_option,
            $total_price,
            $insurance,
            $notes
        );

        //     if ($stmt->execute()) {
        //         echo "Booking successful! Total price: " . number_format($total_price, 2) . " VND.";
        //     } else {
        //         echo "Error: " . $conn->error;
        //     }
        // } else {
        //     echo "Invalid package ID.";
        // }

        if ($stmt->execute()) {
            // Thông báo thành công
            echo "<script>
            alert('Booking successful! Total price: " . number_format($total_price, 2) . " VND.');
            window.location.href = 'package.php'; // Ở lại trang hiện tại
        </script>";
        } else {
            // Thông báo lỗi
            echo "<script>
            alert('Booking failed. Please try again. Error: " . $conn->error . "');
            window.location.href = 'package.php'; // Ở lại trang hiện tại
        </script>";
        }
    } else {
        // Thông báo lỗi khi không tìm thấy package
        echo "<script>
        alert('Invalid package ID. Please try again.');
        window.location.href = 'package.php'; // Ở lại trang hiện tại
    </script>";
    }

    // Đóng kết nối
    $stmt->close();
    $conn->close();
}
