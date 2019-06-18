<?php
require_once('../inc/conn.php');
date_default_timezone_set('Europe/Istanbul');
session_start();
ob_start();

if(!isset($_SESSION['username'])){
  header("Location:../index.php");
  exit();
}

$users=$db->prepare("select * from users where username=:username and verified_mail=:verified");
$users->execute(array(
  'username' => $_SESSION['username'],
  'verified' => 0
));
$takeUserInfo=$users->fetch(PDO::FETCH_ASSOC);
$veri_miktar=$users->rowCount();

if($veri_miktar==0){
  header("Location:../index.php");
  exit();
}

function generateToken(){
  $token = openssl_random_pseudo_bytes(16);
  $token = bin2hex($token);
  return $token;
}

$settings=$db->prepare("select * from settings where id=:id");
$settings->execute(array(
  'id' => 1
));
$takeSetting=$settings->fetch(PDO::FETCH_ASSOC);

$username = $takeSetting['mail_username'];
$server = $takeSetting['mail_server'];
$password = $takeSetting['mail_password'];
$port = $takeSetting['mail_port'];

$token = generateToken();



$mails=$db->prepare("select * from verification_mail where user_id=:id and used=:used ORDER BY id DESC");
$mails->execute(array(
  'id' => $takeUserInfo['id'],
  'used' => 0
));
$takeMail=$mails->fetch(PDO::FETCH_ASSOC);
$veri_miktar=$mails->rowCount();

if($veri_miktar>0){
  $duzenle=$db->prepare("UPDATE verification_mail SET
  used=:used
  WHERE id={$takeMail['id']}");
  $update=$duzenle->execute(array(
  'used' => 1
  ));
}



  $kaydet=$db->prepare("INSERT INTO verification_mail SET
  user_id=:user_id,
  token=:token
  ");
  $insert=$kaydet->execute(array(
  'user_id' => $takeUserInfo['id'],
  'token' => $token
  ));


	require_once("class.phpmailer.php");
	$mail = new PHPMailer();
  $mail->SetLanguage("tr", 'includes/phpMailer/language/');
	$mail->IsSMTP();
	$mail->Host = $server;
	$mail->SMTPAuth = true;
	$mail->Username = $username;
	$mail->Password = $password;
	$mail->From = $username;
	$mail->Fromname = $takeSetting['name'];
	$mail->AddAddress($takeUserInfo['mail'],$takeUserInfo['username']);
  $mail->IsHTML(true);
	$mail->Subject = "Hesap Onaylama";
  $body  = "Merhaba	: ".$takeUserInfo['username']."<br>";
  $body .= "Hesabinizi dogrulamak icin <a href='".$takeSetting['url']."progress/verification?ui=".md5($takeUserInfo['id'])."&token=".md5($token)."'>buraya tiklayin</a><br>";

	$mail->Body = $body;

	if(!$mail->Send())
	{
	   echo '<font color="#F62217"><b>Gönderim Hatası: ' . $mail->ErrorInfo . '</b></font>';
	   exit;
	}
	echo '<font color="#41A317"><b>Mesaj başarıyla gönderildi.</b></font>';


 ?>
