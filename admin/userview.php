<?php
require_once('inc/header.php');

if(!isset($_GET['user_id'])){
  header('Location:users');
  exit();
}

$users=$db->prepare("SELECT * FROM users where id=:id");
$users->execute(array(
  'id' => $_GET['user_id']
));
$countUsers=$users->rowCount();

if($countUsers==0){
  header('Location:users');
  exit();
}

$takeUsers=$users->fetch(PDO::FETCH_ASSOC);

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
                            <h4 class="card-title">Üye Düzenle</h4>
                            <form class="forms-sample" method="post" id="formCategory">

                              <div class="alert alert-dismissible alert-danger" id="dangerUser" style="display:none">
                               Yanlış Kulanıcı Adı Veya Şifre Girdiniz!
                              </div>

                              <div class="alert alert-dismissible alert-success" id="successUser" style="display:none">
                               Yanlış Kulanıcı Adı Veya Şifre Girdiniz!
                              </div>

                              <div class="form-group">
                                <label for="name">Kullanıcı Adı </label><span class="text-danger"> *</span>
                                <input type="text" class="form-control" placeholder="Kategori Adı" value="<?php echo $takeUsers['username']; ?>" disabled>
                              </div>

                              <div class="form-group">
                                <label for="mail">E-Mail Adresi </label><span class="text-danger"> *</span>
                                <input type="text" class="form-control" id="mail" placeholder="E-Mail Adresi" value="<?php echo $takeUsers['mail']; ?>">
                              </div>

                              <div class="form-group">
                                <label for="phone">Telefon Numarası </label><span class="text-danger"> *</span>
                                <input type="text" class="form-control" id="phone" placeholder="Telefon Numarası" value="<?php echo $takeUsers['phone']; ?>">
                              </div>

                              <div class="form-group">
                                <label for="">Kayıt Tarihi </label><span class="text-danger"> *</span>
                                <input type="text" class="form-control" placeholder="Kayıt Tarihi" value="<?php echo tarihcek($takeUsers,'register_time'); ?>" disabled>
                              </div>

                              <input type="hidden" name="" id='cat_id' value="<?php echo $_GET['user_id']; ?>">

                              <div class="form-group">
                                <label for="status">Hesap Durum </label><span class="text-danger"> *</span>
                                <select class="form-control" name="status" id="status">

                                  <?php if($takeUsers['verified_mail']=='0'){ ?>
                                    <option value="0">Onaylanmadı</option>
                                    <option value="1">Onaylandı</option>
                                <?php  }else{ ?>
                                    <option value="1">Onaylandı</option>
                                    <option value="0">Onaylanmadı</option>
                              <?php  } ?>
                                </select>
                              </div>

                              <div class="form-group">
                                <label for="perm">Hesap Yetkisi </label><span class="text-danger"> *</span>
                                <select class="form-control" name="status" id="perm">

                                  <?php if($takeUsers['perm']=='0'){ ?>
                                    <option value="0">Müşteri</option>
                                    <option value="1">Yönetici</option>
                                <?php  }else{ ?>
                                    <option value="1">Yönetici</option>
                                    <option value="0">Müşteri</option>
                              <?php  } ?>
                                </select>
                              </div>


                              <input type="button" class="btn btn-success mr-2" onclick="return saveUser()" value="Kullanıcı Kaydet">
                            </form>
                          </div>
                        </div>
                      </div>

            </div>

            <div class="row">
                  <div class="col-12 grid-margin">
                      <div id="goToMail"></div>
                        <div class="card" style="border:1px solid #161a27;">
                          <div class="card-body">
                            <h4 class="card-title">Şifre Değiştir Düzenle</h4>
                            <form class="forms-sample" method="post" id="formCategory">

                              <div class="alert alert-dismissible alert-danger" id="dangerPassword" style="display:none">
                               Yanlış Kulanıcı Adı Veya Şifre Girdiniz!
                              </div>

                              <div class="alert alert-dismissible alert-success" id="successPassword" style="display:none">
                               Yanlış Kulanıcı Adı Veya Şifre Girdiniz!
                              </div>

                              <div class="form-group">
                                <label for="newPassword">Yeni Şifre </label><span class="text-danger"> *</span>
                                <input type="password" class="form-control" placeholder="Yeni Şifre" id="newPassword">
                              </div>

                              <input type="button" class="btn btn-success mr-2" onclick="return savePassword()" value="Şifre Değiştir">
                            </form>
                          </div>
                        </div>
                      </div>

            </div>

            <div class="row">
                  <div class="col-12 grid-margin">
                      <div id="goToMail"></div>
                        <div class="card" style="border:1px solid #161a27;">
                          <div class="card-body">
                            <h4 class="card-title">Bakiye Düzenle</h4>
                            <p class="muted text-muted">Mevcut Bakiye : <?php echo $takeUsers['balance']; ?> TL</p>
                            <form class="forms-sample" method="post" id="formCategory">

                              <div class="alert alert-dismissible alert-danger" id="dangerBalance" style="display:none">
                               Yanlış Kulanıcı Adı Veya Şifre Girdiniz!
                              </div>

                              <div class="alert alert-dismissible alert-success" id="successBalance" style="display:none">
                               Yanlış Kulanıcı Adı Veya Şifre Girdiniz!
                              </div>

                              <div class="form-group">
                                <label for="balance">Yeni Bakiye </label><span class="text-danger"> *</span>
                                <input type="number" class="form-control" placeholder="Yeni Bakiye" id="balance">
                              </div>

                              <input type="button" class="btn btn-success mr-2" onclick="return saveBalance()" value="Bakiye Değiştir">
                            </form>
                          </div>
                        </div>
                      </div>

            </div>
        </div>

        <!-- ticket end -->

        <!-- content-wrapper ends -->

<?php require_once('inc/footer.php'); ?>
