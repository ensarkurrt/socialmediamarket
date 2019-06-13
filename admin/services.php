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


                    <select class="btn btn-success form-control" name="" id='categories' onchange="getServices(this)">
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

                </div>
                </div>
                </div>
            </div>

          <div class="row" id='rowCont'>

          </div>



        </div>

        <!-- ticket end -->

        <!-- content-wrapper ends -->

<?php require_once('inc/footer.php'); ?>
