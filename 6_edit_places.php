<?php
include 'connect.php';

// Lấy ID chuyến du lịch từ URL
$id = $_GET['id'] ?? null;

if (!$id) {
    echo "<script>alert('ID không hợp lệ!'); window.location.href='6_Place.php';</script>";
    exit;
}

// Truy xuất dữ liệu hiện tại từ cơ sở dữ liệu
$query = "SELECT * FROM packages WHERE id = $id";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $package = $result->fetch_assoc();
} else {
    echo "<script>alert('Không tìm thấy chuyến du lịch!'); window.location.href='6_Place.php';</script>";
    exit;
}

// Kiểm tra nếu người dùng gửi form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $destination = $_POST['destination'];
    $available_slots = $_POST['available_slots'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Xử lý upload hình ảnh (nếu có)
    if (!empty($_FILES['image']['name'])) {
        $image_url = $_FILES['image']['name'];
        $target_dir = "images/";
        $target_file = $target_dir . basename($image_url);
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
    } else {
        $image_url = $package['image_url']; // Giữ nguyên hình ảnh cũ nếu không thay đổi
    }

    // Cập nhật dữ liệu vào cơ sở dữ liệu
    $query = "UPDATE packages SET 
                name = '$name', 
                description = '$description', 
                price = '$price', 
                image_url = '$image_url', 
                destination = '$destination', 
                available_slots = '$available_slots', 
                start_date = '$start_date', 
                end_date = '$end_date' 
              WHERE id = $id";

    if ($conn->query($query) === TRUE) {
        echo "<script>alert('Chuyến du lịch đã được cập nhật thành công!'); window.location.href='6_Place.php';</script>";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="admin/style.css">
    <title>AdminHub</title>
</head>

<body>
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="admin.php" class="brand">
            <i class='bx bxs-smile'></i>
            <span class="text">AdminHub</span>
        </a>
        <ul class="side-menu top">
            <li>
                <!-- <li class="active"> -->
                <a href="1_Order.php">
                    <!-- đường dẫn tuyệt đối -->
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="2_Info_user.php">
                    <i class='bx bxs-shopping-bag-alt'></i>
                    <span class="text">My Store</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-doughnut-chart'></i>
                    <span class="text">Analytics</span>
                </a>
            </li>
            <li>
                <a href="4_Notification.php">
                    <i class='bx bxs-message-dots'></i>
                    <span class="text">Message</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-group'></i>
                    <span class="text">Team</span>
                </a>
            </li>
            <li>
                <a href="6_Place.php" class="menu-item">
                    <i class='bx bxs-home'></i> <!-- Changed icon -->
                    <span class="text">Place</span>
                </a>
            </li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="#">
                    <i class='bx bxs-cog'></i>
                    <span class="text">Settings</span>
                </a>
            </li>
            <li>
                <a href="logout.php" class="logout">
                    <i class='bx bxs-log-out-circle'></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- SIDEBAR -->

    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu'></i>
            <a href="#" class="nav-link">Categories</a>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="switch-mode" hidden>
            <label for="switch-mode" class="switch-mode"></label>
            <a href="#" class="notification">
                <i class='bx bxs-bell'></i>
                <span class="num">8</span>
            </a>
            <a href="#" class="profile">
                <img src="admin/images_admin/people.png">
            </a>
        </nav>

        <div class="container my-5">
            <h2 class="text-center mb-4">Chỉnh Sửa Chuyến Du Lịch</h2>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Tên Chuyến</label>
                        <input type="text" name="name" class="form-control" value="<?= $package['name'] ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="destination" class="form-label">Địa Điểm</label>
                        <input type="text" name="destination" class="form-control" value="<?= $package['destination'] ?>" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Mô Tả</label>
                    <textarea name="description" class="form-control" required><?= $package['description'] ?></textarea>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="price" class="form-label">Giá</label>
                        <input type="number" name="price" class="form-control" value="<?= $package['price'] ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="available_slots" class="form-label">Số Lượng Slot</label>
                        <input type="number" name="available_slots" class="form-control" value="<?= $package['available_slots'] ?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="start_date" class="form-label">Ngày Bắt Đầu</label>
                        <input type="date" name="start_date" class="form-control" value="<?= $package['start_date'] ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="end_date" class="form-label">Ngày Kết Thúc</label>
                        <input type="date" name="end_date" class="form-control" value="<?= $package['end_date'] ?>" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Hình Ảnh</label>
                    <input type="file" name="image" class="form-control">
                    <p>Hình ảnh hiện tại: <img src="images/<?= $package['image_url'] ?>" width="100" alt="Hình ảnh chuyến"></p>
                </div>
                <button type="submit" class="btn btn-primary btn-lg w-100">Cập Nhật Chuyến Du Lịch</button>
            </form>
        </div>

    </section>
    <script src="admin/script.js"></script>
</body>

</html>