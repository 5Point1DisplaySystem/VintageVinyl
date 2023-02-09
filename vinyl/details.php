<?php
session_start();
require_once '../config/dbConfig.php';
include_once '../partials/header.php';
$albID = $_GET['alb_id'];
$stmt = $conn->prepare('SELECT 

        img.id,
        img.file_name,
        alb.albName,
        alb.albDescription,
        g.genreName,
		g.id,
        rl.rlName
		

        from image img
        left join album alb ON img.fk_album_id = alb.id
        left join genre g ON alb.fk_genre_id = g.id
        left join record_label rl ON alb.fk_record_label_id = rl.id
        where img.fk_album_id = '.$albID.'
    
    
');

$stmt->execute();
$stmt->store_result();
$stmt->bind_result( $imgID, $fileName, $albName, $albDesc, $gName, $gid, $rlName) ;
$stmt->fetch();
echo $gid;

// bring in same genre

$genre = $conn->prepare('SELECT 
        img.id,
        img.file_name,
        alb.is_active,
        alb.id

       FROM image img
       LEFT JOIN  album alb ON img.fk_album_id = alb.id
       where alb.fk_genre_id = ' . $gid . ' 
	   and alb.id != ' . $albID . '
       ORDER BY uploaded_on DESC

       LIMIT 4
      ');

$genre->execute();
$genre->store_result();
$genre->bind_result($id, $fileName, $active, $albID);
?>
<style>

</style>   
<div class="container">
    <div class="landing-page">
<!-- adding a comment to see if it update send changes from vscode to goorm -->
        <div class="vinyl-container">
            <div class="album-cover">
            <div class="genre"><p> <?= $gName ?> </p></div>
            <img src="<?= ROOT_DIR ?>auth/user/uploads/<?= $fileName ?>"></div>
            <div class="vinyl-record"><img class="rotating" src="https://res.cloudinary.com/benfiika/image/upload/v1472919793/design003/vinyl.png"/></div>
        </div>
        <div class="text-container">
            <div class="title"><?= $albName ?> </div>
            <div class="description"><p> <?= $albDesc ?> </p></div>
            <a href="mailto:someone@yoursite.com?subject=Mail from Our Site" class="seller">CONTACT SELLER</a>
            <button id="go_back">< BACK</button>

        </div>
    </div>
		
</div>
<main class="home">
	<h2>Albums with the same genre</h2>
    <section>
        <?php while ($genre->fetch()): ?>
            <div>
            <img src="<?= ROOT_DIR ?>auth/user/uploads/<?= $fileName ?>" alt="">
            <button onclick="window.location.href='details.php?alb_id=<?=$albID?>';" class="review-btn">Details</button>
            </div>
        <?php endwhile; ?>
    </section>
	
	</main>

<script>
    document.getElementById('go_back').addEventListener('click', () => {
        history.back();
    });
</script>
<?php include_once '../partials/footer.php'; ?>
