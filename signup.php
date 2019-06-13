<?php require_once("inc/header.php"); ?>
<!-- Main variables *content* -->

<div class="inner-page">
  <section>
    <div class="container">
      <div class="row justify-content-center register-panel">
        <div class="col-lg-7">
          <div class="card bg-white">
            <div class="card-header">
              <div class="card-title">
               Üye Ol!
                <small><?php echo $takeSetting['name']; ?></small>
              </div>
            </div>

            <div class="card-body">
              <form action="progress/signup.php" method="post" name="newuser">
                <?php

                $type=null;
                $text=null;
                if(isset($_GET['stats'])){
                  switch ($_GET['stats']) {
                    case 'check':
                      $type = "warning";
                      $text = "Kuralları Kabul Etmeden Kayıt Olamazsınız!";
                      break;
                    case 'length':
                      $type = "warning";
                      $text = "Şifre En Az 8 Karakter Olmalıdır!";
                      break;
                    case 'pdm':
                      $type = "danger";
                      $text = "Şifreler Aynı Olmalıdır!";
                      break;
                    case 'mau':
                      $type = "danger";
                      $text = "Mail Kullanımda!";
                      break;
                    case 'pau':
                      $type = "danger";
                      $text = "Telefon Numarası Kullanımda!";
                      break;
                    case 'uau':
                      $type = "danger";
                      $text = "Kullanıcı Adı Kullanımda!";
                      break;
                    case 'fail':
                      $type = "danger";
                      $text = "Kayıt sırasında bir hata oluştu!";
                      break;
                  }
                }

                if($type!=null){?>

                  <div class="alert alert-dismissible alert-<?php echo $type; ?> ">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                      <?php echo $text; ?>
                    </div>

              <?php } ?>


                  <div class="form-group">
                  <label for="username" class="control-label">Kulanıcı Adı*</label>
                  <input type="text" class="form-control" id="username" value="" name="username" required placeholder="Kullanıcı Adı">
                </div>
                                <div class="form-group">
                  <label for="email" class="control-label">Email*</label>
                  <input type="email" class="form-control" id="email" value="" name="mail" required placeholder="Email Adresiniz">
                </div>
                                  <div class="form-group">
                    <label for="skype" class="control-label">Telefon Numaranız (0) Olmadan*</label>
                    <input type="text" class="form-control" id="skype" value="" name="phone" required placeholder="Telefon Numaranız">
                  </div>
                                <div class="form-group">
                  <label for="password" class="control-label">Şifre*</label>
                  <input type="password" class="form-control" id="password" name="password_one" required placeholder="Şifreniz">
                </div>
                <div class="form-group">
                  <label for="confirm" class="control-label">Tekrar Şifre*</label>
                  <input type="password" class="form-control" id="confirm" name="password_two" required placeholder="Şifreniz Tekrar">
                </div>

                                                  <div class="form-group">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" class="terms-accept-checkbox" required name="checked"> Kuralları okudum ve kabul ediyorum. <a href="terms.php" target="_blank">Kullanım Koşulları</a>
                      </label>
                    </div>
                  </div>


                <button type="submit" class="btn btn-green" name="newuser">Kayıt Ol</button>
                <span class="pull-right pull-right-middle">Zaten bir hesaba sahip misiniz? <a href="home">Giriş Yap</a></span>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

          <script src="https://www.google.com/recaptcha/api.js?hl=tr"></script>
    	</section>
</div>

<?php require_once("inc/footer.php"); ?>
