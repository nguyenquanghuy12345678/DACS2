<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Location Details</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php
        // Lấy id của địa điểm từ URL
        $location_id = isset($_GET['id']) ? $_GET['id'] : 1;

        // Mảng giả định chứa thông tin chi tiết các địa điểm
        $locations = [
            1 => [
                "title" => "Adventure in the Mountains",
                "description" => "Explore the stunning mountains with thrilling adventures and breathtaking views. Perfect for those who seek adrenaline and peace in nature.",
                "price" => "$200",
                "image" => "images/img-1.jpg",
                "details" => "This tour takes you to some of the highest peaks, including scenic routes and guided tours through local wildlife habitats."
            ],
            2 => [
                "title" => "Hidden Beaches Tour",
                "description" => "Relax on secluded beaches with crystal clear waters and soft sands.",
                "price" => "$300",
                "image" => "images/img-2.jpg",
                "details" => "Experience peaceful beaches away from crowds, with options for snorkeling, kayaking, and sunset cruises."
            ],
            // Tiếp tục thêm các địa điểm khác
        ];

        $location = $locations[$location_id];
    ?>

    <section class="location-info">
        <h1><?php echo $location['title']; ?></h1>
        <div class="location-detail">
            <div class="image">
                <img src="<?php echo $location['image']; ?>" alt="<?php echo $location['title']; ?>">
            </div>
            <div class="content">
                <p><strong>Description:</strong> <?php echo $location['description']; ?></p>
                <p><strong>Details:</strong> <?php echo $location['details']; ?></p>
                <p><strong>Price:</strong> <?php echo $location['price']; ?></p>
                <a href="book.php?id=<?php echo $location_id; ?>" class="btn">Book Now</a>
            </div>
        </div>
    </section>

</body>
</html>
