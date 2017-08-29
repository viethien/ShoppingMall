<?php
/**
 * Created by PhpStorm.
 * User: bon
 * Date: 2016-12-05
 * Time: 오전 10:30
 */
//session start의 중복을 제거
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once('C:/xampp/htdocs/php/shopping_mall/model/DAO.php');

class Check {

    private $db;
    private $row;

    //session값의 유무에 따라 top을 수정
     public function check_session() {

        if(!isset($_SESSION['user_id'])) {
           echo
                "<ul>
                  <li><a href='/php/shopping_mall/view/member/login_form.php'>login</a></li>
                  <li><a onclick='join_open()'>join</a></li>
                  <li><a href='/php/shopping_mall/view/member/login_form.php'>mypage</a></li>
                  <li><a href='/php/shopping_mall/view/member/login_form.php'>cart</a></li>
                </ul>";
        } else {
            echo
                "<ul>
                  <li><a href='#'>".$_SESSION['user_id']."</a></li>
                  <li><a href='/php/shopping_mall/view/member/myPage_form.php'>myPage</a></li>
                  <li><a href='#'>cart</a></li>
                  <li><a href='/php/shopping_mall/view/member/logout.php'>logout</a></li>
                </ul>";
        }
    }

    private function dbObjCreate() {
        $this->db = new Database();
        $this->db->connect();
    }

    public function check_id($argId) {
        $this->dbObjCreate();
        $this->row = $this->db->select_member($argId);

        if(isset($this->row['id'])) {
            return true;
        } else {
            return false;
        }
    }

     public function check_pass($argPass, $replaceURL) {

         if($this->row['pass'] != $argPass) {
             echo "<script>
                alert('비밀번호가 틀렸습니다. 다시 작성해주세요');
                location.replace('".$replaceURL."');
               </script>";
         } else {
            return true;
         }

    }

    //중복 아이디 체크
    public function check_overlap($argId) {
        $bool = $this->check_id($argId);

        if($bool == 1) {
            echo "<script>
                    alert('아이디 중복이 있습니다');
                    location.replace('./join_form.php');
                  </script>";

        } else {

        }
    }

}
