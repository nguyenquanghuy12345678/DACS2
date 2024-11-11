<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Package Info</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php
        // Lấy ID của gói từ URL
        $package_id = isset($_GET['id']) ? $_GET['id'] : 1;

        // Mảng giả định thông tin các gói
        $packages = [
            1 => [
                "title" => "Adventure & Tour",
                "description" => "Embark on an unforgettable journey...",
                "price" => "$200",
                "image" => "images/img-1.jpg"
            ],
            2 => [
                "title" => "Explore Hidden Gems",
                "description" => "Explore hidden gems and create lasting memories...",
                "price" => "$200",
                "image" => "images/img-2.jpg"
            ],
            // Tiếp tục thêm thông tin các gói khác
        ];

        $package = $packages[$package_id];
    ?>

    <section class="info">
        <h1><?php echo $package['title']; ?></h1>
        <div class="package-detail">
            <div class="image">
                <img src="<?php echo $package['image']; ?>" alt="<?php echo $package['title']; ?>">
            </div>
            <div class="content">
                <p><?php echo $package['description']; ?></p>
                <p>Price: <strong><?php echo $package['price']; ?></strong></p>
                <a href="book.php" class="btn">Book Now</a>
                <a href="info/infomation.php?id=1" class="btn">View Details</a>

            </div>
        </div>
    </section>

</body>
</html>
