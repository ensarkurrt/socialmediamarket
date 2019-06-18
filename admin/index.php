<?php
require_once('inc/header.php');


//Kazanç Analytics
$kazancStat=$db->prepare("SELECT * FROM analytics where type=:type ORDER BY id DESC LIMIT 1");
$kazancStat->execute(array(
  'type' => 'Kazanç'
));
$takeKazanc=$kazancStat->fetch(PDO::FETCH_ASSOC);

//Sipariş Analytics
$siparisStat=$db->prepare("SELECT * FROM analytics where type=:type ORDER BY id DESC LIMIT 1");
$siparisStat->execute(array(
  'type' => 'Sipariş'
));
$takeSiparis=$siparisStat->fetch(PDO::FETCH_ASSOC);

//Üye Analytics
$uyeStat=$db->prepare("SELECT * FROM analytics where type=:type ORDER BY id DESC LIMIT 1");
$uyeStat->execute(array(
  'type' => 'Üye'
));
$takeUye=$uyeStat->fetch(PDO::FETCH_ASSOC);

//Tickets Analytics
$ticketsStat=$db->prepare("SELECT * FROM tickets where stats=:stats");
$ticketsStat->execute(array(
  'stats' => 'Cevap Bekleniyor'
));
$ticketCount=$ticketsStat->rowCount();


//Toplam tickets
$ticketsStat1=$db->prepare("SELECT * FROM tickets");
$ticketsStat1->execute();
$ticketCount1=$ticketsStat1->rowCount();

//Toplam Sipariş
$totalSiparis=$db->prepare("SELECT * FROM orders");
$totalSiparis->execute();
$totalSiparisCount=$totalSiparis->rowCount();

$kazanc=0;
$toplamKazanc=$db->prepare("SELECT * FROM analytics where type=:type");
$toplamKazanc->execute(array(
  'type' => 'Kazanç'
));
while($takeToplamKazanc=$toplamKazanc->fetch(PDO::FETCH_ASSOC)){
  $kazanc = $kazanc + $takeToplamKazanc['value'];
}

//Toplam Kazanç
// $totalKazanc=$db->prepare("SELECT * FROM tickets");
// $totalKazanc->execute();
// $totalKazancCount=$totalKazanc->rowCount();

//Toplam Üye
$totalUye=$db->prepare("SELECT * FROM users");
$totalUye->execute();
$totalUyeCount=$totalUye->rowCount();

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
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics" style="border:2px solid #161a27;">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-cash-multiple text-success icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Bu Aylık Kazanç</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0"><?php echo $takeKazanc['value']; ?> TL</h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> Toplam: <?php echo $kazanc; ?> TL
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics" style="border:2px solid #161a27;">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-account-location text-warning icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Bu Aylık Üye</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0"><?php echo $takeUye['value']; ?></h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> Toplam: <?php echo $totalUyeCount; ?>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics" style="border:2px solid #161a27;">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-poll-box text-danger icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Bu Aylık Sipariş</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0"><?php echo $takeSiparis['value']; ?></h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> Toplam: <?php echo $totalSiparisCount; ?>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics" style="border:2px solid #161a27;">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-receipt text-info icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">C. Bekleyen Ticketlar</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0"><?php echo $ticketCount; ?></h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> Toplam: <?php echo $ticketCount1; ?>
                  </p>
                </div>
              </div>
            </div>
          </div>




          <!-- ticket start -->
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card" style="border:1px solid #161a27;">
                <div class="card-body">
                  <h5 class="card-title mb-4">Cevap Bekleyen Ticketlar</h5>
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
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                      <?php   }
                    }else{ echo "Cevap Bekleyen Ticket Bulunamadı...";} ?>




                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- ticket end -->

        <!-- content-wrapper ends -->

<?php require_once('inc/footer.php'); ?>
