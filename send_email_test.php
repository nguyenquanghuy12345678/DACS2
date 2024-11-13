<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/PHPMailer/PHPMailer/src/Exception.php';
require 'vendor/PHPMailer/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/PHPMailer/src/SMTP.php';





if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mail = new PHPMailer(true); // true: enables exceptions

    try {
        $mail->isSMTP();
        $mail->CharSet = "UTF-8";
        $mail->Host = 'smtp.gmail.com'; // SMTP servers
        $mail->SMTPAuth = true;
        $mail->Username = 'huyhuy0510v@gmail.com'; // SMTP username
        $mail->Password = 'your_email_password'; // Replace with your email password
        $mail->SMTPSecure = 'ssl'; // Enable TLS encryption
        $mail->Port = 465; // TCP port to connect to

        $mail->setFrom($mail->Username, 'Huy đẹp trai');
        $mail->addAddress($_POST['email'], 'Bạn'); // Recipient email and name
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = $_POST['tieude'];

        $noidungthu = '
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title"><b>Xin chào ' . htmlspecialchars('Bạn') . '</b></h5>
                    <p class="card-text">' . nl2br(htmlspecialchars($_POST['content'])) . '</p>
                </div>
            </div>
        ';
        $mail->Body = $noidungthu;

        // Handle file attachment
        if (isset($_FILES['file']['name']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
            $uploadfile = tempnam(sys_get_temp_dir(), sha1($_FILES['file']['name']));
            if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
                $mail->addAttachment($uploadfile, $_FILES['file']['name']);
            }
        }

        $mail->smtpConnect(array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
                "allow_self_signed" => true
            )
        ));

        if ($mail->send()) {
            header("Location: index.php?success=Email sent successfully");
            exit();
        }
    } catch (Exception $e) {
        echo 'Mail không gửi được. Lỗi: ', htmlspecialchars($mail->ErrorInfo);
    }
}
?>