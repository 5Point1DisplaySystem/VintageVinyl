<?php
session_start();
include '../../config/dbConfig.php';
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../login/');
    exit;
}

include '../../partials/header.php';
$uid = $_GET['uid'];
$stmt = $conn->prepare('UPDATE user usr
    set
    usr.is_active = 0
    where id = '.$uid.' ');

$stmt->execute();
header("Location: users.php");
exit;