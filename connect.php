<?php
$host = 'localhost';  // Tên máy chủ MySQL (localhost khi chạy cục bộ)
$username = 'root';   // Tên người dùng MySQL
$password = '';       // Mật khẩu MySQL (để trống nếu không đặt mật khẩu)
$database = 'book_db'; // Tên cơ sở dữ liệu của bạn

// Tạo kết nối
$conn = new mysqli($host, $username, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
// echo "Kết nối thành công";
?>
