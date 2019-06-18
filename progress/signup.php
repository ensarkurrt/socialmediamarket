<?php
require_once('../inc/conn.php');
date_default_timezone_set('Europe/Istanbul');
session_start();
ob_start();

function generateToken(){
  $token = openssl_random_pseudo_bytes(16);
  $token = bin2hex($token);
  return $token;
}

if(isset($_POST['newuser'])){

  if(!isset($_POST['checked'])){
    header("Location:../signup?stats=check");
    exit();
  }


  $username = htmlspecialchars($_POST['username']);
  $password_one = htmlspecialchars($_POST['password_one']);
  $password_two = htmlspecialchars($_POST['password_two']);
  $mail = htmlspecialchars($_POST['mail']);
  $phone = htmlspecialchars($_POST['phone']);

  if($password_one == $password_two){

    if(strlen($password_one)<8){
      header("Location:../signup?stats=length");
      exit();
    }

    $cek=$db->prepare("select * from users where mail=:mail");
    $cek->execute(array(
      'mail' => $mail
    ));
    $veri_miktar=$cek->rowCount();

      if ($veri_miktar == 0) {

        $cek=$db->prepare("select * from users where phone=:gsm ");
        $cek->execute(array(
        'gsm' => $phone
        ));
          $veri_miktar=$cek->rowCount();

            if ($veri_miktar == 0) {

              $cek=$db->prepare("select * from users where phone=:gsm ");
              $cek->execute(array(
              'gsm' => $phone
              ));
              $veri_miktar=$cek->rowCount();

                  if ($veri_miktar == 0) {

                      while(true){
                        $token = generateToken();
                        $cek=$db->prepare("select * from users where apikey=:key ");
                        $cek->execute(array(
                        'key' => $token
                        ));
                        $veri_miktar=$cek->rowCount();

                          if ($veri_miktar == 0) {
                            echo "çıktı";
                            break;
                          }
                          echo "çıkamadı";
                      }

                      $password = md5($password_one);

                      $kaydet=$db->prepare("INSERT INTO users SET
        							username=:username,
        							password=:password,
        							mail=:mail,
        							phone=:phone,
                      apikey=:apikey
        							");
        							$insert=$kaydet->execute(array(
        							'username' => $username,
        							'password' => $password,
        							'mail' => $mail,
        							'phone' => $phone,
                      'apikey' => $token
        							));

        							if ($insert) {
                        //Success
        								$_SESSION['username']=$username;
        								header("Location:verification_mail");

        							}else{
                        //Fail
        								header("Location:../signup?stats=fail");
        							}
                  }else{
                    //username using
                    header("Location:../signup?stats=uau");
                  }
            }else{
              //Phone number using
              header("Location:../signup?stats=pau");
            }
      }else{
        //Mail using
        header("Location:../signup?stats=mau");
      }
  }else{
    //Password dont match
    header("Location:../signup?stats=pdm");
  }


}

 ?>
