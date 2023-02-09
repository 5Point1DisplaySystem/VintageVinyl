<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database configuration file
include '../../config/dbConfig.php';
$id = $_SESSION['id']; //Users ID

$statusMsg = '';
$artistInsert = $conn->prepare("INSERT INTO vintageVinyl.artist (artName, artDescription) VALUES(?, ?);");
$albumInsert = $conn->prepare("INSERT INTO vintageVinyl.album (albName, albDescription, fk_genre_id, fk_artist_id, fk_record_label_id) VALUES(?, ?, ?, LAST_INSERT_ID(), ?);");
$artistInsert->bind_param('ss', $_POST['artName'], $_POST['artDescription']);
$albumInsert->bind_param('ssii', $_POST['albName'], $_POST['albDescription'], $_POST['fk_genre_id'], $_POST['fk_record_label_id'] );
$artistInsert->execute();
$albumInsert->execute();
// File upload path
$targetDir = "uploads/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){
    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            // Insert image file name into database
            $insert = $conn->query("INSERT into vintageVinyl.image (file_name, uploaded_on, fk_user_id, fk_album_id) VALUES ('".$fileName."', NOW(), '".$id."', LAST_INSERT_ID());");
            if($insert){
                $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
            }else{
                $statusMsg = "File upload failed, please try again.";
            } 
        }else{
            $statusMsg = "Sorry, there was an error uploading your file.";
        }
    }else{
        $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
    }
}else{
    $statusMsg = 'Please select a file to upload.';
}
// Display status message
//echo $statusMsg;

//Doesn't always return the status message if successful

header("Location: addVinyl.php?success=$statusMsg");



?>