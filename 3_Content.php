<?php
include 'connect.php';

// Query để lấy dữ liệu từ bảng packages và orders
$sql = "
    SELECT 
        p.id AS package_id,
        p.name AS package_name,
        p.price AS package_price,
        COUNT(o.id) AS total_orders,
        SUM(o.total_price) AS total_revenue
    FROM 
        packages p
    LEFT JOIN 
        orders o ON p.id = o.package_id
    GROUP BY 
        p.id, p.name, p.price
    ORDER BY 
        total_orders DESC
";
$result = $conn->query($sql);

// Tạo mảng lưu trữ dữ liệu
$reportData = [];
while ($row = $result->fetch_assoc()) {
    $reportData[] = $row;
}

// Convert dữ liệu sang JSON
echo '<script>
    const reportData = ' . json_encode($reportData) . ';
</script>';
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

        <main>
            <h2>Biểu Đồ Phân Tích</h2>

            <!-- Biểu đồ số lượng đặt theo gói -->
            <div>
                <h3>Số Lượng Đặt Theo Gói</h3>
                <canvas id="ordersChart"></canvas>
            </div>

            <!-- Biểu đồ doanh thu theo gói -->
            <div>
                <h3>Doanh Thu Theo Gói</h3>
                <canvas id="revenueChart"></canvas>
            </div>

            <!-- Bảng dữ liệu -->
            <div>
                <h3>Bảng Dữ Liệu</h3>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên Gói</th>
                            <th>Giá</th>
                            <th>Số Lượng Đặt</th>
                            <th>Tổng Doanh Thu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reportData as $row): ?>
                            <tr>
                                <td><?= $row['package_id'] ?></td>
                                <td><?= $row['package_name'] ?></td>
                                <td><?= number_format($row['package_price'], 0, ',', '.') ?> VND</td>
                                <td><?= $row['total_orders'] ?></td>
                                <td><?= number_format($row['total_revenue'], 0, ',', '.') ?> VND</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>

    </section>
    <!-- vẽ biểu đồ -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="script.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Lấy dữ liệu từ reportData
            const packageNames = reportData.map(data => data.package_name);
            const totalOrders = reportData.map(data => data.total_orders);
            const totalRevenue = reportData.map(data => data.total_revenue);

            // Biểu đồ số lượng đặt theo gói
            const ctx1 = document.getElementById('ordersChart').getContext('2d');
            new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: packageNames,
                    datasets: [{
                        label: 'Số lượng đặt',
                        data: totalOrders,
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Biểu đồ doanh thu theo gói
            const ctx2 = document.getElementById('revenueChart').getContext('2d');
            new Chart(ctx2, {
                type: 'line',
                data: {
                    labels: packageNames,
                    datasets: [{
                        label: 'Doanh thu',
                        data: totalRevenue,
                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 2,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</body>

</html>