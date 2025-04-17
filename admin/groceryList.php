<?php
session_start();

if (!isset($_SESSION["username"])) {
    echo "<script>location.href='../index.php'</script>";
    exit();
}

$errorMessage = "";
$user_id = $_SESSION["user_id"];
require "../php/databaseConnect.php";

$list_id = isset($_SESSION['list_id']) ? $_SESSION['list_id'] : null;

if (isset($_POST['selected_list_id'])) {
    $selectedListId = $_POST['selected_list_id'];
    $_SESSION['list_id'] = $selectedListId;

    $getListName = "SELECT list_name FROM grocery_lists WHERE list_id = '$selectedListId' LIMIT 1";
    $res = mysqli_query($conn, $getListName);
    if ($res && mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        $_SESSION['list_name'] = $row['list_name'];
    }

    $list_id = $selectedListId; 
}
    

    if(isset($_POST["addItemBtn"])){
        if(!isset($_SESSION["list_id"])){
            echo "<script>alert('Select a List.');</script>";
        }
        else{
            $list_id = $_SESSION["list_id"];
            $itemName = $_POST["name"];
            $itemType = $_POST["type"];
            $itemQty = $_POST["qty"];
            $insertQuery = "INSERT INTO list_items (user_id, list_id, item_name, item_type, item_qty)
                            VALUES('$user_id','$list_id','$itemName','$itemType','$itemQty')";
    
            if (mysqli_query($conn, $insertQuery)) {
                header("Location: ".$_SERVER['PHP_SELF']);
                exit();
            } else {
                echo "<script>alert('Error Adding Item.');</script>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page | Groceryz</title>
    <link rel="icon" type="image/x-icon" href="../pictures/app_logo.png" sizes="64X64">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/groceryList.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header>
        <figure>
            <img src="../pictures/logo_with_name-removebg-preview.png" alt="Site Logo" height="90px">
        </figure>
        <nav>
            <ul style="list-style-type: none; color: white; text-decoration:none;">
                <a href="#" class="activeTab"><li id="home">Home</li></a>
                <a href="userDetails.php"><li id="users">Users</li></a>
                <a href="aboutUs.php"><li id="aboutUs">About Us</li></a>
                <a href="contactUs.php"><li id="contact">Contact</li></a>
                <a href="dashboard.php"><li id="profile"><i class="fa-solid fa-circle-user fa-2xl"></i></li></a>
            </ul>
        </nav>
    </header>

    <main id="main">

<!-- Main grocery list app (hidden initially) -->
        <div id="groceryApp" class="grocery-app">
            <section class="itemDescription">
                <div id="selectList">
                    <label for="list">Select List:</label>
                    <form method="POST" style="display: inline;">
                        <select name="selected_list_id" id="list" required onchange="this.form.submit()">
                            <option value="">-- Choose List --</option>
                            <?php
                                $listsQuery = "SELECT list_id, list_name FROM grocery_lists WHERE user_id = '$user_id'";
                                $lists = mysqli_query($conn, $listsQuery);
                                while ($row = mysqli_fetch_assoc($lists)) {
                                    $selected = (isset($_SESSION['list_id']) && $_SESSION['list_id'] == $row['list_id']) ? 'selected' : '';
                                    echo "<option value='".$row['list_id']."' $selected>".$row['list_name']."</option>";
                                }
                            ?>
                        </select>
                    </form>
                </div>
                <h2>Add Item</h2>
                <form id="addItemForm" method="POST" onsubmit="addItem(event)">
                    <input type="text" name="name" id="itemName" placeholder="Item Name" required>
                    <select name="type" id="itemType" required>
                        <option value="" disabled selected>Select Item Type</option>
                        <option value="Fruits">Fruits</option>
                        <option value="Vegetables">Vegetables</option>
                        <option value="Dairy">Dairy</option>
                        <option value="Bread and baked goods">Bread and baked goods</option>
                        <option value="Meat and fish">Meat and fish</option>
                        <option value="Meat alternatives">Meat alternatives</option>
                        <option value="Cans and jars">Cans and jars</option>
                        <option value="Pasta, rice, and cereals">Pasta, rice, and cereals</option>
                        <option value="Sauces and condiments">Sauces and condiments</option>
                        <option value="Herbs and spices">Herbs and spices</option>
                        <option value="Frozen foods">Frozen foods</option>
                        <option value="Snacks">Snacks</option>
                        <option value="Drinks">Drinks</option>
                        <option value="Household and cleaning">Household and cleaning</option>
                        <option value="Personal care">Personal care</option>
                        <option value="Pet care">Pet care</option>
                        <option value="Baby products">Baby products</option>
                        <option value="Other">Other</option>
                    </select>                    
                    <input type="number" name="qty" id="itemQty" placeholder="Quantity" min="1" required>
                    <button type="submit" name="addItemBtn" id="addItemBtn">Add Item</button>
                </form>
            </section>

            <section class="groceryListSection">
                <div class="menu">
                    <button type="button" onclick="toggleMenu()">
                        <i class="fa-solid fa-bars fa-xl"></i>
                    </button>
                    <ul id="menuList" style="display: none;">
                        <li><button id="newList" onclick="newList()">New List</button></li>
                        <li><button id="openList" onclick="openList()">Open List</button></li>
                    </ul>
                </div>
                <div class="groceryList">
                    <div id="listHeading">
                        <h2 id="currentListName"><?php echo isset($_SESSION['list_name'])? $_SESSION['list_name']: ""; ?></h2>
                        <div class="listOptions">
                            <div id="rename">
                                <abbr title="Rename List"><button onclick="renameList()" id="renameBtn" name="renameBtn"><i class="fa-solid fa-pen-to-square fa-xl"></i></button></abbr>
                            </div>
                            <div id="share">
                                <abbr title="Share List"><button onclick="shareList()" id="shareBtn" name="shareBtn"><i class="fa-solid fa-share-nodes fa-xl"></i></button></abbr>
                            </div>
                            <div id="download">
                                <abbr title="Download"><button onclick="toggleDownloadMenu()" id="downloadBtn" name="downloadBtn"><i class="fa-solid fa-download fa-xl"></i></button></abbr>
                                <ul id="downloadMenuList" style="display: none;">
                                    <li><button id="downloadExcel" onclick="downloadListAsExcel()">Download Excel</button></li>
                                    <li><button id="downloadPdf" onclick="downloadListAsPDF()">Download PDF</button></li>
                                </ul>
                            </div>
                            <div id="close">
                                <abbr title="Close"><button onclick="closeList()" id="closeBtn" name="closeBtn"><i class="fa-solid fa-xmark fa-xl"></i></button></abbr>
                            </div>
                        </div>
                    </div>
                    <div id="listDisplay" class="list-display">
                    <!-- List items will be shown here -->
                        <table>
                        <?php
                            $fetchQuery = "SELECT * FROM list_items WHERE list_id = '$list_id' ORDER BY item_type";
                            $result = mysqli_query($conn, $fetchQuery);

                            $current_type = ""; 
                            if (mysqli_num_rows($result) == 0) {
                                echo "<tr><td colspan='3'>No items in this list yet.</td></tr>";
                            }
                            if (mysqli_num_rows($result) > 0) {
                                while ($items = mysqli_fetch_assoc($result)) {
                                    if ($current_type != $items['item_type']) {
                                        $current_type = $items['item_type'];
                                        echo "<tr><td colspan='3' style='font-weight: bold; background-color: #e8f5e9;'>" . ucfirst(htmlspecialchars($current_type)) . "</td></tr>";
                                    }
                                    $is_done = $items['is_done'] ? 'checked' : '';
                                    $row_style = $items['is_done'] ? 'style="text-decoration: line-through;"' : '';

                                    echo "<tr $row_style>
                                        <td>" . htmlspecialchars($items['item_name']) . "</td>
                                        <td>" . htmlspecialchars($items['item_qty']) . "</td>
                                        <td>
                                            <input type='checkbox' onchange='toggleDone(" . $items['item_id'] . ", this)' $is_done />
                                            <button onclick='editItem(" . $items['item_id'] . ", \"" . htmlspecialchars($items['item_name']) . "\", \"" . htmlspecialchars($items['item_qty']) . "\")'>✏️</button>
                                            <button onclick='deleteItem(" . $items['item_id'] . ")'>🗑️</button>
                                        </td>
                                    </tr>";
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </section>
        </div>
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

    <script>
        function shareList() {
            const email = prompt("Enter the email of the user to share this list with:");
            if (!email) return;

            const permission = confirm("Do you want to allow editing permissions for this user?") ? "edit" : "view";
            const listId = <?php echo json_encode($_SESSION["list_id"] ?? ""); ?>;

            fetch("../php/shareList.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `email=${encodeURIComponent(email)}&list_id=${listId}&permission=${permission}`
            })
            .then(res => res.text())
            .then(response => alert(response))
            .catch(err => {
                alert("Error sharing list.");
                console.error(err);
            });
        }

    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>
    <script src="js/groceryList.js"></script>
</body>
</html>