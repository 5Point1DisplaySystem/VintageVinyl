<?php
session_start();
include '../../config/dbConfig.php';
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../login/');
    exit;
}

include '../../partials/header.php';
$uid = $_GET['uid'];
$stmt = $conn->prepare('UPDATE vintageVinyl.user
    SET
    username = ?,
	is_active = ?,
	email =?
    where id = ' . $uid . ' ');

$stmt->bind_param('sss',$_POST['username'], $_POST['is_active'], $_POST['email']);
$stmt->execute();

header("Location: users.php");
exit;
