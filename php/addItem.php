<?php
session_start(); // Ensure session is started

require "databaseConnect.php"; // Connect to DB

function hasEditPermission($conn, $user_id, $list_id) {
    // Check if user is owner
    $ownerCheck = mysqli_query($conn, "SELECT * FROM grocery_lists WHERE list_id='$list_id' AND user_id='$user_id'");
    if (mysqli_num_rows($ownerCheck) > 0) return true;

    // Check shared with edit permission
    $sharedCheck = mysqli_query($conn, "SELECT * FROM shared_lists WHERE list_id='$list_id' AND shared_with_user_id='$user_id' AND permission='edit'");
    return mysqli_num_rows($sharedCheck) > 0;
}

if (!hasEditPermission($conn, $_SESSION["user_id"], $_SESSION["list_id"])) {
    echo "You do not have permission to edit this list.";
    exit();
}


// Check if user is logged in and list is selected
if (!isset($_SESSION["username"]) || !isset($_SESSION["list_id"])) {
    echo "Session expired. Please log in again.";
    exit();
}

$user_id = $_SESSION["user_id"];
$list_id = $_SESSION["list_id"];

if (isset($_POST["addItemBtn"])) {
    $itemName = $_POST["name"];
    $itemType = $_POST["type"];
    $itemQty  = $_POST["qty"];

    // Basic SQL query (not safe against SQL injection)
    $insertQuery = "INSERT INTO list_items (user_id, list_id, item_name, item_type, item_qty)
                    VALUES ('$user_id', '$list_id', '$itemName', '$itemType', '$itemQty')";

    if (mysqli_query($conn, $insertQuery)) {
        echo "Item added successfully!";
    } else {
        echo "Error adding item: " . mysqli_error($conn);
    }
}
?>
