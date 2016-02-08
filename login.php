<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>login</title>
    <link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
<?php
session_start();
if($_POST){
    $file = fopen("users.txt", "r");//只读方式打开users.txt文件
    if(!$file) exit('Document does no exist!');
    //输出文本中所有的行，直到文件结束为止。
    while (!feof($file)) {
        //fgets() 函数从文件指针中读取一行。
        $row = fgets($file);
        //explode(separator,string,limit(可选))把字符串打散为数组。
        $array = explode(',', $row);
        //判断用户名密码是否正确,trim(string)移除字符串两侧的空白字符或其他预定义字符。
        if (($array[0] == $_POST['username']) && (trim($array[1]) == $_POST['password'])) {
            $_SESSION[htmlentities('username')] = $_POST['username'];

            echo $_POST['username'];
            print(' log in successfully,Back to the main page in 5 seconds ');
            header("refresh:5;url=./mainpage.php");
            exit();
        }
    }

    echo('Your username or password was incorrect. Please try again.');
    fclose($file);
    header("refresh:5;url=./login.php");
}else{
    ?>
    <form action="?action=chklogin" method="post">
        <input type="text" name="username" placeholder="username"><br><br>
        <input type="password" name="password" placeholder="password"><br><br>
        <input type="submit" value="log in">
    </form>

    <?php
}
?>
</body>
</html>
