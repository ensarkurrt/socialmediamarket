<?php
require_once('inc/header.php');

if(!isset($_GET['order_id'])){
  header('Location:orders');
  exit();
}

$orders=$db->prepare("SELECT * FROM orders where id=:id");
$orders->execute(array(
  'id' => $_GET['order_id']
));
$countOrder=$orders->rowCount();

if($countOrder==0){
  header('Location:orders');
  exit();
}

$takeOrder=$orders->fetch(PDO::FETCH_ASSOC);

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
                            <h4 class="card-title">Sipariş Detay</h4>
                            <form class="forms-sample" method="post" id="formCategory">

                              <div class="alert alert-dismissible alert-danger" id="dangerCategory" style="display:none">
                               Yanlış Kulanıcı Adı Veya Şifre Girdiniz!
                              </div>

                              <div class="alert alert-dismissible alert-success" id="successCategory" style="display:none">
                               Yanlış Kulanıcı Adı Veya Şifre Girdiniz!
                              </div>

                              <?php $services=$db->prepare("SELECT * FROM services where id=:id");
                              $services->execute(array(
                                'id' => $takeOrder['service']
                              ));
                              $takeService=$services->fetch(PDO::FETCH_ASSOC);

                              $users=$db->prepare("SELECT * FROM users where id=:id");
                              $users->execute(array(
                                'id' => $takeOrder['user_id']
                              ));
                              $takeUser=$users->fetch(PDO::FETCH_ASSOC);
                               ?>

                              <div class="form-group">
                                <label for="name">Servis Adı </label><span class="text-danger"> *</span>
                                <input type="text" class="form-control" id="name" placeholder="Kategori Adı" value="<?php echo $takeService['name']; ?>" disabled>
                              </div>

                              <div class="form-group">
                                <label for="name">Miktar </label><span class="text-danger"> *</span>
                                <input type="number" class="form-control" id="name" placeholder="Kategori Adı" value="<?php echo $takeOrder['count']; ?>" disabled>
                              </div>

                              <div class="form-group">
                                <label for="name">Tutar </label><span class="text-danger"> *</span>
                                <input type="text" class="form-control" id="name" placeholder="Kategori Adı" value="<?php echo $takeOrder['cost']; ?> TL" disabled>
                              </div>

                              <div class="form-group">
                                <label for="name">Link </label><span class="text-danger"> *</span>
                                <input type="text" class="form-control" id="name" placeholder="Kategori Adı" value="<?php echo $takeOrder['link']; ?>" disabled>
                              </div>

                              <div class="form-group">
                                <label for="name">Kullanıcı </label><span class="text-danger"> *</span>
                                <input type="text" class="form-control" id="name" placeholder="Kategori Adı" value="<?php echo $takeUser['username']; ?>" disabled>
                              </div>

                              <div class="form-group">
                                <label for="name">Durum </label><span class="text-danger"> *</span>
                                <input disabled type="text" class="form-control" id="name" placeholder="Kategori Adı" value="<?php if($takeOrder['stats']=='pending'){echo "Beklemede";}else if($takeOrder['stats']=='inprogress'){echo "İşlemde";}
                                else if($takeOrder['stats']=='completed'){echo "Tamamlandı";}
                                else if($takeOrder['stats']=='partial'){echo "Atılmayan İade Edildi";}else if($takeOrder['stats']=='processing'){echo "Sıra Bekliyor";}else if($takeOrder['stats']=='canceled'){echo "İptal Edildi";} ?>">
                              </div>

                            </form>
                          </div>
                        </div>
                      </div>

            </div>
        </div>

        <!-- ticket end -->

        <!-- content-wrapper ends -->

<?php require_once('inc/footer.php'); ?>
