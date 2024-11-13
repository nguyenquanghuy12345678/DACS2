<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/PHPMailer/PHPMailer/src/Exception.php';
require 'vendor/PHPMailer/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/PHPMailer/src/SMTP.php';
include  'connect.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Link đến CSS của Bootstrap từ CDN -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJ06PZ2P7y3JfXv38mmX7fPqAStgZyzJbVt/jzF1IbfzF5pP8lDb5fY7nx5u" crossorigin="anonymous">


	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap-grid.css" integrity="sha512-hhSu9overYjKfSjPCtJW3688VHkfBh+W1pR5Mysll91bOJwGjYntytGTtVXb2aisFOaYXXDrO38NKXDRPJWu7A==" crossorigin="anonymous" referrerpolicy="no-referrer" />


	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="admin/style.css">
	<!-- <link rel="stylesheet" href="admin/admin_first_l2.css"> -->

	<title>AdminHub</title>
</head>

<body>

	<style>
		/* CSS cho phần form trong trang */
		main .container-fluid {
			padding: 20px;
			background-color: #f8f9fa;
		}

		main h1 {
			font-size: 24px;
			color: #333;
			margin-bottom: 20px;
		}

		/* Thiết lập form */
		main form {
			background-color: white;
			padding: 30px;
			border-radius: 8px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
		}

		/* Thiết lập cho các ô input */
		main .form-group input,
		main .form-group textarea {
			border-radius: 5px;
			border: 1px solid #ccc;
			padding: 10px;
			width: 100%;
		}

		main .form-group input[type="file"] {
			padding: 6px;
		}

		/* Thiết lập cho nút gửi */
		main .form-group button {
			background-color: #007bff;
			color: white;
			border: none;
			border-radius: 5px;
			padding: 10px 20px;
			cursor: pointer;
			transition: background-color 0.3s ease;
		}

		main .form-group button:hover {
			background-color: #0056b3;
		}

		/* Đảm bảo các phần tử form có không gian cách nhau hợp lý */
		main .form-row {
			margin-bottom: 15px;
		}

		/* Tối ưu cho thiết bị nhỏ */
		@media (max-width: 768px) {
			main .form-group col-md-6 {
				width: 100%;
			}

			main .form-group col-md-12 {
				width: 100%;
			}
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
		<main>
			<div class="container-fluid">
				<h1>Email tới bạn</h1>
				<form action="mail.php" enctype="multipart/form-data" method="POST">
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="inputEmail4">Email</label>
							<input type="email" class="form-control" name="email" id="inputEmail4" placeholder="Email" required>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="inputSubject">Subject</label>
							<input type="text" class="form-control" name="tieude" id="inputSubject" placeholder="Tiêu đề" required>
						</div>
						<!-- xuống dòng -->
						 <br>
						<div class="form-group col-md-12">
							<label for="editor">Nội dung</label>
							<textarea name="content" id="editor" class="form-control" rows="5" required></textarea>
						</div>
					</div>
					<div class="form-group col-md-6">
						<label for="inputFile">File đính kèm</label>
						<input type="file" class="form-control" name="file" id="inputFile">
					</div>
					<br>
					<div class="form-group col-md-6">
						<button type="submit" class="btn btn-primary">Gửi</button>
					</div>
				</form>
		</main>

	</section>

	<script src="admin/script.js"></script>
	<script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
	<script>
		// Replace the <textarea id="editor"> with a CKEditor instance
		CKEDITOR.replace('editor');
	</script>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>