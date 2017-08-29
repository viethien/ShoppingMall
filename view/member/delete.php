<?php
/**
 * Created by PhpStorm.
 * User: bon
 * Date: 2016-12-06
 * Time: 오후 7:12
 */
    session_start();
    require_once ('../../model/check.php');
    require_once ('C:/xampp/htdocs/php/shopping_mall/model/DAO.php');
    $id = $_SESSION['user_id'];
    $pass = $_POST['pass'];
    $replaceURL = './myPage_form.php?mode=delete';

    $check = new Check();
    $db = new Database();
    $db->connect();

    if($check->check_id($id)) {
        if ($check->check_pass($pass, $replaceURL) == 1) {
            unset($_SESSION['user_id']);
            $db->delete_member($id);
            echo "<script>
                alert('회원 탈퇴되었습니다');
                location.replace('../../index.php');
              </script>";
        }
    }





