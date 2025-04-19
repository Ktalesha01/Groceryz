<?php
    session_start();

    require "../php/header.php";

    if (!isset($_SESSION["username"])) {
        echo "<script>location.href='login.php'</script>";
        exit();
    }

    $errorMessage ="";
?>


    <main id="main">

<!-- Popup to name the grocery list -->
        <section id="listNamePopup" class="popup-section">
            <div>
                <button id="closeBtn" name="closeBtn" type="button"><i class="fa-solid fa-xl fa-xmark"></i></button>
            </div>
            <form method="POST" class="popup-box">
                <h1>Name Your Grocery List</h1>
                <input type="text" name="list_name" id="listNameInput" placeholder="Enter list name" required>
                <button name="createList" id="createList" onclick="saveListName()">Create List</button>
            </form>
        </section>

        <?php
            if(isset($_POST["createList"])){

                require "../php/databaseConnect.php";

                $user_id = $_SESSION["user_id"];
                $list_name = trim($_POST["list_name"]);
                
                $checkQuery = "SELECT list_id, list_name FROM grocery_lists WHERE user_id='$user_id' AND LOWER(list_name) = LOWER('$list_name')";
                $result = mysqli_query($conn, $checkQuery);
                
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $_SESSION["list_id"] = $row["list_id"];
                    $_SESSION["list_name"] = $row["list_name"];
                    echo "<script>alert('List already exists!'); window.location.href='groceryList.php';</script>";
                } else {
                    $insertQuery = "INSERT INTO grocery_lists (user_id, list_name, shared, shared_with, shared_permissions) 
                                    VALUES ('$user_id', '$list_name', 0, '', '')";
                    
                    if (mysqli_query($conn, $insertQuery)) {
                        $list_id = mysqli_insert_id($conn);
                        $_SESSION["list_id"] = $list_id;
                        $_SESSION["list_name"] = $list_name;
                        header("Location: groceryList.php");
                        exit();
                    } else {
                        echo "<script>alert('Error creating list. Please try again.');</script>";
                    }
                }
            }
        ?>

    <?php
        require "../php/footer.php";
    ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>
    <script src="js/homePage.js"></script>
</body>
</html>