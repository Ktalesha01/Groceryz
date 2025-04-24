<?php
session_start();

require "../php/header.php";

if (!isset($_SESSION["username"])) {
    echo "<script>location.href='login.php'</script>";
    exit();
}

$errorMessage = "";
$user_id = $_SESSION["user_id"];
require "../php/databaseConnect.php";

if (isset($_GET['shared_list_id'])) {
    $list_id = $_GET['shared_list_id'];

    $checkAccess = "SELECT gl.list_name FROM shared_lists sl
                    JOIN grocery_lists gl ON sl.list_id = gl.list_id
                    WHERE sl.list_id = '$list_id' AND (sl.shared_with_user_id = '$user_id' OR gl.user_id = '$user_id')";
    $accessResult = mysqli_query($conn, $checkAccess);

    if ($accessResult && mysqli_num_rows($accessResult) > 0) {
        $row = mysqli_fetch_assoc($accessResult);
        $_SESSION['list_id'] = $list_id;
        $shared_list =  $_SESSION['list_id'];
        $_SESSION['list_name'] = $row['list_name'];
    } else {
        echo "<script>alert('Access denied.'); location.href='dashboard.php';</script>";
        exit();
    }
}else if (isset($_GET['i_shared_list_id'])) {
    $list_id = $_GET['i_shared_list_id'];

    $checkAccess = "SELECT gl.list_name FROM shared_lists sl
                    JOIN grocery_lists gl ON sl.list_id = gl.list_id
                    WHERE sl.list_id = '$list_id' AND (sl.shared_by_user_id = '$user_id' OR gl.user_id = '$user_id')";
    $accessResult = mysqli_query($conn, $checkAccess);

    if ($accessResult && mysqli_num_rows($accessResult) > 0) {
        $row = mysqli_fetch_assoc($accessResult);
        $_SESSION['list_id'] = $list_id;
        $i_shared_list =  $_SESSION['list_id'];
        $_SESSION['list_name'] = $row['list_name'];
    } else {
        echo "<script>alert('Access denied.'); location.href='dashboard.php';</script>";
        exit();
    }
}else if (isset($_GET['recent_list_id'])) {
    $list_id = $_GET['recent_list_id'];
    $_SESSION['list_id'] = $list_id;
    $recent_list =  $_SESSION['list_id'];
}else {
    $list_id = isset($_SESSION['list_id']) ? $_SESSION['list_id'] : null;
}


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

            $duplicateQuery = "SELECT * FROM list_items WHERE list_id = '$list_id' AND user_id = '$user_id' AND item_name = '$itemName' AND item_type = '$itemType' AND item_qty = '$itemQty'";
            $duplicateResult = mysqli_query($conn, $duplicateQuery);
        
            if (mysqli_num_rows($duplicateResult) > 0) {
                echo "<script>alert('Duplicate entry. Item already exists.');</script>";
            }
            else{
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
    }
?>


    <main id="main">

        <div id="groceryApp" class="grocery-app">
            <section class="itemDescription">
                <div id="selectList">
                    <label for="list">Select List:</label>
                    <form method="POST" style="display: inline;">
                        <select name="selected_list_id" id="list" required onchange="this.form.submit()">
                            <option value="">-- Choose List --</option>
                            <?php
                                if(isset($_GET["shared_list_id"])){
                                    $listsQuery = "SELECT gl.list_id, gl.list_name 
                                    FROM grocery_lists gl
                                    LEFT JOIN shared_lists sl ON gl.list_id = sl.list_id
                                    WHERE gl.user_id = '$user_id' OR sl.shared_with_user_id = '$user_id'
                                    GROUP BY gl.list_id";
                                }elseif(isset($_GET['i_shared_list_id'])){
                                    $listsQuery = "SELECT gl.list_id, gl.list_name 
                                    FROM grocery_lists gl
                                    LEFT JOIN shared_lists sl ON gl.list_id = sl.list_id
                                    WHERE gl.user_id = '$user_id' OR sl.shared_by_user_id = '$user_id'
                                    GROUP BY gl.list_id";
                                }else{
                                    $listsQuery = "SELECT list_id, list_name FROM grocery_lists WHERE user_id = '$user_id'";
                                }

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
                                        echo "<tr style=\"font-size: larger; background-color: #bbe3c6;\"><td colspan='3'><h3>" . ucfirst(htmlspecialchars($current_type)) . "</h3></td></tr>";
                                    }
                                    $is_done = $items['is_done'] ? 'checked' : '';
                                    $row_style = $items['is_done'] ? 'style="text-decoration: line-through;font-size: larger; text-align: left;"' : '';

                                    echo "<tr $row_style style=\"font-size: larger; text-align: left;\">
                                        <td style=\"width: 55%;padding-left:2vw;\">" . htmlspecialchars($items['item_name']) . "</td>
                                        <td style=\"width: 25%;\">" . htmlspecialchars($items['item_qty']) . "</td>
                                        <td style=\"width: 20%;\">
                                            <input type='checkbox' style='transform: scale(2); margin-right: 10px;' onchange='toggleDone(" . $items['item_id'] . ", this)' $is_done />
                                            <button style='font-size: .85vw; padding: 4px 8px;' onclick='editItem(" . $items['item_id'] . ", \"" . htmlspecialchars($items['item_name']) . "\", \"" . htmlspecialchars($items['item_qty']) . "\")'>✏️</button>
                                            <button style='font-size: .85vw; padding: 4px 8px;' onclick='deleteItem(" . $items['item_id'] . ")'>🗑️</button>
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

    <?php
        require "../php/footer.php";
    ?>

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