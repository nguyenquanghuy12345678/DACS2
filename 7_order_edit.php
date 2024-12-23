<!-- 
include 'connect.php';
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];  
    $query = "
        SELECT 
            o.id, o.customer_name, o.customer_email, o.phone_number, o.order_date, o.quantity, 
            o.total_price, o.status, o.payment_method, o.transport_option, o.insurance, o.notes, p.id AS package_id, p.name AS package_name
        FROM orders o
        JOIN packages p ON o.package_id = p.id
        WHERE o.id = ?
    ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $order = $result->fetch_assoc();
    } else {
        echo "Order not found.";
        exit;
    }
} else {
    echo "No order ID provided.";
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_name = $_POST['customer_name'];
    $customer_email = $_POST['customer_email'];
    $phone_number = $_POST['phone_number'];
    $order_date = $_POST['order_date'];
    $quantity = $_POST['quantity'];
    $total_price = $_POST['total_price'];
    $status = $_POST['status'];
    $payment_method = $_POST['payment_method'];
    $transport_option = $_POST['transport_option'];
    $insurance = $_POST['insurance'];
    $notes = $_POST['notes'];
    $package_id = $_POST['package_id'];

    $update_query = "
        UPDATE orders 
        SET 
            customer_name = ?, 
            customer_email = ?, 
            phone_number = ?, 
            order_date = ?, 
            quantity = ?, 
            total_price = ?, 
            status = ?, 
            payment_method = ?, 
            transport_option = ?, 
            insurance = ?, 
            notes = ?, 
            package_id = ?
        WHERE id = ?
    ";

    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("ssssiiisssii", $customer_name, $customer_email, $phone_number, $order_date, $quantity, $total_price, $status, $payment_method, $transport_option, $insurance, $notes, $package_id, $order_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Order updated successfully!";
    } else {
        echo "Error updating order.";
    }
} -->
<?php
include "connect.php";

// Check if order ID is provided via GET
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Fetch order details
    $query = "SELECT * FROM orders WHERE id = ?";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $order_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $order = $result->fetch_assoc();

        if ($order) {
            // Fetch package details
            $package_id = $order['package_id'];
            $queryPackage = "SELECT * FROM packages WHERE id = ?";
            if ($stmtPackage = $conn->prepare($queryPackage)) {
                $stmtPackage->bind_param("i", $package_id);
                $stmtPackage->execute();
                $resultPackage = $stmtPackage->get_result();
                $package = $resultPackage->fetch_assoc();
            }
        }
    }
}

