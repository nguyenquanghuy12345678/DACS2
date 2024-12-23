<?php
include 'connect.php';

// Xử lý khi form được gửi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $package_name = $_POST['package_name'];
    $customer_name = $_POST['customer_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $quantity = $_POST['quantity'];
    $total_price = $_POST['total_price'];
    $status = $_POST['status'];
    $payment_method = $_POST['payment_method'];
    $transport_option = $_POST['transport_option'];
    $insurance = $_POST['insurance'];
    $notes = $_POST['notes'];

    // Query để thêm đơn hàng vào cơ sở dữ liệu
    $query = "INSERT INTO orders (package_name, customer_name, customer_email, phone_number, quantity, total_price, status, payment_method, transport_option, insurance, notes)
              VALUES ('$package_name', '$customer_name', '$email', '$phone', '$quantity', '$total_price', '$status', '$payment_method', '$transport_option', '$insurance', '$notes')";

    if ($conn->query($query) === TRUE) {
        echo "New order added successfully";
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}

?>
