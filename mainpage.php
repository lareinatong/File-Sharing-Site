<?php
session_start();
if (!($_SESSION['username'])) {
    echo('Your username or password was incorrect. Please try again.');
    header("refresh:5;url=./login.php");
    exit();
}
?>


<form action="up.php" method="post" enctype="multipart/form-data">
    Upload：<input type="file" name="upLoad" value="select the file"><br>
    Rename：<input type="text" name="newName"><br>
    <input type="submit" name="submit" value="submit"><input type="reset" name="reset" value="reset">
</form>


<?php
session_start();

echo "Welcome ".$_SESSION['username']."<div>";
$dir = @ dir("/home/lareinatong/files/".$_SESSION['username']);//打开upload目录；“@”可屏蔽错误信息，因有时候需要显示文件的目录内并没有文件，此时可能会报出错误，用“@”隐藏掉错误
//列举upload目录中的所有文件
echo "<p>File List:</p >";
echo "<form action=\"delete.php\" method=\"post\" enctype=\"multipart/form-data\">";
//不列出".."和"."
while (($file = $dir->read()) ) {
    if (($file != "..")&&($file != ".")){
        echo "<input type=\"radio\" name=\"filename\" value = \"".$file."\" >".$file."<div>";
//      echo "<input type=\"radio\" name=\"filename\" value = \"".$file."\" >"."<a href=\"http://54.69.117.168/~lareinatong/files/".$_SESSION["username"]."/".$file."\"><div>";
    }
}
$dir->close();
echo "<input type=\"submit\" value = \"delete\">";
echo "</form>";
echo "<hr>";

$dir = @ dir("/home/lareinatong/files/".$_SESSION['username']);
echo "<p>File List to Open:</p >";
echo "<form action=\"open.php\" method=\"post\" enctype=\"multipart/form-data\">";
//不列出".."和"."
while (($file = $dir->read()) ) {
    if (($file != "..")&&($file != ".")){
        echo "<input type=\"radio\" name=\"filename\" value = \"".$file."\" >".$file."<div>";
//      echo "<input type=\"radio\" name=\"filename\" value = \"".$file."\" >"."<a href=\"http://54.69.117.168/~lareinatong/files/".$_SESSION["username"]."/".$file."\"><div>";
    }
}
$dir->close();
echo "<input type=\"submit\" value = \"open\">";
echo "</form>";
echo "<hr>";

?>
<form action="logout.php" method="post" enctype="multipart/form-data">
    <input type="submit" name="logoff" value="logoff">
</form>