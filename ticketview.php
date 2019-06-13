<?php
require_once("inc/header.php");

if(!isset($_GET['ticket_id'])){
  header("Location:index");
  exit();
}

//Toplam tickets
$ticket=$db->prepare("SELECT * FROM tickets where id=:id and owner_id=:owner");
$ticket->execute(array(
  'id' => $_GET['ticket_id'],
  'owner' => $takeUserInfo['id']
));
$takeTicket=$ticket->fetch(PDO::FETCH_ASSOC);

$count=$ticket->rowCount();
if($count==0){
  header("Location:index");
  exit();
}

$ticket1=$db->prepare("SELECT * FROM ticket_message where ticket_id=:id");
$ticket1->execute(array(
  'id' => $takeTicket['id']
));

$count=$ticket1->rowCount();



if($count!=0){
  $users=$db->prepare("SELECT * FROM users where id=:id");
  $users->execute(array(
    'id' => $takeTicket['owner_id']
  ));
  $takeUser=$users->fetch(PDO::FETCH_ASSOC);
}


?>
<!-- Main variables *content* -->

<div class="inner-page">
  <section>
    <div class="container">
      <div class="row ticket-panel">
        <div class="col">
          <div class="card bg-white ">
            <div class="card-header">
              <div class="titcket-title card-title">
                <?php echo $takeTicket['subject']; ?> | <?php echo $takeTicket['type']; ?>
              </div>
            </div>
            <div class="card-body">

              <?php

              $int = 0;
              $ticketView=$db->prepare("SELECT * FROM ticket_message where ticket_id=:id");
              $ticketView->execute(array(
                'id' => $_GET['ticket_id']
              ));

                while($takeMessage=$ticketView->fetch(PDO::FETCH_ASSOC)){

                  $int++;

                  $users=$db->prepare("SELECT * FROM users where id=:id");
                  $users->execute(array(
                    'id' => $takeMessage['sender_id']
                  ));
                  $takeUser=$users->fetch(PDO::FETCH_ASSOC);

                  ?>


                                      <?php if($takeUser['id']==$takeUserInfo['id']){ ?>

                                        <!-- Ticket Usera aitse -->
                                        <div class="row ticket-message-block ticket-message-right justify-content-end" id="<?php if($int==$count){echo "lastMessage";} ?>">

                                            <div class="col-md-10">
                                              <span class="avatar">
                                                <i class="fa fa-user-circle"></i>
                                              </span>
                                              <div class="ticket-message">
                                                <div class="message"><?php echo $takeMessage['message']; ?></div>
                                              </div>
                                              <div class="info">
                                                <strong><?php echo $takeUser['username']; ?></strong>
                                                <small class="text-muted"><?php echo tarihcek($takeMessage,'createTime'); ?></small>
                                              </div>
                                            </div>

                                          </div>


                                    <?php }else{ ?>
                                      <!-- Ticket Destek e aitse -->
                                      <div class="row ticket-message-block ticket-message-left" id="<?php if($int==$count){echo "lastMessage";} ?>">
                                        <div class="col-md-10">
                                          <span class="avatar">
                                            <i class="fa fa-headset"></i>
                                          </span>
                                          <div class="ticket-message">
                                            <div class="message"><?php echo $takeMessage['message']; ?></div>
                                          </div>
                                          <div class="info text-right">
                                            <strong>Destek</strong>
                                            <small class="text-muted"><?php echo tarihcek($takeMessage,'createTime'); ?></small>
                                          </div>
                                        </div>

                                      </div>
                                  <?php } ?>



              <?php   } ?>

                      <div class="row">
                  <div class="col-md-12">
                    <form method="post" action="progress/proc.php" name="sendResponseToTicket">
                        <div class="form-group panel-border-top">
                        <label for="message" class="control-label">Mesaj</label>
                        <input type="hidden" name="ticket_id" value="<?php echo $_GET['ticket_id']; ?>">
                        <textarea id="message" rows="5" class="form-control" name="message"></textarea>
                      </div>
                      <div class="form-group">
                        <input type="submit" class="btn btn-green" name='sendResponseToTicket' value="Cevabı Gönder">
                      </div>

                    </form>
                  </div>
                </div>
                          </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php require_once("inc/footer.php"); ?>
