<?php
/**
 * Created by PhpStorm.
 * User: hoya
 * Date: 2016-12-06
 * Time: 오전 2:14
 */
    session_start();
    unset($_SESSION['user_id']);

    echo "<script>
                alert('로그아웃 되었습니다');
                location.replace('../../index.php');
              </script>";
?>