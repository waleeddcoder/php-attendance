<?php
include("connect.php");
$id = $_GET['editid'];
$sql = "SELECT * FROM `registration` WHERE id=$id";

try {
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);
    $name = $row["username"];
    $email = $row["email"];
    $department = $row["department"];
    $password = $row["password"];
} catch (mysqli_sql_exception $e) {
    echo "Data fetching failed. Error: " . $e->getMessage();
}

if (isset($_POST["submit"])) {
    $name = $_POST["username"];
    $email = $_POST["email"];
    $department = $_POST["department"];
    $password = $_POST["password"];

    if (empty($name) || empty($email) || empty($department) || empty($password)) {
        echo "Please fill in all the fields.";
    } else {
        $sql = "UPDATE `registration` SET username = '$name', email = '$email', department = '$department', password = '$password' WHERE id = $id";

        try {
            $result = mysqli_query($conn, $sql);

            if ($result) {
                header('location:admin.php');
            } else {
                echo "Data inserting failed.";
            }
        } catch (mysqli_sql_exception $e) {
            echo "Data inserting failed. Error: " . $e->getMessage();
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="assets/edit.png">

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
    <div class="add-user-container">
        <form method="post">
            <h2>Edit User</h2>
            <div>
                <label for="name"><i class="fa-solid fa-user"></i> Name</label>
                <input type="text" name="username" id="name" autocomplete="off" value="<?php echo $name; ?>">
            </div>
            <div>
                <label><i class="fa-solid fa-envelope"></i> Email address</label>
                <input type="email" name="email" autocomplete="off" value="<?php echo $email; ?>">
            </div>
            <div>
                <label><i class="fa-solid fa-shield"></i> Department</label>
                <input type="text" name="department" autocomplete="off" value="<?php echo $department; ?>">
            </div>
            <div>
                <label><i class="fa-solid fa-key"></i> Password</label>
                <input type="password" name="password" autocomplete="off" value="<?php echo $password; ?>">
            </div>

            <button type="submit" name="submit">Update</button>
        </form>
    </div>
    <script src="https://kit.fontawesome.com/58d91d1e4e.js" crossorigin="anonymous"></script>
</body>

</html>