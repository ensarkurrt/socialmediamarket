<?php
require_once('../../inc/conn.php');
 ?>
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
                Sipariş Sayısı
              </th>
              <th>
                Durum
              </th>
              <th>
                İşlem
              </th>
            </tr>
          </thead>
          <tbody id='tableBody'>
            <?php


                    $service=$db->prepare("SELECT * FROM services where category_id=:id");
                    $service->execute(array(
                      'id' => $_POST['cat_id']
                    ));


                  while($takeService=$service->fetch(PDO::FETCH_ASSOC)){

                    $orders=$db->prepare("SELECT * FROM orders where service=:id");
                    $orders->execute(array(
                      'id' => $takeService['id']
                    ));
                    $count=$orders->rowCount();
                     ?>
                        <tr>
                          <td class="font-weight-medium">
                            <?=$takeService['id']; ?>
                          </td>
                          <td>
                            <?=$takeService['name']; ?>
                          </td>
                          <td>
                            <?=$count ?>
                          </td>
                          <td>
                            <?php if($takeService['enable']=='0'){ ?>

                              <a class="btn btn-danger" href="progress/proc.php?service_id=<?php echo $takeService['id']; ?>&proc=activeService&from=main">
                                <i class="fa fa-reply fa-fw"></i>Pasif
                              </a>

                            <?php }else{ ?>

                              <a class="btn btn-success" href="progress/proc.php?service_id=<?php echo $takeService['id']; ?>&proc=passiveService&from=main">
                                <i class="fa fa-reply fa-fw"></i>Akfif
                              </a>

                          <?php  } ?>
                          </td>
                          <td class="text-danger">
                            <a href="serviceview-<?php echo $takeService['id']; ?>" class="btn btn-info">Düzenle</a>
                          </td>
                        </tr>
                <?php  }  ?>


          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
