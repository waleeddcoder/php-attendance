<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("location:login.php");
    exit();
}

include 'connect.php';
$name = $_SESSION["username"];

$currentDate = date("Y-m-d");
$currentTime = date("H:i:s");

$disableAttendButton = false;
$disableLeaveButton = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['mark-attend'])) {
        // Mark attendance logic
        $sql = "SELECT * FROM attendance WHERE name='$name' AND date='$currentDate'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $indexMsg = "Attendance marked already";
            $disableAttendButton = true;
        } else {
            $sql = "INSERT INTO `attendance` (`name`, `date`, `timein`, `timeout`) VALUES ('$name', '$currentDate', '$currentTime', NULL)";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $indexMsg = "Success! Attendance marked for today";
                $disableAttendButton = true;
            } else {
                $indexMsg = "Error: " . mysqli_error($conn);
            }
        }
    }

    if (isset($_POST['mark-leave'])) {
        // Mark leave logic
        $sqlCheckLeave = "SELECT *, COALESCE(timeout, '') AS timeout FROM attendance WHERE name='$name' AND date='$currentDate'";
        $resultCheckLeave = mysqli_query($conn, $sqlCheckLeave);

        if (mysqli_num_rows($resultCheckLeave) > 0) {
            $row = mysqli_fetch_assoc($resultCheckLeave);

            if ($row['timeout'] === '') {
                $sqlUpdateLeave = "UPDATE `attendance` SET `timeout`='$currentTime' WHERE name='$name' AND date='$currentDate'";
                $resultUpdateLeave = mysqli_query($conn, $sqlUpdateLeave);

                if ($resultUpdateLeave) {
                    $indexMsg = "Success! Leave marked for today.";
                    $disableLeaveButton = true;
                } else {
                    $indexMsg = "Error updating leave: " . mysqli_error($conn);
                }
            } else {
                $indexMsg = "Leave already marked for today.";
                $disableLeaveButton = true;
            }
        } else {
            $indexMsg = "Attendance not marked.";
            $disableLeaveButton = true;
        }
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Attendance</title>
    <link rel="icon" href="assets/home.png">
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


    <form action="index.php" method="post">
        <div class="user-panel">
            <?php if (isset($indexMsg)) : ?>

                <div class="indexMsg" style="background-color: #57606f;padding:5px; border-radius:10px;box-shadow:0 0 10px green;">
                    <?php echo $indexMsg; ?>
                </div>

            <?php endif; ?>

            <div class="buttons">
                <button class="attend-btn" type="submit" name="mark-attend" <?php echo $disableAttendButton ? 'disabled' : ''; ?>>
                    <i class="fa-solid fa-right-to-bracket"></i> Mark Attendance
                </button>


                <button class="leave-btn" type="submit" name="mark-leave" <?php echo $disableLeaveButton ? 'disabled' : ''; ?>>
                    Mark Leave <i class="fa-solid fa-right-to-bracket"></i>
                </button>
            </div>
        </div>
    </form>


    <script src="https://kit.fontawesome.com/58d91d1e4e.js" crossorigin="anonymous"></script>

</body>

</html>