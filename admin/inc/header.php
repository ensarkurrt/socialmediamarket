<?php
session_start();
ob_start();
date_default_timezone_set('Europe/Istanbul');
require_once("../inc/conn.php");


function tarihcek($sqlsorgusu,$tarihname){

switch (substr($sqlsorgusu[$tarihname], 5,2)) {
		case '01':
		$ay = "Ocak";
		break;
		case '02':
		$ay = "Şubat";
		break;
		case '03':
		$ay = "Mart";
		break;
		case '04':
		$ay = "Nisan";
		break;
		case '05':
		$ay = "Mayıs";
		break;
		case '06':
		$ay = "Haziran";
		break;
		case '07':
		$ay = "Temmuz";
		break;
		case '08':
		$ay = "Ağustos";
		break;
		case '09':
		$ay = "Eylül";
		break;
		case '10':
		$ay = "Ekim";
		break;
		case '11':
		$ay = "Kasım";
		break;
		case '12':
		$ay = "Aralık";
		break;

}

$yil = substr($sqlsorgusu[$tarihname],0,4);

$gun =  substr($sqlsorgusu[$tarihname], 8,2);

$saat = substr($sqlsorgusu[$tarihname], 11,2);

$dakika = substr($sqlsorgusu[$tarihname], 14,2);

$saniye = substr($sqlsorgusu[$tarihname], 17,2);


	echo $gun." ".$ay." ".$yil." ".$saat.":".$dakika;


}

$settings=$db->prepare("SELECT * FROM settings where id=:id");
$settings->execute(array(
  'id' => 1
));
$takeSetting=$settings->fetch(PDO::FETCH_ASSOC);
$url = $takeSetting['url'];

if($_SERVER['SCRIPT_NAME']!='/takipci/admin/login.php'){
  if(empty($_SESSION['username'])){
    header("Location:login?redirect=".$_SERVER['SCRIPT_NAME']);
    exit();
  }
}


if(isset($_SESSION['username'])){
  $users=$db->prepare("SELECT * FROM users where username=:username");
  $users->execute(array(
    'username' => $_SESSION['username']
  ));
  $takeUserInfo=$users->fetch(PDO::FETCH_ASSOC);

  if($_SERVER['SCRIPT_NAME']!='/takipci/admin/login.php'){
    if($takeUserInfo['perm']==0){
      header("Location:login?redirect=".$_SERVER['SCRIPT_NAME'].'&reason=perm');
      exit();
    }
  }
}



?>

<!DOCTYPE html>
<html lang="tr">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?php echo $takeSetting['name']; ?> | Yönetim Paneli</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.addons.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <script src="js/my.js"></script>
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />

	<style>
	 .border-bottom {
		 border-bottom:1px solid #161a27 !important;
	 }
	</style>

</head>
<body class="purchase-banner-active sidebar-dark">
