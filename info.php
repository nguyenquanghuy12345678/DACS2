<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Package Info</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <aside class="col-md-3 bg-light p-3">
            <h5 class="text-center">Filter Options</h5>
            <form action="" method="GET">
                <div class="mb-3">
                    <label for="priceRange" class="form-label">Price Range</label>
                    <select id="priceRange" name="price" class="form-select">
                        <option value="">All</option>
                        <option value="100-200">$100 - $200</option>
                        <option value="200-300">$200 - $300</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select id="category" name="category" class="form-select">
                        <option value="">All</option>
                        <option value="adventure">Adventure</option>
                        <option value="relax">Relaxation</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
            </form>
        </aside>

        <!-- Main Content -->
        <main class="col-md-9">
            <div class="row gy-4">
                <?php
                // Mảng giả định 20 gói
                $packages = [];
                for ($i = 1; $i <= 20; $i++) {
                    $packages[$i] = [
                        "title" => "Package $i",
                        "description" => "This is the description for package $i.",
                        "price" => "$" . (100 + $i * 10),
                        "image" => "images/img-" . ($i % 4 + 1) . ".jpg"
                    ];
                }

                foreach ($packages as $id => $package) {
                    echo '
                    <div class="col-md-4">
                        <div class="card h-100">
                            <img src="' . $package["image"] . '" class="card-img-top" alt="' . $package["title"] . '">
                            <div class="card-body">
                                <h5 class="card-title">' . $package["title"] . '</h5>
                                <p class="card-text">' . $package["description"] . '</p>
                                <p class="card-text"><strong>Price:</strong> ' . $package["price"] . '</p>
                                <a href="info/infomation.php?id=' . $id . '" class="btn btn-primary w-100">View Details</a>
                            </div>
                        </div>
                    </div>';
                }
                ?>
            </div>
        </main>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>
