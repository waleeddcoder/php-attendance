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
    <title>Admin panel</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="assets/admin.png">
</head>


<body>
    <nav>
        <div class="logo"><a href="#">Coden</a></div>

        <div class="buttons">
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

    <div class="user-panel">
        <a href="user.php">
            <button class="add-user">Add User</button>
        </a>
        <h2>Registered Users</h2>
        <table>
            <thead>
                <tr>
                    <th scope="col">Sr</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Department</th>
                    <th scope="col">Operations</th>
                </tr>
            </thead>

            <tbody>

                <?php
                $sql = "SELECT * FROM `registration`";

                try {
                    $result = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row["id"];
                        $name = $row["username"];
                        $email = $row["email"];
                        $department = $row["department"];

                        echo '<tr>
                <th scope="row">' . $id . '</th>
                <td>' . $name . '</td>
                <td>' . $email . '</td>
                <td>' . $department . '</td>
                <td>
                <a href="update.php? editid=' . $id . '"><button class="edit-btn" >Edit</button></a>
                <a href="delete.php? deleteid=' . $id . '"><button class="delete-btn">Delete</button></a>
            </td>
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
</body>

</html>