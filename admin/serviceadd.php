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
              <div id='respon'>

              </div>
                  <div class="col-12 grid-margin">
                      <div id="goToMail"></div>
                        <div class="card" style="border:1px solid #161a27;">
                          <div class="card-body">
                            <h4 class="card-title">Servis Ekle</h4>
                            <form class="forms-sample" method="post" id="formCategory">

                              <div class="alert alert-dismissible alert-danger" id="dangerService" style="display:none">

                              </div>

                              <div class="alert alert-dismissible alert-success" id="successService" style="display:none">

                              </div>

                              <div class="form-group">
                                <label for="name">Servis Adı </label><span class="text-danger"> *</span>
                                <input type="text" class="form-control" id="name" placeholder="Kategori Adı" >
                              </div>

                              <div class="form-group">
                                <label for="category">Servis Kategori </label><span class="text-danger"> *</span>
                                <select class="form-control" name="category" id="category">
                                  <?php

                                  $category=$db->prepare("SELECT * FROM category where enable=:enable");
                                  $category->execute(array(
                                    'enable' => 1
                                  ));

                                  while($takeCategory=$category->fetch(PDO::FETCH_ASSOC)){

                                    if($categoryId!=$takeCategory['id']){ ?>

                                    <option value="<?php echo $takeCategory['id']; ?>"><?php echo $takeCategory['name']; ?></option>

                                <?php  }  } ?>
                                </select>
                              </div>

                              <div class="form-group">
                                <label for="description">Açıklama </label><span class="text-danger"> *</span>
                                <textarea class="ckeditor" id="description" name="description" placeholder="Açıklama"></textarea>
                              </div>

                              <div class="form-group">
                                <label for="money">Fiyat </label><span class="text-danger"> *</span>
                                <input type="number" class="form-control" id="money" placeholder="Ücret">
                              </div>

                              <div class="form-group">
                                <label for="min">Minimum </label><span class="text-danger"> *</span>
                                <input type="number" class="form-control" id="min" placeholder="Minimum">
                              </div>

                              <div class="form-group">
                                <label for="max">Maksimum </label><span class="text-danger"> *</span>
                                <input type="number" class="form-control" id="max" placeholder="Maksimum">
                              </div>


                              <input type="hidden" name="" id='service_id'>
                              <div class="form-group">
                                <label for="status">Servis Durum </label><span class="text-danger"> *</span>
                                <select class="form-control" name="status" id="status">
                                    <option value="1">Aktif</option>
                                    <option value="0">Pasif</option>
                                </select>
                              </div>


                              <input type="button" class="btn btn-success mr-2" onclick="return addService()" value="Kategori Kaydet">
                            </form>
                          </div>
                        </div>
                      </div>

            </div>
        </div>

        <!-- ticket end -->

        <!-- content-wrapper ends -->

<?php require_once('inc/footer.php'); ?>
