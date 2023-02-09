<?php
session_start();
include '../../config/dbConfig.php';
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../login/');
    exit;
}
include '../../partials/header.php';

$uid = $_GET['uid'];

$users = $conn->prepare('SELECT 
        u.id,
        u.username,
        u.is_active,
        u.email 
       FROM user u
        left join image img on u.id = img.fk_user_id
        left join album alb on img.fk_album_id = alb.id

        where u.id = '.$uid .'
     
');

$users->execute();
$users->store_result();
$users->bind_result( $uid, $username, $active, $email);
$users->fetch();
?>
View/Edit User details
<form action="editUser.php?uid=<?=$uid?>" method="post">
<input type="text" value="<?= $username ?>">
<input type="submit">


</form>
<?php
include '../../partials/footer.php';
?>
