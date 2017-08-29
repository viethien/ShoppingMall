<?php
/**
 * Created by PhpStorm.
 * User: bon
 * Date: 2016-12-02
 * Time: 오후 2:08
 */

    require_once('../../model/DAO.php');
    require_once('../../model/check.php');

    $id = $_POST['id'];
    $pass = $_POST['pass'];
    $member_name = $_POST['name'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone1']."-".$_POST['phone2']."-".$_POST['phone3'];
    $address = $_POST['address'];
    $email = $_POST['email1']."@".$_POST['email2'];

    $check = new Check();
    $check->check_overlap($id); //중복 여부확인 변수

    $db = new Database();
    $db->connect();
    $db->insert_member($id, $pass, $member_name, $address, $gender, $phone, $email);


    echo "<script>   
        alert('회원가입이 완료되었습니다');
        window.close();
      </script>";


?>


