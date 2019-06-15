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
                  <h2 class=" mb-4">Siparişler</h2>
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
                            Servis Adı
                          </th>
                          <th>
                            Link
                          </th>
                          <th>
                            Sipariş Veren
                          </th>
                          <th>
                            Miktar
                          </th>
                          <th>
                            Tutar
                          </th>
                          <th>
                            Tarih
                          </th>
                          <th>
                            Durum
                          </th>
                          <th>
                            İşlem
                          </th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php



                              $orders=$db->prepare("SELECT * FROM orders ORDER BY id DESC");
                              $orders->execute();

                              while($takeOrder=$orders->fetch(PDO::FETCH_ASSOC)){

                                $services=$db->prepare("SELECT * FROM services where id=:id");
                                $services->execute(array(
                                  'id' => $takeOrder['service']
                                ));
                                $takeService=$services->fetch(PDO::FETCH_ASSOC);

                                $users=$db->prepare("SELECT * FROM users where id=:id");
                                $users->execute(array(
                                  'id' => $takeOrder['user_id']
                                ));
                                $takeUser=$users->fetch(PDO::FETCH_ASSOC);

                                 ?>
                                    <tr>
                                      <td class="font-weight-medium">
                                        #<?=$takeOrder['id']; ?>
                                      </td>
                                      <td>
                                        <?=$takeService['name']; ?>
                                      </td>
                                      <td>
                                        <?=$takeOrder['link']; ?>
                                      </td>
                                      <td>
                                        <?=$takeUser['username']; ?>
                                      </td>
                                      <td>
                                        <?=$takeOrder['count']; ?>
                                      </td>
                                      <td>
                                        <?=$takeOrder['cost']; ?> TL
                                      </td>
                                      <td>
                                        <?= tarihcek($takeOrder,'createDate'); ?>
                                      </td>
                                      <td>
                                        <a style="color:white" class="btn btn-<?php if($takeOrder['stats']=='pending'){echo "warning";}else if($takeOrder['stats']=='inprogress'){echo "primary";}else if($takeOrder['stats']=='completed'){echo "success";}
                                         else if($takeOrder['stats']=='partial'){echo "info";}else if($takeOrder['stats']=='processing'){echo "dark";}else if($takeOrder['stats']=='canceled'){echo "danger";} ?>">
                                        <?php if($takeOrder['stats']=='pending'){echo "Beklemede";}else if($takeOrder['stats']=='inprogress'){echo "İşlemde";}else if($takeOrder['stats']=='completed'){echo "Tamamlandı";}
                                        else if($takeOrder['stats']=='partial'){echo "Atılmayan İade Edildi";}else if($takeOrder['stats']=='processing'){echo "Sıra Bekliyor";}else if($takeOrder['stats']=='canceled'){echo "İptal Edildi";} ?></a>
                                      </td>
                                      <td class="text-danger">
                                        <a href="orderview-<?php echo $takeOrder['id']; ?>" class="btn btn-info">Detay</a>
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
