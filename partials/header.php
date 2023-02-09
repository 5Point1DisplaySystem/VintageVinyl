<?php
//display PHP errors to make debugging easier
// Comment this out when you are finished with the website.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('ROOT_DIR', 'http://localhost:8040/vintageVinylv6Master/');

// if(isset($_SESSION['id']) && !empty($_SESSION['id'])) {
//     echo "session id is set and is not empty";
// }
// else {
//     echo "session id is not set or is empty coming from header";
// }


?>
<!doctype html>
<html lang="en">
<head>
  
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="#000">
    <script src="https://kit.fontawesome.com/18398d078f.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Monoton&display=swap" rel="stylesheet">
    <link rel="stylesheet" data-cfasync="false" type="text/css" href="<?= ROOT_DIR ?>assets/scss/app.css">
    <!-- cookie script -->

     <title>Vintage Vinyl</title>
</head>
<body>
<nav id="navbar">
    <span class="nav-toggle" id="js-nav-toggle">
        <i class="fas fa-bars"></i>
    </span>
    <a href="<?=ROOT_DIR?>/">
        <div class="logo">
        <span class="icon circle-1"></span>
        <span class="icon circle-2"></span>
        <span class="icon circle-3"></span>
        <p>Vintage vinyl</p>
    </div>
    </a>


    <?php
  
    $stmt = $conn->prepare('SELECT id, is_admin
    FROM user u');
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $admin);
    $stmt->fetch();


    if (!isset($_SESSION['loggedin'])) {
        echo '
        <ul class="js-menu">
            <li><a href="' . ROOT_DIR . '">Home</a></li>
            <li><a href="' . ROOT_DIR . 'vinyl/">VINYL</a></li>
            <li><a href="' . ROOT_DIR . 'auth/login/ ">LOGIN</a></li>
            <li><a href="' . ROOT_DIR . 'auth/register/ ">REGISTER</a></li>     
        </ul>';
    } else {
        echo '<ul class="js-menu">';
        echo '<li><a href="' . ROOT_DIR . '">SITE HOME</a></li>';

        if ($_SESSION['is_admin'] == 1) {
            echo '<li><a href="' . ROOT_DIR . 'auth/admin/">ADMIN HOME</a></li>';
            echo'<li><a href="' . ROOT_DIR . 'auth/admin/pending.php">PENDING</a></li>';
            echo'<li><a href="' . ROOT_DIR . 'auth/admin/users.php">USERS</a></li>';
        } elseif ($_SESSION['is_admin'] == 0) {
            echo '<li><a href="' . ROOT_DIR . 'auth/user/">MY HOME</a></li>';
            echo '<li><a href="' . ROOT_DIR . 'auth/user/addVinyl.php">UPLOAD</a></li>';
            echo '<li><a href="' . ROOT_DIR . 'auth/user/account/">MY ACCOUNT</a></li>';
        }
            echo '<li><a href="' . ROOT_DIR . 'vinyl">VINYL</a></li>';
            echo'<li><a href="' . ROOT_DIR . 'config/logout.php"><i class="fas fa-sign-out-alt"></i></a></li>';
            echo'</ul>';

    }


    ?>
</nav>
   
