<?php
require_once('../inc/conn.php');
date_default_timezone_set('Europe/Istanbul');
session_start();
ob_start();


if(isset($_POST)){


  if(isset($_POST['sendResponseToTicket'])){

    if(trim($_POST['message'])==''){
      header('Location:../ticketview-'.$_POST['ticket_id'].'#lastMessage');
      exit();
    }
    $users=$db->prepare("SELECT * FROM users where username=:username");
    $users->execute(array(
      'username' => $_SESSION['username']
    ));
    $takeUser=$users->fetch(PDO::FETCH_ASSOC);

    $usersVerify=$db->prepare("SELECT * FROM tickets where owner_id=:owner_id and id=:id");
    $usersVerify->execute(array(
      'owner_id' => $takeUser['id'],
      'id' => $_POST['ticket_id']
    ));

    $count=$usersVerify->rowCount();

    if($count==0){
      header('../index');
      exit();
    }

    $kaydet=$db->prepare("INSERT INTO ticket_message SET
    ticket_id=:ticket_id,
    sender_id=:sender_id,
    message=:message
    ");
    $insert=$kaydet->execute(array(
    'ticket_id' => $_POST['ticket_id'],
    'sender_id' => $takeUser['id'],
    'message' => $_POST['message']
    ));
    if($insert){

      $duzenle=$db->prepare("UPDATE tickets SET
      stats=:stats
      WHERE id={$_POST['ticket_id']}");
      $update=$duzenle->execute(array(
      'stats' => 'Cevap Bekleniyor'
      ));
      if($update){
        header('Location:../ticketview-'.$_POST['ticket_id'].'#lastMessage');
      }else{
        header('Location:../ticketview-'.$_POST['ticket_id'].'#lastMessage');
      }

    }else{
      header('Location:../ticketview-'.$_POST['ticket_id'].'#lastMessage');
    }

  }

}else{
  header('Location:../index');
}


?>
