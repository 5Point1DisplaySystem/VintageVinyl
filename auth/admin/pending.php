<?php
session_start();
include '../../config/dbConfig.php';
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../login/');
    exit;
}

include '../../partials/header.php';


$pending = $conn->prepare("SELECT 
        img.id,
        img.file_name,
        img.fk_album_id,
        img.fk_user_id,
        alb.albName,
        alb.id,
        alb.is_active
       FROM image img
       
       left join album alb ON  img.fk_album_id = alb.id
       WHERE is_active = 0
       
      ");
$pending->execute();
$pending->store_result();
$pending->bind_result($id, $fileName, $albID, $usrID, $albName, $albId, $active);

// Published albums

$published = $conn->prepare("SELECT 
        img.id,
        img.file_name,
        img.fk_album_id,
        img.fk_user_id,
        alb.albName,
        alb.id,
        alb.is_active
       FROM image img
       
       left join album alb ON  img.fk_album_id = alb.id
       WHERE is_active = 1
       
      ");
$published->execute();
$published->store_result();
$published->bind_result($id, $fileName, $albID, $usrID, $albName, $albId, $active);



?>
<main class="home">

    <h2>Pending approval</h2>
    <?php if ($pending->num_rows == 0): ?>
            <h2>You are up to date, there is nothing pending approval</h2>
        <?php else: ?>
    <section class="admin">
        <?php while ($pending->fetch()): ?>
            <div>
                <img src="<?= ROOT_DIR ?>auth/user/uploads/<?= $fileName ?>" alt="">
                <?php
                echo '<a class="pending" href="publishAlbum.php?alb_id=' . $albId . '"><i class="fas fa-times-circle"></i></i>Pending</a>';
                ?>
                <button onclick="window.location.href='../../vinyl/details.php?alb_id=<?=$albId?>';" class="review-btn">Details</button>
            </div>
        <?php endwhile; ?>
    </section>
    <?php endif; ?>
    <hr>
    <h2>Approved</h2>
    <section class="admin">
        <?php while ($published->fetch()): ?>
            <div>
                <img src="<?= ROOT_DIR ?>auth/user/uploads/<?= $fileName ?>" alt="">
                <?php
                    echo '<a class="published" href="unpublishAlbum.php?alb_id=' . $albId . '" title="Deactivate User"><i class="fas fa-times-circle"></i></i>Published</a>';
                ?>
                <button onclick="window.location.href='../../vinyl/details.php?alb_id=<?=$albId?>';" class="review-btn">Details</button>
            </div>
        <?php endwhile; ?>
    </section>
    
    
</main>

<?php include '../../partials/footer.php'; ?>
