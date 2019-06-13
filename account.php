<?php require_once("inc/header.php"); ?>
<!-- Main variables *content* -->
<div class="inner-page">
  <section>
    <div class="container">
      <div class="row">
        <div class="col-lg">
          		  <div class="card bg-white">
            <div class="card-header">
              <div class="card-title">Hesap Detayları</div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="Kullanıcı Adı" class="control-label">Kullanici Adı</label>
                <input type="text" class="form-control" id="username" value="<?php echo $takeUserInfo['username']; ?>" readonly="">
              </div>

              <form class="pt-0" method="post" >

                <div class="alert alert-dismissible alert-danger" id="danger" style="display:none">
                  Şifreler Eşleşmiyor
                </div>
                <div class="alert alert-dismissible alert-success" id="success" style="display:none">
                  Şifreler Eşleşmiyor
                </div>

                  <div class="form-group">
                <label for="current" class="control-label">Şuanki Şifreniz</label>
                <input type="password" class="form-control" id="currentPass" name="pass_now">
              </div>
              <div class="form-group">
                <label for="new" class="control-label">Yeni Şifreniz</label>
                <input type="password" class="form-control" id="newPass" name="pass_new">
              </div>
              <div class="form-group">
                <label for="confirm" class="control-label">Tekrar Yeni Şifreniz</label>
                <input type="password" class="form-control" id="confirmPass" name="pass_newtwo">
              </div>
                <input type="button" onclick="return changePass()" class="btn btn-green" value="Şifre Değiştir">
            </form>
            </div>
          </div>
        </div>


          <div class="col-lg">
			<!-- <div class="card bg-white">
              <div class="card-header">
              	<div class="card-title">Saat Dilimi Ayarları</div>
            </div>

              <div class="card-body">
                <form class="pt-0" action="" method="post">
                  <div class="form-group">
                    <label for="timezone" class="control-label">Tarih</label>
                    <select name="SettingsFrom[timezone]" id="timezone" class="form-control">
                                            <option value="-43200">(UTC -12:00) Baker/Howland Island</option>
                                            <option value="-39600">(UTC -11:00) Niue</option>
                                            <option value="-36000">(UTC -10:00) Hawaii-Aleutian Standard Time, Cook Islands, Tahiti</option>
                                            <option value="-34200">(UTC -9:30) Marquesas Islands</option>
                                            <option value="-32400">(UTC -9:00) Alaska Standard Time, Gambier Islands</option>
                                            <option value="-28800">(UTC -8:00) Pacific Standard Time, Clipperton Island</option>
                                            <option value="-25200">(UTC -7:00) Mountain Standard Time</option>
                                            <option value="-21600">(UTC -6:00) Central Standard Time</option>
                                            <option value="-18000">(UTC -5:00) Eastern Standard Time, Western Caribbean Standard Time</option>
                                            <option value="-16200">(UTC -4:30) Venezuelan Standard Time</option>
                                            <option value="-14400">(UTC -4:00) Atlantic Standard Time, Eastern Caribbean Standard Time</option>
                                            <option value="-12600">(UTC -3:30) Newfoundland Standard Time</option>
                                            <option value="-10800">(UTC -3:00) Argentina, Brazil, French Guiana, Uruguay</option>
                                            <option value="-7200">(UTC -2:00) South Georgia/South Sandwich Islands</option>
                                            <option value="-3600">(UTC -1:00) Azores, Cape Verde Islands</option>
                                            <option value="0">(UTC) Greenwich Mean Time, Western European Time</option>
                                            <option value="3600">(UTC +1:00) Central European Time, West Africa Time</option>
                                            <option value="7200">(UTC +2:00) Central Africa Time, Eastern European Time, Kaliningrad Time</option>
                                            <option value="10800" selected="">(UTC +3:00) Moscow Time, East Africa Time, Arabia Standard Time</option>
                                            <option value="12600">(UTC +3:30) Iran Standard Time</option>
                                            <option value="14400">(UTC +4:00) Azerbaijan Standard Time, Samara Time</option>
                                            <option value="16200">(UTC +4:30) Afghanistan</option>
                                            <option value="18000">(UTC +5:00) Pakistan Standard Time, Yekaterinburg Time</option>
                                            <option value="19800">(UTC +5:30) Indian Standard Time, Sri Lanka Time</option>
                                            <option value="20700">(UTC +5:45) Nepal Time</option>
                                            <option value="21600">(UTC +6:00) Bangladesh Standard Time, Bhutan Time, Omsk Time</option>
                                            <option value="23400">(UTC +6:30) Cocos Islands, Myanmar</option>
                                            <option value="25200">(UTC +7:00) Krasnoyarsk Time, Cambodia, Laos, Thailand, Vietnam</option>
                                            <option value="28800">(UTC +8:00) Australian Western Standard Time, Beijing Time, Irkutsk Time</option>
                                            <option value="31500">(UTC +8:45) Australian Central Western Standard Time</option>
                                            <option value="32400">(UTC +9:00) Japan Standard Time, Korea Standard Time, Yakutsk Time</option>
                                            <option value="34200">(UTC +9:30) Australian Central Standard Time</option>
                                            <option value="36000">(UTC +10:00) Australian Eastern Standard Time, Vladivostok Time</option>
                                            <option value="37800">(UTC +10:30) Lord Howe Island</option>
                                            <option value="39600">(UTC +11:00) Srednekolymsk Time, Solomon Islands, Vanuatu</option>
                                            <option value="41400">(UTC +11:30) Norfolk Island</option>
                                            <option value="43200">(UTC +12:00) Fiji, Gilbert Islands, Kamchatka Time, New Zealand Standard Time</option>
                                            <option value="45900">(UTC +12:45) Chatham Islands Standard Time</option>
                                            <option value="46800">(UTC +13:00) Samoa Time Zone, Phoenix Islands Time, Tonga</option>
                                            <option value="50400">(UTC +14:00) Line Islands</option>
                                          </select>
                  </div>


                  <button type="submit" class="btn btn-green">Kaydet</button>
                </form>
              </div>
           </div> -->

            <div class="card bg-white">
                          <div class="card-header">
              <div class="card-title">API Key Ayarları</div>
            </div>

            	<div class="card-body">
                                  <form class="pt-0" action="" method="post">
                                    <div class="alert alert-dismissible alert-danger" id="dangerAPI" style="display:none">
                                      Şifreler Eşleşmiyor
                                    </div>
                                    <div class="alert alert-dismissible alert-success" id="successAPI" style="display:none">
                                      Şifreler Eşleşmiyor
                                    </div>
              <div class="form-group">
                <label for="key" class="control-label">API key</label>
                <input type="text" class="form-control" id="api_key" value="<?php echo $takeUserInfo['apikey']; ?>" readonly="">
              </div>


              <input type="button" onclick="return newAPIKey()" class="btn btn-green" value="API Key değiştir">
            </form>
              </div>
            </div>
      		</div>
      </div>
    </div>
  </section>
</div>
<?php require_once("inc/footer.php"); ?>
