<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("location:login.php");
    exit();
}
include 'connect.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="assets/history.png">

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
    </nav>v
    <div class="user-panel">

        <h2>Attendance History</h2>
        <table>
            <thead>
                <tr>
                    <th scope="col">Sr</th>
                    <th scope="col">Name</th>
                    <th scope="col">Time In</th>
                    <th scope="col">Time Out</th>
                    <th scope="col">Work Hrs</th>
                </tr>
            </thead>

            <tbody>

                <?php
                $username = $_SESSION['username'];
                $sql = "SELECT * FROM `attendance` WHERE name='$username'";

                try {
                    $result = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row["id"];
                        $name = $row["name"];
                        $timein = $row["timein"];
                        $timeout = $row["timeout"];
                        $hoursworked = round((strtotime($timeout) - strtotime($timein)) / 3600, 2);
                        echo '<tr>
                <th scope="row">' . $id . '</th>
                <td>' . $name . '</td>
                <td>' . $timein . '</td>
                <td>' . $timeout . '</td>
                <td>' . $hoursworked . '</td>
                
              </tr>';
                    }
                } catch (mysqli_sql_exception $e) {
                    echo "Data fetching failed. Error: " . $e->getMessage();
                }
                ?>

            </tbody>
        </table>
    </div>
    <script src="https://kit.fontawesome.com/58d91d1e4e.js" crossorigin="anonymous"></script>

    <script src="script.js"></script>

</body>

</html>