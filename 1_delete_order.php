<?php
include 'connect.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM book_form WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // Xóa thành công, quay lại 1_Places.php với thông báo thành công
        header("Location: 1_Order.php?status=success");
    } else {
        // Xóa thất bại, quay lại 1_Places.php với thông báo lỗi
        header("Location: 1_Order.php?status=error");
    }
} else {
    // Trường hợp không có ID hợp lệ, quay lại 1_Places.php với thông báo lỗi
    header("Location: 1_Order.php?status=error");
}
?>
