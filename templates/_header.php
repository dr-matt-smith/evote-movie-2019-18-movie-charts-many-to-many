<?php
//----- login variables
use TuDublin\SessionManager;
$sessionManager = new SessionManager();
$isLoggedIn = $sessionManager->isLoggedIn();
$username = $sessionManager->usernameFromSession();

// ------ page title
if(empty($pageTitle)){
    $pageTitle = '';
}

// ----- current page nav styles
if(empty($homePageStyle)) $homePageStyle = '';
if(empty($aboutPageStyle)) $aboutPageStyle = '';
if(empty($contactPageStyle)) $contactPageStyle = '';
if(empty($sitemapPageStyle)) $sitemapPageStyle = '';
if(empty($listPageStyle)) $listPageStyle = '';
if(empty($listCheapPageStyle)) $listCheapPageStyle = '';
if(empty($chartPageStyle)) $chartPageStyle = '';
?>
<!doctype html>
<html lang="en">
<head>
    <title>EVOTE MOVIE - <?= $pageTitle ?> page</title>
    <meta charset="utf-8">
    <style>
        @import "/css/basic.css";
        @import "/css/nav.css";
        @import "/css/footer.css";
    </style>
</head>
<body>



<header>
    <!-- LOGIN LINK -->
    <span style="float: right; text-align: right;">
        <?php
            if($isLoggedIn):
        ?>
            You are logged in as: <strong><?= $username ?></strong>
            <br>
            <a href="index.php?action=logout">Logout</a>
        <?php
            else:
        ?>
            <a href="index.php?action=login">Login</a>
        <?php
            endif;
        ?>
    </span>

    <!-- LOGO -->
    <img src="/images/smithit_logo.gif" alt="logo">
</header>


<nav>
    <ul>
        <li>
            <a href="index.php" class="<?= $homePageStyle ?>">Home</a>
        </li>

        <li>
            <a href="index.php?action=about"  class="<?= $aboutPageStyle ?>">About Us</a>
        </li>

        <li>
            <a href="index.php?action=list"  class="<?= $listPageStyle ?>">Movie ratings</a>
        </li>

        <li>
            <a href="index.php?action=listCheap"  class="<?= $listCheapPageStyle ?>">cheap movies</a>
        </li>

        <li>
            <a href="index.php?action=contact"  class="<?= $contactPageStyle ?>">Contact Us</a>
        </li>

        <li>
            <a href="index.php?action=sitemap"  class="<?= $sitemapPageStyle ?>">Site Map</a>
        </li>

        <li>
            <a href="index.php?action=charts"  class="<?= $chartPageStyle ?>">Charts</a>
        </li>
    </ul>
</nav>
