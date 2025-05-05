<?php

session_start();

require "includes/functions.php";

$path = $_SERVER["REQUEST_URI"];

switch ($path) {

  case '/dashboard':
    require "pages/dashboard.php";
    break;

  case '/login':
    require "pages/login.php";
    break;
  
  case '/logout':
    require "pages/logout.php";
     break;
  
  case '/post':
    require "pages/post.php";
    break;

  case '/signup':
    require "pages/signup.php";
    break;
    
  case '/posts/add':
    require "includes/posts/manage_posts_add.php";
    break;

  case '/posts/edit':
    require "includes/posts/manage_posts_edit.php";
    break;

   case '/posts/manage':
    require "includes/posts/manage_posts.php";
    break;

  case '/users/add':
    require "includes/users/manage_users_add.php";
    break;

  case '/users/edit':
    require "includes/users/manage_users_edit.php";
    break;

  case '/users/changepwd':
    require "includes/users/manage_users_changepwd.php";
    break;

  case '/users/manage':
    require "includes/users/manage_users.php";
    break;
    
  case '/auth/login':
    require "includes/auth/do_login.php";
    break;
    
  case '/auth/signup':
    require "includes/auth/do_signup.php";
    break;
  
  default:
    require "pages/home.php";
    break;
};

?>