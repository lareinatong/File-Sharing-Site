<?php
session_start();
$username = $_SESSION['username'];
$filename = $_POST['filename'];
if ($filename){
    $full_path = sprintf("/home/lareinatong/files/%s/%s", $username, $filename);
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime = $finfo->file($full_path);
    header('Content-Type: '.$mime);
    readfile($full_path);
}else{
    echo "Please select file to open";
}
echo '<br><input type="button" value = "Back" onclick="location.href=\'mainpage.php\'" />';
?>
$filename = $_POST['filename'];