<?php
    session_start();

    if (!isset($_SESSION["username"])) {
        echo "<script>location.href='../index.php'</script>";
        exit();
    }

    $errorMessage ="";
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
                <h2>Add Item</h2>
                <form id="addItemForm" onsubmit="addItem(event)">
                    <input type="text" name="name" id="itemName" placeholder="Item Name" required>
                    <input type="text" name="type" id="itemType" placeholder="Item Type" required>
                    <input type="number" name="qty" id="itemQty" placeholder="Quantity" min="1" required>
                    <button type="submit">Add Item</button>
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
                        <h2 id="currentListName"></h2>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>
    <script src="js/groceryList.js"></script>
</body>
</html>