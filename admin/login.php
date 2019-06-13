<?php require_once('inc/header.php'); ?>
<?php

$stats=null;

if(isset($_POST)){

  if(isset($_POST['loginuser'])){

    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    $password = md5($password);

    $cek=$db->prepare("select * from users where username=:username and password=:password");
    $cek->execute(array(
      'username' => $username,
      'password' => $password
    ));
    $veri_miktar=$cek->rowCount();

      if ($veri_miktar > 0) {
        $_SESSION['username']=$username;

        if(isset($_POST['redirect'])){
          header("Location:".$_POST['redirect']);
        }else{
          header("Location:index");
        }

      }else{
        $stats='nf';
      }
  }
}



 ?>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <div class="auto-form-wrapper">
              <form action="" method="post" name="loginuser">

                <?php if($stats!=null){
                  echo "<b stlye='color:red'>Kullanıcı bulunamadı</b>";
                } ?>
                <div class="form-group">
                  <label class="label">Kullanıcı adı</label>
                  <div class="input-group">
                    <input type="text" id="username" name="username" class="form-control" placeholder="Kullanıcı Adı">
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="label">şifre</label>
                  <div class="input-group">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Şifre">
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <input type="submit" class="btn btn-primary submit-btn btn-block" name="loginuser" value="Giriş Yap">
                </div>
              </form>
            </div>

            <p class="footer-text text-center">© <?php echo $takeSetting['copyright']; ?></p>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="../../vendors/js/vendor.bundle.base.js"></script>
  <script src="../../vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="../../js/off-canvas.js"></script>
  <script src="../../js/misc.js"></script>
  <!-- endinject -->
</body>

</html>
