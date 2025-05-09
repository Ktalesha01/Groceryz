<?php
require "databaseConnect.php";
session_start();

function hasEditPermission($conn, $user_id, $list_id) {
    $ownerCheck = mysqli_query($conn, "SELECT * FROM grocery_lists WHERE list_id='$list_id' AND user_id='$user_id'");
    if (mysqli_num_rows($ownerCheck) > 0) return true;

    $sharedCheck = mysqli_query($conn, "SELECT * FROM shared_lists WHERE list_id='$list_id' AND shared_with_user_id='$user_id' AND permission='edit'");
    return mysqli_num_rows($sharedCheck) > 0;
}

if (!hasEditPermission($conn, $_SESSION["user_id"], $_SESSION["list_id"])) {
    echo "You do not have permission to edit this list.";
    exit();
}


if (isset($_POST['item_id']) && isset($_POST['item_name']) && isset($_POST['item_qty'])) {
    $item_id = $_POST['item_id'];
    $item_name = $_POST['item_name'];
    $item_qty = $_POST['item_qty'];

    $updateQuery = "UPDATE list_items SET item_name = '$item_name', item_qty = '$item_qty' WHERE item_id = '$item_id'";
    echo mysqli_query($conn, $updateQuery) ? "success" : "error";
}
?>