// Update order on form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = $_POST['order_id'];
    $package_id = $_POST['package_id'];
    $customer_name = $_POST['customer_name'];
    $customer_email = $_POST['customer_email'];
    $phone_number = $_POST['phone_number'];
    $quantity = $_POST['quantity'];
    $total_price = $_POST['total_price'];
    $order_date = $_POST['order_date'];
    $payment_method = $_POST['payment_method'];
    $transport_option = $_POST['transport_option'];
    $insurance = isset($_POST['insurance']) ? 1 : 0;
    $notes = $_POST['notes'];

    // Update order in the database
    $query = "UPDATE orders SET customer_name = ?, customer_email = ?, phone_number = ?, quantity = ?, total_price = ?, order_date = ?, payment_method = ?, transport_option = ?, insurance = ?, notes = ? WHERE id = ?";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("sssiisssssi", $customer_name, $customer_email, $phone_number, $quantity, $total_price, $order_date, $payment_method, $transport_option, $insurance, $notes, $order_id);

        if ($stmt->execute()) {
            echo "Order updated successfully!";
        } else {
            echo "Error updating order.";
        }
    } else {
        echo "Error preparing query.";
    }

    if ($stmt->execute()) {
        echo "<script>alert('Order updated successfully!'); window.location.href='7_Order_directly.php';</script>";
    } else {
        echo "<script>alert('Error updating order.');</script>";
    }

    $conn->close();
}

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
        /* Thêm padding cho section content để tránh nội dung sát viền */
        #content {
            padding: 20px;
            font-family: Arial, sans-serif;
        }

        /* Căn chỉnh tiêu đề */
        #content h2 {
            color: red;
            font-size: 24px;
            margin-bottom: 20px;
        }

        /* Cải thiện giao diện cho form */
        .order-form {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }

        /* Làm cho các trường nhập liệu dễ nhìn hơn */
        .order-form label {
            font-weight: bold;
            margin-bottom: 5px;
            display: inline-block;
        }

        /* Định dạng các trường nhập liệu */
        .order-form input[type="text"],
        .order-form input[type="email"],
        .order-form input[type="number"],
        .order-form input[type="date"],
        .order-form select,
        .order-form textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        /* Định dạng cho checkbox */
        .order-form input[type="checkbox"] {
            margin-right: 10px;
        }

        /* Cải thiện giao diện button */
        .order-form button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .order-form button:hover {
            background-color: #0056b3;
        }

        /* Định dạng cho các thông tin về gói */
        .package-info {
            display: flex;
            margin-bottom: 30px;
        }

        .package-info .image {
            flex: 1;
            padding-right: 20px;
        }

        .package-info .image img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .package-info .info {
            flex: 2;
        }

        .package-info .info h3 {
            margin-bottom: 10px;
            font-size: 20px;
        }

        .package-info .info p {
            margin: 5px 0;
            font-size: 16px;
        }
    </style>

    <section id="sidebar">
        <a href="admin.php" class="brand">
            <i class='bx bxs-smile'></i>
            <span class="text">AdminHub</span>
        </a>
        <ul class="side-menu top">
            <li><a href="1_Order.php"><i class='bx bxs-dashboard'></i><span class="text">Dashboard</span></a></li>
            <li><a href="2_Info_user.php"><i class='bx bxs-shopping-bag-alt'></i><span class="text">My Store</span></a></li>
            <li><a href="3_Content.php"><i class='bx bxs-doughnut-chart'></i><span class="text">Analytics</span></a></li>
            <li><a href="4_Notification.php"><i class='bx bxs-message-dots'></i><span class="text">Message</span></a></li>
            <li><a href="5_Chart.php"><i class='bx bxs-group'></i><span class="text">Team</span></a></li>
            <li><a href="6_Place.php"><i class='bx bxs-home'></i><span class="text">Place</span></a></li>
            <li><a href="7_Order_directly.php"><i class='bx bx-slider'></i><span class="text">Order</span></a></li>
        </ul>
        <ul class="side-menu">
            <li><a href="#"><i class='bx bxs-cog'></i><span class="text">Settings</span></a></li>
            <li><a href="logout.php" class="logout"><i class='bx bxs-log-out-circle'></i><span class="text">Logout</span></a></li>
        </ul>
    </section>

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
            <a href="#" class="notification"><i class='bx bxs-bell'></i><span class="num">8</span></a>
            <a href="#" class="profile"><img src="admin/images_admin/people.png"></a>
        </nav>

        <main>
            <h2><a style="color:red">Edit Order</a> ID: <?php echo htmlspecialchars($order['id']); ?></h2>
            <?php if (isset($order)): ?>
                <div class="package-info">
                    <div class="image">
                        <img src="images/<?php echo htmlspecialchars($package['image_url']); ?>" alt="<?php echo htmlspecialchars($package['name']); ?>">
                    </div>
                    <div class="info">
                        <h3><?php echo htmlspecialchars($package['name']); ?></h3>
                        <p><?php echo htmlspecialchars($package['description']); ?></p>
                        <p>Price: <?php echo number_format($package['price'], 2); ?> VND</p>
                        <p>Available Slots: <?php echo htmlspecialchars($package['available_slots']); ?></p>
                    </div>
                </div>

                <div class="order-form">
                    <form action="" method="POST">
                        <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($order['id']); ?>">
                        <input type="hidden" name="package_id" value="<?php echo htmlspecialchars($package['id']); ?>">

                        <label for="customer_name">Your Name:</label>
                        <input type="text" name="customer_name" value="<?php echo htmlspecialchars($order['customer_name']); ?>" required><br>

                        <label for="customer_email">Your Email:</label>
                        <input type="email" name="customer_email" value="<?php echo htmlspecialchars($order['customer_email']); ?>" required><br>

                        <label for="phone_number">Phone Number:</label>
                        <input type="text" name="phone_number" value="<?php echo htmlspecialchars($order['phone_number']); ?>"><br>

                        <label for="quantity">Quantity (Slots):</label>
                        <input type="number" id="quantity" name="quantity" min="1" max="<?php echo htmlspecialchars($package['available_slots']); ?>" value="<?php echo htmlspecialchars($order['quantity']); ?>" required><br>

                        <label for="total_price">Total Price (VND):</label>
                        <input type="text" id="total_price" name="total_price" readonly value="<?php echo number_format($package['price'] * $order['quantity'], 2); ?>"><br>

                        <label for="order_date">Select Date:</label>
                        <input type="date" name="order_date" required value="<?php echo htmlspecialchars($order['order_date']); ?>" min="<?php echo htmlspecialchars($package['start_date']); ?>" max="<?php echo htmlspecialchars($package['end_date']); ?>"><br>

                        <label for="payment_method">Payment Method:</label>
                        <select name="payment_method">
                            <option value="Cash" <?php echo $order['payment_method'] == 'Cash' ? 'selected' : ''; ?>>Cash</option>
                            <option value="Credit Card" <?php echo $order['payment_method'] == 'Credit Card' ? 'selected' : ''; ?>>Credit Card</option>
                            <option value="Bank Transfer" <?php echo $order['payment_method'] == 'Bank Transfer' ? 'selected' : ''; ?>>Bank Transfer</option>
                        </select><br>

                        <!-- <label for="transport_option">Transport Option:</label>
                        <select name="transport_option">
                            <option value="Pickup" < echo $order['transport_option'] == 'Pickup' ? 'selected' : ''; ?>>Pickup</option>
                            <option value="Delivery"  echo $order['transport_option'] == 'Delivery' ? 'selected' : ''; ?>>Delivery</option>
                        </select><br> -->

                        <label for="transport_option">Transport Option:</label>
                        <select name="transport_option">
                            <option value="Bus" <?php echo $order['transport_option'] == 'Bus' ? 'selected' : ''; ?>>Bus</option>
                            <option value="Plane" <?php echo $order['transport_option'] == 'Plane' ? 'selected' : ''; ?>>Plane</option>
                            <option value="Train" <?php echo $order['transport_option'] == 'Train' ? 'selected' : ''; ?>>Train</option>
                        </select><br>


                        <label for="insurance">Insurance:</label>
                        <input type="checkbox" name="insurance" <?php echo $order['insurance'] ? 'checked' : ''; ?>><br>

                        <label for="notes">Notes:</label>
                        <textarea name="notes"><?php echo htmlspecialchars($order['notes']); ?></textarea><br>

                        <button type="submit">Update Order</button>
                    </form>
                </div>
            <?php endif; ?>
        </main>
    </section>

    <script>
        document.getElementById('quantity').addEventListener('input', function() {
            var quantity = this.value;
            var pricePerSlot = <?php echo $package['price']; ?>;
            var totalPrice = quantity * pricePerSlot;
            document.getElementById('total_price').value = totalPrice.toFixed(2);
        });
    </script>
    <script src="admin/script.js"></script>
</body>

</html>