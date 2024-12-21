

LƯU CỦA INFO.PHP


<?php
            include "connect.php";

            // Kiểm tra kết nối
            if ($conn->connect_error) {
                die("Kết nối thất bại: " . $conn->connect_error);
            }

            // Lấy ID của package từ URL
            if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                $id = intval($_GET['id']); // Ép kiểu ID thành số nguyên

                // Truy vấn dữ liệu //;
                            $sql ="SELECT p.*, i.description AS detail_description, i.detailed_activities, i.images, i.additional_info
                    FROM packages p
                    LEFT JOIN information_details i ON p.id = i.package_id
                    WHERE p.id = ?
                ";

                $stmt = $conn->prepare($sql);
                if ($stmt) {
                    $stmt->bind_param("i", $id); // Truyền tham số ID vào truy vấn
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        // Hiển thị dữ liệu từ cơ sở dữ liệu
                        $row = $result->fetch_assoc();
                        echo '<div class="container">';

                        // Hiển thị hình ảnh
                        echo '<div class="image-column">';
                        if (!empty($row['image_url'])) {
                            echo '<img src="images/' . htmlspecialchars($row['image_url']) . '" alt="Package Image">';
                        } else {
                            echo '<p>Image not available</p>';
                        }
                        echo '</div>';

                        // Hiển thị thông tin chi tiết
                        echo '<div class="info-column">';
                        echo '<h3>' . htmlspecialchars($row['name']) . '</h3>';
                        echo '<p><strong>Description:</strong> ' . htmlspecialchars($row['description']) . '</p>';
                        echo '<p><strong>Price:</strong> $' . htmlspecialchars($row['price']) . '</p>';
                        echo '<p><strong>Destination:</strong> ' . htmlspecialchars($row['destination']) . '</p>';
                        echo '<p><strong>Available Slots:</strong> ' . htmlspecialchars($row['available_slots']) . '</p>';
                        echo '<p><strong>Start Date:</strong> ' . htmlspecialchars($row['start_date']) . '</p>';
                        echo '<p><strong>End Date:</strong> ' . htmlspecialchars($row['end_date']) . '</p>';

                        // Thông tin bổ sung
                        // if (!empty($row['additional_info'])) {
                        //     echo '<h4>Additional Information</h4>';
                        //     echo '<p>' . nl2br(htmlspecialchars($row['additional_info'])) . '</p>';
                        // }

                        // if (!empty($row['detailed_activities'])) {
                        //     echo '<h4>Detailed Activities</h4>';
                        //     echo '<p>' . nl2br(htmlspecialchars($row['detailed_activities'])) . '</p>';
                        // }
                        if (!empty($row['detail_description'])) {
                            echo '<p><strong>Detail Description:</strong> ' . nl2br(htmlspecialchars($row['detail_description'])) . '</p>';
                        }

                        if (!empty($row['additional_info'])) {
                            echo '<h4>Additional Information</h4>';
                            echo '<p>' . nl2br(htmlspecialchars($row['additional_info'])) . '</p>';
                        }

                        if (!empty($row['detailed_activities'])) {
                            echo '<h4>Detailed Activities</h4>';
                            echo '<p>' . nl2br(htmlspecialchars($row['detailed_activities'])) . '</p>';
                        }

                        if (!empty($row['images'])) {
                            echo '<h4>Activity Images</h4>';
                            echo '<img src="images/' . htmlspecialchars($row['images']) . '" alt="Activity Image">';
                        }

                        echo '</div>'; // Kết thúc cột thông tin
                        echo '</div>'; // Kết thúc container
                    } else {
                        echo '<p>No details available for this package.</p>';
                    }

                    $stmt->close();
                } else {
                    echo '<p>Error preparing the query: ' . $conn->error . '</p>';
                }
            } else {
                echo '<p>Invalid package ID.</p>';
            }

            $conn->close();
            ?>
