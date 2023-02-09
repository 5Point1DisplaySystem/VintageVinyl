<?php
session_start();

include_once 'config/dbConfig.php';

include_once 'partials/header.php';

$latest = $conn->prepare('SELECT 
        img.id,
        img.file_name,
        alb.is_active,
        alb.id

       FROM image img
       LEFT JOIN  album alb ON img.fk_album_id = alb.id
       where alb.is_active = 1
       ORDER BY uploaded_on DESC

       LIMIT 4
      ');

$latest->execute();
$latest->store_result();
$latest->bind_result($id, $fileName, $active, $albID);
// random
$random = $conn->prepare('SELECT 
          img.id,
        img.file_name,
        alb.is_active,
        alb.id

       FROM image img
       LEFT JOIN  album alb ON img.fk_album_id = alb.id
       where alb.is_active = 1
       ORDER BY RAND()
       LIMIT 4
      ');
$random->execute();
$random->store_result();
$random->bind_result($id, $fileName, $active, $albID);
// section three
$s3 = $conn->prepare('SELECT 
        img.id,
        img.file_name,
        alb.is_active,
        alb.id
       FROM image img
       LEFT JOIN  album alb ON img.fk_album_id = alb.id
       LEFT JOIN  artist art ON alb.fk_artist_id = art.id
       where alb.is_active = 1
       ORDER BY art.artName ASC
       LIMIT 4
      ');
$s3->execute();
$s3->store_result();
$s3->bind_result($id, $fileName, $active, $albID);



?>

  <div class="page-wrapper">
    <div class="head-wrapper">
      <div class="background">
        <img src="http://i.giphy.com/11QY4zzd3mqHe.gif" alt="" class="bg-img" />
        <div class="bg-filter"></div>
      </div>
      <div class="title-wrapper">
        <div class="title">
          <div class='yeah'>Yeah</div>
        </div>
      </div>
      <div class="button-wrapper">
        <a href="#content"><i class="fa fa-angle-down" aria-hidden="true"></i></a></div>
    </div>
    <div class="content-wrapper">
      <a data-scroll name="content"></a>
      <h1 class="text-center">Intro</h1>
  <div class='text-block'>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata
    sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
    Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At <br /> <br />Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata
    sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
    Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</div>
    
      <br />
      <br />
      <h1 class="text-center">Outro</h1>
      <div class='text-block'>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea
        takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores
        et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</div>
      
  
    </div>
  
  </div>
<main class="home">
    <h2>LATEST UPLOADS</h2>
    <section>
        <?php while ($latest->fetch()): ?>
            <div>
                <img src="<?= ROOT_DIR ?>auth/user/uploads/<?= $fileName ?>" alt="">
                <button onclick="window.location.href='vinyl/details.php?alb_id=<?=$albID?>';" class="review-btn">Details</button>
            </div>
        <?php endwhile; ?>
    </section>
    <h2>RANDOM</h2>
    <section>
        <?php while ($random->fetch()): ?>
            <div>
            <img src="<?= ROOT_DIR ?>auth/user/uploads/<?= $fileName ?>" alt="">
            <button onclick="window.location.href='vinyl/details.php?alb_id=<?=$albID?>';" class="review-btn">Details</button>
            </div>
        <?php endwhile; ?>
    </section>
    <h2>SORT BY ARTIST</h2>
    <section>
        <?php while ($s3->fetch()): ?>
            <div>
            <img src="<?= ROOT_DIR ?>auth/user/uploads/<?= $fileName ?>" alt="">
                <button onclick="window.location.href='vinyl/details.php?alb_id=<?=$albID?>';" class="review-btn">Details</button>
            </div>
        <?php endwhile; ?>
    </section>

</main>
<?php include_once 'partials/footer.php'; ?>
