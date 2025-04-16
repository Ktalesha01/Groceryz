<?php
    session_start();

    if(isset($_SESSION["username"])){
    }
    else{
        echo "<script>location.href='../index.php'</script>";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details | Groceryz</title>
    <link rel="icon" type="image/x-icon" href="../pictures/app_logo.png" sizes="64X64">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/userDetails.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header>
        <figure>
            <img src="../pictures/logo_with_name-removebg-preview.png" alt="Site Logo" height="100px">
        </figure>
        <nav>
            <ul style="list-style-type: none;">
                <a href="adminHomePage.php"><li id="home">Home</li></a>
                <a href="#" class="activeTab"><li id="users">Users</li></a>
                <a href="aboutUs.php"><li id="aboutUs">About Us</li></a>
                <a href="contactUs.php"><li id="contact">Contact</li></a>
                <a href="dashboard.php"><li id="profile"><i class="fa-solid fa-circle-user fa-2xl"></i></li></a>
            </ul>
        </nav>
    </header>


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
    </main>


    <footer>
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
</body>
</html>