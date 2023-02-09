<?php 
session_start();
include '../../config/dbConfig.php';

include_once "../../partials/header.php";
// $statusMsg = $_GET['status'];


$genre = $conn->prepare('SELECT 
        g.id,
        g.genreName
       FROM genre g
       
      ');
$genre->execute();
$genre->store_result();
$genre->bind_result($genID, $genreName);


$rl = $conn->prepare('SELECT 
        rl.id,
        rl.rlName
       FROM record_label rl
       
      ');
$rl->execute();
$rl->store_result();
$rl->bind_result($rlID, $rlName);

?>

<main class="upload">
	<h1>
	</h1>
<h2 class="header">Hi <?=$_SESSION['name']?> Would you like to Upload an Album for sale? </h2>
<section class="uploadVinyl">
    <form action="upload.php" method="post" enctype="multipart/form-data">

       
            <label for="imgUpload">Select Album Image</label>
            <input type="file" name="file" id="imgUpload">
       
            <label for="albumName">Album Name</label>    
            <input type="text" name="albName" id="albumName" required>
       
            <label for="albumDescription">Album Description</label>    
            <textarea name="albDescription" id="albumDescription"></textarea>
      
            <label for="artistName">Artist Name</label>    
            <input type="text" name="artName" id="artistName">
      
            <label for="artistDescription">Artist Description</label>    
            <textarea name="artDescription" id="artistDescription"></textarea>
        
            <select name="fk_genre_id">
                <option value="">Select Genre</option>
                <?php while ($genre->fetch()): ?>  
                    <option value="<?= $genID ?>"><?= $genreName ?></option>
                <?php endwhile; ?>
            </select>
       
            <select name="fk_record_label_id">
                <option value="">Select Record Label</option>
                <?php while ($rl->fetch()): ?>  
                    <option value="<?= $rlID ?>"><?= $rlName ?></option>
                <?php endwhile; ?>
            </select>
        
        
        <input type="submit" name="submit" value="Upload" class="submit">
    </form>
</section>
</main>
 

<?php
    include '../../partials/footer.php';
?>