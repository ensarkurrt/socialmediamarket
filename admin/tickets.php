<?php
require_once('inc/header.php');


//Tickets Analytics
if(isset($_GET['type'])){
  $ticketsStat=$db->prepare("SELECT * FROM tickets where stats=:stats ORDER BY id DESC");
  $ticketsStat->execute(array(
    'stats' => $_GET['type']
  ));
  $ticketCount=$ticketsStat->rowCount();
}else{
  $ticketsStat=$db->prepare("SELECT * FROM tickets where stats=:stats ORDER BY id DESC");
  $ticketsStat->execute(array(
    'stats' => 'Cevap Bekleniyor'
  ));
  $ticketCount=$ticketsStat->rowCount();
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


          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card" style="border:1px solid #161a27;">
              <div class="card-body">
                  <h2 class=" mb-4">Ticketlar</h2>
                  <a href='tickets?type=Kapalı' class="btn btn-success mr-2"> Kapalı Ticketlar</a>
                  <a href='tickets?type=Açık' class="btn btn-success mr-2"> Açık Ticketlar</a>
                  <a href='tickets?type=Cevap Bekleniyor' class="btn btn-success mr-2"> Cevap Bekleyen Ticketlar</a>

                </div>
                </div>
                </div>
            </div>
          <!-- ticket start -->
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card" style="border:1px solid #161a27;">
                <div class="card-body">
                  <h5 class="card-title mb-4"><?php if(isset($_GET['type'])){ echo $_GET['type'];}else{echo "Cevap Bekleyen";} ?> Ticketlar</h5>
                  <div class="fluid-container">

                      <?php
                      $int = 0;
                      if($ticketCount>0){
                        while($takeTickets=$ticketsStat->fetch(PDO::FETCH_ASSOC)){
                          $int++;
                          $users=$db->prepare("SELECT * FROM users where id=:id");
                          $users->execute(array(
                            'id' => $takeTickets['owner_id']
                          ));
                          $takeUser=$users->fetch(PDO::FETCH_ASSOC);
                           ?>

                                              <div class="row ticket-card mt-3 pb-2  <?php if($int!=$ticketCount && $int != 0){ echo "border-bottom";} ?> pb-3 mb-3">

                                                <div class="ticket-details col-md-9">
                                                  <div class="d-flex">
                                                    <p class="text-dark font-weight-semibold mr-2 mb-0 no-wrap"> Kullanıcı Adı: <?php echo $takeUser['username']; ?> </p>
                                                    <p class="text-primary mr-1 mb-0"> [#<?php echo $takeTickets['id']; ?>]</p>
                                                    <!-- <p class="mb-0 ellipsis"><?php echo $takeTickets['type']; ?></p> -->
                                                  </div>
                                                  <p class="text-gray ellipsis mb-2">Konu: <?php echo $takeTickets['subject']; ?>
                                                  </p>
                                                  <div class="row text-gray d-md-flex d-none">
                                                    <div class="col-4 d-flex">
                                                      <small class="mb-0 mr-2 text-muted text-muted">Tür :</small>
                                                      <small class="Last-responded mr-2 mb-0 text-muted text-muted"><?php echo $takeTickets['type']; ?></small>
                                                    </div>
                                                    <div class="col-4 d-flex">
                                                      <small class="mb-0 mr-2 text-muted text-muted">Oluşturma Tarihi :</small>
                                                      <small class="Last-responded mr-2 mb-0 text-muted text-muted"><?php echo tarihcek($takeTickets,'createTime'); ?></small>
                                                    </div>
                                                  </div>
                                                </div>
                                                <div class="ticket-actions col-md-2">
                                                  <div class="btn-group dropdown">
                                                    <button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      Yönet
                                                    </button>
                                                    <div class="dropdown-menu">
                                                      <a class="dropdown-item" href="ticketview-<?php echo $takeTickets['id']; ?>">
                                                        <i class="fa fa-reply fa-fw"></i>Görüntüle
                                                      </a>
                                                      <a class="dropdown-item" href="progress/proc.php?ticket_id=<?php echo $takeTickets['id']; ?>&proc=ticketopen&from=main">
                                                        <i class="fa fa-reply fa-fw"></i>Talebi Aç
                                                      </a>
                                                      <a class="dropdown-item" href="progress/proc.php?ticket_id=<?php echo $takeTickets['id']; ?>&proc=ticketclose&from=main">
                                                        <i class="fa fa-reply fa-fw"></i>Talebi Kapat
                                                      </a>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                      <?php   }
                    }else{ if(isset($_GET['type'])){ echo $_GET['type'];}else{echo "Cevap Bekleyen";} echo " Ticket Bulunamadı...";} ?>




                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- ticket end -->

        <!-- content-wrapper ends -->

<?php require_once('inc/footer.php'); ?>
