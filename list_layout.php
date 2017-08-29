<?php

require_once 'C:/xampp/htdocs/php/shopping_mall/model/DAO.php';

abstract class List_layout{

  //게시판의 상품타입
  public $product_type='';
  public $product_no;


  //레이아웃 출력
  function show_layout(){
      echo "<div class='container'>"; //add_product 마지막에서 div닫을것.
  }



  //게시판별 정보 출력
  abstract function show_info();  //각자 원하는형태로 구현.

  //정렬 등과같은 메뉴 컴포넌트
  function show_product_sub_menu(){
    echo "<hr><div class='sub_menu'>
                <div class='wrapper_menu'>";

    //매니저일 조건
    if(!isset($_SESSION['user_id'])){

    }else{
      if($_SESSION['user_id'] == 'admin'){
        //글작성을 누르면 write.php로
        //hidden값으로 현재 product_type이 넘어간다.
        echo "<div class='manager_menu'>
              <form class='' action='product_write.php' method='GET'>
                <input type='submit' value='상품등록'>
                 <input type='hidden' name='type' value='{$this->product_type}'>
              </form>
              </div>";
      }
    }

      echo "    <div class='user_menu'>
                <form class='' action='list.php?no={$this->product_no}' method='POST'>
                  <input type='submit' name='sort_type' value='인기상품'>
                  <input type='submit' name='sort_type' value='높은가격'>
                  <input type='submit' name='sort_type' value='낮은가격'>
                  <input type='submit' name='sort_type' value='신상품'>
                </form>
                </div>
              </div>    <!--wrapper end-->
            </div><hr>  <!-- sub_menu end-->";
  }

  //상품 추가 게시판애서 상품을 보여줌
  function show_product($arg_sort_type,$arg_order_type){

    // $sort_type = $arg_sort_type;

    $pdo = new Database();
    $pdo->connect();

    $products = $pdo->show_product_select($this->product_type,$arg_sort_type,$arg_order_type);

    // echo var_dump($products);



    foreach ($products as $product) {

      //number_format으로 가격을저장.
      // 소수점이 찍힘.
      $product_price = number_format($product['price']);

      echo "<div class='wrapper'>
        <div class='img'>
        <a href='/php/shopping_mall/view/read.php?no={$product['no']}'>
          <img src='/php/shopping_mall/file/image/{$product['image_name']}'></a>
        </a>
        </div>
        <div class='title'>
        <a href='/php/shopping_mall/view/read.php?no={$product['no']}'>
          {$product['title']}
        </a>
        </div>
        <div class='price'>
        <a href='/php/shopping_mall/view/read.php?no={$product['no']}'>
          {$product_price}
        </a>
        </div>
        <div class='tag'></div>
        </div>";
    }
    echo "</div>";  //show_layout에서 container div닫는 거
  }

  //자유게시판에서 사용됨. list에서 불러짐으로
  //다른 게시판 객체에서는 빈값으로 오버라이딩.
  function show_board(){

    echo "<div class='wrapper_board'>

          <div class='board_sub_menu'>

            <button onclick='location.href=\"/php/shopping_mall/view/board_write.php\"'>글쓰기</button>

          </div>

            <table class='wrapper_table'>
            <tr class='board_title_label'>
              <td class='board_no_TD'>no</td>
              <td class='board_title_TD'> 제 목 </a></td>
              <td class='board_writer_TD'>작성자</td>
              <td class='board_date_time_TD'>날 짜</td>
              <td class='board_view_TD'>조회수</td>
            </tr>";


    $pdo = new Database();
    $pdo->connect();

    if(!isset($_GET['page_num'])){
      $_GET['page_num'] = 0;
    }
    $page = $_GET['page_num'];
    $boards = $pdo->show_board($page); //페이지에 맞는 게시글 불러오는 함수.

    foreach ($boards as $board) {
      echo "<tr class>
              <td class='board_no_TD'>{$board['no']}</td>
              <td class='board_title_TD'><a href='./board_read.php?page_num={$_GET['page_num']}&no={$board['no']}'>{$board['title']}</a></td>
              <td class='board_writer_TD'>{$board['writer']}</td>
              <td class='board_date_time_TD'>{$board['time']}</td>
              <td class='board_view_TD'>{$board['view']}</td>
            </tr>";
    }

    echo "</table>";

    $board_count = $pdo->board_count();  //총 게시물 수.
    $page_count = ceil($board_count['count']/10);  //총만들어야하는 page의 수. ceil() 무조건 올림.

    echo "<div class='page_num'>";
    for($i= 0; $i < $page_count ; $i++ ){
      echo "<a href=/php/shopping_mall/view/list.php?no=5&page_num={$i}>$i</a> | ";
    }
    echo "</div>";
  }


}


