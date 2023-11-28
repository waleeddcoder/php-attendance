<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'connect.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM registration WHERE username = '$username' && password = '$password'";
    $result = mysqli_query($conn, $sql);


    if (empty($_POST["username"]) || empty($_POST['password'])) {
        $loginError = "Username/password is mandatory";
    } else {

        if ($result) {
            $num = mysqli_num_rows($result);
            if ($num > 0) {
                session_start();
                $_SESSION["username"] = $username;
                header("location:index.php");
            } else {
                $loginError = "Invalid username/password";
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
    <title>Log In</title>
    <link rel="icon" href="assets/login.png">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav>
        <div class="logo"><a href="#">Coden</a></div>

        <div class="buttons">
            <a href="signup.php"> <button class="login-btn-in-signup">Sign-Up</button></a>
        </div>

    </nav>
    <div class="signup-container">
        <?php if (isset($loginError)) : ?>
            <div class="error-message" style="background-color: #57606f;padding:5px; border-radius:10px;box-shadow:0 0 5px red;">
                <?php echo $loginError; ?>
            </div>
        <?php endif; ?>
        <form action="login.php" method="post">

            <h1><i class="fa-solid fa-right-to-bracket"></i> Log In</h1>

            <div class="username">
                <label><i class="fa-solid fa-user"></i> User-name</label>
                <input type="text" name="username" placeholder="Enter a valid username">
            </div>

            <div class="password">
                <label><i class="fa-solid fa-key"></i> Password</label>
                <input type="password" name="password" placeholder="Enter your password">
            </div>

            <button type="submit" class="signup-btn" name="signup">Log In</button>
        </form>
    </div>
    <script src="https://kit.fontawesome.com/58d91d1e4e.js" crossorigin="anonymous"></script>
</body>

</html>