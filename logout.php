<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 16/2/6
 * Time: 下午9:52
 */
session_start();
session_destroy();
echo "Log out successfully";
header("refresh:5;url=./login.php");
exit();
?>