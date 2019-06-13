<?php
require_once('../inc/conn.php');
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

function generateToken(){
  $token = openssl_random_pseudo_bytes(16);
  $token = bin2hex($token);
  return $token;
}


if($dataType=='newTicket'){

  $orderNumber = $_POST['orderNumber'];
  $message = $_POST['message'];
  $konu = $_POST['konuInput'];
  $type = $_POST['ticketSubject'];

  $users=$db->prepare("SELECT * FROM users where username=:username");
  $users->execute(array(
    'username' => $_SESSION['username']
  ));
  $takeUserInfo=$users->fetch(PDO::FETCH_ASSOC);

  $kaydet=$db->prepare("INSERT INTO tickets SET
  owner_id=:owner_id,
  type=:type,
  subject=:subject,
  orderNumber=:orderNumber
  ");
  $insert=$kaydet->execute(array(
  'owner_id' => $takeUserInfo['id'],
  'type' => $type,
  'subject' => $konu,
  'orderNumber' => $orderNumber
  ));
  if($insert){

    $ticket=$db->prepare("SELECT * FROM tickets where owner_id=:owner_id and type=:type and subject=:subject and orderNumber=:orderNumber");
    $ticket->execute(array(
    'owner_id' => $takeUserInfo['id'],
    'type' => $type,
    'subject' => $konu,
    'orderNumber' => $orderNumber
    ));
    $takeTicket=$ticket->fetch(PDO::FETCH_ASSOC);

    $kaydet=$db->prepare("INSERT INTO ticket_message SET
    ticket_id=:ticket_id,
    sender_id=:sender_id,
    message=:message
    ");
    $insert=$kaydet->execute(array(
    'ticket_id' => $takeTicket['id'],
    'sender_id' => $takeUserInfo['id'],
    'message' => $message
    ));
    if($insert){
      echo json_encode(array('stats'=>'ok'));
    }else{
      echo json_encode(array('stats'=>'no'));
    }
  }else{
    echo json_encode(array('stats'=>'no'));
  }

}

if($dataType=="createAPIKey"){


  while(true){
    $token = generateToken();
    $cek=$db->prepare("select * from users where apikey=:key ");
    $cek->execute(array(
    'key' => $token
    ));
    $veri_miktar=$cek->rowCount();
    if ($veri_miktar == 0) {
      break;
    }
  }

  $users=$db->prepare("SELECT * FROM users where username=:username");
  $users->execute(array(
    'username' => $_SESSION['username']
  ));
  $takeUserInfo=$users->fetch(PDO::FETCH_ASSOC);

  $duzenle=$db->prepare("UPDATE users SET
  apikey=:apikey
  WHERE id={$takeUserInfo['id']}");
  $update=$duzenle->execute(array(
  'apikey' => $token
  ));

  if($update){
    echo json_encode(array('stats'=>'ok'));
  }else{
    echo json_encode(array('stats'=>'no'));
  }

}

if($dataType=="changePass"){
  $newPass = md5($value);
  $currentPass = md5($_POST['currentPass']);

  $users=$db->prepare("SELECT * FROM users where username=:username and password=:password");
  $users->execute(array(
    'username' => $_SESSION['username'],
    'password' => $currentPass
  ));
  $takeUserInfo=$users->fetch(PDO::FETCH_ASSOC);
  $count=$users->rowCount();
  if($count>0){

    $duzenle=$db->prepare("UPDATE users SET
    password=:password
    WHERE id={$takeUserInfo['id']}");
    $update=$duzenle->execute(array(
    'password' => $newPass
    ));
    if($update){
      echo json_encode(array('stats'=>'ok'));
    }else{
      echo json_encode(array('stats'=>'no'));
    }
  }else{
    echo json_encode(array('stats'=>'nf'));
  }

}

if($dataType=="transferPay"){

  $username = $_SESSION['username'];
  $bankId = $value;
  $amount = $_POST['amount'];

  $kaydet=$db->prepare("INSERT INTO transferPay SET
  username=:username,
  bank_id=:bank_id,
  amount=:amount
  ");
  $insert=$kaydet->execute(array(
  'username' => $username,
  'bank_id' => $bankId,
  'amount' => $amount
  ));

  if($insert){

    $pay=$db->prepare("SELECT * FROM transferPay where username=:username and bank_id=:bank_id and amount=:amount ORDER BY id DESC");
    $pay->execute(array(
      'username' => $username,
      'bank_id' => $bankId,
      'amount' => $amount
    ));
    $takePay=$pay->fetch(PDO::FETCH_ASSOC);

    echo json_encode(array('stats'=>'ok','number'=> $takePay['id']));
  }else{
    echo json_encode(array('stats'=>'no'));
  }

}


if($dataType=="getBankDesc"){
  $bank=$db->prepare("SELECT * FROM pay_type where id=:id");
  $bank->execute(array(
    'id' => $value
  ));
  $takeBank=$bank->fetch(PDO::FETCH_ASSOC);
  echo json_encode($takeBank);
}

if($dataType=="services"){
    $category=$db->prepare("SELECT * FROM services where category_id=:id and enable=:enable");
    $category->execute(array(
      'id' => $value,
      'enable' => 1
      ));

      while($takeCategory=$category->fetch(PDO::FETCH_ASSOC)){
        $arrayName[] = $takeCategory;
      }

      echo json_encode($arrayName);
}

if ($dataType=="desc"){

  $category=$db->prepare("SELECT * FROM services where id=:id");
  $category->execute(array(
    'id' => $value
  ));

  $takeCategory=$category->fetch(PDO::FETCH_ASSOC);
  echo json_encode($takeCategory);
}

if($dataType=="newOrder"){

  if($_POST['count'] < $_POST['min']){
    echo "min";
    exit();
  }

  if($_POST['count'] > $_POST['max']){
    echo "max";
    exit();
  }

  $cek=$db->prepare("select * from users where username=:username");
  $cek->execute(array(
    'username' => $_SESSION['username']
  ));
  $takeInfo=$cek->fetch(PDO::FETCH_ASSOC);

  if($takeInfo['balance']<$_POST['cost']){
    echo "yb";
    exit();
  }

  $kaydet=$db->prepare("INSERT INTO orders SET
  service=:service,
  count=:count,
  cost=:cost,
  link=:link,
  user_id=:user_id
  ");
  $insert=$kaydet->execute(array(
  'service' => $_POST['service'],
  'count' => $_POST['count'],
  'cost' => $_POST['cost'],
  'link' => $_POST['link'],
  'user_id' => $takeInfo['id']
  ));
  if($insert){
    $userMoney=$takeInfo['balance']-$_POST['cost'];

    $duzenle=$db->prepare("UPDATE users SET
    balance=:balance
    WHERE id={$takeInfo['id']}");
    $update=$duzenle->execute(array(
    'balance' => $userMoney
    ));
    if ($duzenle) {
      echo "ok";
    }else{
      echo "no";
    }
  }else{
    echo "no";
  }

}

 ?>
