<?php

require_once '../list_layout.php';

class Menu3 extends List_layout{

  public $product_type = 'menu3';
  public $product_no = 3;

  function show_info(){
    // echo $this->product_type;
    echo "<div class='menu_info'>
            <div class='menu_title'>{$this->product_type}</div>
            <div class='menu_content'>
            절대 포기하지 말라. 당신이 되고 싶은 무언가가 있다면, <br>
            그에 대해 자부심을 가져라. 당신 자신에게 기회를 주어라. 스스로가 형편없다고 생각하지 말라.<br>
            그래봐야 아무 것도 얻을 것이 없다. 목표를 높이 세워라.인생은 그렇게 살아야 한다. <br>
            - 마이크 맥라렌
            </div>
          </div>
          ";
  }
  function show_board(){}
}




 ?>
