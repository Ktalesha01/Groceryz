<?php
    session_start();

    require "../php/header.php";

    if (!isset($_SESSION["username"])) {
        echo "<script>location.href='login.php'</script>";
        exit();
    }

    include "../php/databaseConnect.php";
    $phone = $_SESSION["phone"];
    $email = $_SESSION["email"];
    $user_id = $_SESSION["user_id"];


    $sql = "SELECT * FROM user_data WHERE phone_no = '$phone' and email_id = '$email'";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        if (!empty($row["profile_pic"])) {
            $base64ProfilePic = "data:image/jpeg;base64," . $row["profile_pic"];
        } else {
            $base64ProfilePic = "../pictures/profile_pic.jpg";
        }
    }


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
        $listIds = implode(",", $recentListIds); 
    
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
    AND gl.list_id IN ($listIds)";

    $sharedResult1 = mysqli_query($conn, $sharedQuery1);
    $sharedLists1 = [];

    while ($row1 = mysqli_fetch_assoc($sharedResult1)) {
        $sharedLists1[] = $row1;
    }

    mysqli_close($conn);
?>


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
            <?php if (count($recentLists) === 0): ?>
                <p>No lists available.</p>
            <?php else: ?>
                <div class="listGrid">
                    <?php
                    $maxLists = min(10, count($recentLists)); 
                    for ($i = 0; $i < $maxLists; $i++):
                        $list = $recentLists[$i];
                        $list_id = $list['list_id'];
                        $list_name = htmlspecialchars($list['list_name']);
                    ?>
                        <a href="groceryList.php?recent_list_id=<?php echo $list_id; ?>" class="listItemLink">
                            <div class="listItem">
                                <?php echo $list_name; ?>
                            </div>
                        </a>

                    <?php endfor; ?>
                </div>
            <?php endif; ?>
        </section>

        <section class="shareingInfo">
            <h2>Shared Lists</h2>
            <?php if (count($sharedLists) === 0): ?>
                <p>No shared lists available.</p>
            <?php else: ?>
                <div class="slistGrid">
                    <?php
                    $maxsLists = min(10, count($sharedLists)); 
                    for ($i = 0; $i < $maxsLists; $i++):
                        $slist = $sharedLists[$i];
                        $slist_id = $slist['list_id'];
                        $slist_name = htmlspecialchars($slist['list_name']);
                        $spermission = htmlspecialchars($slist['permission']);
                    ?>
                        <a href="groceryList.php?shared_list_id=<?php echo $slist_id; ?>" class="slistItemLink">
                            <div class="slistItem">
                                <?php echo $slist_name; ?>
                                <small>(<?php echo $spermission; ?>)</small>
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
                    $maxSharedLists = min(10, count($sharedLists1));
                    for ($i = 0; $i < $maxSharedLists; $i++):
                        $sharedList = $sharedLists1[$i];
                        $sharedList_id = $sharedList['list_id'];
                        $sharedList_name = htmlspecialchars($sharedList['list_name']);
                        $sharedPermission = htmlspecialchars($sharedList['permission']);
                    ?>
                        <a href="groceryList.php?i_shared_list_id=<?php echo $sharedList_id; ?>" class="sharedListItemLink">
                            <div class="sharedListItem">
                                <?php echo $sharedList_name; ?>
                                <small>(<?php echo $sharedPermission; ?>)</small>
                            </div>
                        </a>

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

    <?php
        require "../php/footer.php";
    ?>
    
    <script src="js/dashboard.js"></script>
</body>
</html>