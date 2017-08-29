<?php

$real_filename = $_GET['file'];
$file_dir = 'C:/xampp/htdocs/php/shopping_mall/file/free_board/';


header('Content-Type: application/x-octetstream');
header('Content-Length: '.filesize($file_dir.$real_filename));   //파일의 경로 로 사이즈를 알수있음.
header('Content-Disposition: attachment; filename='.$real_filename);
header('Content-Transfer-Encoding: binary');

$fp = fopen($file_dir.$real_filename, "r");
fpassthru($fp);
fclose($fp);


echo "<script>history.back()</script>";
 ?>
