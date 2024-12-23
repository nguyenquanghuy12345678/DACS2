<?php

include 'connect.php';


// Fetch existing records from user_info table
$sql = "SELECT * FROM user_info_management";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- My CSS -->
    <link rel="stylesheet" href="admin/style.css">
    <link rel="stylesheet" href="css/css_loai_1.css">

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
                <a href="1_Order.php">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li class="active">
                <a href="2_Info_user.php">
                    <i class='bx bxs-shopping-bag-alt'></i>
                    <span class="text">My Store</span>
                </a>
            </li>
            <li>
                <a href="index3.php">
                    <i class='bx bxs-doughnut-chart'></i>
                    <span class="text">Analytics</span>
                </a>
            </li>
            <li>
                <a href="index4.php">
                    <i class='bx bxs-message-dots'></i>
                    <span class="text">Message</span>
                </a>
            </li>
            <li>
                <a href="index5.php">
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
                <img src="admin/images_admin/icon_comunication.png">
            </a>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <h2>Thông Tin Người Dùng</h2>
            <button onclick="location.href='2_add_user.php'">Thêm Mới</button>
            <table border="1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Điện Thoại</th>
                        <th>Địa Chỉ</th>
                        <th>Vị Trí</th>
                        <th>Trạng Thái</th>
                        <th>Ghi Chú</th>
                        <th>Hình Ảnh</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['phone']; ?></td>
                                <td><?php echo $row['address']; ?></td>
                                <td><?php echo $row['location']; ?></td>
                                <td><?php echo $row['status']; ?></td>
                                <td><?php echo $row['notes']; ?></td>
                                <td>
                                    <?php if ($row['profile_image']): ?>
                                        <img src="uploads/<?php echo $row['profile_image']; ?>" alt="Profile Image" width="50" height="50">
                                    <?php else: ?>
                                        <span>Chưa có ảnh</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <button onclick="location.href='2_update_user.php?id=<?php echo $row['id']; ?>'">Sửa</button>
                                    <button onclick="if(confirm('Bạn có chắc chắn muốn xóa không?')) { location.href='delete_user.php?id=<?php echo $row['id']; ?>' }">Xóa</button>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="10">Không có dữ liệu nào.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </main>
        <!-- MAIN -->





    </section>


    <script src="script.js"></script>
</body>

</html>