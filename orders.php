<?php require_once("inc/header.php"); ?>
<!-- Main variables *content* -->
<div class="inner-page">

  <!-- <section class="service-search-panel">
    <div class="container">
      <div class="search-panel">
        <form action="/orders" method="get" id="history-search">
              <div class="form-group">
                <div class="input-group">
                <input type="text" name="search" class="form-control" value="" placeholder="Sipariş Ara">

              <span class="input-group-btn">
                <button type="submit" class="btn btn-green"><i class="fa fa-search" aria-hidden="true"></i></button>
              </span>
            </div>
          </div>
        </form>
      </div>

    </div>
  </section> -->

  <section>
    <div class="container-fluid">
      <div class="card my-orders-panel">
        <div class="card-body">
          <div class="tabs-wrapper">
            <ul class="nav nav-justified nav-tabs dragscroll horizontal ">
              <li class="nav-item <? if(!isset($_GET['stats'])){echo "active";}?>"><a class="nav-link" href="orders"><i class="fa fa-list-ul"></i> Hepsi</a></li>
              <li class="nav-item <? if(isset($_GET['stats'])){if ($_GET['stats']=="pending") {echo "active";}} ?>"><a class="nav-link" href="orders?stats=pending"><i class="fa fa-clock"></i> Beklemede</a></li>
              <li class="nav-item <? if(isset($_GET['stats'])){if ($_GET['stats']=="inprogress") {echo "active";}} ?>"><a class="nav-link" href="orders?stats=inprogress"><i class="fa fa-spinner"></i>  İşlemde</a></li>
              <li class="nav-item <? if(isset($_GET['stats'])){if ($_GET['stats']=="completed") {echo "active";}} ?>"><a class="nav-link" href="orders?stats=completed"><i class="fa fa-check"></i> Tamamlandı</a></li>
              <li class="nav-item <? if(isset($_GET['stats'])){if ($_GET['stats']=="partial") {echo "active";}} ?>"><a class="nav-link" href="orders?stats=partial"><i class="fa fa-hourglass-half"></i> Atılamayan İade Edildi</a></li>
              <li class="nav-item <? if(isset($_GET['stats'])){if ($_GET['stats']=="processing") {echo "active";}} ?>"><a class="nav-link" href="orders?stats=processing"><i class="fa fa-chart-line"></i> Sıra Bekliyor</a></li>
              <li class="nav-item <? if(isset($_GET['stats'])){if ($_GET['stats']=="canceled") {echo "active";}} ?>"><a class="nav-link" href="orders?stats=canceled"><i class="fa fa-times-circle"></i>  İptal Edildi</a></li>
            </ul>
          </div>

          <div class="tab-content table-responsive-xl">
            <table class="table table-striped ">
              <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Servis</th>
                <th scope="col">Link</th>
                <th scope="col">Miktar</th>
                <th scope="col" width="150">Başlangıç Sayısı</th>
                <th scope="col" width="100">Tarih</th>
                <th scope="col">Ücret</th>
                <th scope="col" width="120">Durum</th>
                <th scope="col" width="0"></th>
                <!-- <th scope="col">Kalan</th> -->
                              </tr>
              </thead>
              <tbody>
                <?php

                      if(isset($_GET['stats'])){
                        $orders=$db->prepare("SELECT * FROM orders where user_id=:user_id and stats=:stats ORDER BY id DESC");
                        $orders->execute(array(
                          'stats' => $_GET['stats'],
                          'user_id' => $takeUserInfo['id']
                        ));
                      }else{
                        $orders=$db->prepare("SELECT * FROM orders where user_id=:user_id ORDER BY id DESC");
                        $orders->execute(array(
                          'user_id' => $takeUserInfo['id']
                        ));
                      }


                      while($takeOrder=$orders->fetch(PDO::FETCH_ASSOC)){
                        $services=$db->prepare("SELECT * FROM services where id=:id");
                        $services->execute(array(
                          'id' => $takeOrder['service']
                        ));
                        $takeService=$services->fetch(PDO::FETCH_ASSOC)

                         ?>


                        <tr>
            <td><?php echo $takeOrder['id']; ?></td>
            <td><?php echo $takeService['name']; ?></td>
            <td><a href="<?php echo $takeOrder['link']; ?>" class="link" target="_blank"><i class="fa fa-link"></i> <?php echo $takeOrder['link']; ?></a></td>
            <td><?php echo $takeOrder['count']; ?></td>
            <td>13848</td>
            <td><?php echo $takeOrder['createDate']; ?></td>
            <td><?php echo $takeOrder['cost']; ?></td>
            <td class="status-value"><span class="status ">
              <?php
              if ($takeOrder['stats']=="pending") {
                echo "Beklemede";
              }elseif ($takeOrder['stats']=="inprogress") {
                echo "İşlemde";
              }elseif ($takeOrder['stats']=="completed") {
                echo "Tamamlandı";
              }elseif ($takeOrder['stats']=="partial") {
                echo "Atılmayan İade Edildi";
              }elseif ($takeOrder['stats']=="processing") {
                echo "Sıra Bekliyor";
              }elseif ($takeOrder['stats']=="canceled") {
                echo "İade Edildi";
              } ?></span></td>
            <td></td>
                            </tr>

                    <?php  }  ?>


                            </tbody>
            </table>
          </div>



        </div>
      </div>
          </div>
  </section>
</div>

<?php require_once("inc/footer.php"); ?>
