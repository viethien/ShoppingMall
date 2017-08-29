<?php

require_once '../model/DAO.php';
require_once './definition_exception.php';

$pdo = new Database();
$pdo->connect();


//파일업로드 부분

  try{

    $title    = (empty($_POST['b_title']))?"":$_POST['b_title'];
    $writer   = (empty($_POST['b_writer']))?"":$_POST['b_writer'];
    $content  = (empty($_POST['b_content']))?"":$_POST['b_content'];

    if($title=="" || $writer=="" || $content=="" ){
        throw new EmptyValueException();
      }

    $upload_file = $_FILES['board_upload_file'];

    $upload_files="";  //업로드된 모든 파일을 text로 저장할 변수



        // var_dump($upload_file);

        // echo count($upload_file['name']);

        for($count = 0 ; $count < count($upload_file['name']) ; $count++){
          $file_name = $upload_file['name'][$count];
          $file_tmp_name = $upload_file['tmp_name'][$count];

          $upload_path = 'C:/xampp/htdocs/php/shopping_mall/file/free_board/';
          $upload_file_name = $upload_path.$file_name;  //해당경로에 해당이름으로 파일이 저장
          $file_path = $upload_path.$file_name."*";   // db에 들어갈 file의 경로 *는 explode하기위한 문자열

          $upload_files .= $file_path;    //모든 (파일의 경로+파일이름+*) 를 하나의 문자열에 합침.  //db에 실질적으로 들어갈 값

          move_uploaded_file($file_tmp_name,$upload_file_name);
        }


        //db에 들어가는 값
        //title,writer,contents,files,view
        $pdo->board_insert($title,$writer,$content,$upload_files,0);



        Header("Location:/php/shopping_mall/view/list.php?no=5");


  }catch(EmptyValueException $e){
    $e->printMessage();
  }


 ?>
