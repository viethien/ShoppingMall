<?php

require_once '../model/DAO.php';
require_once './definition_exception.php';

  $files_arr = array(); //파일을 임시저장할 배열

  //넘어오는 값 확인.초기화
try{
  //isset으로는 비교불가.값이 안넘어와도 빈값이 넘어간걸로 되어 isset은 true가된다
  $p_title          =(empty($_POST['p_title']))?"":$_POST['p_title'];
  $p_name           =(empty($_POST['p_name']))?"":$_POST['p_name'];
  $product_category =($_POST['product_category']=='select')?"":$_POST['product_category'];
  $p_stock          =(empty($_POST['p_stock']))?"":$_POST['p_stock'];
  $p_price          =(empty($_POST['p_price']))?"":$_POST['p_price'];
  $p_deliver_price  =(empty($_POST['p_deliver_price']))?"":$_POST['p_deliver_price'];
  $p_point          =(empty($_POST['p_point']))?"":$_POST['p_point'];
  $p_content        =(empty($_POST['p_content']))?"":$_POST['p_content'];

  // if(is_numeric($p_price) && is_numeric($p_deliver_price)){echo "됨";}
  // var_dump(is_numeric($p_price));
  // echo $p_title,$p_name,$product_category,$p_stock,$p_price,$p_deliver_price,$p_point,$p_content;


  if($p_title=="" || $p_name=="" || $product_category=="" || $p_price==""||
    $p_deliver_price=="" ||  $p_point=="" ||  $p_content=="" ){
      throw new EmptyValueException();
    }
  if(!is_numeric($p_stock) || !is_numeric($p_price) || !is_numeric($p_deliver_price)
    || !is_numeric($p_point)){
      throw new WrongTypeException();
    }

}catch(EmptyValueException $e){
  $e->printMessage();
}catch(WrongTypeException $e){
  $e->printMessage();
}

//파일 확인 부분.
//아무파일이 안들어가도 배열은 존재함으로. 0번째 인덱스 값 확인.



//db에 넣는 부분.
$pdo = new Database();
$pdo->connect();

$pdo->product_insert($p_title,$p_name,$product_category,$p_stock,$p_price,$p_deliver_price,$p_point,$p_content);


//금방 insert된 product의 아이디와 상품명을 통해 내림차순 정렬하여
//금방 업로드한 상품의 no값을 가져옴. 인덱스([0])로 접근해야함.
$product_no = $pdo->insert_product_select($p_title,$p_name);

if($_FILES['image_file']['tmp_name'][0]==""){
  //이미지가 없을경우 no_image_0.png파일을 출력하게끔 데이터를 삽입.
  //_0이 붙은 이유는 상품을 뿌려줄때
  // product_no_index.extension 에서 index가 0 인것과 product 테이블을 join하기때문.
  $pdo->image_insert($product_no[0],'no_image_0.png','png','0','C:/xampp/htdocs/php/shopping_mall/file/image/no_image.png');
}else{

  $file_count = count($_FILES['image_file']['tmp_name']);
  // echo "파일 개수 ={$file_count}<br>"; //배열 개수.

  // echo var_dump($_FILES['image_file']);

  for($i = 0; $i < $file_count ; $i++){

    //파일의 타입과 확장자를 가져와 type,extension으로 자른다.
    list($type,$extension) = explode("/",$_FILES['image_file']['type'][$i]);

    $file_name = "product_{$product_no[0]}_{$i}.".$extension;
    //파일 이름 명 규칙 product_(no)_(index).(extension)

    $tmp_file = $_FILES['image_file']['tmp_name'][$i];
    $file_size = $_FILES['image_file']['size'][$i];

    //한글도 되도록 인코딩. 사용x
    // $file_name = basename($_FILES['image_file']['name'][$i]);
    // $file_name = iconv('utf-8','cp949//TRANSLIT',$file_name);
    $file_path = 'C:/xampp/htdocs/php/shopping_mall/file/image/'; //파일 저장경로

    $upload_file = $file_path.$file_name; //이 이름으로 저장됨.

    //files_arr배열에 임시로 저장하고 이배열을 이용하여 DB에 저장.
    $files_arr[$i]['name'] = $file_name;
    $files_arr[$i]['extension'] = $extension;
    $files_arr[$i]['path'] = $upload_file;
    $files_arr[$i]['size'] = $file_size;

    move_uploaded_file($tmp_file,$upload_file);

  }
}
//파일(이미지) 업로드.
foreach ($files_arr as $file) {
  // echo $value['name']."<br>";
  // echo $value['path']."<br>";
  // echo $value['size']."<br>";
  $pdo->image_insert($product_no[0],$file['name'],$file['extension'],$file['size'],$file['path']);
}

//파일업로드 성공
// echo $_POST['product_category'];
$no = explode("menu",$_POST['product_category']);
// echo $no[1];
header('Location: http://112.165.72.190/php/shopping_mall/view/list.php?no='.$no[1]);







 ?>
