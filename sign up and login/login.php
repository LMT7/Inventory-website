<?php
include 'connection.php';

session_start();

if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
} else {
  $user_id = '';
};

if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $email = filter_var($email, FILTER_SANITIZE_EMAIL);
  $password = $_POST['password'];
  $password = filter_var($password, FILTER_SANITIZE_STRING);

  $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
  $select_user->execute([$email]);
  $row = $select_user->fetch(PDO::FETCH_ASSOC);

  // Check if user exists and verify the password
  if ($row && password_verify($password, $row['password_hash'])) {
    $_SESSION['user_id'] = $row['user_id'];
    $_SESSION['user_type'] = $row['user_type'];

    if ($_SESSION['user_type'] === 'owner') {
      header('location: ../Owner Dashboard/Dashboard.php');
    } else if ($_SESSION['user_type'] === "renter") {
      header('location: ../Product page/Productpage.html');
    }
  }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="style.css">
  <script type="text/javascript" src="validation.js" defer></script>
</head>

<body>
  <div class="wrapper">
    <h1>Login</h1>
    <p id="error-message"></p>
    <form id="form" method="POST" action="">
      <div>
        <label for="email-input">
          <span>@</span>
        </label>
        <input type="email" name="email" id="email-input" placeholder="Email">
      </div>
      <div>
        <label for="password-input">
          <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
            <path d="M240-80q-33 0-56.5-23.5T160-160v-400q0-33 23.5-56.5T240-640h40v-80q0-83 58.5-141.5T480-920q83 0 141.5 58.5T680-720v80h40q33 0 56.5 23.5T800-560v400q0 33-23.5 56.5T720-80H240Zm240-200q33 0 56.5-23.5T560-360q0-33-23.5-56.5T480-440q-33 0-56.5 23.5T400-360q0 33 23.5 56.5T480-280ZM360-640h240v-80q0-50-35-85t-85-35q-50 0-85 35t-35 85v80Z" />
          </svg>
        </label>
        <input type="password" name="password" id="password-input" placeholder="Password">
      </div>
      <button type="submit" name="submit">Login</button>
    </form>
    <p>New here? <a href="signup.php">Create an Account</a></p>
    <a href="">forgot password?</a>
  </div>
</body>

</html>