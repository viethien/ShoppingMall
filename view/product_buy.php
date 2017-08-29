<?php
require_once('./top.php');
require_once '../model/DAO.php';

//
// echo $_POST['product_no']."<br>";
// echo $_POST['product_title']."<br>";
// echo $_POST['product_name']."<br>";
// echo $_POST['product_price']."<br>";
// echo $_POST['product_point']."<br>";
// echo $_POST['product_deliver_price']."<br>";

// product_deliver_price

//=======================로그인 하였는가? 검사 ===========================

if(empty($_SESSION['user_id'])){
  // $log_id = ""; //잠깐동안 에러뜨기때문에 빈값으로 초기화.
  echo "<script>
          alert('로그인 전용 기능입니다.');
          history.back();
        </script>";
}else{

  $log_id = $_SESSION['user_id'];

  $pdo = new Database();
  $pdo->connect();

  $user_result = $pdo->select_member($log_id);

  ?>

  <div class="product_buy_info">

    <div class="product_buy_label"> | 주문할 상품</div>

    <table class="p_buy_info_table">
      <thead>
        <tr>
          <td class="p_buy_img"></td>
          <td class="p_buy_title">구입 상품명</td>
          <td class="p_buy_count">수량</td>
          <td class="p_buy_price">상품 금액</td>
          <td class="p_buy_point">적립금</td>
          <td class="p_buy_deliver_price">배송비</td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="p_buy_img"><img src="/php/shopping_mall/file/image/product_<?=$_POST['product_no']?>_0.jpeg"></td>
          <td class="p_buy_title"><?=$_POST['product_title']."<br>".$_POST['product_name']?></td>
          <td class="p_buy_count"><?=$_POST['product_count']?></td>
          <td class="p_buy_price"><?=$_POST['product_price']?></td>
          <td class="p_buy_point"><?=$_POST['product_point']?></td>
          <td class="p_buy_deliver_price"><?=$_POST['product_deliver_price']?></td>
        </tr>
      </tbody>
    </table>

    <div class="product_buy_label"> | 주문 상품 결제금액</div>

    <table class="p_buy_price_info_table">
      <thead>
        <tr>
          <td class="p_buy_p_price">상품 금액</td>
          <td class="p_buy_p_plus"> </td>
          <td class="p_buy_p_deliver">배송비</td>
          <td class="p_buy_p_plus"> </td>
          <td class="p_buy_p_discount">할인금액</td>
          <td class="p_buy_p_plus"> </td>
          <td class="p_buy_p_additional">추가금액</td>
          <td class="p_buy_p_plus"> </td>
          <td class="p_buy_p_total_price">결제 예정금액</td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="p_buy_p_price"><?=$_POST['product_price']?></td>
          <td class="p_buy_p_plus"> + </td>
          <td class="p_buy_p_deliver"><?=$_POST['product_deliver_price']?></td>
          <td class="p_buy_p_plus"> + </td>
          <td class="p_buy_p_discount"> 0 </td>
          <td class="p_buy_p_plus"> + </td>
          <td class="p_buy_p_additional"> 0 </td>
          <td class="p_buy_p_plus"> + </td>
          <td class="p_buy_p_total_price"><?=$_POST['product_price']*$_POST['product_count']?> </td>
        </tr>
      </tbody>
    </table>

    <hr>

  </div>


  <div class="product_buy_user_info">

    <div class="product_buy_label"> | 주문자 정보</div>


    <div class="div_TR">
      <span class="span_TD_label">
        이름
      </span>
      <span class="span_TD_component">
        <?=$user_result['member_name'] ?>
      </span>
      <hr>
    </div>

    <div class="div_TR">
      <span class="span_TD_label">
        연락처
      </span>
      <span class="span_TD_component">
        <?=$user_result['phone'] ?>
      </span>
      <hr>
    </div>

    <div class="div_TR">
      <span class="span_TD_label">
        주소
      </span>
      <span class="span_TD_component">
        <?=$user_result['address'] ?>
      </span>
      <hr>
    </div>

    <div class="div_TR">
      <span class="span_TD_label">
        연락메세지
      </span>
      <span class="span_TD_component">
        <textarea name="send_message" rows="3" cols="60" value=""></textarea>
      </span>
      <hr>
    </div>

  </div>

  <div class="product_payment_button">
    <form action="../controller/product_buy_controller.php" method="post">

      <input type="hidden" name="product_no" value="<?=$_POST['product_no']?>">
      <input type="hidden" name="product_name" value="<?=$_POST['product_name']?>">
      <input type="hidden" name="product_price" value="<?=$_POST['product_price']?>">
      <input type="hidden" name="product_count" value="<?=$_POST['product_count']?>">

      <input type="submit" name=""  value="구매하기">
    </form>

  </div>


<?php

 }  //if..else end
require_once './bottom.php';
 ?>
