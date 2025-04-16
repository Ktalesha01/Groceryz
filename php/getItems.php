<?php
session_start();
require 'databaseConnect.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode([]);
    exit;
}

$list_id = $_GET['list_id'];
$sql = "SELECT * FROM list_items WHERE list_id = '$list_id'";
$result = mysqli_query($conn, $sql);

$items = [];
while ($row = mysqli_fetch_assoc($result)) {
    $items[] = $row;
}

echo json_encode($items);
?>
