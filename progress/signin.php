<?php
require_once('../inc/conn.php');
date_default_timezone_set('Europe/Istanbul');
session_start();
ob_start();

if(isset($_POST['loginuser'])){



  $username = htmlspecialchars($_POST['username']);
  $password = htmlspecialchars($_POST['password']);

  if(strlen($password)<8){
    header("Location:../home?stats=length");
    exit();
  }
  $password = md5($password);

  $cek=$db->prepare("select * from users where username=:username and password=:password");
  $cek->execute(array(
    'username' => $username,
    'password' => $password
  ));
  $veri_miktar=$cek->rowCount();

    if ($veri_miktar > 0) {
      $_SESSION['username']=$username;

      if(isset($_POST['redirect'])){
        header("Location:../".$_POST['redirect']);
      }else{
        header("Location:../index");
      }

    }else{
      header("Location:../home?stats=nf");
    }
}


 ?>
