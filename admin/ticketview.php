<?php
require_once('inc/header.php');



if(!isset($_GET['ticket_id'])){
  header("Location:index");
  exit();
}

//Toplam tickets
$ticket=$db->prepare("SELECT * FROM tickets where id=:id");
$ticket->execute(array(
  'id' => $_GET['ticket_id']
));
$takeTicket=$ticket->fetch(PDO::FETCH_ASSOC);
$count=$ticket->rowCount();

$ticket1=$db->prepare("SELECT * FROM ticket_message where ticket_id=:id");
$ticket1->execute(array(
  'id' => $takeTicket['id']
));

$count1=$ticket1->rowCount();

if($count==0){
  header("Location:index");
  exit();
}

if($count!=0){
  $users=$db->prepare("SELECT * FROM users where id=:id");
  $users->execute(array(
    'id' => $takeTicket['owner_id']
  ));
  $takeUser=$users->fetch(PDO::FETCH_ASSOC);
}

 ?>
<body>
  <div class="container-scroller">
  <?php require_once('inc/navbar.php'); ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
    <?php require_once('inc/sidebar.php'); ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">

          <!-- Uyarı Barı -->
          <!-- <div class="row purchace-popup">
            <div class="col-12">
              <span class="d-block d-md-flex align-items-center">
                <p>Like what you see? Check out our premium version for more.</p>
                <a class="btn ml-auto download-button d-none d-md-block" href="https://github.com/BootstrapDash/StarAdmin-Free-Bootstrap-Admin-Template" target="_blank">Download Free Version</a>
                <a class="btn purchase-button mt-4 mt-md-0" href="https://www.bootstrapdash.com/product/star-admin-pro/" target="_blank">Upgrade To Pro</a>
                <i class="mdi mdi-close popup-dismiss d-none d-md-block"></i>
              </span>
            </div>
          </div> -->



          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card" style="border:1px solid #161a27;">
              <div class="card-body">
                  <h2 class=" mb-4">Ticket [#<?php echo $takeTicket['id']; ?>]</h2>

                  <div class="row text-gray d-md-flex d-none">
                    <div class="col-4 d-flex">
                      <small class="mb-0 mr-2 ">Tür :</small>
                      <small class="Last-responded mr-2 mb-0"><?php echo $takeTicket['type']; ?></small>
                    </div>
                    <div class="col-4 d-flex">
                      <small class="mb-0 mr-2">Kullanıcı Adı :</small>
                      <small class="Last-responded mr-2 mb-0"><?php echo $takeUser['username']; ?></small>
                    </div>
                    <div class="btn-group dropdown">
                      <button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Yönet
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="progress/proc.php?ticket_id=<?php echo $takeTicket['id']; ?>&proc=ticketopen">
                          <i class="fa fa-reply fa-fw"></i>Talebi Aç
                        </a>
                        <a class="dropdown-item" href="progress/proc.php?ticket_id=<?php echo $takeTicket['id']; ?>&proc=ticketclose">
                          <i class="fa fa-reply fa-fw"></i>Talebi Kapat
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
                </div>
                </div>
            </div>


            <!-- ticket start -->
            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card" style="border:1px solid #161a27;">
                  <div class="card-body">
                    <h5 class="card-title mb-4">Yazışmalar | Devamını okumak için aşağı kaydırın!</h5>
                    <div class="fluid-container" style="overflow-y:auto;">

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
                                                <div class="row ticket-card mt-3 pb-2 <?php if($int!=$count1 && $int != 0){ echo "border-bottom";} ?> pb-3 mb-3" id="<?php if($int==$count1){echo "lastMessage";} ?>">

                                                  <div class="ticket-details col-md-9">
                                                    <div class="d-flex">
                                                      <p class="text-dark font-weight-semibold mr-2 mb-0 no-wrap"> Gönderen: <?php echo $takeUser['username']; ?> </p>
                                                    </div>
                                                    <p class="text-gray ellipsis mb-2"><?php echo $takeMessage['message']; ?>
                                                    </p>
                                                    <div class="row text-gray d-md-flex d-none">
                                                      <div class="col-4 d-flex">
                                                        <small class="mb-0 mr-2 text-muted text-muted">Gönderme Tarihi :</small>
                                                        <small class="Last-responded mr-2 mb-0 text-muted text-muted"><?php echo tarihcek($takeMessage,'createTime'); ?></small>
                                                      </div>
                                                    </div>
                                                  </div>

                                                </div>
                        <?php   } ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card" style="border:1px solid #161a27;">
                  <div class="card-body">
                    <h5 class="card-title mb-4">Cevap Yaz</h5>
                    <div class="fluid-container">
                      <form action="progress/proc.php" method="post" name="sendResponseToTicket">
                        <fieldset class="form-group">
                          <label for="message">Mesaj <span class="text-danger">*</span></label>
                          <input type="hidden" name="redirect" value="<?php echo $_SERVER['SCRIPT_NAME']; ?>">
                          <input type="hidden" name="ticket_id" value="<?php echo $_GET['ticket_id']; ?>">
                          <textarea name="message" id="message" placeholder="Yeni cevabınız" class="form-control" rows="6" style="border:1px solid #161a27;"></textarea>
                          <small class="text-muted">Cevabınızı yazın</small>
                        </fieldset>
                          <input type="submit" class="btn btn-success mr-2" name='sendResponseToTicket' value="Cevabı Gönder">

                      </form>

                      </div>
                    </div>
                  </div>
                </div>
              </div>

        </div>




        <!-- ticket end -->

        <!-- content-wrapper ends -->

<?php require_once('inc/footer.php'); ?>
