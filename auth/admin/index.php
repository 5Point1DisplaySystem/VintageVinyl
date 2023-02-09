<?php
session_start();
include '../../config/dbConfig.php';
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../login/');
    exit;
}

include '../../partials/header.php';
$pending = $conn->prepare('SELECT is_active 
FROM vintageVinyl.album WHERE is_active = 0 ');



$pending->execute();
$pending->store_result();
$pending->bind_result($pendingCount);

?>
    <?php while ($pending->fetch()): ?> 
<p>
	<?= $pendingCount ?>
</p>
    <?php endwhile; ?>


    Here you could list:
    <ul>
        <li>There are <span></span> albums pending</li>
        <li>Any pending request for Albums to be published</li>
        <li>Number of Uplods?</li>
    </ul>

<?php
include '../../partials/footer.php';
?>
