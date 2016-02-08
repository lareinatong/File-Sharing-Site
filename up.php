<?php
session_start();
$upLoadDir="/home/lareinatong/files/".$_SESSION['username']."/"; //为目录变量指定目录位置
$upLoadError=$_FILES['upLoad']['error'];
$fileName=$_FILES['upLoad']['name'];
$fileTemName=$_FILES['upLoad']['tmp_name'];
$fileSize=$_FILES['upLoad']['size'];
$newName=$_POST['newName'];
echo $newName;
function upLoad(){
    global $upLoadDir,$upLoadError,$fileName,$fileTemName,$fileSize,$fileSuffix,$newName;
    if($newName){ //如果需要被更新文件名
        $fileReName=$newName.".".pathinfo($fileName,PATHINFO_EXTENSION); //采用新文件名+获取文件名后缀
    }else{ //如果不需要更新文件名
        $fileReName=$fileName; //定义文件存储位置，并在文件名前加一组随机数字
    }
    if($upLoadError>0){ //0表示没有错误发生，文件上传成功
        echo"error：";
        switch($upLoadError){
            case 1:echo"Upload a file over the configuration file specified value.";break; //1表示上传的文件超过了php.ini中upload_max_filesize选项限制的值
            case 2:echo"Upload a file over the form contract value.";break; //2表示上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值。
            case 3:echo"The file is incomplete";break; //3表示文件只有部分被上传。
            case 4:echo"There is no file.";break; //4表示没有文件被上传。
        }
    }else{
        if(is_uploaded_file($fileTemName)){ //确认文件通过HTTP POST上传
            //move_uploaded_file($fileTemName,($upLoadDir.$fileReName));
            echo "temp: ".$fileTemName;
            if(!move_uploaded_file($fileTemName,($upLoadDir.$fileReName))){ //如果无法将上传的文件移动到新位置
                echo"Failed，please upload again。";
            }else{ //否则返回成功信息
            //echo "path: ".$upLoadDir.$fileReName;
            echo"upload successful！<br>".date("Y-m-d H:i:s")."<br>上传文件：".$fileReName."<br>文件大小：".number_format(($fileSize/1024/1024),2)."Mb"."<br>重命名为：".$fileReName;
           }
        }else{ //如果不是通过HTTP POST方式上传，则提示非法信息
            echo"File".$fileReName."is illegal！";
        }
    }
}
if(!empty($fileName)){
    if(is_dir($upLoadDir)){ //如果目录存在
        upLoad(); //则执行上传流程
    }else{ //如果目录不存在
        mkdir($upLoadDir); //则创建目录
        upLoad(); //再执行上传流程
    }
}else {
    echo "Please select the file you want to upload.";
}
echo '<br><input type="button" value="Back" onclick="location.href=\'mainpage.php\'" />';
?>