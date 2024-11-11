<?php
// Assuming you already have a database connection
// Replace with your actual database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "book_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   if (isset($_POST['login-email']) && isset($_POST['login-pass'])) {
      // Handle login
      $email = $_POST['login-email'];
      $password = $_POST['login-pass'];

      $sql = "SELECT * FROM users WHERE email = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("s", $email);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0) {
         $user = $result->fetch_assoc();
         if (password_verify($password, $user['password'])) {
            // Successful login
            session_start();
            $_SESSION['user'] = $user;
            header("Location: home.php"); // Redirect to a dashboard or main page - chuyển hướng
            exit();
         } else {
            $login_error = "Incorrect password.";
         }
      } else {
         $login_error = "No user found with this email.";
      }
   } elseif (isset($_POST['register-email']) && isset($_POST['register-pass'])) {
      // Handle registration
      $email = $_POST['register-email'];
      $password = password_hash($_POST['register-pass'], PASSWORD_DEFAULT);

      // Check if email already exists
      $sql = "SELECT * FROM users WHERE email = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("s", $email);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0) {
         $register_error = "Email already exists.";
      } else {
         // Insert the new user
         $sql = "INSERT INTO users (email, password) VALUES (?, ?)";
         $stmt = $conn->prepare($sql);
         $stmt->bind_param("ss", $email, $password);
         if ($stmt->execute()) {
            $register_success = "Registration successful! Please login.";
         } else {
            $register_error = "Error during registration.";
         }
      }
   }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login and Register Form</title>

   <!-- Remixicon and jQuery -->
   <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
   <link rel="stylesheet" href="login/login.css">
   <!-- <link rel="stylesheet" href="css/style.css" class=""> -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>


<!-- 
   <section class="header">
      <a href="home.php" class="logo">Travel</a>
      <nav class="navbar">
         <a href="home.php">Home</a>
         <a href="about.php">About</a>
         <a href="package.php">Package</a>
         <a href="book.php">Book</a>

         
         <a href="login.php">Login</a>
         <a href="info.php" class="">Info</a>
      </nav>
      <div id="menu-btn" class="fas fa-bars"></div>
   </section> -->
 




   <div class="login">
      <img src="login/login_1.jpg" alt="Login image" class="login__img">

      <!-- Login Form -->
      <form id="login-form" class="login__form" method="POST">
         <h1 class="login__title">Login</h1>

         <?php if (isset($login_error)): ?>
            <p class="error-message"><?php echo $login_error; ?></p>
         <?php endif; ?>

         <div class="login__content">
            <div class="login__box">
               <i class="ri-user-3-line login__icon"></i>
               <div class="login__box-input">
                  <input type="email" required class="login__input" id="login-email" name="login-email" placeholder=" " value="<?php echo isset($_POST['login-email']) ? $_POST['login-email'] : ''; ?>">
                  <label for="login-email" class="login__label">Email</label>
               </div>
            </div>

            <div class="login__box">
               <i class="ri-lock-2-line login__icon"></i>
               <div class="login__box-input">
                  <input type="password" required class="login__input" id="login-pass" name="login-pass" placeholder=" ">
                  <label for="login-pass" class="login__label">Password</label>
                  <i class="ri-eye-off-line login__eye" onclick="togglePasswordVisibility('login-pass', this)"></i>
               </div>
            </div>
         </div>

         <div class="login__check">
            <div class="login__check-group">
               <input type="checkbox" class="login__check-input" id="login-check">
               <label for="login-check" class="login__check-label">Remember me</label>
            </div>
            <a href="#" class="login__forgot">Forgot Password?</a>
         </div>

         <button type="submit" class="login__button">Login</button>
         <p class="login__register">Don't have an account? <a href="#" onclick="toggleForm('register')">Register</a></p>

         <!-- thêm lạ -->
         <!-- <p class="login__admin">Are you admin? <a href="#" onclick="toggleForm('admin')">Admin</a></p> -->
      </form>

      <!-- Register Form -->
      <form id="register-form" class="login__form" style="display: none;" method="POST">
         <h1 class="login__title">Register</h1>

         <?php if (isset($register_error)): ?>
            <p class="error-message"><?php echo $register_error; ?></p>
         <?php endif; ?>

         <?php if (isset($register_success)): ?>
            <p class="success-message"><?php echo $register_success; ?></p>
         <?php endif; ?>

         <div class="login__content">
            <div class="login__box">
               <i class="ri-user-3-line login__icon"></i>
               <div class="login__box-input">
                  <input type="email" required class="login__input" id="register-email" name="register-email" placeholder=" " value="<?php echo isset($_POST['register-email']) ? $_POST['register-email'] : ''; ?>">
                  <label for="register-email" class="login__label">Email</label>
               </div>
            </div>

            <div class="login__box">
               <i class="ri-lock-2-line login__icon"></i>
               <div class="login__box-input">
                  <input type="password" required class="login__input" id="register-pass" name="register-pass" placeholder=" ">
                  <label for="register-pass" class="login__label">Password</label>
                  <i class="ri-eye-off-line login__eye" onclick="togglePasswordVisibility('register-pass', this)"></i>
               </div>
            </div>
         </div>

         <button type="submit" class="login__button">Register</button>
         <p class="login__register">Already have an account? <a href="#" onclick="toggleForm('login')">Login</a></p>
      </form>
   </div>

   <script src="login/login_gpt.js"></script>
</body>

</html>