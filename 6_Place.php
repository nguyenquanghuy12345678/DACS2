<?php
include  'connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Link đến CSS của Bootstrap từ CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJ06PZ2P7y3JfXv38mmX7fPqAStgZyzJbVt/jzF1IbfzF5pP8lDb5fY7nx5u" crossorigin="anonymous">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- My CSS -->
    <link rel="stylesheet" href="admin/style.css">
    <!-- <link rel="stylesheet" href="admin/admin_first_l2.css"> -->

    <title>AdminHub</title>
</head>

<body>

    <style>
        /* Các thay đổi chỉ áp dụng trong <main> */
        main {
            margin: 20px;
            /* Tạo khoảng cách cho toàn bộ phần chính */
        }

        /* Cải thiện không gian giữa các nút */
        main .btn {
            margin-bottom: 15px;
            /* Khoảng cách dưới mỗi nút */
            padding: 10px 20px;
            /* Padding cho các nút để chúng trông to hơn và dễ bấm */
            border-radius: 8px;
            /* Góc tròn để nút trông mềm mại hơn */
        }

        /* Thêm padding và giãn cách cho các ô trong bảng */
        main .table th,
        main .table td {
            padding: 15px 20px;
            /* Giãn cách các ô trong bảng */
            text-align: center;
        }

        /* Cải thiện đường viền của bảng */
        main .table-bordered {
            border: 1px solid #ddd;
            border-radius: 10px;
        }

        /* Tăng kích thước và khoảng cách của icon trong các nút */
        main .btn i.bx {
            font-size: 18px;
            margin-right: 8px;
            /* Khoảng cách giữa icon và chữ */
        }

        /* Tạo không gian thoải mái giữa các phần tử trong section */
        main .mb-3 {
            margin-bottom: 20px;
            /* Khoảng cách giữa các mục */
        }

        /* Cải thiện form input tìm kiếm */
        main .form-input input[type="search"] {
            padding: 10px;
            margin-right: 10px;
            /* Khoảng cách giữa input và button */
            border-radius: 5px;
            /* Góc tròn cho input */
        }

        /* Tăng khoảng cách giữa các mục trong bảng */
        main table td,
        main table th {
            padding: 12px 15px;
            /* Thêm padding cho các ô trong bảng */
        }

        /* Thêm khoảng cách dưới các phần tử .mb-3 */
        main .mb-3 {
            margin-bottom: 20px;
        }
    </style>

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

        <main class="container my-5">
            <h2 class="text-center mb-4">Quản Lý Địa Điểm</h2>
            <br>

            <div class="mb-3">
                <a href="add_place.php" class="btn btn-primary">
                    <i class="bx bxs-plus-circle"></i>
                    <!-- thêm i -->
                    Thêm Mới Địa Điểm
                </a>
            </div>

            <div class="mb-3">
                <a href="edit_place.php" class="btn btn-warning">
                    <i class="bx bxs-edit"></i> <!-- Biểu tượng chỉnh sửa -->
                    Chỉnh Sửa Địa Điểm
                </a>
            </div>


            <br>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên Địa Điểm</th>
                        <th>Mô Tả</th>
                        <th>Hình Ảnh</th>
                        <th>Địa Chỉ</th>
                        <th>Đánh Giá</th>
                        <th>Giá</th>
                        <th>Trạng Thái</th>
                        <th>Loại Dịch Vụ</th>
                        <th>Hạn Đặt</th>
                        <th>Ngày Có Sẵn</th>
                        <th>Sức Chứa</th>
                        <th>Thông Tin Liên Hệ</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Kết nối đến cơ sở dữ liệu và lấy thông tin các địa điểm
                    $result = $conn->query("SELECT * FROM places");
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . substr($row['description'], 0, 100) . "...</td>";
                        echo "<td><img src='" . $row['image_url'] . "' alt='" . $row['name'] . "' class='img-thumbnail' width='100'></td>";
                        echo "<td>" . $row['location'] . "</td>";
                        echo "<td>" . $row['rating'] . "</td>";
                        echo "<td>" . number_format($row['price'], 2) . " VND</td>";
                        echo "<td>" . $row['status'] . "</td>";
                        echo "<td>" . $row['service_type'] . "</td>";
                        echo "<td>" . $row['booking_deadline'] . "</td>";
                        echo "<td>" . $row['available_from'] . " đến " . $row['available_to'] . "</td>";
                        echo "<td>" . $row['max_capacity'] . "</td>";
                        echo "<td>" . $row['contact_info'] . "</td>";
                        echo "<td>
                <a href='edit_place.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Sửa</a>
                <a href='delete_place.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Bạn có chắc chắn muốn xóa không?\")'>Xóa</a>
            </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </main>




    </section>


    <script src="admin/script.js"></script>
</body>

</html>