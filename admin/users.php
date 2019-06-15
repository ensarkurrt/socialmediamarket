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
                  <h2 class=" mb-4">Üyeler</h2>
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
                            Bakiye
                          </th>
                          <th>
                            Üyelik Tarihi
                          </th>
                          <th>
                            Fiyatlandırma
                          </th>
                          <th>
                            İşlem
                          </th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php



                                $users=$db->prepare("SELECT * FROM users ORDER BY id DESC");
                                $users->execute();


                              while($takeUsers=$users->fetch(PDO::FETCH_ASSOC)){
                                 ?>
                                    <tr>
                                      <td class="font-weight-medium">
                                        <?=$takeUsers['id']; ?>
                                      </td>
                                      <td>
                                        <?=$takeUsers['username']; ?>
                                      </td>
                                      <td>
                                        <?=$takeUsers['balance'] ?> TL
                                      </td>
                                      <td>
                                        <?= tarihcek($takeUsers,'register_time'); ?>
                                      </td>
                                      <td>
                                        <a href="specialcost?user_id=<?=$takeUsers['id']?>" class="btn btn-success">Özel Fiyatlandırma</a>
                                      </td>
                                      <td class="text-danger">
                                        <a href="userview-<?php echo $takeUsers['id']; ?>" class="btn btn-info">Düzenle</a>
                                        <a href="progress/proc.php?user_id=<?php echo $takeUsers['id']; ?>&proc=deleteUser&from=main" class="btn btn-danger">Sil</a>
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
