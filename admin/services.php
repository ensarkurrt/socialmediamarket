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
              <div class="card" style="border:1px solid #161a27;">
              <div class="card-body">
                  <h2 class=" mb-4">Servisler</h2>

                  <?php if(!isset($_GET['category'])){ ?>
                    <select class="btn btn-success form-control col-md-2" name="" id='categories' onchange="getServices(this)">
                      <option value="0">Kategori Seçin</option>
                      <?php
                          $category=$db->prepare("SELECT * FROM category where enable=:status");
                          $category->execute(array(
                            'status' => 1
                          ));
                        while($takeCategory=$category->fetch(PDO::FETCH_ASSOC)){ ?>
                            <option value="<?php echo $takeCategory['id']; ?>"><?php echo $takeCategory['name']; ?></option>
                        <?php } ?>
                    </select>

                    <div class="alert alert-dismissible alert-success" id="dangerSetting" style="display:<?php if(isset($_GET['status'])){if($_GET['status']=='ok'){echo 'block';}else{echo 'none';}}else{echo 'none';} ?>">
                      İşlem başarılı
                    </div>
                  <?php } ?>
                  <a href='serviceadd' class="btn btn-info mr-2">Servis Ekle</a>

                </div>
                </div>
                </div>
            </div>

          <div class="row" id='rowCont'>
              <?php if (isset($_GET['category'])) { ?>

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
                                     'id' => $_GET['category']
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
                                           <a href="progress/proc.php?service_id=<?php echo $takeService['id']; ?>&proc=deleteService&from=main" class="btn btn-danger">Sil</a>
                                         </td>
                                       </tr>
                               <?php  }  ?>


                         </tbody>
                       </table>
                     </div>
                   </div>
                 </div>
               </div>

            <?php  } ?>
          </div>



        </div>

        <!-- ticket end -->

        <!-- content-wrapper ends -->

<?php require_once('inc/footer.php'); ?>
