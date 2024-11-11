<?php
// Include database connection
include 'connect.php'; // Điều chỉnh đường dẫn nếu cần

// Initialize variables
$name = $email = $phone = $address = $location = $status = $notes = $profile_image = "";
$error = "";

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

    // Handle file upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
    if (!empty($profile_image) && !move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
        $error = "Failed to upload image.";
    }

    // Simple validation
    if (empty($name) || empty($email) || empty($phone) || empty($address) || empty($location) || empty($status)) {
        $error = "Please fill in all required fields.";
    } else {
        // Prepare SQL statement
        $sql = "INSERT INTO user_info (name, email, phone, address, location, status, notes, profile_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssss", $name, $email, $phone, $address, $location, $status, $notes, $profile_image);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to the main page after successful insertion
            header("Location: index1.php");
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
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="add_user.css">
    <title>Thêm Người Dùng</title>
</head>

<body>
    <!-- SIDEBAR -->
    <!-- <section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-smile'></i>
			<span class="text">AdminHub</span>
		</a>
		<ul class="side-menu top">
			<li><a href="#"><i class='bx bxs-dashboard'></i><span class="text">Dashboard</span></a></li>
			<li><a href="#"><i class='bx bxs-group'></i><span class="text">User Management</span></a></li>
		</ul>
		<ul class="side-menu">
			<li><a href="#"><i class='bx bxs-cog'></i><span class="text">Settings</span></a></li>
			<li><a href="#" class="logout"><i class='bx bxs-log-out-circle'></i><span class="text">Logout</span></a></li>
		</ul>
	</section> -->

    <!-- SIDEBAR -->





    <section id="sidebar">
        <a href="#" class="brand">
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
                <img src="../images_admin/icon_comunication.png">
            </a>
        </nav>
        <!-- NAVBAR -->

        <main>
            <h2>Thêm Người Dùng</h2>
            <?php if ($error): ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                <label for="name">Tên:</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="phone">Điện Thoại:</label>
                <input type="text" id="phone" name="phone" required>

                <label for="address">Địa Chỉ:</label>
                <input type="text" id="address" name="address" required>

                <label for="location">Vị Trí:</label>
                <input type="text" id="location" name="location" required>

                <label for="status">Trạng Thái:</label>
                <input type="text" id="status" name="status" required>

                <label for="notes">Ghi Chú:</label>
                <textarea id="notes" name="notes"></textarea>

                <label for="profile_image">Hình Ảnh:</label>
                <input type="file" id="profile_image" name="profile_image" accept="image/*">

                <button type="submit">Thêm</button>
                <button type="button" onclick="location.href='index2.php'">Hủy</button>
            </form>
        </main>
    </section>

    <script src="../script.js"></script>
</body>

</html>