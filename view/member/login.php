<?php
/**
 * Created by PhpStorm.
 * User: hoya
 * Date: 2016-12-05
 * Time: 오후 11:30
 */

    require_once('../../model/check.php');

    $id = $_POST['id'];
    $pass = $_POST['pass'];
    $replaceURL = './login_form.php';

    $check = new Check();

    if($check->check_id($id) == 1) {

        if($check->check_pass($pass, $replaceURL) == 1) {
            $_SESSION['user_id'] = $id;

            echo "<script>
            location.replace('../../index.php');
          </script>";
        }
    } else {
        echo "<script>
                alert('아이디를 확인해주세요');
                location.replace('".$replaceURL."');
               </script>";

    }




?>
