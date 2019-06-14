<?php
require_once('../../inc/conn.php');
date_default_timezone_set('Europe/Istanbul');
session_start();
ob_start();


if(isset($_GET['proc'])){
    if($_GET['proc'] == 'ticketopen'){

      $duzenle=$db->prepare("UPDATE tickets SET
      stats=:stats
      WHERE id={$_GET['ticket_id']}");
      $update=$duzenle->execute(array(
      'stats' => 'Açık'
      ));
      if($update){
        if(isset($_GET['from'])){
          header('Location:../tickets');
        }else{
          header('Location:../ticketview-'.$_GET['ticket_id']);
        }
      }else{
        if(isset($_GET['from'])){
          header('Location:../tickets');
        }else{
          header('Location:../ticketview-'.$_GET['ticket_id']);
        }
      }

    }

    if($_GET['proc'] == 'deleteCategory'){
      $delete=$db->prepare("DELETE  FROM category WHERE id={$_GET['category_id']}");
      $sil=$delete->execute();
      if($sil){
        header('Location:../categories?stats=ok');
      }else{
        header('Location:../categories');
      }
    }

    if($_GET['proc'] == 'deleteService'){
      $delete=$db->prepare("DELETE  FROM services WHERE id={$_GET['service_id']}");
      $sil=$delete->execute();
      if($sil){
        header('Location:../services?status=ok');
      }else{
        header('Location:../services');
      }
    }

    if($_GET['proc'] == 'deleteShopierLink'){
      $delete=$db->prepare("DELETE  FROM shopier_id WHERE id={$_GET['shopierlink_id']}");
      $sil=$delete->execute();
      if($sil){
        header('Location:../shopierlinks?stats=ok');
      }else{
        header('Location:../shopierlinks');
      }
    }

    if($_GET['proc'] == 'deleteBankAccount'){
      $delete=$db->prepare("DELETE  FROM pay_type WHERE id={$_GET['account_id']}");
      $sil=$delete->execute();
      if($sil){
        header('Location:../bankaccounts?stats=ok');
      }else{
        header('Location:../bankaccounts');
      }
    }

    if($_GET['proc'] == 'activeService'){

      $duzenle=$db->prepare("UPDATE services SET
      enable=:stats
      WHERE id={$_GET['service_id']}");
      $update=$duzenle->execute(array(
      'stats' => 1
      ));
      if($update){
        if(isset($_GET['from'])){
          header('Location:../services?status=ok');
        }else{
          header('Location:../serviceview-'.$_GET['service_id']);
        }
      }else{
        if(isset($_GET['from'])){
          header('Location:../services');
        }else{
          header('Location:../serviceview-'.$_GET['service_id']);
        }
      }

    }

    if($_GET['proc'] == 'passiveService'){

      $duzenle=$db->prepare("UPDATE services SET
      enable=:stats
      WHERE id={$_GET['service_id']}");
      $update=$duzenle->execute(array(
      'stats' => 0
      ));
      if($update){
        if(isset($_GET['from'])){
          header('Location:../services?status=ok');
        }else{
          header('Location:../serviceview-'.$_GET['service_id']);
        }
      }else{
        if(isset($_GET['from'])){
          header('Location:../services');
        }else{
          header('Location:../serviceview-'.$_GET['service_id']);
        }
      }

    }



    if($_GET['proc'] == 'activeCategory'){

      $duzenle=$db->prepare("UPDATE category SET
      enable=:stats
      WHERE id={$_GET['category_id']}");
      $update=$duzenle->execute(array(
      'stats' => 1
      ));
      if($update){
        if(isset($_GET['from'])){
          header('Location:../categories');
        }else{
          header('Location:../categoryview-'.$_GET['category_id']);
        }
      }else{
        if(isset($_GET['from'])){
          header('Location:../categories');
        }else{
          header('Location:../categoryview-'.$_GET['category_id']);
        }
      }

    }

    if($_GET['proc'] == 'passiveCategory'){

      $duzenle=$db->prepare("UPDATE category SET
      enable=:stats
      WHERE id={$_GET['category_id']}");
      $update=$duzenle->execute(array(
      'stats' => 0
      ));
      if($update){
        if(isset($_GET['from'])){
          header('Location:../categories');
        }else{
          header('Location:../categoryview-'.$_GET['category_id']);
        }
      }else{
        if(isset($_GET['from'])){
          header('Location:../categories');
        }else{
          header('Location:../categoryview-'.$_GET['category_id']);
        }
      }

    }

    if($_GET['proc'] == 'ticketclose'){

      $duzenle=$db->prepare("UPDATE tickets SET
      stats=:stats
      WHERE id={$_GET['ticket_id']}");
      $update=$duzenle->execute(array(
      'stats' => 'Kapalı'
      ));
      if($update){
        if(isset($_GET['from'])){
          header('Location:../tickets');
        }else{
          header('Location:../ticketview-'.$_GET['ticket_id']);
        }
      }else{
        if(isset($_GET['from'])){
          header('Location:../tickets');
        }else{
          header('Location:../ticketview-'.$_GET['ticket_id']);
        }
      }

    }
}

if(isset($_POST)){
echo "post var";
  $redirect = $_POST['redirect'];

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
      'stats' => 'Kapalı'
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
