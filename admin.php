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
	<link rel="stylesheet" href="admin/admin_first_l2.css">

	<title>AdminHub</title>
</head>

<body>

	<style>
		.dashboard-content img {
			max-width: 100%;
			height: auto;
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

			<!-- thêm  -->
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
		<!-- NAVBAR -->




		<!-- MAIN -->
		<!-- <main>

			<section class="dashboard-content">
				<div class="text-content">
					<h1>Dashboard Quản Lý</h1>
					<p>Chào mừng bạn đến với Dashboard quản lý của AdminHub. Tại đây, bạn có thể theo dõi hoạt động, quản lý cửa hàng, và truy cập các phân tích số liệu một cách dễ dàng.</p>
				</div>
				<div class="image-content">
					<img src="admin/images_admin/admin icon.jpg" alt="Dashboard Management">
				</div>
			</section>

		</main> -->
		<main>
			<section class="dashboard-content">
				<div class="container">
					<div class="row">
						<!-- Cột bên trái: Nội dung text -->
						<div class="col-md-6">
							<div class="text-content">
								<h1>Dashboard Quản Lý</h1>
								<p>Chào mừng bạn đến với Dashboard quản lý của AdminHub. Tại đây, bạn có thể theo dõi hoạt động, quản lý cửa hàng, và truy cập các phân tích số liệu một cách dễ dàng.</p>
							</div>
						</div>

						<!-- Cột bên phải: Hình ảnh -->
						<div class="col-md-6">
							<div class="image-content">
								<img src="admin/images_admin/admin_icon_4.jpg" alt="Dashboard Management" class="img-fluid">
							</div>
						</div>
					</div>
				</div>
			</section>
		</main>




	</section>


	<script src="admin/script.js"></script>
</body>

</html>