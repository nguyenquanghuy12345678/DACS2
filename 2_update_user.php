<?php
// Include database connection
include 'connect.php'; // Điều chỉnh đường dẫn nếu cần

// Initialize variables
$name = $email = $phone = $address = $location = $status = $notes = $profile_image = "";
$error = "";

// Get user ID from query string
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Retrieve the current user information
    $sql = "SELECT * FROM user_info_management WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // If user exists, populate form fields
    if ($user) {
        $name = $user['name'];
        $email = $user['email'];
        $phone = $user['phone'];
        $address = $user['address'];
        $location = $user['location'];
        $status = $user['status'];
        $notes = $user['notes'];
        $profile_image = $user['profile_image'];
    } else {
        $error = "User not found.";
    }
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $location = trim($_POST['location']);
    $status = trim($_POST['status']);
    $notes = trim($_POST['notes']);
    $profile_image = $_FILES['profile_image']['name'];

    // Handle file upload if new image is provided
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
    if (!empty($profile_image) && !move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
        $error = "Failed to upload image.";
    }

    // Simple validation
    if (empty($name) || empty($email) || empty($phone) || empty($address) || empty($location) || empty($status)) {
        $error = "Please fill in all required fields.";
    } else {
        // Prepare SQL statement for update
        if (!empty($profile_image)) {
            $sql = "UPDATE user_info_management SET name = ?, email = ?, phone = ?, address = ?, location = ?, status = ?, notes = ?, profile_image = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssssssi", $name, $email, $phone, $address, $location, $status, $notes, $profile_image, $user_id);
        } else {
            $sql = "UPDATE user_info_management SET name = ?, email = ?, phone = ?, address = ?, location = ?, status = ?, notes = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssssi", $name, $email, $phone, $address, $location, $status, $notes, $user_id);
        }

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to the main page after successful update
            header("Location: 2_Info_user.php");
            exit();
        } else {
            $error = "Error: " . $stmt->error;
        }
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
    <link rel="stylesheet" href="css/add_user.css">
    <link rel="stylesheet" href="admin/style.css">
    <title>Cập Nhật Người Dùng</title>
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
                <a href="#">
                    <!-- <li class="active"> -->
                    <!-- <a href="admin/index1.php"> -->
                    <!-- nên ẩn -->
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#">
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
                <a href="#">
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
        </ul>
        <ul class="side-menu">
            <li>
                <a href="#">
                    <i class='bx bxs-cog'></i>
                    <span class="text">Settings</span>
                </a>
            </li>
            <li>
                <a href="#" class="logout">
                    <i class='bx bxs-log-out-circle'></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </section>


    <!-- CONTENT -->
    <section id="content">
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
                <img src="admin/images_admin/icon_comunication.png">
            </a>
        </nav>
        <!-- NAVBAR -->
        <main class="container mt-5">
            <div class="card p-4 shadow-sm">
                <h2 class="mb-4 text-center">Cập Nhật Người Dùng</h2>

                <?php if ($error): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $user_id; ?>" method="post" enctype="multipart/form-data">
                    <!-- Tên -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên:</label>
                        <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($name); ?>" required>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($email); ?>" required>
                    </div>

                    <!-- Số điện thoại -->
                    <div class="mb-3">
                        <label for="phone" class="form-label">Điện Thoại:</label>
                        <input type="text" id="phone" name="phone" class="form-control" value="<?php echo htmlspecialchars($phone); ?>" required>
                    </div>

                    <!-- Địa chỉ -->
                    <div class="mb-3">
                        <label for="address" class="form-label">Địa Chỉ:</label>
                        <input type="text" id="address" name="address" class="form-control" value="<?php echo htmlspecialchars($address); ?>" required>
                    </div>

                    <!-- Vị trí -->
                    <div class="mb-3">
                        <label for="location" class="form-label">Vị Trí:</label>
                        <input type="text" id="location" name="location" class="form-control" value="<?php echo htmlspecialchars($location); ?>" required>
                    </div>

                    <!-- Trạng thái -->
                    <div class="mb-3">
                        <label for="status" class="form-label">Trạng Thái:</label>
                        <select id="status" name="status" class="form-select" required>
                            <option value="active" <?php echo $status == 'active' ? 'selected' : ''; ?>>Active</option>
                            <option value="inactive" <?php echo $status == 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                            <option value="pending" <?php echo $status == 'pending' ? 'selected' : ''; ?>>Pending</option>
                        </select>
                    </div>

                    <!-- Ghi chú -->
                    <div class="mb-3">
                        <label for="notes" class="form-label">Ghi Chú:</label>
                        <textarea id="notes" name="notes" class="form-control"><?php echo htmlspecialchars($notes); ?></textarea>
                    </div>

                    <!-- Hình ảnh -->
                    <div class="mb-3">
                        <label for="profile_image" class="form-label">Hình Ảnh:</label>
                        <input type="file" id="profile_image" name="profile_image" class="form-control" accept="image/*">
                        <?php if ($profile_image): ?>
                            <div class="mt-2">
                                <img src="uploads/<?php echo $profile_image; ?>" alt="Profile Image" class="img-fluid" style="width: 100px;">
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Các nút -->
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-success">Cập Nhật</button>
                        <button type="button" class="btn btn-danger" onclick="location.href='index2.php'">Hủy</button>
                    </div>
                </form>
            </div>
        </main>

    </section>

    <script src="script.js"></script>

    <script>
        document.getElementById('profile_image').addEventListener('change', function(event) {
            const previewImg = document.getElementById('preview-img');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.style.display = 'block';
                    previewImg.src = e.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                previewImg.style.display = 'none';
            }
        });
    </script>

</body>

</html>