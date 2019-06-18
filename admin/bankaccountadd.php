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
                      <div id="goToShopier"></div>
                        <div class="card" style="border:1px solid #161a27;">
                          <div class="card-body">
                            <h4 class="card-title">Banka Hesabı Ekle</h4>
                            <form class="forms-sample" method="post" id="formCategory">

                              <div class="alert alert-dismissible alert-danger" id="dangerShopier" style="display:none"></div>

                              <div class="alert alert-dismissible alert-success" id="successShopier" style="display:none"></div>

                              <div class="form-group">
                                <label for="cost">Hesap adı </label><span class="text-danger"> *</span>
                                <input type="text" class="form-control" id="name" placeholder="Hesap adı" >
                              </div>
                              <div class="form-group">
                                <label for="description">Açıklama </label><span class="text-danger"> *</span>
                                <textarea class="ckeditor" id="description" placeholder="Açıklama"></textarea>
                              </div>

                              <input type="button" class="btn btn-success mr-2" onclick="return addBankAccount()" value="Hesap Ekle">
                            </form>
                          </div>
                        </div>
                      </div>

            </div>
        </div>

        <!-- ticket end -->

        <!-- content-wrapper ends -->

<?php require_once('inc/footer.php'); ?>
