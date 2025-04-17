<?php
session_start();
require "databaseConnect.php";

if (isset($_POST['new_name']) && isset($_SESSION['list_id'])) {
    $list_id = $_SESSION['list_id'];
    $new_name = mysqli_real_escape_string($conn, $_POST['new_name']);

    $query = "UPDATE grocery_lists SET list_name = '$new_name' WHERE list_id = '$list_id'";

    if (mysqli_query($conn, $query)) {
        $_SESSION['list_name'] = $new_name;
        echo "success";
    } else {
        echo "error";
    }
}
?>
