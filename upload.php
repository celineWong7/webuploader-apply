<?php
// https://github.com/zhangchengjin/webuploader-php-demo/blob/master/server/fileupload.php
// Only for POST method
// Make sure file is not cached (as it happens for example on iOS devices)

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
date_default_timezone_set('PRC'); // if happen Warning for date() , you can add this code.

// 2 minutes execution time
@set_time_limit(2 * 60);
$uploadDir = 'uploads';
$todayDir = $uploadDir.DIRECTORY_SEPARATOR.date('Ymd',time());

// Create upload dir
if (!file_exists($uploadDir)) {
    @mkdir($uploadDir);
}

// Create today dir
if(!file_exists($todayDir)){
    @mkdir($todayDir);
}

// Get file
$file = $_FILES["file"];
// var_dump($file);

$fileName = $todayDir.DIRECTORY_SEPARATOR.$file["name"];
move_uploaded_file($_FILES["file"]["tmp_name"],$fileName);

$src = '.'.DIRECTORY_SEPARATOR.$fileName;
// die('{"jsonrpc" : "2.0", "result" : "success", "src" : "'.$src.'"}');
die($src);

?>