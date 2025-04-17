<?php
require "databaseConnect.php";
session_start();

function hasEditPermission($conn, $user_id, $list_id) {
    // Check if user is owner
    $ownerCheck = mysqli_query($conn, "SELECT * FROM grocery_lists WHERE list_id='$list_id' AND user_id='$user_id'");
    if (mysqli_num_rows($ownerCheck) > 0) return true;

    // Check shared with edit permission
    $sharedCheck = mysqli_query($conn, "SELECT * FROM shared_lists WHERE list_id='$list_id' AND shared_with_user_id='$user_id' AND permission='edit'");
    return mysqli_num_rows($sharedCheck) > 0;
}

if (!hasEditPermission($conn, $_SESSION["user_id"], $_POST["list_id"])) {
    echo "You do not have permission to edit this list.";
    exit();
}


if (isset($_POST['item_id'])) {
    $item_id = $_POST['item_id'];
    $deleteQuery = "DELETE FROM list_items WHERE item_id = '$item_id'";
    echo mysqli_query($conn, $deleteQuery) ? "success" : "error";
}
?>
