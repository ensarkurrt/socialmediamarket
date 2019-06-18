<?php
require_once('inc/header.php');

if(!isset($_GET['shopierlink_id'])){
  header('Location:shopierlinks');
  exit();
}

$ids=$db->prepare("SELECT * FROM shopier_id where id=:id");
$ids->execute(array(
  'id' => $_GET['shopierlink_id']
));
$countIds=$ids->rowCount();

if($countIds==0){
  header('Location:shopierlinks');
  exit();
}

$takeIds=$ids->fetch(PDO::FETCH_ASSOC);

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
                            <h4 class="card-title">Shopier Link Düzenle</h4>
                            <form class="forms-sample" method="post" id="formCategory">

                              <div class="alert alert-dismissible alert-danger" id="dangerShopier" style="display:none"></div>

                              <div class="alert alert-dismissible alert-success" id="successShopier" style="display:none"></div>

                              <div class="form-group">
                                <label for="cost">Link Tutarı </label><span class="text-danger"> *</span>
                                <input type="number" class="form-control" id="cost" placeholder="Tutar" value="<?php echo $takeIds['amount']; ?>">
                              </div>
                              <input type="hidden" name="" id='data_id' value="<?php echo $takeIds['id'] ?>">
                              <div class="form-group">
                                <label for="link_id">Link Id </label><span class="text-danger"> *</span>
                                <input type="number" class="form-control" id="link_id" placeholder="Link Id" value="<?php echo $takeIds['link_id']; ?>"><br>
                                <p class="muted text-muted"> Örnek: https://www.shopier.com/ShowProductNew/products.php?id=<b>962375</b></p>
                              </div>

                              <input type="button" class="btn btn-success mr-2" onclick="return saveShopierLink()" value="Link Düzenle">
                            </form>
                          </div>
                        </div>
                      </div>

            </div>
        </div>

        <!-- ticket end -->

        <!-- content-wrapper ends -->

<?php require_once('inc/footer.php'); ?>
