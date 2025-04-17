<?php
require "databaseConnect.php";

if (isset($_POST['item_id']) && isset($_POST['is_done'])) {
    $item_id = $_POST['item_id'];
    $is_done = $_POST['is_done'];

    $query = "UPDATE list_items SET is_done = '$is_done' WHERE item_id = '$item_id'";
    if (mysqli_query($conn, $query)) {
        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "invalid";
}
?>
