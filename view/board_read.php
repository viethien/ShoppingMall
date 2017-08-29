<?php
require_once('./top.php');
require_once '../model/DAO.php';

$pdo = new Database();
$pdo->connect();

?>

  <div class="board_content">


<?php
      if(!isset($_GET['no'])){

      }else{

        $board_result =$pdo->show_select_board($_GET['no']);

        // echo "no :".$board_result['no']."<br>";
        // echo "title :".$board_result['title']."<br>";
        // echo "writer :".$board_result['writer']."<br>";
        // echo "time :".$board_result['time']."<br>";
        // echo "contents :".$board_result['contents']."<br>";
        // echo "view :".$board_result['view']."<br>";

        echo "<div class='board_no'>
                No . {$board_result['no']}
              </div>
              <div class='board_title'>
                {$board_result['title']}
              </div>
              <hr>
              <div class='board_info'>
                <label class='b_i_label'>작 성 자 : </label> {$board_result['writer']}<br>
                <label class='b_i_label'>날 &nbsp;&nbsp;&nbsp; 짜 : </label> {$board_result['time']}<br>
                <label class='b_i_label'>조 회 수 : </label> {$board_result['view']}<br><hr>
              </div>
              <div class='b_c_label'> CONTENTS </div><br>
              <div class='files'>
              첨부파일<br>
        ";

        //파일 다운로드 부분.

        $files = explode('*',$board_result['files']);
        $file_explode_count = count($files)-1;    //맨뒤에 공백값이 배열로 하나 들어가기때문.

        for($upload_count=0; $upload_count < $file_explode_count ; $upload_count++){

          if(file_exists($files[$upload_count])){ //파일이 있는가 없는가 확인.
            $file_name = explode('board/',$files[$upload_count]);
            $real_filename = $file_name[1];

            echo "<a href='/php/shopping_mall/controller/board_file_download.php?file={$real_filename}'>{$real_filename}</a>";
            echo " ".(filesize($files[$upload_count])/1000)."KB<br>";
          }else{}
        }
          echo "</div>   <!-- files end-->";
          echo "<div class='contents'>
                  {$board_result['contents']}
                </div>";

      }


      //조회수 올리는 부분.



?>

    </div>


<?php
require_once './bottom.php';
?>
