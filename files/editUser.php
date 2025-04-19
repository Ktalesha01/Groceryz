<?php
session_start();

if (!isset($_SESSION["username"])) {
    echo "<script>location.href='login.php'</script>";
    exit();
}

require "../php/databaseConnect.php";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<script>alert('Invalid user ID.'); location.href='userDetails.php';</script>";
    exit();
}

$userId = intval($_GET['id']);
$updateSuccess = null;

// Fetch existing user data
$query = "SELECT * FROM user_data WHERE id = $userId";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    echo "<script>alert('User not found.'); location.href='userDetails.php';</script>";
    exit();
}

$error = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $phone = mysqli_real_escape_string($conn, $_POST["phone_no"]);
    $email = mysqli_real_escape_string($conn, $_POST["email_id"]);
    $role = mysqli_real_escape_string($conn, $_POST["role"]);

    // Check for duplicate phone or email (excluding current user)
    $checkQuery = "SELECT * FROM user_data WHERE (phone_no = '$phone' OR email_id = '$email') AND id != $userId";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        $conflictUser = mysqli_fetch_assoc($checkResult);
        if ($conflictUser['email_id'] === $email) {
            $error = "Email already in use.";
        } elseif ($conflictUser['phone_no'] === $phone) {
            $error = "Phone number already in use.";
        }
    } else {
        $updateQuery = "UPDATE user_data SET 
                            name = '$name',
                            phone_no = '$phone',
                            email_id = '$email',
                            role = '$role'
                        WHERE id = $userId";

        if (mysqli_query($conn, $updateQuery)) {
            $updateSuccess = true;
            $user['name'] = $name;
            $user['phone_no'] = $phone;
            $user['email_id'] = $email;
            $user['role'] = $role;
        } else {
            $updateSuccess = false;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User | Groceryz</title>
    <link rel="icon" type="image/x-icon" href="../pictures/app_logo.png" sizes="64X64">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/editUser.css">
</head>
<body>
    <section class="editDetailsSection">
        <div>
            <a href="userDetails.php"><button id="closeBtn" type="button"><i class="fa-solid fa-xl fa-xmark"></i></button></a>
        </div>
        <div id="formName">
            <h2>Edit User Details</h2>
        </div>

        <form id="editDetailsForm" method="POST">
            <div class="maindiv">
            <?php if ($error): ?>
                <p style="color:red; text-align:center;"><?= $error ?></p>
            <?php endif; ?>
            <div>
                <label>Name:</label>
                <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>
            </div>
            <div>
                <label>Phone No:</label>
                <input type="text" name="phone_no" value="<?= htmlspecialchars($user['phone_no']) ?>" required pattern="[0-9]{10}" title="Enter 10 digit number">
            </div>
            <div>
                <label>Email ID:</label>
                <input type="email" name="email_id" value="<?= htmlspecialchars($user['email_id']) ?>" required>
            </div>
            <div>
                <label>Role:</label><br>
                <select name="role" required>
                    <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
                    <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                </select>
            </div>
            <div class="formBtns">
                <button id="resetBtn" type="reset">Reset</button>
                <button type="submit" id="editDetailsBtn" name="editDetailsBtn">Edit User</button>
            </div>
        </form>
    </section>

    <?php if ($updateSuccess === true): ?>
        <script>alert('User updated successfully!');
            window.location="userDetails.php";
        </script>
    <?php elseif ($updateSuccess === false): ?>
        <script>alert('Failed to update user. Try again.');</script>
    <?php endif; ?>
</body>
</html>
