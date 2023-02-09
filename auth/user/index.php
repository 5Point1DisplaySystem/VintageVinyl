<?php
session_start();
include '../../config/dbConfig.php';
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../login/');
    exit;
}

include '../../partials/header.php';


$album = $conn->prepare("SELECT 
        img.id,
        img.file_name,
        img.fk_album_id,
        img.fk_user_id,
        alb.albName,
        alb.id,
        alb.is_active
       FROM image img
       
       left join album alb ON  img.fk_album_id = alb.id
       where img.fk_user_id = ?
       ORDER BY alb.is_active ASC
      ");
$album->bind_param('i', $_SESSION['id']);
$album->execute();
$album->store_result();
$album->bind_result($id, $fileName, $albID, $usrID, $albName, $albID, $is_active);



?>
<main class="home">
    <h2>Hi, <?=$_SESSION['name']?>!</h2>
        <?php if ($album->num_rows == 0): ?>
            <h3>You have not uploaded any albums yet. Get started - <a href="addVinyl.php">UPLOAD NOW</a></h2>
        <?php else: ?>

    <h2>LATEST RELEASES</h2>

    <section>
        <?php while ($album->fetch()): ?>
            <div>
                <img src="<?= ROOT_DIR ?>auth/user/uploads/<?= $fileName ?>" alt="">
                <?php
                    if($is_active == 1){
                        echo '<h4 class="published">Active</h4>';
                    }
                    else{
                        echo '<h4 class="pending">Pending Approval</h4>';
                    }
                ?>
                <button onclick="window.location.href='../../vinyl/details.php?alb_id=<?=$albID?>';" class="review-btn">Details</button>
            </div>
        <?php endwhile; ?>
    </section>
    <?php endif; ?>

    
</main>

<?php include '../../partials/footer.php'; ?>
