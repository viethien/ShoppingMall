<?php
/**
 * Created by PhpStorm.
 * User: bon
 * Date: 2016-12-06
 * Time: 오전 10:26
 */
    session_start();

    $id = $_SESSION['user_id'];
    $pass = $_POST['pass'];
    $change_pass = $_POST['change_pass'];
    $change_pass_confirm = $_POST['change_pass_confirm'];
    $change_name = $_POST['change_name'];
    $change_gender = $_POST['change_gender'];
    $change_address = $_POST['change_address'];
    $change_phone = $_POST['change_phone1']."-".$_POST['change_phone2']."-".$_POST['change_phone3'];
    $change_email = $_POST['change_email1']."@".$_POST['change_email2'];
    $replaceURL = "./myPage_form.php";

    require_once ('C:/xampp/htdocs/php/shopping_mall/model/check.php');
    $check = new Check();

    require_once ('C:/xampp/htdocs/php/shopping_mall/model/DAO.php');
    $db = new Database();
    $db->connect();

    if($check->check_id($id) == 1) {
        if($check->check_pass($pass, $replaceURL) == 1) {
//            echo $id.$change_pass.$change_pass_confirm.$change_name.$change_gender.$change_phone.$change_address.$change_email;
            $db->modify_member($change_pass, $change_name, $change_gender, $change_address, $change_phone, $change_email, $id);
            echo "<script>
                    alert('회원정보가 수정되었습니다\\n다시 로그인해주세요');
                   </script>";
            unset($_SESSION['user_id']);
            echo "<script>
                    location.replace('../../index.php');
                  </script>";
        }
    }


