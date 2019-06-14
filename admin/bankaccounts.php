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
                  <h2 class=" mb-4">Banka Hesapları</h2>
                  <a href='bankaccountadd' class="btn btn-info mr-2">Hesap Ekle</a>
                  <div class="alert alert-dismissible alert-success " id="dangerSetting" style="display:<?php if(isset($_GET['stats'])){if($_GET['stats']=='ok'){echo 'block';}else{echo 'none';}}else{echo 'none';} ?>">
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
                            Hesap adı
                          </th>
                          <th>
                            İşlem
                          </th>
                        </tr>
                      </thead>
                      <tbody>

                              <?php
                              $accounts=$db->prepare("SELECT * FROM pay_type");
                              $accounts->execute();
                              while($takeAccount=$accounts->fetch(PDO::FETCH_ASSOC)){ ?>
                                    <tr>
                                      <td class="font-weight-medium">
                                        <?=$takeAccount['id']; ?>
                                      </td>
                                      <td>
                                        <?=$takeAccount['name']; ?>
                                      </td>
                                      <td class="text-danger">
                                        <a href="bankaccountview-<?php echo $takeAccount['id']; ?>" class="btn btn-info">Düzenle</a>
                                        <a href="progress/proc.php?account_id=<?php echo $takeAccount['id']; ?>&proc=deleteBankAccount&from=main" class="btn btn-danger">Sil</a>
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
