<?php
$url_text =$_GET['url'];
$params = explode("/", $url_text);


// var_dump($params."<br>");
// var_dump($params[0]."<br>");

$webroot = $_SERVER['DOCUMENT_ROOT'];
$models = $webroot."/../app/";     //post.phpとuser.php２個有るけど区別できるのか？２つ書かないとではない？
$views = $webroot."/../resources/views/";

include($webroot."/../app/Http/Controllers/PostsController.php");
$postsController =new PostsController($models, $views); 

include($webroot."/../app/Http/Controllers/UsersController.php");
$usersController =new UsersController($models, $views); 

switch ($params[0]){
  
    case "":
      $postsController->index();
      break;
    case "create":
      $postsController->create();
    break;
    case "store":
      $postsController->store();
    break;
    case "show":
      $postsController->show($params[1]);
    break;
    case "edit":
      $postsController->edit($params[1]);
    break;
    case "update":
      $postsController->update($params[1]);
    break;
    case "destroy":
      $postsController->destroy($params[1]);
    break;
    case "top":
      $usersController->top();
    break;
    case "login":
      $usersController->login();
    break;
    case "logout":
      $usersController->logout();
    break;
    case "touroku":
      $usersController->touroku();
    break;
    case "form":
      $usersController->form();
    break;
    case "logon":
      $usersController->logon($params[1]);
    break;
}


