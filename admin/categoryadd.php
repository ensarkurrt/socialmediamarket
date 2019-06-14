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

          <!-- ticket start -->

            <div class="row">
                  <div class="col-12 grid-margin">
                      <div id="goToMail"></div>
                        <div class="card" style="border:1px solid #161a27;">
                          <div class="card-body">
                            <h4 class="card-title">Kategori Ekle</h4>
                            <form class="forms-sample" method="post" id="formCategory">

                              <div class="alert alert-dismissible alert-danger" id="dangerCategory" style="display:none">
                               Yanlış Kulanıcı Adı Veya Şifre Girdiniz!
                              </div>

                              <div class="alert alert-dismissible alert-success" id="successCategory" style="display:none">
                               Yanlış Kulanıcı Adı Veya Şifre Girdiniz!
                              </div>

                              <div class="form-group">
                                <label for="name">Kategori Adı </label><span class="text-danger"> *</span>
                                <input type="text" class="form-control" id="name" placeholder="Kategori Adı" >
                              </div>
                              <div class="form-group">
                                <label for="status">Kategori Durum </label><span class="text-danger"> *</span>
                                <select class="form-control" name="status" id="status">
                                    <option value="1">Aktif</option>
                                    <option value="0">Pasif</option>
                                </select>
                              </div>

                              <input type="button" class="btn btn-success mr-2" onclick="return addCategory()" value="Kategori Ekle">
                            </form>
                          </div>
                        </div>
                      </div>

            </div>
        </div>

        <!-- ticket end -->

        <!-- content-wrapper ends -->

<?php require_once('inc/footer.php'); ?>
