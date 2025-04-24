<?php
session_start();
require "databaseConnect.php";

if (!isset($_SESSION["user_id"]) || !isset($_POST["email"]) || !isset($_POST["list_id"])) {
    echo "Invalid request.";
    exit();
}

$owner_id = $_SESSION["user_id"];
$shared_email = $_POST["email"];
$list_id = $_POST["list_id"];
$permission = isset($_POST["permission"]) && $_POST["permission"] === "edit" ? "edit" : "view";

$getUserQuery = "SELECT id FROM user_data WHERE email_id = '$shared_email' LIMIT 1";
$userRes = mysqli_query($conn, $getUserQuery);

if ($userRes && mysqli_num_rows($userRes) > 0) {
    $row = mysqli_fetch_assoc($userRes);
    $sharedUserId = $row["id"];

    $checkQuery = "SELECT * FROM shared_lists WHERE list_id = '$list_id' AND shared_with_user_id = '$sharedUserId'";
    $checkRes = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkRes) > 0) {
        echo "List already shared with this user.";
    } else {
        $insert = "INSERT INTO shared_lists (list_id, shared_with_user_id, permission, shared_by_user_id) 
                   VALUES ('$list_id', '$sharedUserId', '$permission', '$owner_id')";
        if (mysqli_query($conn, $insert)) {
            echo "List shared successfully with $shared_email with $permission permission.";
        } else {
            echo "Error sharing list.";
        }
    }
} else {
    echo "No user found with this email.";
}
?>
