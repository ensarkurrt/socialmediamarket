<?php
require_once("inc/header.php");

if(!empty($_SESSION['username'])){
  header("Location:index");
}
$users=$db->prepare("SELECT * FROM users");
$users->execute();
$countUsers=$users->rowCount();

$orders=$db->prepare("SELECT * FROM orders");
$orders->execute();
$countOrders=$orders->rowCount();
 ?>

  <!-- Main variables *content* -->
  <div class="top-banner" style="padding-bottom: 0px;">
    <div class="container">
      <div class="row">
        <div class="col-md">

          <h1 class="heading"><?php echo $takeSetting['name']; ?></h1>
          <h4 class="sub-heading">Türkiye'nin #1 Numaralı Sosyal Medya Bayilik Paneli!</h4>
          <p class="pera">
          </p>
          <h5><i class="fa fa-check"></i> 7/24 online bakiye yükleme!</h5>
          <h5><i class="fa fa-check"></i> Piyasadaki en ucuz, en kaliteli servisler!</h5>
          <h5><i class="fa fa-check"></i> Piyasadaki en iyi destek hizmeti!</h5>
          <h5><i class="fa fa-check"></i> Panel sahipleri için API Desteği!</h5>
          <h5><i class="fa fa-check"></i> <?php echo $countOrders; ?> Adet Tamamlanan Sipariş!<br>
          </h5>
          <h5><i class="fa fa-check"></i> Bizi Tercih Eden <?php echo $countUsers; ?> Kişiye Teşekkürler!</h5>

          <a href="signup" class="btn btn-green mr-2 hvr-bob">Ücretsiz Üye Ol!</a>
        </div>

        <div class="col-md text-md-right">
          <div class="card login-panel">
            <div class="card-body">
              <div class="title">Kullanıcı Girişi!</div>
              <form method="POST" action="progress/signin.php" name="loginuser">
                <?php if(isset($_GET['stats'])){
                  if($_GET['stats']=="nf"){?>
                    <div class="alert alert-dismissible alert-danger ">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                      Yanlış Kulanıcı Adı Veya Şifre Girdiniz!
                    </div>
                <?php  }elseif($_GET['stats']=="length"){?>
                    <div class="alert alert-dismissible alert-danger ">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                      Şifreniz 8 Karakter Olmalıdır!
                    </div>
                <?php  }
                } ?>

                <div class="form-group">
                  <label for="username" class="control-label">Kullanıcı Adı</label>
                  <input type="text" class="form-control" id="username" name="username" placeholder="Kullanıcı Adınız">
                </div>
                <div class="form-group form-group__password">
                  <label for="password" class="control-label">Şifre</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Şifreniz">
                  <?php if(isset($_GET['redirect'])){ ?> <input type="hidden" class="form-control" id="redirect" name="redirect" value="<? echo $_GET['redirect'];?>"> <?php } ?>
                  <a href="resetpassword" class="link float-right forgot-password">Şifremi Unuttum</a>
                </div>


                <div class="form-group text-center">
                  <input type="submit" class="btn btn-green hvr-bob" name="loginuser" value="Giriş Yap">
                </div>

                <p class="text-center">Hesabınız Yokmu? <a href="signup">Kayıt Ol</a></p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>


  </div>




  <section class="bg-light smm-services">
    <div class="container">
      <h2 class="sec-heading"><span class="blue"><?php echo $takeSetting['name']; ?></span> Türkiye'nin <small>1 Numaralı Sosyal Medya Hizmetleri Sağlayıcısı!</small>
      </h2>
      <div class="row">

        <div class="col-md-6 col-lg-6 cols">
          <div class="card facebook hvr-icon-push">
            <div class="card-body">
              <span class="icon"> <i class="fab fa-facebook hvr-icon" style="margin-top:10px"></i> </span>
              <h3 class="title">FACEBOOK</h3>
              <p class="pera"><?php echo $takeSetting['face_text']; ?></p>
            </div>
          </div>

        </div>
        <div class="col-md-6 col-lg-6 cols">
          <div class="card instagram hvr-icon-push">
            <div class="card-body">
              <span class="icon"> <i class="fab fa-instagram hvr-icon" style="margin-top:10px"></i> </span>
              <h3 class="title">INSTAGRAM </h3>
              <p class="pera"><?php echo $takeSetting['face_text']; ?></p>
            </div>
          </div>

        </div>



      </div>
    </div>

  </section>




  <div class="support-panel">
    <div class="bg-graphic wave" style="margin-top: 0px;"></div>
    <div class="container position-relative">
      <h3 class="title">
        <i class="fa fa-star"></i><span> 7/24 Bize Ulaşabileceğiniz İletişim Adreslerimiz!</span>
      </h3>
      <div class="row">
        <div class="col-md">
          <div class="card"> <a href="tickets" class="card-body hvr-icon-pop"><i class="fa fa-comments hvr-icon"></i> Support Ticket</a>
          </div>
        </div>
        <div class="col-md">
          <div class="card"> <a href="mailto:<?php echo $takeSetting['mail'] ?>" class="card-body hvr-icon-pop"><i class="fa fa-envelope hvr-icon"></i> <?php echo $takeSetting['mail'] ?></a>
          </div>
        </div>
      </div>
    </div>
  </div>




  <?php require_once("inc/footer.php"); ?>
