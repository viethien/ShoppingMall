<?php
/**
 * Created by PhpStorm.
 * User: bon
 * Date: 2016-12-05
 * Time: 오전 10:36
 */

    require_once('C:/xampp/htdocs/php/shopping_mall/list_layout.php');
    require_once('../top.php');

    $login_layout = new Login_layout();
    $login_layout->draw_loginLayout();

    require_once('../bottom.php');
