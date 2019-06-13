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
                <div id="goToSetting"></div>
                    <div class="card" style="border:1px solid #161a27;">
                      <div class="card-body">
                        <h4 class="card-title">Genel Ayar</h4>
                        <p class="card-description">
                          Genel ayarları buradan düzenleyebilirsiniz
                        </p>
                        <form class="forms-sample" method="post">

                          <div class="alert alert-dismissible alert-danger" id="dangerSetting" style="display:none">
                           Yanlış Kulanıcı Adı Veya Şifre Girdiniz!
                          </div>

                          <div class="alert alert-dismissible alert-success" id="successSetting" style="display:none">
                           Yanlış Kulanıcı Adı Veya Şifre Girdiniz!
                          </div>

                          <div class="form-group">
                            <label for="url">Site Url </label><span class="text-danger"> *</span>
                            <input type="text" class="form-control" id="url" placeholder="Site Adı" value="<?php echo $takeSetting['url']; ?>">
                          </div>

                          <div class="form-group">
                            <label for="title">Site Adı </label><span class="text-danger"> *</span>
                            <input type="text" class="form-control" id="title" placeholder="Site Adı" value="<?php echo $takeSetting['name']; ?>">
                          </div>

                          <div class="form-group">
                            <label for="slogan">Site Sloganı </label><span class="text-danger"> *</span>
                            <input type="text" class="form-control" id="slogan" placeholder="Site Sloganı" value="<?php echo $takeSetting['slogan']; ?>">
                          </div>

                          <div class="form-group">
                            <label for="description">Site Açıklaması </label><span class="text-danger"> *</span>
                            <textarea class="form-control" id="description" placeholder="Site Açıklaması"><?php echo $takeSetting['description']; ?></textarea>
                          </div>

                          <div class="form-group">
                            <label for="keywords">Site Anahtar Kelimeleri </label><span class="text-danger"> *</span>
                            <textarea class="form-control" id="keywords" placeholder="Site Anahtar Kelimeleri"><?php echo $takeSetting['keywords']; ?></textarea>
                          </div>

                          <div class="form-group">
                            <label for="copyright">Copyright </label><span class="text-danger"> *</span>
                            <input type="text" class="form-control" id="copyright" placeholder="Copyright" value="<?php echo $takeSetting['copyright']; ?>">
                          </div>

                          <div class="form-group">
                            <label for="mail">İletişim Mail </label><span class="text-danger"> *</span>
                            <input type="email" class="form-control" id="mail" placeholder="İletişim Mail" value="<?php echo $takeSetting['mail']; ?>">
                          </div>

                          <div class="form-group">
                            <label for="face_text">Facebook Açıklama </label><span class="text-danger"> *</span>
                            <input type="text" class="form-control" id="face_text" placeholder="Facebook Açıklama" value="<?php echo $takeSetting['face_text']; ?>">
                          </div>

                          <div class="form-group">
                            <label for="insta_text">Instagram Açıklama </label><span class="text-danger"> *</span>
                            <input type="text" class="form-control" id="insta_text" placeholder="Instagram Açıklama" value="<?php echo $takeSetting['insta_text']; ?>">
                          </div>

                          <div class="form-group">
                            <label for="header">Head Kodları </label><span class="text-danger"> *</span>
                            <textarea class="ckeditor" id="header" placeholder="Head Kodları"><?php echo $takeSetting['headerCode']; ?></textarea>
                          </div>

                          <div class="form-group">
                            <label for="notice">Duyuru </label><span class="text-danger"> *</span>
                            <textarea class="ckeditor" id="notice" placeholder="Duyuru"><?php echo $takeSetting['notice']; ?></textarea>
                          </div>

                          <div class="form-group">
                            <label for="kul_kos">Kullanım Koşulları </label><span class="text-danger"> *</span>
                            <textarea class="ckeditor" id="kul_kos" placeholder="Kullanım Koşulları"><?php echo $takeSetting['kullanim_kos']; ?></textarea>
                          </div>

                          <div class="form-group">
                            <label for="iade_kos">İade Koşulları </label><span class="text-danger"> *</span>
                            <textarea class="ckeditor" id="iade_kos" placeholder="İade Koşulları"><?php echo $takeSetting['iade_kos']; ?></textarea>
                          </div>

                          <div class="form-group">
                            <label for="giz_pol">Gizlilik Politikası </label><span class="text-danger"> *</span>
                            <textarea class="ckeditor" id="giz_pol" placeholder="Gizlilik Politikası"><?php echo $takeSetting['giz_pol']; ?></textarea>
                          </div>

                          <input type="button" class="btn btn-success mr-2" onclick="return saveSettings()" value="Ayarları Kaydet">
                        </form>
                      </div>
                    </div>
                  </div>

                  <div class="col-12 grid-margin">
                      <div id="goToMail"></div>
                        <div class="card" style="border:1px solid #161a27;">
                          <div class="card-body">
                            <h4 class="card-title">Mail Ayarları</h4>
                            <p class="card-description">
                              Mail ayarlarını buradan düzenleyebilirsiniz
                            </p>
                            <form class="forms-sample" method="post" id="formMail">

                              <div class="alert alert-dismissible alert-danger" id="dangerMail" style="display:none">
                               Yanlış Kulanıcı Adı Veya Şifre Girdiniz!
                              </div>

                              <div class="alert alert-dismissible alert-success" id="successMail" style="display:none">
                               Yanlış Kulanıcı Adı Veya Şifre Girdiniz!
                              </div>

                              <div class="form-group">
                                <label for="server">Mail Sunucu </label><span class="text-danger"> *</span>
                                <input type="text" class="form-control" id="server" placeholder="Mail Sunucusu" value="<?php echo $takeSetting['mail_server']; ?>">
                              </div>

                              <div class="form-group">
                                <label for="username_mail">Mail Kullanıcı Adı </label><span class="text-danger"> *</span>
                                <input type="email" class="form-control" id="username_mail" placeholder="Mail Kullanıcı Adı" value="<?php echo $takeSetting['mail_username']; ?>">
                              </div>

                              <div class="form-group">
                                <label for="password_mail">Mail Şifre </label><span class="text-danger"> *</span>
                                <input type="password" class="form-control" id="password_mail" placeholder="Mail Şifre " value="<?php echo $takeSetting['mail_password']; ?>">
                              </div>

                              <div class="form-group">
                                <label for="port">Mail Port </label><span class="text-danger"> *</span>
                                <input type="text" class="form-control" id="port" placeholder="Mail Port" value="<?php echo $takeSetting['mail_port']; ?>">
                              </div>


                              <input type="button" class="btn btn-success mr-2" onclick="return saveMail()" value="Ayarları Kaydet">
                            </form>
                          </div>
                        </div>
                      </div>

                  <div class="col-12 grid-margin">
                      <div id="goToPayment"></div>
                        <div class="card" style="border:1px solid #161a27;">
                          <div class="card-body">
                            <h4 class="card-title">Ödeme Ayarları</h4>
                            <p class="card-description">
                              Ödeme ayarlarını buradan düzenleyebilirsiniz
                            </p>
                            <form class="forms-sample" method="post" id="formPayment">

                              <div class="alert alert-dismissible alert-danger" id="dangerPayment" style="display:none">
                               Yanlış Kulanıcı Adı Veya Şifre Girdiniz!
                              </div>

                              <div class="alert alert-dismissible alert-success" id="successPayment" style="display:none">
                               Yanlış Kulanıcı Adı Veya Şifre Girdiniz!
                              </div>

                              <div class="form-group">
                                <div class="form-check form-check-flat">
                                    <label class="form-check-label">
                                      <input type="checkbox" <?php if($takeSetting['paywant']=='1'){echo "checked";} ?> class="form-check-input" id="paywantCheck"> Paywant
                                      <i class="input-helper"></i>
                                    </label>
                                </div>
                              </div>

                              <div class="form-group">
                                <div class="form-check form-check-flat">
                                    <label class="form-check-label">
                                      <input type="checkbox" <?php if($takeSetting['shopier']=='1'){echo "checked";} ?> class="form-check-input" id="shopierCheck"> Shopier
                                      <i class="input-helper"></i>
                                    </label>
                                </div>
                              </div>

                              <div class="form-group">
                                <div class="form-check form-check-flat">
                                    <label class="form-check-label">
                                      <input type="checkbox" <?php if($takeSetting['transfer']=='1'){echo "checked";} ?> class="form-check-input" id="transferCheck"> EFT/HAVALE
                                      <i class="input-helper"></i>
                                    </label>
                                </div>
                              </div>

                              <input type="button" class="btn btn-success mr-2" onclick="return savePayment()" value="Ayarları Kaydet">
                            </form>
                          </div>
                        </div>
                      </div>
            </div>
        </div>

        <!-- ticket end -->

        <!-- content-wrapper ends -->

<?php require_once('inc/footer.php'); ?>
