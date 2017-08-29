<?php
session_start();

$product_no = $_POST['product_no'];
$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];
$product_count = $_POST['product_count'];

$user_id = $_SESSION['user_id'];  //현재 로그인중인 유저

require_once '../model/DAO.php';

$pdo = new Database();
$pdo->connect();

$pdo->product_sell($product_no,$product_count); //상품의 재고량을 감소시킴.

$pdo->product_order_list_add($user_id,$product_name,$product_price,$product_count);

echo "<script>
        alert('상품을 구입하셨습니다.');
        location.href='../index.php';
      </script>";


 ?>
