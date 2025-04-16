<?php
session_start();
include('databaseConnect.php'); // Database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $list_id = $_POST['list_id'];
    $new_name = trim($_POST['new_name']);
    $user_id = $_SESSION['user_id'];

    if (!empty($new_name)) {
        // Direct SQL query to update the list name
        $sql = "UPDATE grocery_lists SET list_name = '$new_name' WHERE list_id = '$list_id' AND user_id = '$user_id'";
        if (mysqli_query($conn, $sql)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    } else {
        echo json_encode(['success' => false]);
    }
}
?>
