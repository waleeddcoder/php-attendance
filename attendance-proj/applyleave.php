<?php

try {
    if (isset($_POST["submit"])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        $subject = $_POST['subject'];

        $mailHeader = "From: $name <$email> \r\n";
        $recipient = "shahzebwaleed505@gmail.com";

        if (mail($recipient, $subject, $message, $mailHeader)) {
            echo ' 
            <div class="signup-container">
                <h2>Message Sent!
                we will get back to you <br> with our response
                </h2>       
                <a href="index.php"><button>Back to Homepage</button></a>         
            </div>';
            header('location:index.php');
        } else {
            throw new Exception("Error sending email.");
        }
    }
} catch (Exception $e) {
    echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
}

?>




<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Apply leave</title>
    <link rel="icon" href="assets/login.png">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav>
        <div class="logo"><a href="index.php">Coden</a></div>

        <div class="buttons">
            <a href="history.php"> <button>History</button></a>
            <a href="applyleave.php"><button>Apply Leave</button></a>
            <a href="logout.php"> <button>Log Out</button></a>
        </div>
        <div class="user">
            <div class="name">
                <p class="username"><?php echo $_SESSION['username']; ?></p>
                <p>status: <span>00</span> </p>
            </div>
            <div class="dp">
                <img src="assets/angrydp.jpg" alt="dp">
            </div>
        </div>
    </nav>
    <div class="signup-container">
        <?php if (isset($loginError)) : ?>
            <div class="error-message" style="background-color: #57606f;padding:5px; border-radius:10px;box-shadow:0 0 5px red;">
                <?php echo $loginError; ?>
            </div>
        <?php endif; ?>
        <form method="post">

            <h1><i class="fa-solid fa-right-to-bracket"></i> Apply leave</h1>

            <div class="username">
                <label><i class="fa-solid fa-user"></i> Name</label>
                <input type="text" name="name" placeholder="Enter Your Name">
            </div>

            <div class="email">
                <label><i class="fa-solid fa-key"></i> Email</label>
                <input type="email" name="email" placeholder="Enter your Email">
            </div>
            <div class="subject">
                <label><i class="fa-solid fa-magnifying-glass"></i> Subject</label>
                <input type="text" name="subject" placeholder="Enter your subject">
            </div>
            <div class="request-msg">
                <label><i class="fa-solid fa-paper-plane"></i> Message</label>
                <textarea type="text" rows="6" name="message" placeholder="Enter your leave request"></textarea>
            </div>


            <a href="index.php"><button type="submit" class="signup-btn" name="submit">Send Message</button></a>
        </form>
    </div>
    <script src="https://kit.fontawesome.com/58d91d1e4e.js" crossorigin="anonymous"></script>
</body>

</html>