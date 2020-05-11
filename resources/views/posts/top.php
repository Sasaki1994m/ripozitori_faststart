<?php
session_start(); // セッション開始
?>
 
<!DOCTYPE html>
 
<html>
  <head>
    <title>PHPHacks</title>
    <meta charset="utf-8">
  </head>
  <body>
    <h1>メモアプリへようこそ！</h1>
 
    <?php
     if (isset($_SESSION['username'])) {
       echo('<p>ようこそ'.$_SESSION['username'].'さん</p>');
     }
    ?>
 
    <p><a href="/touroku">新規会員登録</a></p>
    <p><a href="/login">ログイン</a></p>
  </body>
</html>