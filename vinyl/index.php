<?php
session_start();

include_once '../config/dbConfig.php';

include_once '../partials/header.php';

$album = $conn->prepare('SELECT 
        img.file_name,
        alb.id,
        alb.albName,
        alb.is_active,
        g.genreName

       FROM image img
       left join album alb ON  img.fk_album_id = alb.id
       left join genre g ON  alb.fk_genre_id = g.id
       left join user usr ON  img.fk_user_id = usr.id
       where alb.is_active = 1 AND usr.is_active = 1
       
      ');
$album->execute();
$album->store_result();
$album->bind_result($fileName, $albID, $albName, $active, $genre);

?>


<main class="home">
    <h2>All Vinyl for Sale</h2>   
    <?php if ($album->num_rows == 0): ?>
            <h2>There are No Albums uploaded yet</h2>
        <?php else: ?>  
    <section>
     
        <?php while ($album->fetch()): ?>
            <div class="<?= $genre ?>">
                <img src="<?= ROOT_DIR ?>auth/user/uploads/<?= $fileName ?>" alt="">
                <button onclick="window.location.href='details.php?alb_id=<?=$albID?>';" class="review-btn">Details</button>
            </div>
        <?php endwhile; ?>
    </section>
    <?php endif; ?>
    
</main>

<?php include_once '../partials/footer.php'; ?>
