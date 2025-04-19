<?php
    session_start();

    require "../php/header.php";

    if(isset($_SESSION["username"])){
    }
    else{
        echo "<script>location.href='login.php'</script>";
    }

?>


    <main>
        <section>
            <div>
                <form id="filterForm" name="filterForm" method="GET" action="userDetails.php">
                    Sort:
                    <select name="sort" id="userSorting" onchange="this.form.submit()">
                        <option value="default" <?= ($_GET['sort'] ?? '') === 'default' ? 'selected' : '' ?>>Default</option>
                        <option value="idAsc" <?= ($_GET['sort'] ?? '') === 'idAsc' ? 'selected' : '' ?>>ID Ascending</option>
                        <option value="idDesc" <?= ($_GET['sort'] ?? '') === 'idDesc' ? 'selected' : '' ?>>ID Descending</option>
                        <option value="nameAsc" <?= ($_GET['sort'] ?? '') === 'nameAsc' ? 'selected' : '' ?>>Name Ascending</option>
                        <option value="nameDesc" <?= ($_GET['sort'] ?? '') === 'nameDesc' ? 'selected' : '' ?>>Name Descending</option>
                    </select>

                    <input type="search" name="search" id="userSearch" placeholder="Search user..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                    <button type="submit" id="searchBtn" name="searchBtn">Search</button>
                </form>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Phone No.</th>
                        <th>Email Id</th>
                        <th>Role</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
            <?php
                require "../php/databaseConnect.php";

                $search = $_GET['search'] ?? '';
                $sort = $_GET['sort'] ?? 'default';

                $fetchQuery = "SELECT * FROM user_data";

                if (!empty($search)) {
                    $searchSafe = mysqli_real_escape_string($conn, $search);
                    $fetchQuery .= " WHERE name LIKE '%$searchSafe%' OR email_id LIKE '%$searchSafe%' OR phone_no LIKE '%$searchSafe%'";
                }

                switch ($sort) {
                    case 'idAsc': $fetchQuery .= " ORDER BY id ASC"; break;
                    case 'idDesc': $fetchQuery .= " ORDER BY id DESC"; break;
                    case 'nameAsc': $fetchQuery .= " ORDER BY name ASC"; break;
                    case 'nameDesc': $fetchQuery .= " ORDER BY name DESC"; break;
                }

                $fetchResult = mysqli_query($conn, $fetchQuery);

                if (mysqli_num_rows($fetchResult) > 0) {
                    while ($fetchData = mysqli_fetch_assoc($fetchResult)) {
                        $userId = htmlspecialchars($fetchData["id"]);
                        echo "<tr>
                                <td>{$userId}</td>
                                <td>" . htmlspecialchars($fetchData["name"]) . "</td>
                                <td>" . htmlspecialchars($fetchData["phone_no"]) . "</td>
                                <td>" . htmlspecialchars($fetchData["email_id"]) . "</td>
                                <td>" . htmlspecialchars($fetchData["role"]) . "</td>
                                <td>
                                    <a href='editUser.php?id={$userId}'>
                                        <button style='background-color: #007BFF; color: white;'>Edit</button>
                                    </a>
                                    <form method='POST' action='deleteUser.php' style='display:inline;' onsubmit=\"return confirm('Are you sure you want to DELETE this user?')\">
                                        <input type='hidden' name='id' value='{$userId}'>
                                        <button type='submit' style='background-color: red; color: white;'>Delete</button>
                                    </form>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No users found.</td></tr>";
                }
            ?>
            </tbody>

            </table>
        </section>

    <?php
        require "../php/footer.php";
    ?>
</body>
</html>