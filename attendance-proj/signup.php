<?php
include('connect.php');
if (isset($_POST['signup'])) {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $password = $_POST['password'];


    $sql = "SELECT * FROM registration WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);


    if (empty($username)  || empty($email) || empty($department) || empty($password)) {
        $message = "All fields are mandatory";
    } else {
        if ($result) {
            $num = mysqli_num_rows($result);
            if ($num > 0) {
                $message = "User already exists";
            } else {
                $sql = "INSERT INTO `registration` (username, email, department, password) VALUES ('$username', '$email', '$department', '$password')";

                $result = mysqli_query($conn, $sql);
                if ($result) {
                    header('location:login.php');
                } else {
                    $message = "Error: " . mysqli_error($conn);
                }
            }
        }
    }
}
?>



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sign Up!</title>
    <link rel="icon" href="assets/signup.png">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav>
        <div class="logo"><a href="#">Coden</a></div>

        <div class="buttons">
            <a href="login.php"> <button class="login-btn-in-signup">Log In</button></a>
        </div>

    </nav>
    <div class="signup-container">
        <?php if (isset($message)) : ?>
            <div class="message" style="background-color: #57606f;padding:5px; border-radius:10px;box-shadow:0 0 5px red;">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        <form method="post" action="signup.php">

            <h1><i class="fa-solid fa-user-plus"></i> Sign Up</h1>
            <div class="username">
                <label><i class="fa-solid fa-user"></i> User-name</label>
                <input type="text" name="username" placeholder="Enter Username">
            </div>
            <div class="email">
                <label><i class="fa-solid fa-envelope"></i> E-mail</label>
                <input type="email" name="email" placeholder="Enter a valid Email id">
            </div>
            <div class="department">
                <label><i class="fa-solid fa-shield"></i> Department</label>
                <input type="text" name="department" placeholder="Your Area of expertise">
            </div>

            <div class="password">
                <label><i class="fa-solid fa-key"></i> Password</label>
                <input type="password" name="password" placeholder="Enter your password">
            </div>

            <button type="submit" class="signup-btn" name="signup">Sign Up</button>
        </form>
    </div>
    <script src="https://kit.fontawesome.com/58d91d1e4e.js" crossorigin="anonymous"></script>
</body>

</html>