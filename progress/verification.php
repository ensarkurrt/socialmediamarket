<?php

require_once('../inc/conn.php');
date_default_timezone_set('Europe/Istanbul');
session_start();
ob_start();


if(!isset($_GET['ui']) || !isset($_GET['token'])){
  echo "URL Hatalı";
  exit();
}

$mails=$db->prepare("select * from verification_mail where md5(user_id)=:id and used=:used and md5(token)=:token");
$mails->execute(array(
  'id' => $_GET['ui'],
  'used' => '0',
  'token' => $_GET['token']
));
$takeMail=$mails->fetch(PDO::FETCH_ASSOC);
$veri_miktar=$mails->rowCount();

if($veri_miktar==0){
  echo "URL Hatalı";
  exit();
}


$duzenle=$db->prepare("UPDATE users SET
verified_mail=:verified_mail
WHERE id={$takeMail['user_id']}");
$update=$duzenle->execute(array(
'verified_mail' => 1
));

$duzenle=$db->prepare("UPDATE verification_mail SET
used=:used
WHERE id={$takeMail['id']}");
$update=$duzenle->execute(array(
'used' => 1
));

header('Location:../');

?>
