<?php
require_once('./top.php');
require_once '../model/DAO.php';

$pdo = new Database();
$pdo->connect();
?>

<div class="board_write">
  <form enctype="multipart/form-data" method="post" action="/php/shopping_mall/controller/board_writer_controller.php">
    <div class="write_body">
      <div class="write_title">
         글작성
         <hr>
      </div>

      <div class="div_TR">
        <span class="span_TD_label">
          제목
        </span>
        <span class="span_TD_component">
          <input type="text" name="b_title" value="" size="60">
        </span>
        <hr>
      </div>

      <div class="div_TR">
        <span class="span_TD_label">
          작성자
        </span>
        <span class="span_TD_component">
          <input type="text" name="b_writer" value="" size="60">
        </span>
        <hr>
      </div>


      <div class="div_TR">
        <span class="span_TD_label">
          파일
        </span>
        <span class="span_TD_component">
          <!-- <input type="file" name="" id=""> -->
          <!--  files-upload 는 파일 다중 업로드 -->
          <input type="file" multiple name="board_upload_file[]">

        </span>
        <hr>
      </div>

      <div class="div_TR">
        <span class="span_TD_label">
          내용
        </span>
        <span class="span_TD_component">
          <textarea name="b_content" rows="20" cols="100"></textarea>

        </span>
      </div>

      <div class="product_write_bottom">
          <input type='submit' name='board_write' value='작성'>
      </div>
    </div>
  </form>

</div>




<?php
require_once './bottom.php';
?>
