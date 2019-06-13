<?php
require_once('../../inc/conn.php');
date_default_timezone_set('Europe/Istanbul');
session_start();
ob_start();

$value = null;
$dataType = null;

if(isset($_POST['value'])){
  $value = $_POST['value'];
}

if(!isset($_POST['dataType'])){
  exit();
}

$dataType = $_POST['dataType'];


if($dataType=="savePayment"){

  $duzenle=$db->prepare("UPDATE settings SET
  paywant=:paywant,
  shopier=:shopier,
  transfer=:transfer
  WHERE id=1");
  $update=$duzenle->execute(array(
  'paywant' => $_POST['paywant'],
  'shopier' => $_POST['shopier'],
  'transfer' => $_POST['transfer']
  ));
  if($update){
      echo json_encode(array('stats'=>'ok'));
  }else{
      echo json_encode(array('stats'=>'no'));
  }

}

if($dataType=="saveMail"){

  $duzenle=$db->prepare("UPDATE settings SET
  mail_server=:mail_server,
  mail_username=:mail_username,
  mail_password=:mail_password,
  mail_port=:mail_port
  WHERE id=1");
  $update=$duzenle->execute(array(
  'mail_server' => $_POST['server'],
  'mail_username' => $_POST['username_mail'],
  'mail_password' => $_POST['password_mail'],
  'mail_port' => $_POST['port']
  ));
  if($update){
      echo json_encode(array('stats'=>'ok'));
  }else{
      echo json_encode(array('stats'=>'no'));
  }

}

if($dataType=="saveCategory"){


    $duzenle=$db->prepare("UPDATE category SET
    name=:name,
    enable=:enable
    WHERE id={$_POST['id']}");
    $update=$duzenle->execute(array(
    'name' => $_POST['name'],
    'enable' => $_POST['status']
    ));
    if($update){
        echo json_encode(array('stats'=>'ok'));
    }else{
        echo json_encode(array('stats'=>'no'));
    }


}


if($dataType=="saveService"){


  if($_POST['max'] <= $_POST['min']){
    echo json_encode(array('stats'=>'mm'));
    exit();
  }


    $duzenle=$db->prepare("UPDATE services SET
    name=:name,
    category_id=:cat_id,
    description=:description,
    money=:money,
    min=:min,
    max=:max,
    enable=:enable
    WHERE id={$_POST['id']}");
    $update=$duzenle->execute(array(
    'name' => $_POST['name'],
    'cat_id' => $_POST['cat_id'],
    'description' => $_POST['description'],
    'money' => $_POST['money'],
    'min' => $_POST['min'],
    'max' => $_POST['max'],
    'enable' => $_POST['status']
    ));
    if($update){
        echo json_encode(array('stats'=>'ok'));
    }else{
        echo json_encode(array('stats'=>'no'));
    }


}

if($dataType=="saveSettings"){

  $duzenle=$db->prepare("UPDATE settings SET
  name=:name,
  slogan=:slogan,
  description=:description,
  keywords=:keywords,
  url=:url,
  copyright=:copyright,
  mail=:mail,
  face_text=:face_text,
  insta_text=:insta_text,
  headerCode=:headerCode,
  notice=:notice,
  kullanim_kos=:kul_kos,
  iade_kos=:iade_kos,
  giz_pol=:giz_pol
  WHERE id=1");
  $update=$duzenle->execute(array(
  'name' => $_POST['title'],
  'slogan' => $_POST['slogan'],
  'description' => $_POST['description'],
  'keywords' => $_POST['keywords'],
  'url' => $_POST['url'],
  'copyright' => $_POST['copyright'],
  'mail' => $_POST['mail'],
  'face_text' => $_POST['face_text'],
  'insta_text' => $_POST['insta_text'],
  'headerCode' => $_POST['header'],
  'notice' => $_POST['notice'],
  'kul_kos' => $_POST['kul_kos'],
  'iade_kos' => $_POST['iade_kos'],
  'giz_pol' => $_POST['giz_pol']
  ));
  if($update){
      echo json_encode(array('stats'=>'ok'));
  }else{
      echo json_encode(array('stats'=>'no'));
  }

}



 ?>
