<?php
// Khởi động session nếu chưa có
session_start();

// Xóa tất cả dữ liệu của session
$_SESSION = [];
session_unset(); // Hủy tất cả biến của session
session_destroy(); // Hủy session hiện tại

// Chuyển hướng về trang đăng nhập hoặc trang chủ kèm thông báo thành công
header("Location: login.php");
exit();
