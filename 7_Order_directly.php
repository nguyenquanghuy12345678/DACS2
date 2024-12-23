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
	<style>
		body {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
			background-color: #f9f9f9;
		}

		h2 {
			text-align: center;
			margin-bottom: 20px;
		}

		.admin-orders {
			/* max-width: 1200px; */
			margin: 20px auto;
			padding: 20px;
			background-color: #fff;
			border-radius: 8px;
			box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
		}

		.add-button {
			display: block;
			margin: 0 auto 20px auto;
			padding: 10px 20px;
			font-size: 16px;
			color: #fff;
			background-color: #007bff;
			border: none;
			border-radius: 4px;
			cursor: pointer;
		}

		.add-button:hover {
			background-color: #0056b3;
		}

		table {
			width: 100%;
			border-collapse: collapse;
		}

		th,
		td {
			padding: 10px;
			text-align: left;
			border-bottom: 1px solid #ddd;
		}

		th {
			background-color: #007bff;
			color: #fff;
		}

		tr:hover {
			background-color: #f1f1f1;
		}

		.action-buttons {
			display: flex;
			gap: 10px;
		}

		.action-buttons button {
			padding: 5px 10px;
			border: none;
			border-radius: 4px;
			cursor: pointer;
		}

		.btn-edit {
			background-color: #ffc107;
			color: #fff;
		}

		.btn-edit:hover {
			background-color: #e0a800;
		}

		.btn-delete {
			background-color: #dc3545;
			color: #fff;
		}

		.btn-delete:hover {
			background-color: #bd2130;
		}

		.btn-status {
			background-color: #28a745;
			color: #fff;
		}

		.btn-status:hover {
			background-color: #218838;
		}

		.no-orders {
			text-align: center;
			font-size: 18px;
			color: #666;
		}
	</style>
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
			<li>
				<a href="2_Info_user.php">
					<i class='bx bxs-shopping-bag-alt'></i>
					<span class="text">My Store</span>
				</a>
			</li>
			<li>
				<a href="3_Content.php">
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
				<a href="5_Chart.php">
					<i class='bx bxs-group'></i>
					<span class="text">Team</span>
				</a>
			</li>
			<li>
				<a href="6_Place.php" class="menu-item">
					<i class='bx bxs-home'></i>
					<span class="text">Place</span>
				</a>
			</li>

			<li>
				<a href="7_Order_directly.php" class="menu-item">
					<i class='bx bx-slider'></i>
					<span class="text">Order </span>
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
		<main>
			<!-- <section class="admin-orders"> -->
			<h2>Manage Orders</h2>
			<!-- <button class="add-button">Add Order</button> -->
			<button class="add-button" onclick="window.location.href='7_add_order.php';">Add Order</button>

			<div class="table-container">
				<table>
					<thead>
						<tr>
							<th>Order ID</th>
							<th>Package Name</th>
							<th>Customer Name</th>
							<th>Email</th>
							<th>Phone</th>
							<th>Order Date</th>
							<th>Quantity</th>
							<th>Total Price</th>
							<th>Status</th>
							<th>Payment Method</th>
							<th>Transport</th>
							<th>Insurance</th>
							<th>Notes</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php
						include "connect.php";

						$query = "
                                SELECT 
                                    o.id AS order_id, 
                                    o.customer_name, 
                                    o.customer_email, 
                                    o.phone_number, 
                                    o.order_date, 
                                    o.quantity, 
                                    o.total_price, 
                                    o.status, 
                                    o.payment_method, 
                                    o.transport_option, 
                                    o.insurance, 
                                    o.notes, 
                                    p.name AS package_name 
                                FROM 
                                    orders o 
                                JOIN 
                                    packages p 
                                ON 
                                    o.package_id = p.id
                            ";

						$result = $conn->query($query);

						if ($result && $result->num_rows > 0) {
							while ($row = $result->fetch_assoc()) {
								echo '<tr>';
								echo '<td>' . htmlspecialchars($row['order_id']) . '</td>';
								echo '<td>' . htmlspecialchars($row['package_name']) . '</td>';
								echo '<td>' . htmlspecialchars($row['customer_name']) . '</td>';
								echo '<td>' . htmlspecialchars($row['customer_email']) . '</td>';
								echo '<td>' . htmlspecialchars($row['phone_number']) . '</td>';
								echo '<td>' . htmlspecialchars($row['order_date']) . '</td>';
								echo '<td>' . htmlspecialchars($row['quantity']) . '</td>';
								
								echo '<td>' . number_format($row['total_price'], 2) . ' VND</td>';

							    // echo '<td>' . number_format($row['total_price']) . ' VND</td>'; sai hàm 
								echo '<td>' . htmlspecialchars($row['status']) . '</td>';
								echo '<td>' . htmlspecialchars($row['payment_method']) . '</td>';
								echo '<td>' . htmlspecialchars($row['transport_option']) . '</td>';
								echo '<td>' . ($row['insurance'] ? 'Yes' : 'No') . '</td>';
								echo '<td>' . htmlspecialchars($row['notes']) . '</td>';
								echo '<td class="action-buttons">';
								// echo '<button class="btn-edit">Edit</button>';
								echo '<button class="btn-edit" onclick="window.location.href=\'7_order_edit.php?order_id=' . $row['order_id'] . '\'">Edit</button>';

								echo '<button class="btn-delete">Delete</button>';
								echo '<button class="btn-status">Change Status</button>';
								echo '</td>';
								echo '</tr>';
							}
						} else {
							echo '<tr><td colspan="14" class="no-orders">No orders found!</td></tr>';
						}

						$conn->close();
						?>
					</tbody>
				</table>
			</div>
			<!-- </section> -->
		</main>
	</section>

	<script src="admin/script.js"></script>
</body>

</html>