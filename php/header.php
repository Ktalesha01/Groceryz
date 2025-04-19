<?php
// Get the current page name
$currentPage = basename($_SERVER['PHP_SELF']);

switch ($currentPage) {
    case "homePage.php":
        $title = "Home Page";
        $cssfile = "homePage";
        break;

    case "groceryList.php":
        $title = "Home Page";
        $cssfile = "groceryList";
        break;
    
    case "userDetails.php":
        $title = "User Details";
        $cssfile = "userDetails";
        break;

    case "aboutUs.php":
        $title = "About Us";
        $cssfile = "aboutUs";
        break;

    case "contactUs.php":
        $title = "Contact Us";
        $cssfile = "contactUs";
        break;

    case "dashboard.php":
        $title = "Dashboard";
        $cssfile = "dashBoard";
        break;

    default:
        $title = "Groceryz";
}

function activeClass($page) {
    global $currentPage;
    return $currentPage === $page ? 'activeTab' : '';
}

function activeHref($page) {
    global $currentPage;
    return $currentPage === $page ? '#' : $page;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?> | Groceryz</title>
    <link rel="icon" type="image/x-icon" href="../pictures/app_logo.png" sizes="64X64">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/<?php echo $cssfile;?>.css">
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
                <a href="<?php echo activeHref('homePage.php'); ?>"  class="<?php echo activeClass('homePage.php'); ?>"><li id="home">Home</li></a>
                <?php if($_SESSION["role"]=="admin"): ?>
                    <a href="<?php echo activeHref('userDetails.php'); ?>"  class="<?php echo activeClass('userDetails.php'); ?>"><li id="users">Users</li></a>
                <?php endif; ?>
                <a href="<?php echo activeHref('aboutUs.php'); ?>"  class="<?php echo activeClass('aboutUs.php'); ?>"><li id="aboutUs">About Us</li></a>
                <a href="<?php echo activeHref('contactUs.php'); ?>"  class="<?php echo activeClass('contactUs.php'); ?>"><li id="contact">Contact</li></a>
                <a href="<?php echo activeHref('dashboard.php'); ?>"  class="<?php echo activeClass('dashboard.php'); ?>"><li id="profile"><i class="fa-solid fa-circle-user fa-2xl"></i></li></a>
            </ul>
        </nav>
    </header>
