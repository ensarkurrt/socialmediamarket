<?php
require_once('inc/header.php');


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
              <div class="card"  style="border:1px solid #161a27;">
              <div class="card-body">
                  <h2 class=" mb-4">Ödeme Bildirimleri</h2>
                  <a href='paynotif?status=Odendi' class="btn btn-success mr-2"> Ödenmiş Bildirimler</a>
                  <a href='paynotif?status=Iptal Edildi' class="btn btn-danger mr-2"> İptal Edilen Bildirimler</a>
                  <a href='paynotif?status=Bekleniyor' class="btn btn-info mr-2"> Bekleyen Bildirimler</a>
                  <div class="alert alert-dismissible alert-success" id="dangerSetting" style="display:<?php if(isset($_GET['stats'])){if($_GET['stats']=='ok'){echo 'block';}else{echo 'none';}}else{echo 'none';} ?>">
                    İşlem başarılı
                  </div>
                </div>
                </div>
                </div>
            </div>

          <div class="row">
            <div class="col-lg-12 grid-margin">
              <div class="card" style="border:1px solid #161a27;">
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>
                            #
                          </th>
                          <th>
                            Kullanıcı Adı
                          </th>
                          <th>
                            Banka Adı
                          </th>
                          <th>
                            Tutar
                          </th>
                          <th>
                            Durum
                          </th>
                          <th>
                            Tarih
                          </th>
                          <th>
                            İşlem
                          </th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php

                              if(isset($_GET['status'])){
                                $notif=$db->prepare("SELECT * FROM transferPay where stats=:status");
                                $notif->execute(array(
                                  'status' => $_GET['status']
                                ));
                              }else{
                                $notif=$db->prepare("SELECT * FROM transferPay");
                                $notif->execute();
                              }

                              while($takeNotif=$notif->fetch(PDO::FETCH_ASSOC)){
                                $bank=$db->prepare("SELECT * FROM pay_type where id=:id");
                                $bank->execute(array(
                                  'id' => $takeNotif['bank_id']
                                ));
                                $takeBank=$bank->fetch(PDO::FETCH_ASSOC);
                                 ?>
                                    <tr>
                                      <td class="font-weight-medium">
                                        <?=$takeNotif['id']; ?>
                                      </td>
                                      <td>
                                        <?=$takeNotif['username']; ?>
                                      </td>
                                      <td>
                                        <?=$takeBank['name']; ?>
                                      </td>
                                      <td>
                                        <?=$takeNotif['amount'] ?> TL
                                      </td>
                                      <td>
                                        <?php if(isset($_GET['status'])){
                                          if($_GET['status']=='Iptal Edildi'){?>
                                            <a class="btn btn-danger" style="color:white">İptal Edildi</a>
                                        <?php }else  if($_GET['status']=='Odendi'){?>
                                          <a class="btn btn-success" style="color:white">Ödendi</a>
                                      <?php }else  if($_GET['status']=='Bekleniyor'){?>
                                        <div class="btn-group dropdown">
                                          <button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Bekleniyor
                                          </button>
                                          <div class="dropdown-menu">
                                            <a class="dropdown-item" href="progress/proc.php?notif_id=<?php echo $takeNotif['id']; ?>&proc=activeNotif&from=main">
                                              <i class="fa fa-reply fa-fw"></i>Onayla
                                            </a>
                                            <a class="dropdown-item" href="progress/proc.php?notif_id=<?php echo $takeNotif['id']; ?>&proc=cancelNotif&from=main">
                                              <i class="fa fa-reply fa-fw"></i>İptal Et
                                            </a>
                                          </div>
                                        </div>
                                    <?php }
                                  }else{ ?>
                                    <div class="btn-group dropdown">
                                      <button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Bekleniyor
                                      </button>
                                      <div class="dropdown-menu">
                                        <a class="dropdown-item" href="progress/proc.php?notif_id=<?php echo $takeNotif['id']; ?>&proc=activeNotif&from=main">
                                          <i class="fa fa-reply fa-fw"></i>Onayla
                                        </a>
                                        <a class="dropdown-item" href="progress/proc.php?notif_id=<?php echo $takeNotif['id']; ?>&proc=cancelNotif&from=main">
                                          <i class="fa fa-reply fa-fw"></i>İptal Et
                                        </a>
                                      </div>
                                    </div>
                                <?php } ?>
                                      </td>
                                      <td>
                                        <?= tarihcek($takeNotif,'createTime'); ?>
                                      </td>
                                      <td class="text-danger">
                                        <a href="progress/proc.php?notif_id=<?php echo $takeNotif['id']; ?>&proc=deleteNotif&from=main" class="btn btn-danger">Sil</a>
                                      </td>
                                    </tr>
                            <?php  }  ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- ticket end -->

        <!-- content-wrapper ends -->

<?php require_once('inc/footer.php'); ?>
