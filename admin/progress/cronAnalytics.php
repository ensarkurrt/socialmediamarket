<?php
require_once('../../inc/conn.php');
date_default_timezone_set('Europe/Istanbul');
session_start();
ob_start();

// Örnek sonuç: 29.07.2013 12:13:00
$day = date('d');

$time = date('Y-m-d');


if($day==1 || $day==01){
  $lastAnalytics=$db->prepare("SELECT * FROM analytics ORDER BY id DESC");
  $lastAnalytics->execute();
  $takeAnalytics=$lastAnalytics->fetch(PDO::FETCH_ASSOC);

  $lastTime = $takeAnalytics['createTime'];

  $yil = substr($lastTime,0,4);

  $gun =  substr($lastTime, 8,2);

  $ay = substr($lastTime, 5,2);

  if($time!=$yil.'-'.$ay.'-'.$gun){

    //En son analytics alınmamış

    //Get Data State

    $users=$db->prepare("SELECT * FROM users");
    $users->execute();
    $countUsers=$users->rowCount();

    $orders=$db->prepare("SELECT * FROM orders");
    $orders->execute();
    $countOrders=$orders->rowCount();
    $kazanc=0;

    while($takeKazanc=$orders->fetch(PDO::FETCH_ASSOC)){
      $kazanc+=$takeKazanc['cost'];
    }


    //Update State

    $kaydetKazanc=$db->prepare("INSERT INTO analytics SET
    type=:type,
    value=:value
    ");
    $insertKazanc=$kaydetKazanc->execute(array(
    'type' => 'Kazanç',
    'value' => $kazanc
    ));

    $kaydetOrder=$db->prepare("INSERT INTO analytics SET
    type=:type,
    value=:value
    ");
    $insertOrder=$kaydetOrder->execute(array(
    'type' => 'Sipariş',
    'value' => $countOrders
    ));

    $kaydetUser=$db->prepare("INSERT INTO analytics SET
    type=:type,
    value=:value
    ");
    $insertUser=$kaydetUser->execute(array(
    'type' => 'Üye',
    'value' => $countUsers
    ));





  }else{

    //Zaten Hesaplanmış
  }

}

?>
