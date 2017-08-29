<?php


switch($_GET['no']){
  case 1:
    require_once './list/menu1.php';
    require_once './top.php';
    $list = new Menu1();
  break;

  case 2:
    require_once './list/menu2.php';
    require_once './top.php';
    $list = new Menu2();
  break;

  case 3:
    require_once './list/menu3.php';
    require_once './top.php';
    $list = new Menu3();
  break;

  case 4:
    require_once './list/menu4.php';
    require_once './top.php';
    $list = new Menu4();
  break;

  case 5:
    require_once './list/board.php';
    require_once './top.php';
    $list = new board();
  break;
}



$list->show_layout();
$list->show_info();

$list->show_product_sub_menu();   //매니져일경우 조건추가.
$list->show_board();  //자유게시판 불러옴.
                      //다른 게시판은 빈값으로 오버라이딩되어있음.

//원하는 정렬방식으로 상품을 show
//sort_type이 안넘어오면 time을 기준으로 show
if(!isset($_POST['sort_type'])){
  $list->show_product('time','desc');
}else{
  $order_type = 'desc';   //default 내림차순

  if($_POST['sort_type']=='인기상품'){ $sort_type = 'view';}
  if($_POST['sort_type']=='높은가격'){ $sort_type = 'price';}
  if($_POST['sort_type']=='낮은가격'){ $sort_type = 'price'; $order_type='asc';}
  if($_POST['sort_type']=='신상품'){ $sort_type = 'time';}

  $list->show_product($sort_type,$order_type);
}


require_once './bottom.php';


 ?>
