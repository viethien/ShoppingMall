<?php

require_once '../list_layout.php';

class board extends List_layout{


  public $product_type = "board";
  public $product_no = 5;

  function show_info(){
    // echo $this->product_type;
    echo "<div class='menu_info'>
            <div class='menu_title'>{$this->product_type}</div>
            <div class='menu_content'>
            나는야 자유 게시판 <br>
            </div>
          </div>
          ";
  }

  function show_product_sub_menu(){}


  function show_product(){}



}





 ?>
