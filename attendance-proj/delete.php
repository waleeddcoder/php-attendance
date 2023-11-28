<?php
include("connect.php");

if (isset($_GET["deleteid"])) {
    $id = $_GET["deleteid"];
    $sql  = "DELETE FROM `registration` WHERE id  = '$id'";

    try {
        $result = mysqli_query($conn, $sql);
        header('location:admin.php');
    } catch (mysqli_sql_exception $e) {
        echo "Data deletion failed. Error: " . $e->getMessage();
    }
}
