<?php
require_once('./top.php');
 ?>

 <form enctype="multipart/form-data" name="" method="post" action="\php\shopping_mall\controller\product_write_controller.php">
   <div class="write_body">
     <div class="write_title">
        상품 등록
        <hr>
     </div>

     <div class="div_TR">
       <span class="span_TD_label">
         제목
       </span>
       <span class="span_TD_component">
         <input type="text" name="p_title" value="" size="60">
       </span>
       <hr>
     </div>

     <div class="div_TR">
       <span class="span_TD_label">
         상품명
       </span>
       <span class="span_TD_component">
         <input type="text" name="p_name" value="">
       </span>
       <hr>
     </div>


     <div class="div_TR">
       <span class="span_TD_label">
         상품 카테고리
       </span>
       <span class="span_TD_component">

         <select name="product_category" >
          <option> select </option>
 					<option> menu1 </option>
 					<option> menu2 </option>
 					<option> menu3 </option>
 					<option> menu4 </option>
 				</select>
        <!--  값이 넘어올때 게시판 이름도 hidden으로 같이 넘어온다($_POSt['type'])
              그러므로 어떤 메뉴에서 들어왔는가에 따라 default 메뉴값을 바꾸고자 하면
              javascript를 활용하여 해당되는 컴포넌트에 selected="selected" 속성을 추가할 것.  -->

       </span>
       <hr>
     </div>

     <div class="div_TR">
       <span class="span_TD_label">
         상품 수량
       </span>
       <span class="span_TD_component">
         <input type="text" name="p_stock" value="">
       </span>
       <hr>
     </div>

     <div class="div_TR">
       <span class="span_TD_label">
         가격
       </span>
       <span class="span_TD_component">
         <input type="text" name="p_price" value="">
       </span>
       <hr>
     </div>


     <div class="div_TR">
       <span class="span_TD_label">
         배송비
       </span>
       <span class="span_TD_component">
         <input type="text" name="p_deliver_price" value="">
       </span>
       <hr>
     </div>

     <div class="div_TR">
       <span class="span_TD_label">
         적립금
       </span>
       <span class="span_TD_component">
         <input type="text" name="p_point" value="">
       </span>
       <hr>
     </div>

     <div class="div_TR">
       <span class="span_TD_label">
         이미지
       </span>
       <span class="span_TD_component">
         <!-- <input type="file" name="" id=""> -->
         <!--  files-upload 는 파일 다중 업로드 -->
         <input type="file" multiple name="image_file[]">


       </span>
       <hr>
     </div>

     <div class="div_TR">
       <span class="span_TD_label">
         내용
       </span>
       <span class="span_TD_component">
         <textarea name="p_content" rows="20" cols="100"></textarea>

       </span>
     </div>

     <div class="product_write_bottom">
         <input type='submit' name='product_write' value='전송'>
     </div>
   </div>
 </form>



<?php
require_once './bottom.php';
 ?>
