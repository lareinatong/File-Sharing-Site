<?php
session_start();
$fileName=$_POST['filename'];
if(!empty($fileName)){
    if (unlink("/home/lareinatong/files/".$_SESSION['username']."/".$fileName)){
        echo "Successful";
    }else{
        echo "Failed";
    }

}else {
    echo "Please select the file you want to delete.";
}
echo '<br><input type="button" value="Back" onclick="location.href=\'mainpage.php\'" />';
?>