class Join_layout extends List_layout {

  function show_info() {

  }

  public function draw_joinLayout() {

    echo "<form action='join.php' method='post' name='join_form' id='join_form'>

      <div class='join_div'>

      <h3>기본 정보</h3>

      <table class='join_table'>
          <tr>
            <td class='join_table_label'>아이디<span class='star_mark'> *</span></td>
            <td>
              <input type='text' class='input_medium' name='id' maxlength='16'>아이디를 입력해 주세요. (영문소문자/숫자, 4~16자)
            </td>
          </tr>
          <tr>
            <td>비밀번호<span class='star_mark'> *</span></td>
            <td>
              <input type='password' class='input_medium' name='pass'>(영문 대소문자/숫자/특수문자,  10자~16자)
            </td>
          </tr>
          <tr>
            <td>비밀번호 확인<span class='star_mark'> *</span></td>
            <td>
              <input type='password' class='input_medium' name='pass_confirm'>
              <input type='button' class='pass_confirm_btn' value='확 인' onclick='passConfirm_check()'>
            </td>
          </tr>
          <tr>
            <td>이름<span class='star_mark'> *</span></td>
            <td><input type='text' class='input_medium' name='name'></td>
          </tr>
          <tr>
            <td>성별<span class='star_mark'> *</span></td>
            <td>
              <input type='radio' name='gender' value='male'> 남
              <input type='radio' name='gender' value='female'> 여
            </td>
          </tr>
          <tr>
            <td>주소<span class='star_mark'> *</span></td>
            <td><input type='text' class='input_large' name='address'></td>
          </tr>
          <tr>
            <td>전화번호<span class='star_mark'> *</span></td>
            <td>
              <input type='text' class='input_small' value='010' name='phone1'> -
              <input type='text' class='input_small' name='phone2' maxlength='4'> -
              <input type='text' class='input_small' name='phone3' maxlength='4'>
            </td>
          </tr>
          <tr>
            <td>메일<span class='star_mark'> *</span></td>
            <td>
              <input type='text' class='input_medium' name='email1' id='email1'> @
              <select name='email2' id='select_box'>
                <option value='naver.com'>네이버</option>
                <option value='gmail.com'>구글</option>
                <option value='daum.net'>다음</option>
              </select>
            </td>
          </tr>
      </table>

      <div class='join_button'>
          <input type='button' value='가입' onclick='check_input()'>
          <input type='button' value='취소' onclick='reset_value()'>
      </div>

      </div>
    </form>";

    echo "</div>";  //show_layout에서 container div닫는 거
  }
}

class Login_layout extends List_layout {
  function show_info() {

  }

  function draw_loginLayout() {


    echo "<form action='login.php' method='post' name='join_form' id='join_form'>

      <div class='login_wrapper'>
          <div id='login_title'>
            L O G I N
          </div>

          <div class='login_form_wrapper'>

            <div id='login_id'>
              <div class='log_label'>Login id </div>
              <input type='text' name='id' >
            </div>

            <div id='login_pass'>
              <div class='log_label'>Login password </div>
              <input type='password' name='pass' >
            </div>

          </div>

          <div id='login_button'>
            <input type='submit' value='로그인'>
            <input type='button' name='join' value='회원가입' onclick='join_open()'>
          </div>

      </div>
    </form>";

    echo "</div>"; //show_layout에서 container div닫는 거
  }

}

class MyPage_layout extends List_layout {

  function show_info() {

  }

  function draw_myPageLayout($argName, $argPoint) {

    echo"<div class='my_page_wrapper'>

        <div class='my_page_title'>
          MY PAGE
        </div>
        <div class='my_page_nav'>


          <div class='my_page_nav_button'>
            <a href='./myPage_form.php?mode=info'>
              <div class='my_page_nav_btn_text'>
                <h3>USER INFO</h3>
                <h5>(회원 정보)</h5>
                <h6>회원이신 고객님의 개인정보를 관리하는 공간입니다.</h6>
              </div>
            </a>
          </div>
          <div class='my_page_nav_button'>
            <a href='./myPage_form.php?mode=cart'>
              <div class='my_page_nav_btn_text'>
                <h3>ORDER</h3>
                <h5>(주문내역 조회)</h5>
                <h6>주문하신 상품의 주문내역을 확인하실 수 있습니다.</h6>
              </div>
            </a>
          </div>
          <div class='my_page_nav_button'>
            <a href='./myPage_form.php?mode=delete'>
              <div class='my_page_nav_btn_text'>
                <h3>USER WITHDRAW</h3>
                <h5>(회원탈퇴)</h5>
                <h6>회원 탈퇴를 하실 수 있습니다.</h6>
              </div>
            </a>
          </div>
        </div>";
  }

