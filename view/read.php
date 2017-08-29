<?php
require_once('./top.php');
require_once '../model/DAO.php';


// echo $_GET['no'];

$pdo = new Database();
$pdo->connect();

//선택된 상품 정보
$product = $pdo->show_select_product_select($_GET['no']);
$product_images = $pdo->show_select_product_images($_GET['no']);

// var_dump($product);


?>


<div class="read_wrapper">
  <div class="read_header">

    <div class="read_image">
      <img src='/php/shopping_mall/file/image/product_<?=$_GET['no']?>_0.jpeg'>
    </div>
    <div class="read_product_info">

   <form class="buy_product_info" action="./product_buy.php" method="post">        <!--  buy form -->

      <div class="div_TR">
        <span class="span_TD_label">
          상품 번호
        </span>
        <span class="span_TD_component">
          <?=$product['no']?>
        </span>
        <hr>
      </div>

      <div class="div_TR">
        <span class="span_TD_label">
          타이틀
        </span>
        <span class="span_TD_component">
          <?=$product['title']?>&nbsp;
        </span>
        <hr>
      </div>

      <div class="div_TR">
        <span class="span_TD_label">
          상품명
        </span>
        <span class="span_TD_component">
          <?=$product['product_name']?>
        </span>
        <hr>
      </div>

      <div class="div_TR">
        <span class="span_TD_label">
          수량
        </span>
        <span class="span_TD_component">
          <input type="text" name="product_count" size="5" value="1">
        </span>
        <hr>
      </div>

      <div class="div_TR">
        <span class="span_TD_label">
          가격
        </span>
        <span class="span_TD_component">
          <?=$product['price']?>
        </span>
        <hr>
      </div>

      <div class="div_TR">
        <span class="span_TD_label">
          적립금
        </span>
        <span class="span_TD_component">
          <?=$product['point']?>
        </span>
        <hr>
      </div>

      <div class="div_TR">
        <span class="span_TD_label">
          옵션1
        </span>
        <span class="span_TD_component">
          알아서 하시오
        </span>
        <hr>
      </div>


      <div class="read_product_controll">

          <input type="hidden" name="product_no" value="<?=$product['no']?>">
          <input type="hidden" name="product_title" value="<?=$product['title']?>">
          <input type="hidden" name="product_name" value="<?=$product['product_name']?>">
          <!-- 상품 개수는 위에서 보냄. -->
          <input type="hidden" name="product_price" value="<?=$product['price']?>">
          <input type="hidden" name="product_point" value="<?=$product['point']?>">
          <input type="hidden" name="product_deliver_price" value="<?=$product['deliver_price']?>">

          <input type="submit" class="product_buy_button" value="Buy">

      </form>

        <form class="" action="index.html" method="post">
          <input type="hidden" name="product_price" value="<?=$product['price']?>">
          <input type="submit" class="product_buy_button" value="cart">
        </form>

        <form class="" action="index.html" method="post">
          <input type="submit" class="product_buy_button" value="Wish List">
        </form>
        <!-- <button type="button" name="buy" class="read_product_button">Buy</button>
        <button type="button" name="add_cart" class="read_product_button">Cart</button>
        <button type="button" name="add_wish_List" class="read_product_button">Wish List</button> -->
      </div>


  </div>
  </div>
<div class="read_body">
  <div class="read_body_title">
    <hr>
    <div class="r_b_t_label">
      PRODUCT INFO
    </div>
  </div>

  <?php
      for($i = 1 ; $i < count($product_images) ; $i ++){
        echo "<img src='/php/shopping_mall/file/image/product_{$product['no']}_{$i}.jpeg'><br>";
      }
  ?>
  <!-- <img src='/php/shopping_mall/file/image/product_<?=$_GET['no']?>_1.jpeg'> -->

</div>
</div>




<?php
require_once './bottom.php';
?>
