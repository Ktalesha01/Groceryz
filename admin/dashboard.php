<?php
    session_start();

    if (!isset($_SESSION["username"])) {
        echo "<script>location.href='../index.php'</script>";
        exit();
    }

    include "../php/databaseConnect.php";
    $phone = $_SESSION["phone"];
    $email = $_SESSION["email"];
    $user_id = $_SESSION["user_id"]; // Make sure this is set during login


    $sql = "SELECT * FROM user_data WHERE phone_no = '$phone' and email_id = '$email'";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        if (!empty($row["profile_pic"])) {
            $base64ProfilePic = "data:image/jpeg;base64," . $row["profile_pic"];
        } else {
            $base64ProfilePic = "../pictures/profile_pic.jpg";
        }
    }


    // Fetch recent 5 lists created by user
    $recentLists = [];
    $recentQuery = "SELECT * FROM grocery_lists WHERE user_id = '$user_id' ORDER BY created_at DESC LIMIT 10";
    $recentResult = mysqli_query($conn, $recentQuery);

    while ($row = mysqli_fetch_assoc($recentResult)) {
        $recentLists[] = $row;
    }

    $sharedLists = [];

    $recentListsQuery = "SELECT list_id 
        FROM grocery_lists 
        ORDER BY created_at DESC
        LIMIT 10
    ";
    
    $recentListsResult = mysqli_query($conn, $recentListsQuery);
    
    $recentListIds = [];
    while ($row = mysqli_fetch_assoc($recentListsResult)) {
        $recentListIds[] = $row['list_id'];
    }
    
    if (count($recentListIds) > 0) {
        $listIds = implode(",", $recentListIds); // Prepare the list IDs for the query
    
        $sharedQuery = "SELECT gl.list_name, gl.list_id, sl.permission 
            FROM shared_lists sl
            JOIN grocery_lists gl ON sl.list_id = gl.list_id
            WHERE sl.shared_with_user_id = '$user_id'
            AND gl.list_id IN ($listIds)
        ";
    
        $sharedResult = mysqli_query($conn, $sharedQuery);
    
        while ($row = mysqli_fetch_assoc($sharedResult)) {
            $sharedLists[] = $row;
        }
    }

    $sharedQuery1 = "SELECT gl.list_name, gl.list_id, sl.permission
    FROM shared_lists sl
    JOIN grocery_lists gl ON sl.list_id = gl.list_id
    WHERE sl.shared_by_user_id = '$user_id'
    AND gl.list_id IN ($listIds)
";

$sharedResult1 = mysqli_query($conn, $sharedQuery1);
$sharedLists1 = [];