  function draw_mode_modify($id, $member_name, $address, $phone, $email) {


    echo "<form action='modify.php' method='post' name='modify_form' class='modify_form'>

      <div class='join_div'>

      <div class='join_div_title'>회원정보 확인 및 수정</div>

      <table class='join_table'>
          <tr>
            <td class='join_table_label'>아이디<span class='star_mark'> *</span></td>
            <td>
              <input type='text' class='input_medium' name='id' value={$id} readonly>
            </td>
          </tr>
          <tr>
            <td>현재 비밀번호<span class='star_mark'> *</span></td>
            <td>
              <input type='password' class='input_medium' name='pass'>
            </td>
          </tr>
          <tr>
            <td>변경 비밀번호<span class='star_mark'> *</span></td>
            <td>
              <input type='password' class='input_medium' name='change_pass'>
            </td>
          </tr>
          <tr>
            <td>비밀번호 확인<span class='star_mark'> *</span></td>
            <td>
              <input type='password' class='input_medium' name='change_pass_confirm'>
            </td>
          </tr>
          <tr>
            <td>이름<span class='star_mark'> *</span></td>
            <td><input type='text' class='input_medium' name='change_name' value='{$member_name}'></td>
          </tr>
          <tr>
            <td>성별<span class='star_mark'> *</span></td>
            <td>
              <input type='radio' name='change_gender' value='male'> 남
              <input type='radio' name='change_gender' value='female'> 여
            </td>
          </tr>
          <tr>
            <td>주소<span class='star_mark'> *</span></td>
            <td><input type='text' class='input_large' name='change_address' value='{$address}'></td>
          </tr>
          <tr>
            <td>전화번호<span class='star_mark'> *</span></td>
            <td>
              <input type='text' class='input_small' value='010' name='change_phone1'> -
              <input type='text' class='input_small' name='change_phone2' maxlength='4'> -
              <input type='text' class='input_small' name='change_phone3' maxlength='4'>
            </td>
          </tr>
          <tr>
            <td>메일<span class='star_mark'> *</span></td>
            <td>
              <input type='text' class='input_medium' name='change_email1' id='email1'> @
              <select name='change_email2' id='select_box'>
                <option value='naver.com'>네이버</option>
                <option value='gmail.com'>구글</option>
                <option value='daum.net'>다음</option>
              </select>
            </td>
          </tr>
      </table>

      <div class='modify_button'>
          <input type='button' value='수정' onclick='modify_check_input()'>
          <input type='button' value='취소' onclick='modify_reset_value()'>
      </div>

      </div>
    </form>
    </div> <!-- my_page_wrapper end --> ";



    echo "</div>";  //show_layout에서 container div닫는 거
  }

  function draw_mode_delete() {
    echo "<form action='delete.php' method='post' name='delete_form' class='delete_form'>
            <div class='delete_wrap'>
                <p class='mode_title'>회원탈퇴</p><hr>
                <div>
                    비밀번호
                    <span class='pass_box'><input type='password' name='pass'></span>
                </div><hr>
                <div>
                    비밀번호 확인
                    <span class='pass_box'><input type='password' name='pass_confirm'></span>
                </div><hr>
                <div>
                    <input type='button' value='확인' onclick='delete_passConfirm_check()'>
                </div><hr>
            </div>
          </form>";
    echo "</div>";  //show_layout에서 container div닫는 거
  }

  function draw_mode_cart() {
    echo " <div class='cart_wrap'>
              <p class='mode_title'>주문 내역 조회</p><hr>";
              $pdo = new Database();
              $pdo->connect();
              $result = $pdo->order_list($_SESSION['user_id']);

    echo "<table>
            <tr>
              <td>상품이름</td>
              <td>가격</td>
              <td>개수</td>
              <td>날짜</td>
            </tr>";

  foreach($result as $value){
    echo "  <tr>
              <td>{$value['product_name']}</td>
              <td>{$value['price']}</td>
              <td>{$value['count']}</td>
              <td>{$value['time']}</td>
            </tr>";
          }


    echo "</table>
          </div>
        </div>"; //show_layout에서 container div닫는 거
  }
}










 ?>
