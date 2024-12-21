<?php
include 'connect.php';
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=places.csv');
$output = fopen('php://output', 'w');
fputcsv($output, array('ID', 'Tên Địa Điểm', 'Mô Tả', 'Địa Chỉ', 'Giá', 'Trạng Thái'));

$result = $conn->query("SELECT id, name, description, location, price, status FROM places");
while ($row = $result->fetch_assoc()) {
    fputcsv($output, $row);
}
fclose($output);
?>