while ($row1 = mysqli_fetch_assoc($sharedResult1)) {
    $sharedLists1[] = $row1;
}

        mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Groceryz</title>
    <link rel="icon" type="image/x-icon" href="../pictures/app_logo.png" sizes="64X64">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header class="header">
        <figure>
            <img src="../pictures/logo_with_name-removebg-preview.png" alt="Site Logo" height="100px">
        </figure>
        <nav>
            <ul style="list-style-type: none; color: white; text-decoration:none;">
                <a href="adminHomePage.php"><li id="home">Home</li></a>
                <a href="userDetails.php"><li id="users">Users</li></a>
                <a href="aboutUs.php"><li id="aboutUs">About Us</li></a>
                <a href="contactUs.php"><li id="contact">Contact</li></a>
                <a href="#" class="activeTab"><li id="profile"><i class="fa-solid fa-circle-user fa-2xl"></i></li></a>
            </ul>
        </nav>
    </header>


    <main>
        <section class="userInfoSection">
            <div class="profilePic">
                <img src="<?php echo $base64ProfilePic; ?>" alt="Profile Picture" width="100%">
            </div>
            <div class="userInfo">
                <p id="userName"><?php echo $_SESSION["username"] ?></p>
                <p id="userPhone"><?php echo $_SESSION["phone"] ?></p>
                <p id="userEmail"><?php echo $_SESSION["email"] ?></p>
                <p id="userRole"><?php echo $_SESSION["role"] ?></p>
            </div>
        </section>

        <section class="settings">
            <h2>Settings</h2>
            <div class="changeDetails">Change Personal Details</div>
            <div class="changePassword">Change Password</div>
        </section>

        <section class="recentLists">
            <h2>Recent Lists</h2>
            <div class="listGrid">
                <?php
                // Loop through the recent lists array and display each list in grid style
                for ($i = 0; $i < 10; $i++) {
                    if (!isset($recentLists[$i])) {
                        break;  // Stop the loop if there are no more lists
                    }
                    
                    echo "<div class='listItem'>";
                    echo htmlspecialchars($recentLists[$i]['list_name']);
                    echo "</div>";
                }                ?>
            </div>
        </section>

        <section class="shareingInfo">
    <h2>Shared Lists</h2>
    <?php if (count($sharedLists) === 0): ?>
        <p>No shared lists available from recent 10.</p>
    <?php else: ?>
        <div class="slistGrid">
            <?php
            $maxLists = min(10, count($sharedLists)); // Display max 10 lists
            for ($i = 0; $i < $maxLists; $i++):
                $list = $sharedLists[$i];
                $list_id = $list['list_id'];
                $list_name = htmlspecialchars($list['list_name']);
                $permission = htmlspecialchars($list['permission']);
            ?>
                <a href="groceryList.php?list_id=<?php echo $list_id; ?>" class="listItemLink">
                    <div class="slistItem">
                        <?php echo $list_name; ?>
                        <small>(<?php echo $permission; ?>)</small>
                    </div>
                </a>
            <?php endfor; ?>
        </div>
    <?php endif; ?>
</section>

        <section class="sharedListsSection">
            <h2>Lists You've Shared</h2>
            <?php if (count($sharedLists1) > 0): ?>
                <div class="sharedListGrid">
                    <?php
                    $maxShared = min(10, count($sharedLists1));
                    for ($i = 0; $i < $maxShared; $i++):
                        $list1 = $sharedLists1[$i];
                    ?>
                        <div class="sharedListItem">
                            <?php echo htmlspecialchars($list1['list_name']); ?>
                            <small>(Permission: <?php echo ucfirst($list1['permission']); ?>)</small>
                        </div>
                    <?php endfor; ?>
                </div>
            <?php else: ?>
                <p>You have not shared any lists yet.</p>
            <?php endif; ?>
        </section>

        <section class="logout">
            <span id="logout">
                <i class="fa-solid fa-right-from-bracket fa-xl"></i>
                <p>Logout</p>
            </span>
        </section>

    </main>


    <footer class="footer">
        <section class="socialMedia">
            <div>
                <a href="https://github.com/Ktalesha01">
                <i class="fa-brands fa-github fa-2xl"></i>
                <p>GitHub</p>
                </a>
            </div>
            <div>
                <a href="mailto:kalpeshtalesha01official@gmail.com">
                <i class="fa-regular fa-envelope fa-2xl"></i>
                <p>Mail</p>
                </a>
            </div>
            <div>
                <a href="https://www.linkedin.com/in/kalpesh-talesha-881b75311/">
                <i class="fa-brands fa-linkedin fa-2xl"></i>
                <p>Linked In</p>
                </a>
            </div>
            <div>
                <a href="https://www.instagram.com/ktalesha01.official/?next=%2F&hl=en">
                <i class="fa-brands fa-instagram fa-2xl"></i>
                <p>Instagram</p>
                </a>
            </div>
            <div>
                <a href="https://wa.me/+917208495230">
                <i class="fa-brands fa-whatsapp fa-2xl"></i>  
                <p>Whatsapp</p>
                </a>
            </div>
        </section>
        <nav>
            <ul style="list-style-type: none;">
                <a href="#"><li>Home</li></a>
                <a href="userDetails.php"><li>Users</li></a>
                <a href="aboutUs.php"><li>About Us</li></a>
                <a href="contactUs.php"><li>Contact Us</li></a>
            </ul>
        </nav>
        <p>
            Copyright &copy;2025 Groceryz <br>
            All Rights Reserved <br>
            Designed by- Kalpesh Talesha
        </p>
    </footer>
    <script src="js/dashboard.js"></script>
</body>
</html>