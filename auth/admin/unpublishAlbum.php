<?php
session_start();
include '../../config/dbConfig.php';
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../login/');
    exit;
}

include '../../partials/header.php';
$albId = $_GET['alb_id'];
$stmt = $conn->prepare('UPDATE album alb
    set
    alb.is_active = 0
    where id = '.$albId.' ');

$stmt->execute();
header("Location: pending.php");
exit;