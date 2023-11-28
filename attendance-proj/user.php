<?php
include("connect.php");

if (isset($_POST["submit"])) {
    $name = $_POST["username"];
    $email = $_POST["email"];
    $department = $_POST["department"];
    $password = $_POST["password"];

    if (empty($name) || empty($email) || empty($department) || empty($password)) {
        echo "Please fill in all the fields.";
    } else {
        $sql = "INSERT INTO `registration` (username, email, department, password) VALUES ('$name', '$email', '$department', '$password') ";

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
    <title>Add User</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="assets/add.png">

</head>

<body>
    <div class="add-user-container">
        <form method="post">
            <h2>Add User</h2>
            <div>
                <label for="name"><i class="fa-solid fa-user"></i> Name</label>
                <input type="text" name="username" autocomplete="off">
            </div>
            <div>
                <label><i class="fa-solid fa-envelope"></i> Email address</label>
                <input type="email" name="email" autocomplete="off">
            </div>
            <div>
                <label><i class="fa-solid fa-shield"></i> Department</label>
                <input type="text" name="department" autocomplete="off">
            </div>
            <div>
                <label><i class="fa-solid fa-key"></i> Password</label>
                <input type="password" name="password" autocomplete="off">
            </div>

            <button type="submit" name="submit">Submit</button>
        </form>
    </div>
    <script src="https://kit.fontawesome.com/58d91d1e4e.js" crossorigin="anonymous"></script>
</body>

</html>