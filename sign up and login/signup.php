<?php
include 'connection.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
};

if (isset($_POST['submit'])) {
    $fullname = $_POST['fullname'];
    $fullname = filter_var($fullname, FILTER_SANITIZE_STRING);
    $username = $_POST['username'];
    $username = filter_var($username, FILTER_SANITIZE_STRING);
    $role = $_POST['role'];
    $role = filter_var($role, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $password = filter_var($password, FILTER_SANITIZE_STRING);
    $repeat_password = $_POST['repeat-password'];
    $repeat_password = filter_var($repeat_password, FILTER_SANITIZE_STRING);


    $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
    $select_user->execute([$email]);
    $row = $select_user->fetch(PDO::FETCH_ASSOC);

    if ($select_user->rowCount() > 0) {
        echo "<script>alert('Email already exists!');</script>";
    } else {
        if ($password != $repeat_password) {
            echo "<script>alert('Passwords does not match!')</script>";
        } else {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $insert_user = $conn->prepare("INSERT INTO `users`(full_name,username,user_type,email,password_hash) VALUES (?,?,?,?,?)");
            $insert_user->execute([$fullname, $username, $role, $email, $password_hash]);
            echo "<script>alert('Sign up Successful!');</script>";
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Signup</title>
  <link rel="stylesheet" href="style.css">
  <script type="text/javascript" src="validation.js" defer></script>
</head>
<body>
  <div class="wrapper">
    <h1>Signup</h1>
    <p id="error-message"></p>
    <form id="form" action="" method="POST">
      <div>
        <label for="fullname-input">
          <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Z"/></svg>
        </label>
        <input type="text" name="fullname" id="fullname-input" placeholder="Full Name">
      </div>
      <div>
        <label for="username-input">
          <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Z"/></svg>
        </label>
        <input type="text" name="username" id="username-input" placeholder="Username">
      </div>
      <div>
        <label for="Role-input">
          <?xml version="1.0" encoding="utf-8"?><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="24" viewBox="0 0 106.17 122.88" style="enable-background:new 0 0 106.17 122.88" xml:space="preserve"><g><path d="M29.96,67.49c-0.16-0.09-0.32-0.19-0.47-0.31c-1.95-1.56-4.08-3.29-5.94-4.81c-2.69-2.2-5.8-4.76-7.97-6.55 c-1.49-1.23-3.17-2.07-4.75-2.39c-1.02-0.2-1.95-0.18-2.67,0.12c-0.59,0.24-1.1,0.72-1.45,1.48c-0.45,0.99-0.66,2.41-0.54,4.32 c0.11,1.69,0.7,3.55,1.48,5.33c1.16,2.63,2.73,5.04,3.89,6.59c0.07,0.09,0.13,0.19,0.19,0.29l23.32,33.31 c0.3,0.43,0.47,0.91,0.53,1.4l0.01,0c0.46,3.85,1.28,6.73,2.49,8.54c0.88,1.31,2.01,1.98,3.42,1.94l0.07,0v-0.01h36.38 c0.09,0,0.17,0,0.26,0.01c2.28-0.03,4.36-0.71,6.25-2.02c2.09-1.44,3.99-3.68,5.72-6.7c0.03-0.05,0.06-0.11,0.1-0.16 c0.67-1.15,1.55-2.6,2.41-4.02c3.72-6.13,6.96-11.45,7.35-19.04L99.8,74.34c-0.02-0.15-0.03-0.3-0.03-0.45 c0-0.14,0.02-1.13,0.03-2.46c0.09-6.92,0.19-15.48-6.14-16.56h-4.05l-0.04,0c-0.02,1.95-0.15,3.93-0.27,5.86 c-0.11,1.71-0.21,3.37-0.21,4.95c0,1.7-1.38,3.08-3.08,3.08c-1.7,0-3.08-1.38-3.08-3.08c0-1.58,0.12-3.42,0.24-5.33 c0.41-6.51,0.89-13.99-4.33-14.93H74.8c-0.23,0-0.45-0.02-0.66-0.07c0.04,2.36-0.12,4.81-0.27,7.16c-0.11,1.71-0.21,3.37-0.21,4.95 c0,1.7-1.38,3.08-3.08,3.08c-1.7,0-3.08-1.38-3.08-3.08c0-1.58,0.12-3.42,0.24-5.33c0.41-6.51,0.89-13.99-4.33-14.93h-4.05 c-0.28,0-0.55-0.04-0.8-0.11V49c0,1.7-1.38,3.08-3.08,3.08c-1.7,0-3.08-1.38-3.08-3.08V17.05c0-5.35-2.18-8.73-4.97-10.14 c-1.02-0.52-2.12-0.78-3.21-0.78c-1.08,0-2.18,0.26-3.19,0.77c-2.76,1.4-4.92,4.79-4.92,10.28v56c0,1.7-1.38,3.08-3.08,3.08 c-1.7,0-3.08-1.38-3.08-3.08V67.49L29.96,67.49z M58.57,31.15c0.26-0.07,0.53-0.11,0.8-0.11h4.24c0.24,0,0.47,0.03,0.69,0.08 c5.65,0.88,8.17,4.18,9.2,8.43c0.39-0.18,0.83-0.29,1.3-0.29h4.24c0.24,0,0.47,0.03,0.69,0.08c6.08,0.94,8.53,4.69,9.41,9.41 c0.15-0.02,0.31-0.04,0.47-0.04h4.24c0.24,0,0.47,0.03,0.69,0.08c11.64,1.8,11.5,13.37,11.38,22.71c0,0.33-0.01,0.68-0.01,2.35 l0,0.07l0.24,10.77c0.01,0.11,0.01,0.23,0,0.34c-0.45,9.16-4.07,15.12-8.24,21.98c-0.7,1.14-1.41,2.32-2.34,3.93 c-0.02,0.04-0.04,0.08-0.07,0.13c-2.18,3.8-4.7,6.71-7.57,8.69c-2.92,2.02-6.16,3.06-9.71,3.1c-0.09,0.01-0.19,0.01-0.28,0.01 H41.58v-0.01c-3.66,0.07-6.5-1.53-8.59-4.66c-1.68-2.51-2.79-6.03-3.4-10.47L6.73,75.07c-0.03-0.04-0.07-0.08-0.1-0.12 c-1.36-1.82-3.21-4.65-4.59-7.79C1,64.8,0.21,62.24,0.05,59.74c-0.2-2.97,0.22-5.36,1.06-7.23c1.05-2.32,2.72-3.83,4.74-4.66 c1.89-0.77,4.01-0.88,6.16-0.45c2.57,0.51,5.22,1.81,7.49,3.68c1.86,1.54,4.95,4.07,7.95,6.52l2.52,2.06V17.18 c0-8.14,3.63-13.39,8.28-15.76C40.12,0.47,42.17,0,44.23,0c2.05,0,4.1,0.48,5.98,1.43c4.69,2.37,8.36,7.62,8.36,15.62V31.15 L58.57,31.15z"/></g></svg>
        </label>
        <select name="role" id="Role-input">
          <option value="" disabled selected>Select your Role</option>
          <option value="Owner">Warehouse Owner</option>
          <option value="Renter">Warehouse Renter</option>
        </select>
      </div>
      <div>
        <label for="email-input">
          <span>@</span>
        </label>
        <input type="email" name="email" id="email-input" placeholder="Email" oninput="this.value = this.value.replace(/\s/g, '')">
      </div>
      <div>
        <label for="password-input">
          <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M240-80q-33 0-56.5-23.5T160-160v-400q0-33 23.5-56.5T240-640h40v-80q0-83 58.5-141.5T480-920q83 0 141.5 58.5T680-720v80h40q33 0 56.5 23.5T800-560v400q0 33-23.5 56.5T720-80H240Zm240-200q33 0 56.5-23.5T560-360q0-33-23.5-56.5T480-440q-33 0-56.5 23.5T400-360q0 33 23.5 56.5T480-280ZM360-640h240v-80q0-50-35-85t-85-35q-50 0-85 35t-35 85v80Z"/></svg>
        </label>
        <input type="password" name="password" id="password-input" placeholder="Password" oninput="this.value = this.value.replace(/\s/g, '')">
      </div>
      <div>
        <label for="repeat-password-input">
          <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M240-80q-33 0-56.5-23.5T160-160v-400q0-33 23.5-56.5T240-640h40v-80q0-83 58.5-141.5T480-920q83 0 141.5 58.5T680-720v80h40q33 0 56.5 23.5T800-560v400q0 33-23.5 56.5T720-80H240Zm240-200q33 0 56.5-23.5T560-360q0-33-23.5-56.5T480-440q-33 0-56.5 23.5T400-360q0 33 23.5 56.5T480-280ZM360-640h240v-80q0-50-35-85t-85-35q-50 0-85 35t-35 85v80Z"/></svg>
        </label>
        <input type="password" name="repeat-password" id="repeat-password-input" placeholder="Repeat Password" oninput="this.value = this.value.replace(/\s/g, '')">
      </div>
      <button type="submit" name="submit">Signup</button>
    </form>
    <p>Already have an Account? <a href="login.php">login</a> </p>
  </div>
</body>
</html>