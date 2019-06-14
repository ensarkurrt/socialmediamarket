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
                  <h2 class=" mb-4">Kategoriler</h2>
                  <a href='categories?status=1' class="btn btn-success mr-2"> Aktif Kategoriler</a>
                  <a href='categories?status=0' class="btn btn-danger mr-2"> Pasif Kategoriler</a>
                  <a href='categories' class="btn btn-info mr-2"> Tüm Kategoriler</a>
                  <a href='categoryadd' class="btn btn-info mr-2">Kategori Ekle</a>

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
                            Kategori Adı
                          </th>
                          <th>
                            Servis Sayısı
                          </th>
                          <th>
                            Durum
                          </th>
                          <th>
                            Servisler
                          </th>
                          <th>
                            İşlem
                          </th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php


                              if(isset($_GET['status'])){
                                $category=$db->prepare("SELECT * FROM category where enable=:status");
                                $category->execute(array(
                                  'status' => $_GET['status']
                                ));
                              }else{
                                $category=$db->prepare("SELECT * FROM category");
                                $category->execute();
                              }

                              while($takeCategory=$category->fetch(PDO::FETCH_ASSOC)){

                                $services=$db->prepare("SELECT * FROM services where category_id=:id");
                                $services->execute(array(
                                  'id' => $takeCategory['id']
                                ));
                                $count=$services->rowCount();
                                 ?>
                                    <tr>
                                      <td class="font-weight-medium">
                                        <?=$takeCategory['id']; ?>
                                      </td>
                                      <td>
                                        <?=$takeCategory['name']; ?>
                                      </td>
                                      <td>
                                        <?=$count ?>
                                      </td>
                                      <td>
                                        <?php if($takeCategory['enable']=='0'){ ?>

                                          <a class="btn btn-danger" href="progress/proc.php?category_id=<?php echo $takeCategory['id']; ?>&proc=activeCategory&from=main">
                                            <i class="fa fa-reply fa-fw"></i>Pasif
                                          </a>

                                        <?php }else{ ?>

                                          <a class="btn btn-success" href="progress/proc.php?category_id=<?php echo $takeCategory['id']; ?>&proc=passiveCategory&from=main">
                                            <i class="fa fa-reply fa-fw"></i>Akfif
                                          </a>

                                      <?php  } ?>
                                      </td>
                                      <td>
                                        <a href="services?category=<?=$takeCategory['id']?>" class="btn btn-success">Servisleri görüntüle</a>
                                      </td>
                                      <td class="text-danger">
                                        <a href="categoryview-<?php echo $takeCategory['id']; ?>" class="btn btn-info">Düzenle</a>
                                        <a href="progress/proc.php?category_id=<?php echo $takeCategory['id']; ?>&proc=deleteCategory&from=main" class="btn btn-danger">Sil</a>
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
