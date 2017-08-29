
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>홈페이지</title>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

      <!-- bootstrap 3.3.7버전은 jquery 1.9.1이상의 버전을 요구함. -->

      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

      <!-- Optional theme -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

      <!-- Latest compiled and minified JavaScript -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

      <!-- DEVICON  -->
      <link rel="stylesheet" href="https://cdn.rawgit.com/konpa/devicon/master/devicon.min.css">

      <!-- 직접정의한 css -->
      <!-- <link rel="stylesheet" href="./public/main.css"> -->
      <link rel="stylesheet" href="/php/shopping_mall/public/main.css">
      <!-- <link rel="stylesheet" href="./public/write.css"> -->
      <link rel="stylesheet" href="/php/shopping_mall/public/write.css">
      <!-- <link rel="stylesheet" href="./public/board.css"> -->
      <link rel="stylesheet" href="/php/shopping_mall/public/board.css">
      <!-- <link rel="stylesheet" href="./public/product_buy.css"> -->
      <link rel="stylesheet" href="/php/shopping_mall/public/product_buy.css">
      <!-- <link rel="stylesheet" href="./public/login.css"> -->
      <link rel="stylesheet" href="/php/shopping_mall/public/login.css">
      <!-- <link rel="stylesheet" href="./public/join.css">  실제로는 modify에서쓰임-->
      <link rel="stylesheet" href="/php/shopping_mall/public/join.css">
      <!-- <link rel="stylesheet" href="./public/my_page.css">  -->
      <link rel="stylesheet" href="/php/shopping_mall/public/my_page.css">


      <!-- 메뉴고정 js 파일-->
      <script src="/php/shopping_mall/public/menu.js"></script>
      <!-- background 주기적 변경하는 js 파일 -->
      <script src="/php/shopping_mall/public/background.js"></script>


  </head>
<body>
  <div id="header">

      <!-- Nav -->
      <div id="title">

        <div id="title_logo">
          SOFSYS
        </div>

        <div id="title_right">

          <nav id="user_nav">
            <?php
              require_once ('C:/xampp/htdocs/php/shopping_mall/model/check.php');
              $check = new check();
              $check->check_session();
            ?>
          </nav>
          <nav id="menu_nav">
            <ul>
              <li><a href="/php/shopping_mall/index.php">Home</a></li>
              <li><a href="/php/shopping_mall/view/list.php?no=1">위더스</a></li>
              <li><a href="/php/shopping_mall/view/list.php?no=2">소프시스</a></li>
              <li><a href="/php/shopping_mall/view/list.php?no=3">스칸</a></li>
              <li><a href="/php/shopping_mall/view/list.php?no=4">menu4</a></li>
              <li><a href="/php/shopping_mall/view/list.php?no=5">board</a></li>

            </ul>
          </nav>

        </div>
      </div>


      <!-- Inner -->

  </div>



  <!--  회원가입 window open-->
    <script>

      function join_open() {
        window.open(
            "/php/shopping_mall/view/member/join_form.php",
            "회원가입",
            "width=800,height=650,scrollbars=no,resizeable=no "
        );
      }

    </script>
