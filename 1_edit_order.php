<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Đặt Phòng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php
    include 'header.php';
    include 'connect.php'; // Kết nối cơ sở dữ liệu

    // Khởi tạo biến
    $error = "";
    $id = $name = $email = $phone = $address = $location = $guests = $arrivals = $leaving = "";

    // Lấy ID từ URL
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = intval($_GET['id']); // Ép kiểu để đảm bảo an toàn

        // Lấy dữ liệu hiện tại từ cơ sở dữ liệu
        $sql = "SELECT * FROM book_form WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $name = $row['name'];
            $email = $row['email'];
            $phone = $row['phone'];
            $address = $row['address'];
            $location = $row['location'];
            $guests = $row['guests'];
            $arrivals = $row['arrivals'];
            $leaving = $row['leaving'];
        } else {
            $error = "Không tìm thấy đặt phòng.";
        }
        $stmt->close();
    } else {
        $error = "ID không hợp lệ.";
    }

    // Xử lý cập nhật dữ liệu khi người dùng nhấn "Lưu"
    if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($error)) {
        // Lấy dữ liệu từ form
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);
        $address = trim($_POST['address']);
        $location = trim($_POST['location']);
        $guests = intval($_POST['guests']);
        $arrivals = $_POST['arrivals'];
        $leaving = $_POST['leaving'];

        // Kiểm tra lỗi cơ bản
        if (empty($name) || empty($email) || empty($phone) || empty($address) || empty($location) || empty($guests) || empty($arrivals) || empty($leaving)) {
            $error = "Vui lòng điền đầy đủ thông tin.";
        } else {
            // Cập nhật cơ sở dữ liệu
            $sql = "UPDATE book_form SET name=?, email=?, phone=?, address=?, location=?, guests=?, arrivals=?, leaving=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssissi", $name, $email, $phone, $address, $location, $guests, $arrivals, $leaving, $id);

            if ($stmt->execute()) {
                header("Location: 1_Order.php"); // Quay lại trang danh sách sau khi cập nhật
                exit();
            } else {
                $error = "Cập nhật thất bại: " . $stmt->error;
            }
            $stmt->close();
        }
    }

    $conn->close();
    ?>
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
                <img src="images_admin/icon_comunication.png">
            </a>
        </nav>
        <!-- NAVBAR -->

        <main class="container my-5">
            <h2 class="mb-4">Chỉnh sửa Đặt Phòng</h2>

            <?php if ($error): ?>
                <div class="alert alert-danger">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id; ?>" method="post" class="needs-validation" novalidate>
                <div class="mb-3">
                    <label for="name" class="form-label">Tên:</label>
                    <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($name); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($email); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Điện Thoại:</label>
                    <input type="text" id="phone" name="phone" class="form-control" value="<?php echo htmlspecialchars($phone); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Địa Chỉ:</label>
                    <input type="text" id="address" name="address" class="form-control" value="<?php echo htmlspecialchars($address); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="location" class="form-label">Vị Trí:</label>
                    <input type="text" id="location" name="location" class="form-control" value="<?php echo htmlspecialchars($location); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="guests" class="form-label">Khách:</label>
                    <input type="number" id="guests" name="guests" class="form-control" value="<?php echo htmlspecialchars($guests); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="arrivals" class="form-label">Ngày Đến:</label>
                    <input type="date" id="arrivals" name="arrivals" class="form-control" value="<?php echo htmlspecialchars($arrivals); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="leaving" class="form-label">Ngày Rời:</label>
                    <input type="date" id="leaving" name="leaving" class="form-control" value="<?php echo htmlspecialchars($leaving); ?>" required>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary me-2">Lưu</button>
                    <button type="button" onclick="location.href='1_Order.php'" class="btn btn-secondary">Hủy</button>
                </div>
            </form>
        </main>


    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>